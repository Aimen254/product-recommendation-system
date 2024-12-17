<?php

namespace App\Http\Controllers\Backend;

use App\Models\Advice;
use App\Models\Project;
use App\Models\GoogleFont;
use App\Models\ProjectSetting;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectSettingsRequest;

class ProjectSettingController extends Controller
{
    public function index()
    {
        $project = Project::where('uuid', currentProject())->first();
        $fonts = GoogleFont::all();
        $advices = Advice::where('account_id', getActiveAccount()->id)->get();
        return view('project_settings.index')->with([
            'fonts' => $fonts,
            'advices' => $advices,
        ]);
    }

    public function welcome()
    {
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $ProjectSetting = ProjectSetting::where([
            'project_id' => $project->id])->first();
            $fonts = GoogleFont::all();
        return view('project_settings.welcome')->with([
            'ProjectSetting' => $ProjectSetting,
            'fonts' => $fonts
        ]);
    }

    public function question()
    {
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $ProjectSetting = ProjectSetting::where([
            'project_id' => $project->id,
        ])->first();
        $fonts = GoogleFont::all();
        return view('project_settings.questions')->with([
            'ProjectSetting' => $ProjectSetting,
            'fonts' => $fonts
        ]);
    }

    public function advice()
    {
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $ProjectSetting = ProjectSetting::where([
            'project_id' => $project->id,
        ])->first();
        $fonts = GoogleFont::all();
        return view('project_settings.advice')->with([
            'ProjectSetting' => $ProjectSetting,
            'fonts' => $fonts
        ]);
    }

    public function updateGeneralSettings(ProjectSettingsRequest $request)
    {
        try {
            $validated = $request->validated();
            $project = Project::where('uuid', currentProject())->firstOrFail();
            foreach ($request->all() as $key => $value) {
                $ProjectSetting = ProjectSetting::updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'key' => $key,
                    ],
                    [
                        'value' => $value,
                    ]);
            }
            if ($request->has('home_icon')) {
                $file = $request->file('home_icon');
                $file->storeAs('public/images', $file->getClientOriginalName());
                $ProjectSetting->update(['key' => 'home_icon', 'value' => $file->getClientOriginalName()]);
            }
            if ($request->has('image')) {
                $file = $request->file('image');
                $file->storeAs('public/images', $request->file('image')->getClientOriginalName());
                $ProjectSetting->update(['key' => 'image', 'value' => $request->file('image')->getClientOriginalName()]);
            } elseif ($request->remove_image == 1 && !($request->file('image'))) {
                $ProjectSetting->where('key','image')->update(['key' => 'image', 'value' => null]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Project Settings Updated Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function newQuestion(){
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $ProjectSetting = ProjectSetting::where([
            'project_id' => $project->id,
        ])->first();
        $fonts = GoogleFont::all();
        return view('project_settings.new_question')->with([
            'ProjectSetting' => $ProjectSetting,
            'fonts' => $fonts
        ]);
    }
}