<?php

namespace App\Http\Controllers\Backend;

use App\Models\Advice;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProjectResponse;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\ProjectResponseAnswer;

class ResponseController extends Controller
{
    public function index()
    {
        $project = getActiveProject();
        $account = getActiveAccount();
        $responses = ProjectResponse::where('project_id', $project->id)->latest()->get();
        $advices = Advice::where('account_id', $account->id)->latest()->get();
        return view('responses.index', compact('responses','advices'));
    }
    public function getResponse(Request $request)
    {
        if ($request->ajax()) {
            $project = getActiveProject();

            $response = ProjectResponse::query();
            $response->when(request('advice'), function ($res) {
                return $res->where(['advice_id' => request('advice') , 'finished' => 1]);
            });

            $response = $response->where(['project_id' => $project->id , 'finished' => 1])->latest()->get();
            return DataTables::of($response)
                ->addColumn('date', function ($response) {
                    $date = Carbon::parse($response->created_at)->isoFormat('D MMM YYYY , h:mm:s A');
                    return $date;
                })->addColumn('view', function ($response) {
                return '<a href=" ' . route('response.answer', [currentAccount(), currentProject(), $response->uuid]) . ' "><em class="icon ni ni-eye" style="font-size:20px;"></em>';
            })->addColumn('advice', function ($response) {
                return $response->advice ? $response->advice->title : '';
            })->rawColumns(['date', 'view', 'advice'])->make(true);
        }
    }

    public function responseAnswer($account, $project, $uuid)
    {
        return view('responses.response_details')->with(['response_id' => $uuid]);
    }

    public function responseDataTable(Request $request, $account, $project, $uuid)
    {
        $account = getActiveAccount();
        if ($request->ajax()) {
            $response = ProjectResponse::where('uuid', $uuid)->firstOrFail();
            $project = getActiveProject();
            $response = ProjectResponseAnswer::where('project_response_id', $response->id)->get();
            return DataTables::of($response)->addColumn('answer', function ($response) {
                $answers = Answer::where('id', $response->answer_id)->get();
                foreach($answers as $answer){

                   if($answer->answer_type == 'image'){
                        return $answer->image_description;
                    }
                    else{
                        return $response->answer;
                    }
                }
            })->rawColumns(['answer'])->make(true);
        }
    }
}
