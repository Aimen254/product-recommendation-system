<?php

namespace App\Http\Controllers\Backend;

use App\Models\Style;
use App\Models\Advice;
use App\Models\Project;
use App\Models\GoogleFont;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StylesRequest;

class StylesController extends Controller
{
    public function index()
    {
        $project = Project::where('uuid', currentProject())->first();
        $fonts = GoogleFont::all();
        $style = Style::where([
            'project_id' => $project->id,
            'page' => 'general',
        ])->first();
        $advices = Advice::where('account_id',getActiveAccount()->id)->get();
        return view('styles.index')->with([
            'style' => $style,
            'fonts' => $fonts,
            'advices' => $advices
        ]);
    }

    public function welcome()
    {
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $style = Style::where([
            'project_id' => $project->id,
            'page' => 'welcome'])->first();
        return view('styles.welcome')->with('style', $style);
    }

    public function question()
    { 
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $style = Style::where([
            'project_id' => $project->id,
            'page' => 'question']
        )->first();
        return view('styles.questions')->with('style', $style);
    }

    public function advice()
    {
        $project = Project::where('uuid', currentProject())->firstOrFail();
        $style = Style::where([
            'project_id' => $project->id,
            'page' => 'advice'])->first();
        return view('styles.advice')->with('style', $style);
    }

    public function updateStyles(StylesRequest $request)
    {
        try {
            $validated = $request->validated();
            $project = Project::where('uuid', currentProject())->firstOrFail();
            $style = Style::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'page' => $request->page_name,
                ],
                [
                    'default_advice' =>$request->default_advice,
                    'general_background' => $request->general_background_color,
                    'font' => $request->font,
                    'title_color' => $request->title_color,
                    'description_color' => $request->description_color,
                    'button_background_color' => $request->button_background_color,
                    'button_text_color' => $request->button_text_color,
                ]);
            if ($request->has('image')) {
                $file = $request->file('image');
                $file->storeAs('public/images', $request->file('image')->getClientOriginalName());
                $style->update(['image' => $request->file('image')->getClientOriginalName()]);
            } elseif($request->remove_image == 1) {
                $style->update(['image' => null]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'General Styles updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
