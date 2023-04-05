<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    // create Index
    public function index()
    {
        $data['subject'] = Subject::orderBy('id', 'desc')->paginate(5);
        return view('subject.index', $data);
    }

    // create resource 
    public function create()
    {
        return view('subject.create');
    }

    //store for admin
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'subject_name' => 'required',
            'section' => 'required',
            'details' => 'required',
            'owner' => 'required',
            'user_id' => 'required'
        ]);
        $subject = new Subject;
        $subject->subject_id = $request->subject_id;
        $subject->subject_name = $request->subject_name;
        $subject->section = $request->section;
        $subject->details = $request->details;
        $subject->owner = $request->owner;
        $subject->user_id = $request->user_id;
        $subject->save();
        return redirect()->route('subject.index')->with('success', 'infornarion has been store');
    }

    public function addstudent($id)
    {
        $subject = DB::select("SELECT * FROM subjects WHERE id=? ORDER BY subject_name ASC", [$id]);
        return view('subject.add', compact('subject'));
    }

    public function general($id)
    {
        $UserData =  auth()->user()->name;
        $subject = DB::select("SELECT * FROM subjects WHERE id=? ORDER BY subject_name ASC", [$id]);
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
        $activity = DB::select("SELECT activities.id,activities.type,activities.activity_name,subjects.subject_name,subjects.section,subjects.subject_id,activities.owner,activities.duedate,activities.detail,activities.point
                                FROM activities
                                LEFT JOIN tasks ON activities.id = tasks.activity_id
                                LEFT JOIN subjects ON activities.subject_id = subjects.id
                                LEFT JOIN members ON members.subject_id = subjects.id
                                LEFT JOIN users ON members.user_id = users.user_id
                                WHERE users.name = ? AND subjects.id=?
                                EXCEPT
                                SELECT activities.id,activities.type,activities.activity_name,subjects.subject_name,subjects.section,subjects.subject_id,activities.owner,activities.duedate,activities.detail,activities.point
                                FROM activities
                                RIGHT JOIN tasks ON activities.id=tasks.activity_id
                                LEFT JOIN subjects ON activities.subject_id = subjects.id
                                LEFT JOIN members ON members.subject_id = subjects.id
                                LEFT JOIN users ON members.user_id = users.user_id
                                WHERE users.name = ? AND subjects.id=?", [$UserData, $id, $UserData, $id]);
        $submitted = DB::select("SELECT tasks.id, tasks.updated_at,tasks.point,subjects.subject_id,subjects.subject_name,subjects.section,activities.activity_name, activities.duedate ,activities.type
                                FROM tasks 
                                JOIN activities ON activities.id = tasks.activity_id 
                                JOIN subjects ON activities.subject_id = subjects.id
                                WHERE tasks.task_owner=? AND subjects.id=? ORDER BY updated_at DESC", [$UserData, $id]);


        $activityforteacher = DB::select("SELECT activities.activity_name , activities.type ,activities.detail,activities.point,activities.duedate 
                                FROM `activities` JOIN subjects ON subjects.id = activities.subject_id 
                                WHERE activities.owner= ? AND subjects.id = ?
                                Order by activities.updated_at asc", [$UserData, $id]);

        $user = auth()->user()->is_admin;
        if ($user == '1') {



            return view('subject.teachergeneral', compact('subject', 'activityforteacher', 'members', 'submitted'));
        }
        return view('subject.studentgeneral', compact('subject', 'activity', 'members', 'submitted'));
    }
}
