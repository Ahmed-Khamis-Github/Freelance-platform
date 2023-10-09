<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('web')->user();

        $proposals = $user->proposals()
            ->with('project')
            ->latest()
            ->paginate();

         return view('freelancer.proposals.index',compact('proposals')) ;

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
 
        if($project->status !== 'open')
        {
            return redirect()->back()->with('info','you cannot submit a proposal to this project') ;
        }
        $user= Auth::user() ;

        
        $proposal= new Proposal() ;
        $units=[
            'day'=>'Day' ,
            'week'=>'week',
            'month'=>'Month'
        ] ;
        return view('freelancer.proposals.create',compact('proposal','project','units')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$project_id)
    {
        $project=Project::findOrFail($project_id) ;

        if($project->status !== 'open')
        {
            return redirect()->back()->with('info','you cannot submit a proposal to this project') ;
        }

        $user= Auth::user() ;

        if($user->proposedProjects()->find($project->id))
        {
            return redirect()->back()->with('error','you already submitted a proposal to this project') ;
        }
        $request->merge([
            'project_id'=>$project_id
        ]) ;
 

        $user=Auth::guard('web')->user() ;
        $proposal= $user->proposals()->create($request->all()) ;
        $project->user->notify(new NewProposalNotification($proposal,$user) ) ;

        return redirect()->route('freelancer.proposals.index')->with('success','Proposal has been submited') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
