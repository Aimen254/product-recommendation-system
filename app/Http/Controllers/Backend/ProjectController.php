<?php

namespace App\Http\Controllers\Backend;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
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
        $account = getActiveAccount();
        $projects = Project::where('account_id', $account->id)->latest()->paginate(8);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try {
            $account = getActiveAccount();
            $validated = $request->validated();
            $project = Project::create([
                'uuid' => Str::uuid(),
                'account_id' => $account->id,
                'title' => $validated['project_title'],
                'description' => $validated['project_description'],
            ]);

            if ($request->has('img')) {

                $image = $request->file('img');
                $project->update(['image' => time() . $image->getClientOriginalName()]);
                $image->storeAs('public/images', time() . $image->getClientOriginalName());
            }
            return response()->json([
                'success' => 200,
                'message' => 'Project Added Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function edit($account, $uuid)
    {
        $project = Project::where('uuid', $uuid)->firstOrFail();
        return view('projects.edit', compact('project'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $account, $uuid)
    {
        try {
            $project = Project::where('uuid', $uuid)->firstOrFail();
            $currentImage = $project->image;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $filename = time() . $image->getClientOriginalName();
                $tmp_path = $image->storeAs('public/tmp', $filename);
                Storage::delete('public/images/' . $currentImage);
                Storage::move($tmp_path, 'public/images/' . $filename);
                $project->image = $filename;
            }
            Project::where('uuid', $uuid)->update([
                'image' => $project->image
            ]);            
            $validated = $request->validated();
            Project::where('uuid', $uuid)->update([
                'title' => $validated['project_title'],
                'description' => $validated['project_description'],
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Project updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $uuid)
    {
        try {
            $project = Project::where('uuid', $uuid)->firstOrFail();
            $project->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Project deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function fetchProjects(Request $request)
    {
        if ($request->ajax()) {
            $account = getActiveAccount();
            $projects = Project::where('account_id', $account->id)->latest()->paginate(8);
            $search = false;
            return view('projects.partials.child_view', compact('projects', 'search'))->render();
        }
    }

    public function search(Request $request)
    {
        $account = getActiveAccount();
        $projects = Project::where('account_id', $account->id)->where('title', 'LIKE', '%' . $request->search . '%')->paginate(8);
        $search = true;
        return view('projects.partials.child_view', compact('projects', 'search'))->render();
    }
}
