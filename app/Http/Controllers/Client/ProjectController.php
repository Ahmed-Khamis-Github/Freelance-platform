<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $projects = $user->projects()->with('category.parent', 'tags')->paginate();


        return view('client.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Project::types();
        $categories = $this->categories();
        $tags = '';

        return view('client.projects.create', compact('project', 'types', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $user = $request->user();


        $data = $request->except('attachments');
        $data['attachments'] = $this->uploadAttachments($request);

        $project = $user->projects()->create($data);

        $tags = explode(',', $request->input('tags'));

        $project->syncTags($tags);



        return redirect()->route('client.projects.index')->with('success', 'Project Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $projects = $user->projects()->findOrFail($id);

        return view('client.projects.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $project = $user->projects()->findOrFail($id);
        $types = Project::types();
        $categories = $this->categories();

        $tags = $project->tags()->pluck('name')->toArray();
        $tags = implode(',', $tags);



        return view('client.projects.edit', compact('project', 'types', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $user = Auth::user();
        $projects = $user->projects()->findOrFail($id);
        $data = $request->except('attachments');

        $attachments = $projects->attachments ?? [];

        $requestImg = $this->uploadAttachments($request) ?? [];



        if ($request->attachments) {
            $data['attachments'] = array_merge($attachments, $requestImg);
        }



        $projects->update($data);

        $tags = explode(',', $request->input('tags'));

        $projects->syncTags($tags);

        return redirect()->route('client.projects.index')->with('success', 'Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $project = $user->projects()->findOrFail($id);


        $project->delete();

        foreach ($project->attachments as $file) {
            Storage::disk('public')->delete($file);
        }


        return redirect()->route('client.projects.index')->with('success', 'Project Deleted');
    }

    protected function categories()
    {
        return Category::all();
    }


    protected function uploadAttachments(Request $request)
    {
        if (!$request->hasFile('attachments')) {
            return;
        }
        $files = $request->file('attachments');
        $attachemnts = [];
        foreach ($files as $file) {
            if ($file->isValid()) {
                $path = $file->store('/attachments', [
                    'disk' => 'uploads',
                ]);

                $attachemnts[] = $path;
            }
        }

        return $attachemnts;
    }
}
