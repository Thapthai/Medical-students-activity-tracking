<?php

namespace App\Http\Controllers;

use App\Models\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /// create Index
    public function index()
    {
        $data['member'] = Member::orderBy('id', 'desc')->paginate(5);
        return view('member.index', $data);
    }

    // create resource 
    public function create()
    {
        return view('member.create');
    }

    //store for admin
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'subject_id' => 'required',
            'section' => 'required',
        ]);
        $member = new Member();
        $member->user_id = $request->user_id;
        $member->subject_id = $request->subject_id;
        $member->section = $request->section;

        $member->save();
        return redirect()->route('member.index')->with('success', 'infornarion has been store');
    }
}
