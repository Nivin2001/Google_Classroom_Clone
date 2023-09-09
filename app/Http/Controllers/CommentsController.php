<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string'],
            'id' => ['required', 'int'],
            'type' => ['required', 'in:classwork,post'],
        ]);
        Auth::user()->comments()->create([
            'commentable_id' => $request->input('id'),
            'commentable_type' => $request->input('type'),

            'content' => $request->input('content'), // Provide the content of the comment
            'ip' => $request->input('ip'),
            'user_agent' => $request->header('user-agent')
        ]);


        return back()->with('success', 'Comments added');
    }


}
