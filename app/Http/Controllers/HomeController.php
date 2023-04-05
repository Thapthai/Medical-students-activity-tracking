<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $UserData =  auth()->user()->name;


        $subject = DB::select("SELECT subjects.subject_name , subjects.subject_id ,subjects.section ,subjects.details , subjects.owner ,subjects.id
                               FROM users 
                               JOIN members ON users.user_id = members.user_id 
                               JOIN subjects ON members.subject_id=subjects.id 
                               WHERE users.name =?;", [$UserData]);

        $activity = DB::select("SELECT activities.id,activities.type,activities.activity_name,subjects.subject_name,subjects.section,subjects.subject_id,activities.owner,activities.duedate
                                FROM activities
                                LEFT JOIN tasks ON activities.id = tasks.activity_id
                                LEFT JOIN subjects ON activities.subject_id = subjects.id
                                LEFT JOIN members ON members.subject_id = subjects.id
                                LEFT JOIN users ON members.user_id = users.user_id
                                WHERE users.name = ?
                            EXCEPT
                                SELECT activities.id,activities.type,activities.activity_name,subjects.subject_name,subjects.section,subjects.subject_id,activities.owner,activities.duedate
                                FROM activities
                                RIGHT JOIN tasks ON activities.id=tasks.activity_id
                                LEFT JOIN subjects ON activities.subject_id = subjects.id
                                LEFT JOIN members ON members.subject_id = subjects.id
                                LEFT JOIN users ON members.user_id = users.user_id
                                WHERE users.name = ?", [$UserData, $UserData]);

        $newactivity = DB::select("SELECT activities.updated_at,activities.id, activities.type, activities.activity_name,activities.duedate ,subjects.subject_name ,subjects.section ,activities.detail , subjects.owner ,subjects.subject_id
                                    FROM activities 
                                    JOIN subjects ON activities.subject_id = subjects.id 
                                    JOIN members ON subjects.id = members.subject_id 
                                    JOIN users ON users.user_id = members.user_id 
                                    WHERE users.name = ?
                                    Order by activities.updated_at DESC limit 2", [$UserData]);

        $submitted = DB::select("SELECT tasks.task_owner,tasks.updated_at,activities.activity_name 
                                 FROM tasks JOIN activities ON activities.id = tasks.activity_id 
                                 WHERE tasks.task_owner= ? ORDER BY tasks.updated_at DESC;", [$UserData]);

        $user = auth()->user()->is_admin;
        if ($user == '1') {
            return view('adminHome', compact('activity', 'subject', 'newactivity', 'submitted'));
        }
        return view('home', compact('activity', 'subject', 'newactivity', 'submitted'));
    }

    public function adminHome()
    {
        $UserData =  auth()->user()->name;



        $activity = DB::select("SELECT activities.id , activities.activity_name ,activities.section ,activities.type,activities.duedate ,subjects.subject_id,subjects.subject_name ,activities.owner
                                FROM `activities` JOIN subjects ON subjects.id = activities.subject_id 
                                WHERE activities.owner= ? 
                                Order by activities.duedate asc", [$UserData]);

        $newactivity = DB::select("SELECT activities.id , activities.activity_name ,activities.section ,activities.type,activities.duedate ,subjects.subject_id,subjects.subject_name 
                                    FROM `activities` 
                                    JOIN subjects ON subjects.id = activities.subject_id
                                    WHERE activities.owner=? 
                                    Order by activities.duedate asc LIMIT 1;", [$UserData]);

        $subject = DB::select("SELECT subjects.id,subjects.owner,subjects.subject_name,subjects.subject_id ,subjects.details 
                                FROM subjects 
                                JOIN users on users.name = subjects.owner 
                                WHERE users.name = ?", [$UserData]);
        $submitted = DB::select("SELECT tasks.task_owner,tasks.updated_at,activities.activity_name ,activities.owner,tasks.task_owner
                                FROM tasks JOIN activities ON activities.id = tasks.activity_id 
                                WHERE activities.owner= ? ORDER BY tasks.updated_at DESC limit 2", [$UserData]);

        $subject = DB::select("SELECT * FROM subjects WHERE owner=? ORDER BY subject_name ASC", [$UserData]);

        return view('adminHome', compact('activity', 'subject', 'newactivity', 'submitted'));
    }
}
