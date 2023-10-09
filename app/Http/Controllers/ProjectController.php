<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects= Project::latest()->paginate() ;

        return view('projects.index',compact('projects')) ;
    }

    public function show(Project $project)
    {
        $units=[
            'day'=>'Day' ,
            'week'=>'week',
            'month'=>'Month'
        ] ;
         return view('projects.show',compact('project','units')) ;
    }
}
