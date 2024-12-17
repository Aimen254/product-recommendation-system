<?php

namespace App\Http\Controllers\Backend;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuestionLogic;
use Illuminate\Http\JsonResponse;
use App\Models\NumberQuestionLogic;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionLogicRequest ;

class QuestionLogicController extends Controller
{
    public function index($account, $project, $uuid)
    {   
        $currentQuestion = Question::where('uuid', $uuid)->firstOrFail();
        $numberLogics = NumberQuestionLogic::where('selected_question_id',$currentQuestion->id)->get();
       
        $questions = getActiveProject()->questions()->get()->slice(1);
        
        $logicConditions = QuestionLogic::where('question_id', $currentQuestion->id)->get();
        if($currentQuestion->question_type == 'Images' || $currentQuestion->question_type == 'MCQS' || $currentQuestion->question_type == null){
            return view('question_logic.create', compact('questions', 'currentQuestion', 'logicConditions', 'numberLogics'));
        }
        elseif($currentQuestion->question_type == 'Numeric'){
            return view('question_logic.numeric' , compact('questions', 'currentQuestion', 'logicConditions', 'numberLogics'));
        }
        elseif($currentQuestion->question_type == 'Email'){
            return view('question_logic.email' , compact('questions', 'currentQuestion', 'logicConditions', 'numberLogics'));
        }
        elseif($currentQuestion->question_type == 'Text'){
            return view('question_logic.text' , compact('questions', 'currentQuestion', 'logicConditions', 'numberLogics'));
        }
    }

    public function create()
    {
        return view('question_logic.create');
    }

    public function store(Request $request)
    {
        try {
            foreach (array_combine($request->answer, $request->question) as $answer => $question) {
                QuestionLogic::updateOrCreate([
                    'selected_answer_id' => $answer,
                ], [
                    'question_id' => $request->selected_question_id,
                    'next_question_id' => $question,
                ]);
            }
            return response()->json([
                'success' => 200,
                'message' => 'Question Logic Set successfully',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createMultipleQuestionLogic(Request $request){
        try {
            NumberQuestionLogic::where('selected_question_id' , $request->selected_question_id)->delete();
            foreach($request->question as $question){
            NumberQuestionLogic::create([
                'uuid' => Str::uuid(),
                'selected_question_id' => $request->selected_question_id,
                'next_question_id' => $question,
            ]);
        }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Question Logic Created successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createNumberQuestionLogic(Request $request){
        
        try {
        $this->validate($request, [
             'data.details.*.logic' => 'required',
            'data.details.*.question' => 'required',
        ]);
        if($request->_perform == 'edit')
        {
           NumberQuestionLogic::where('selected_question_id',$request->question_id)->delete();
        }
        foreach ($request->data['details']  as $val ) {
           
                    NumberQuestionLogic::Create([   
                        'uuid' => Str::uuid(),
                        'selected_question_id' => $request->selected_question_id,
                        'next_question_id' =>$val['question'],
                        'firstValue' => $val['value'],
                        'firstOperator' =>$val['logic'],
                    ]);     
       }
                        return response()->json([
                            'success' => 200,
                            'message' => 'Question Number Logic Set successfully',
                        ], JsonResponse::HTTP_OK);
        }catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createEmailQuestionLogic(Request $request){
        NumberQuestionLogic::where('selected_question_id' , $request->selected_question_id)->delete();
        foreach($request->question as $question){
        NumberQuestionLogic::create([
            'uuid' => Str::uuid(),
            'selected_question_id' => $request->selected_question_id,
            'next_question_id' => $question,
        ]);
    }
    }

    public function editEmailQuestionLogic(Request $request){
        foreach($request->question as $question){
            NumberQuestionLogic::updateOrCreate([
                'selected_question_id' => $request->selected_question_id
            ],[
            'uuid' => Str::uuid(),
            'next_question_id' => $question,
        ]);
    }
    }

    public function createTextQuestionLogic(Request $request){
        NumberQuestionLogic::where('selected_question_id' , $request->selected_question_id)->delete();
        foreach($request->question as $question){
            NumberQuestionLogic::create([
            'uuid' => Str::uuid(),
            'selected_question_id' => $request->selected_question_id,
            'next_question_id' => $question,
        ]);
    }
    }
    public function editTextQuestionLogic(Request $request){
        $selectedQuestion =  NumberQuestionLogic::where('selected_question_id' , $request->selected_question_id)->first();
        foreach($request->question as $question){
            $selectedQuestion ->update([
            'selected_question_id' => $request->selected_question_id,
            'next_question_id' => $question,
        ]);
    }
    }

    public function delete(Request $request, $account, $project, $id)
    {
        try {
            if ($id != 0) { 
                $logic = QuestionLogic::where('id', $id)->first();
                $logic->delete();
            }

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Logic Removed successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNewLogic(Request $request){
        $questions = getActiveProject()->questions()->get()->slice(1);
        return view('question_logic.add_logic', compact('questions'))->render();
    }
}
