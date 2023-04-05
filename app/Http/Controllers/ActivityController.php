<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    // create Index
    public function index()
    {
        $data['activity'] = Activity::orderBy('id', 'desc')->paginate(5);
        return view('activity.index', $data);
    }

    // create resource 
    public function create()
    {
        return view('activity.create');
    }

    //store 
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
            'subject_id' => 'required',
            'section' => 'required',
            'owner' => 'required',
            'type' => 'required',
            'point' => 'required',
            'detail' => 'required',
            'duedate' => 'required',
        ]);
        $activity = new Activity;
        $activity->activity_name = $request->activity_name;
        $activity->subject_id = $request->subject_id;
        $activity->section = $request->section;
        $activity->owner = $request->owner;
        $activity->type = $request->type;
        $activity->point = $request->point;
        $activity->detail = $request->detail;
        $activity->duedate = $request->duedate;
        $activity->save();
        return redirect()->route('home');
    }
    public function addactivity($id)
    {
        $subject = DB::select("SELECT * FROM subjects WHERE id=? ORDER BY subject_name ASC", [$id]);
        return view('activity.add', compact('subject'));
    }

    public function detail($id)
    {
        $activity = DB::select("SELECT activities.point, activities.detail, activities.id, activities.activity_name ,activities.type , activities.duedate,subjects.subject_id,subjects.subject_name ,subjects.section 
                                FROM `activities` 
                                JOIN subjects on activities.subject_id = subjects.id 
                                WHERE activities.id=?", [$id]);

        $activitys = DB::select("SELECT activities.activity_name , activities.type ,activities.detail,activities.point,activities.duedate 
                                 FROM `activities` 
                                 inner JOIN subjects 
                                 ON subjects.id=activities.subject_id 
                                 WHERE subjects.id=? 
                                 ORDER BY duedate ASC;", [$id]);

        $members = DB::select("SELECT users.user_id,users.name
                               FROM users 
                               JOIN members 
                               ON users.user_id = members.user_id 
                               JOIN subjects 
                               ON members.subject_id=subjects.id 
                               WHERE subjects.id = ?;", [$id]);

        $user = auth()->user()->is_admin;

        if ($user == '1') {
            return view('activity.activity', compact('activity', 'activitys', 'members'));
        }
        return view('activity.activity', compact('activity', 'activitys', 'members'));
    }

    public function task($id) // ac id
    {
        $task = DB::select("SELECT tasks.id,tasks.task_owner ,tasks.updated_at ,tasks.decision, activities.point,activities.activity_name, activities.type ,subjects.subject_id ,subjects.subject_name ,subjects.section,activities.duedate
        
    FROM `tasks` 

        JOIN activities ON activities.id = tasks.activity_id 
        JOIN subjects ON subjects.id = activities.subject_id
        WHERE activity_id = ?", [$id]);

        $user = auth()->user()->is_admin;

        if ($user == '1') {
            return view('activity.task', compact('task'));
        }
        return view('activity.task', compact('task'));
    }
}
