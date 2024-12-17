<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProjectResponse;
use App\Http\Controllers\Controller;
use App\Models\ProjectResponseAnswer;

class ResponseController extends Controller
{
    public function index(){
        $responses = ProjectResponse::where('advice_id', '!=', null)->pluck('id');
        $responseAnswer = ProjectResponseAnswer::select('question','answer')->whereIn('project_response_id', $responses)->get();
        return response()->json($responseAnswer);
    }
}
