<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdviceLogicRequest;
use App\Models\Advice;
use App\Models\AdviceLogic;
use App\Models\AdviceLogicCondition;
use App\Models\AdviceLogicConditionOption;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class AdviceLogicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = getActiveAccount();
        $project = getActiveProject();
        $questions = Question::where('project_id', $project->id)->where(function ($query) use ($project) {
            $query->where('question_type', 'MCQS');
            $query->orWhere('question_type', 'Images');
            $query->orWhere('question_type', null);
        })->latest()->get();
        $advices = Advice::where('account_id', $account->id)->latest()->get();
        return view('advice_logic.index', compact('questions', 'advices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = getActiveProject();
        $account = getActiveAccount();
        $questions = Question::where('project_id', $project->id)->where(function ($query) use ($project) {
            $query->where('question_type', 'MCQS');
            $query->orWhere('question_type', 'Images');
            $query->orWhere('question_type', null);
        })->latest()->get();
        // $questions = Question::where('project_id', $project->id)->Where('question_type', '!=', 'Email')->Where('question_type', '!=', 'Text')->latest()->get();
        $advices = Advice::where('account_id', $account->id)->latest()->get();
        return view('advice_logic.create', compact('questions', 'advices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(AdviceLogicRequest $request)
    {

        $validated = $request->validated();
        $questions = $validated['question'];
        foreach ($questions as $questionIndex => $questionUUID) {
            $choice = 'choice_' . $questionUUID;
            $data = $request->only($choice);
            $validator = Validator::make($data, [
                $choice => 'required',
            ], [
                'required' => 'The :attribute field is required.',
            ]);
            $validator->setAttributeNames([
                $choice => 'Select option for question ',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $errorMessage = $errors->first($choice);

                return response()->json([
                    'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $errorMessage ?: 'Validation failed for question ' . ($questionIndex + 1),
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        // Rest of the code...




        try {
            $account = getActiveAccount();
            $project = getActiveProject();
            $validated = $request->validated();
            $choice = 'choice' . '_' . $validated['question'][0];


            $adviceLogic = AdviceLogic::create([
                'uuid' => Str::uuid(),
                'project_id' => $project->id,
                'advice_id' => $validated['advice'],
            ]);
            $array = [];
            $counter = 0;
            $questionsArray = [];
            foreach (collect($validated['question'])->unique() as $questionUUID) {
                $questionList = array_push($questionsArray, $questionUUID);
            }
            foreach ($validated['question'] as $uuid) {
                $question = Question::where('uuid', $uuid)->first();
                $adviceLogicCondition = AdviceLogicCondition::where([
                    'question_id' => $question->id,
                    'advice_logic_id' => $adviceLogic->id
                ])->first();

                if ($request->input('logic_' . $uuid)) {
                    $adviceLogicCond = AdviceLogicCondition::where(['question_id' => $question->id])->get();
                    foreach ($adviceLogicCond as $cond) {

                        $conditionOpt = AdviceLogicConditionOption::where(['advice_logic_condition_id' => $cond->id])->get();
                        foreach ($conditionOpt as $opt) {

                            $choices = $request->input('logic_' . $uuid);
                            $value = $request->input('value_' . $uuid);
                            $res = array_map(null, $choices, $value);
                            $keys = array("logic", "value");
                            $logic_val = array_map(function ($e) use ($keys) {
                                return array_combine($keys, $e);
                            }, $res);
                            array_push($array, $logic_val);
                            $newArray = Arr::collapse($array);
                            $uniqueOperatorAndValue = collect($newArray)->unique();
                            foreach ($uniqueOperatorAndValue as $logic) {
                                if ($questionList >= 1) {
                                    if ($counter >= 1) {
                                        break;
                                    }
                                }

                                if ($opt->operator == $logic['logic'] && $opt->value == $logic['value']) {
                                    $adviceLogicCondtn = AdviceLogicCondition::find($opt->advice_logic_condition_id);
                                    $advicelog = AdviceLogic::find($adviceLogicCondtn->advice_logic_id);
                                    if ($advicelog) {
                                        $advice = Advice::find($advicelog->advice_id);
                                    }
                                    $adviceName = isset($advice) ? $advice->title : "";
                                    $deleteAdvice = AdviceLogic::find($adviceLogic->id);
                                    foreach ($deleteAdvice->conditions as $condition) {
                                        $condition->options()->delete();
                                    }
                                    $deleteAdvice->conditions()->delete();
                                    $deleteAdvice->delete();
                                    return response()->json([
                                        'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                                        'message' => "Warning: This advice Logic is Conflicting with Advice " . $adviceName,
                                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                                }
                            }
                        }
                    }
                }

                if (!$adviceLogicCondition) {
                    $adviceLogicCondition = AdviceLogicCondition::create([
                        'uuid' => Str::uuid(),
                        'advice_logic_id' => $adviceLogic->id,
                        'question_id' => $question->id,
                        'condition' => $counter == 0 ? 'base' : $request->input('condition_' . $uuid),
                    ]);
                }

                if ($request->input('logic_' . $uuid)) {
                    $choices = $request->input('logic_' . $uuid);
                    $value = $request->input('value_' . $uuid);
                    $res = array_map(null, $choices, $value);
                    $keys = array("logic", "value");
                    $logic_val = array_map(function ($e) use ($keys) {
                        return array_combine($keys, $e);
                    }, $res);
                    foreach ($logic_val as $logic) {

                        $adviceLogicConditionOption = AdviceLogicConditionOption::firstOrCreate(
                            [

                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'operator' => $logic['logic'],
                            ],
                            [
                                'uuid' => Str::uuid(),
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => 0,
                                'operator' => $logic['logic'],
                                'value' => $logic['value'],
                            ]
                        );
                    }
                }

                if ($request->input('choice_' . $uuid)) {

                    $choices = $request->input('choice_' . $uuid);
                    foreach ($choices as $choice) {
                        $answer = Answer::where('uuid', $choice)->first();
                        $adviceLogicConditionOption = AdviceLogicConditionOption::firstOrCreate(
                            [
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => $answer->id,
                            ],
                            [
                                'uuid' => Str::uuid(),
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => $answer->id,
                            ]
                        );
                    }
                }
                $counter++;
            }
            return response()->json([
                'success' => 200,
                'message' => 'Advice Added Successfully',
                'model' => ['uuid' => $adviceLogic->uuid, 'id' => $adviceLogic->id],
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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
        $project = getActiveProject();
        $account = getActiveAccount();
        // $questions = Question::where('project_id', $project->id)->Where('question_type', '!=', 'Email')->Where('question_type', '!=', 'Text')->latest()->get();
        $questions = Question::where('project_id', $project->id)->where(function ($query) use ($project) {
            $query->where('question_type', 'MCQS');
            $query->orWhere('question_type', 'Images');
            $query->orWhere('question_type', null);
        })->latest()->get();
        $advices = Advice::where('account_id', $account->id)->latest()->get();
        $adviceLogic = AdviceLogic::where('uuid', $uuid)->firstOrFail();

        return view('advice_logic.edit', compact('questions', 'advices', 'adviceLogic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(AdviceLogicRequest $request, $account, $project, AdviceLogic $adviceLogic)
    {
        $validated = $request->validated();
        $choice = 'choice_' . $validated['question'][0];
        $validator = Validator::make($request->all(), [
            $choice => 'required',
        ], [
            'required' => 'The :attribute field is required.',
        ]);
        $validator->setAttributeNames([
            $choice => 'Select option',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first($choice);

            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $errorMessage ?: 'Validation failed.',
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        try {
            $account = getActiveAccount();
            $project = getActiveProject();
            $validated = $request->validated();
            $adviceLogic->update([
                'advice_id' => $validated['advice'],
            ]);
            $array = [];
            $questionsArray = [];
            foreach (collect($validated['question'])->unique() as $questionUUID) {
                $questionList = array_push($questionsArray, $questionUUID);
            }
            foreach ($adviceLogic->conditions as $condition) {
                $condition->options()->delete();
            }
            $adviceLogic->conditions()->delete();
            $counter = 0;
            foreach ($validated['question'] as $question_uuid) {
                $question = Question::where('uuid', $question_uuid)->first();
                $adviceLogicCondition = AdviceLogicCondition::where([
                    'question_id' => $question->id,
                    'advice_logic_id' => $adviceLogic->id
                ])->first();

                if ($request->input('logic_' . $question_uuid)) {
                    $adviceLogicCond = AdviceLogicCondition::where(['question_id' => $question->id])->get();
                    foreach ($adviceLogicCond as $cond) {
                        $conditionOpt = AdviceLogicConditionOption::where(['advice_logic_condition_id' => $cond->id])->get();
                        foreach ($conditionOpt as $opt) {

                            $choices = $request->input('logic_' . $question_uuid);
                            $value = $request->input('value_' . $question_uuid);
                            $res = array_map(null, $choices, $value);
                            $keys = array("logic", "value");
                            $logic_val = array_map(function ($e) use ($keys) {
                                return array_combine($keys, $e);
                            }, $res);
                            array_push($array, $logic_val);
                            $newArray = Arr::collapse($array);
                            $uniqueOperatorAndValue = collect($newArray)->unique();
                            foreach ($uniqueOperatorAndValue as $logic) {
                                Log::info($logic);
                                // if ($questionList >= 1) {
                                if ($counter >= 1) {
                                    break;
                                }
                                // }

                                if ($opt->operator == $logic['logic'] && $opt->value == $logic['value']) {
                                    $adviceLogicCondtn = AdviceLogicCondition::find($opt->advice_logic_condition_id);
                                    $advicelog = AdviceLogic::find($adviceLogicCondtn->advice_logic_id);
                                    if ($advicelog) {
                                        $advice = Advice::find($advicelog->advice_id);
                                    }
                                    $adviceName = isset($advice) ? $advice->title : "";

                                    return response()->json([
                                        'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                                        'message' => "Warning: This advice Logic is Conflicting with Advice " . $adviceName,
                                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                                }
                            }
                        }
                    }
                }

                if (!$adviceLogicCondition) {
                    $adviceLogicCondition = AdviceLogicCondition::create([
                        'uuid' => Str::uuid(),
                        'advice_logic_id' => $adviceLogic->id,
                        'question_id' => $question->id,
                        'condition' => $counter == 0 ? 'base' : $request->input('condition_' . $question_uuid),
                    ]);
                }

                if ($request->input('logic_' . $question_uuid)) {
                    $choices = $request->input('logic_' . $question_uuid);
                    $value = $request->input('value_' . $question_uuid);
                    $res = array_map(null, $choices, $value);
                    $keys = array("logic", "value");
                    $logic_val = array_map(function ($e) use ($keys) {
                        return array_combine($keys, $e);
                    }, $res);
                    foreach ($logic_val as $logic) {
                        $adviceLogicConditionOption = AdviceLogicConditionOption::firstOrCreate(
                            [
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'operator' => $logic['logic'],
                            ],
                            [
                                'uuid' => Str::uuid(),
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => 0,
                                'operator' => $logic['logic'],
                                'value' => $logic['value'],
                            ]
                        );
                    }
                }
                if ($request->input('choice_' . $question_uuid)) {
                    foreach ($request->input('choice_' . $question_uuid) as $choice) {

                        $answer = Answer::where('uuid', $choice)->first();
                        $adviceLogicConditionOption = AdviceLogicConditionOption::firstOrCreate(
                            [
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => $answer->id,
                            ],
                            [
                                'uuid' => Str::uuid(),
                                'advice_logic_condition_id' => $adviceLogicCondition->id,
                                'answer_id' => $answer->id,
                            ]
                        );
                    }
                }

                $counter++;
            }

            return response()->json([
                'success' => 200,
                'message' => 'Advice Logic Updated Successfully',
                'modelUUID' => $adviceLogic->uuid,
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
            $adviceLogic = AdviceLogic::where('uuid', $uuid)->firstOrFail();
            foreach ($adviceLogic->conditions as $c) {
                $c->options()->delete();
            }
            $adviceLogic->conditions()->delete();
            $adviceLogic->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Advice Logic deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAdvices(Request $request)
    {
        if ($request->ajax()) {
            $project = getActiveProject();
            $adviceLogics = AdviceLogic::where('project_id', $project->id)->latest()->get();
            return view('advice_logic.advices_list', compact('adviceLogics'))->render();
        }
    }
    public function newCondition()
    {
        $project = getActiveProject();
        $questions = Question::where('project_id', $project->id)->where(function ($query) use ($project) {
            $query->where('question_type', 'MCQS');
            $query->orWhere('question_type', 'Images');
            $query->orWhere('question_type', null);
        })->latest()->get();
        // $questions = Question::where('project_id', $project->id)->Where('question_type', '!=', 'Email')->Where('question_type', '!=', 'Text')->latest()->get();
        return view('advice_logic.condition', compact('questions'))->render();
    }

    public function getAnswers($account, $project)
    {
        try {
            $uuid = request()->uuid;
            $question = Question::where('uuid', $uuid)->firstOrFail();

            $answers = '';

            switch ($question->question_type) {
                case "Numeric":
                    $data = [
                        [
                            'data' => '<select class="form-select operator-select" data-search="off" name="logic_' . $question->uuid . '[]"
                            data-placeholder="Select Logic">
                            <option></option>
                            <option value="" selected disabled>Options</option>
        
                            <option value="equal to"> Equal to </option>
                            <option value="not equal to"> Not Equal to </option>
                            <option value="greater than"> Greater than </option>
                            <option value="less than"> Less than </option>
                            </select>' .
                                '<div class="form-control-wrap mt-3">
                            <input type="number" name="value_' . $question->uuid . '[]" class="form-control" placeholder="Enter only number">
                            </div>',
                        ],
                        [
                            'labels' => '<label class="form-label">Operator</label><br>
                            <label class="form-label mt-4">Value</label>',
                        ],
                    ];
                    break;

                case "MCQS":
                case null:
                    foreach ($question->answers as $answer) {
                        $answers .= '<option value="' . $answer->uuid . '">' . $answer->answer . '</option>';
                    }

                    $data = [
                        [
                            'data' => '<select class="form-select" multiple="multiple" data-search="on" name="choice_' . $question->uuid . '[]"
                            data-placeholder="Select answer" novalidate>' . $answers . '</select>',
                        ],
                        ['labels' => '<label class="form-label">Selected Options</label><br>']
                    ];
                    break;

                case "Images":
                    foreach ($question->answers as $answer) {
                        $answers .= '<option value="' . $answer->uuid . '">' . $answer->image_description . '</option>';
                    }

                    $data = [
                        [
                            'data' => '<select class="form-select" multiple="multiple" data-search="on" name="choice_' . $question->uuid . '[]"
                            data-placeholder="Select answer" novalidate>' . $answers . '</select>',
                        ],
                        ['labels' => '<label class="form-label">Selected Options</label><br>']
                    ];
                    break;
            }

            return $data;

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Question cloned successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
