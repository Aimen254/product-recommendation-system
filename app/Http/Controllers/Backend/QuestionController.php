<?php

namespace App\Http\Controllers\Backend;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\McqIsMultipleAdviceLogic;
use App\Models\NumberQuestionLogic;
use App\Models\QuestionLogic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = getActiveProject();
        $questions = Question::where('project_id', $project->id)->latest()->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($account, $project, QuestionRequest $request)
    {
        try {
            $request->is_multiple == null ? $isMultiple = "0" : $isMultiple = "1";
            $request->option == null ? $option = "required" : $option = "optional";
            $project = getActiveProject();
            $account = getActiveAccount();
            $validated = $request->validated();
            $question = Question::create([
                'title' => $validated['title'],
                'secondary_title' => $validated['secondary_title'],
                'uuid' => Str::uuid(),
                'project_id' => $project->id,
                'description' => $validated['description'],
                'question_type' => $request->answer_type,
                'choice' => $option,
                'is_multiple' => $isMultiple,
                'order' => Question::where('project_id', $project->id)->max('order') + 1,
            ]);
            if ($request->answer) {
                if ($request->type == 'image') {
                    $index = 0;
                    foreach ($request->answer as $answer) {
                        $file = $answer;
                        $image = time() . $index . $file->getClientOriginalName();
                        $file->storeAs('public/images', time() . $index . $file->getClientOriginalName());
                        $question->answers()->create([
                            'answer' => $image,
                            'image_description' => $request->image_description[$index],
                            'uuid' => Str::uuid(),
                            'answer_type' => $request->type,
                        ]);
                        $index++;
                    }
                } else {
                    foreach ($request->answer as $answer) {
                        $question->answers()->create([
                            'answer' => substr($answer, 0, 40),
                            'uuid' => Str::uuid(),
                            'answer_type' => $request->type,
                        ]);
                    }
                }
            }
            return response()->json([
                'success' => 200,
                'message' => 'Question Added Successfully',
                'model' => ['uuid' => $question->uuid, 'id' => $question->id],
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
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
    public function edit($account, $project, $uuid)
    {
        $question = Question::where('uuid', $uuid)->firstOrFail();
        $answer = $question->answers->first();
        if ($question->question_type == 'Images') {
            return view('questions.edit_image_type', compact('question'))->render();
        } elseif ($question->question_type == 'MCQS' || $question->question_type == null) {
            return view('questions.edit', compact('question'))->render();
        } elseif ($question->question_type == 'Numeric') {
            return view('questions.edit_numeric_type', compact('question'))->render();
        } elseif ($question->question_type == 'email' || $question->question_type == 'Email') {
            return view('questions.edit_email_type', compact('question'))->render();
        } elseif ($question->question_type == 'Text' || $question->question_type == 'text') {
            return view('questions.edit_text_type', compact('question'))->render();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $account, $project, $uuid)
    {
        try {
            $request->is_multiple == null ? $isMultiple = '0' : $isMultiple = '1';
            $request->option == null ? $option = "required" : $option = "optional";
            $question = Question::where('uuid', $uuid)->firstOrFail();

            $question->update([
                'title' => $request->title,
                'secondary_title' => $request->secondary_title,
                'description' => $request->description,
                'choice' => $option,
                'is_multiple' => $isMultiple,
            ]);
            $answers = [];
            if ($request->hasFile('answer') && $request->image_description) {
                $index = 0;
                foreach ($request->answer as $key => $value) {
                    $answer = Answer::where(['id' => $key, 'question_id' => $question->id])->first();
                    if ($answer) {
                        $file = $value;
                        $image = time() . $index . $file->getClientOriginalName();
                        $file->storeAs('public/images', time() . $index . $file->getClientOriginalName());
                        $answer->update([
                            'answer' => $image,
                            'image_description' =>  $request->image_description[$key],
                        ]);
                        $index++;
                    } else {
                        $file = $value;
                        $image = time() . $index . $file->getClientOriginalName();
                        $file->storeAs('public/images', time() . $index . $file->getClientOriginalName());
                        $answer = Answer::create([
                            'answer' => $image,
                            'uuid' => Str::uuid(),
                            'question_id' => $question->id,
                            'answer_type' => $request->type,
                            'image_description' =>  $request->image_description[$key],
                        ]);
                        $index++;
                    }
                    array_push($answers, $answer->id);
                }
            } elseif ($request->hasFile('answer')) {
                foreach ($request->answer as $key => $value) {
                    $answer = Answer::where(['id' => $key, 'question_id' => $question->id])->first();
                    if (isset($answer)) {
                        $file = $value;
                        $image = time() . $file->getClientOriginalName();
                        $file->storeAs('public/images', time() . $file->getClientOriginalName());
                        $answer->update([
                            'answer' => $image,
                        ]);
                    }
                    array_push($answers, $answer->id);
                }
                $question->answers()->whereNotIn('id', $answers)->delete();
            } elseif ($request->image_description) {
                foreach ($request->image_description as $key => $value) {
                    $ansr = Answer::where(['id' => $key])->first();
                    $ansr->update([
                        'image_description' => $value
                    ]);
                    array_push($answers, $ansr->id);
                }
                $question->answers()->whereNotIn('id', $answers)->delete();
            }
            //MCQS Type update @s
            else {
                if ($request->answer) {
                    foreach ($request->answer as $key => $value) {
                        $answer = Answer::where(['id' => $key, 'question_id' => $question->id])->first();
                        if ($answer) {
                            $answer->update([
                                'answer' => substr($value, 0, 40),
                            ]);
                        } else {
                            $answer = Answer::create([
                                'answer' => substr($value, 0, 40),
                                'uuid' => Str::uuid(),
                                'question_id' => $question->id,
                                'answer_type' => $request->type,
                            ]);
                        }
                        array_push($answers, $answer->id);
                    }
                }
                $question->answers()->whereNotIn('id', $answers)->delete();
            }
            return response()->json([
                'status' => 200,
                'message' => 'Question updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
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
    public function destroy($account, $project, $uuid)
    {
        try {
            DB::transaction(function () use ($uuid) {
                $question = Question::where('uuid', $uuid)->firstOrFail();
                McqIsMultipleAdviceLogic::where('question_id', $question->id)->delete();
                $data = NumberQuestionLogic::where('next_question_id', $question->id)->first();
                $question->delete();
                if ($data) {
                    $data->delete();
                }
                if ($question->answers->contains('answer_type', 'image')) {
                    $answers = $question->answers->where('answer_type', 'image')->pluck('answer');
                    foreach ($answers as $answer) {
                        if (Storage::exists('public/images/' . $answer)) {
                            Storage::delete('public/images/' . $answer);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Image does not exist',
                            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                        }
                    }
                }
                $question->answers()->delete();
            });
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Question deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getQuestions(Request $request)
    {
        if ($request->ajax()) {
            $project = getActiveProject();
            $questions = Question::where('project_id', $project->id)->orderBy('order', 'ASC')->get();
            return view('questions.question_list', compact('questions'))->render();
        }
    }
    public function cloneQuestion($account, $project, $uuid)
    {
        try {
            $project = getActiveProject();
            $question = Question::where('uuid', $uuid)->firstOrFail();
            $newquestion = $question->replicateQuestion();
            $questions = Question::where('project_id', $project->id)->orderBy('order', 'ASC')->get();
            $order = 0;
            foreach ($questions as $questionOrder) {
                $questionOrder->update(['order' => $order]);
                $order++;
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Question cloned successfully.',
                'question' => ['uuid' => $newquestion->uuid, 'id' => $newquestion->id],
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function sortQuestions(Request $request)
    {
        try {
            foreach ($request->input('question') as $order => $id) {

                $question = Question::where('id', $id)->first();
                $question->update(['order' => $order]);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Questions order updated successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function sortAnswers(Request $request)
    {
        try {
            foreach ($request->input('answers') as $order => $id) {

                $answer = Answer::where('id', $id)->first();
                $answer->update(['order' => $order]);
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Answers order updated successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAnswerType(Request $request)
    {
        if ($request->ajax()) {
            if ($request->data == 'MCQS') {
                return view('questions.mcqs_type')->render();
            } elseif ($request->data == 'Email') {
                return view('questions.email_type')->render();
            } elseif ($request->data == 'Images') {
                return view('questions.image_type')->render();
            } elseif ($request->data == 'Numeric') {
                return view('questions.numeric_type')->render();
            } elseif ($request->data == 'Text') {
                return view('questions.text_type')->render();
            }
        }
    }

    public function zapierIntegration()
    {
        return view('zapier.index');
    }
}
