<?php

namespace App\Http\Controllers\Backend;

use App\Models\Answer;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\ProductSetup;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\ProductSetupValue;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\McqIsMultipleAdviceLogic;
use Symfony\Component\VarDumper\VarDumper;
use App\Models\McqIsMultipleAdviceLogicValue;
use App\Http\Requests\McqIsMultipleAdviceLogicRequest;

class McqIsMultipleAdviceLogicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account, $project, $uuid)
    {
        $account = getActiveAccount();
        $project = getActiveProject();
        $currentQuestion = Question::where('uuid', $uuid)->firstOrFail();
        $questionValues = McqIsMultipleAdviceLogic::with('values')->where('question_id', $currentQuestion->id)->get();
        $questionProductSetup = McqIsMultipleAdviceLogic::where('question_id', $currentQuestion->id)->first();
        $answers = Answer::where('question_id', $currentQuestion->id)->get();
        $productSetups = ProductSetup::with('productSetupValues')->where('account_id', $account->id)->get();
        if ($currentQuestion->question_type == 'MCQS' && $currentQuestion->is_multiple == '1' && sizeof($questionValues) == 0) {
            return view('mcq_advice_logic.create', compact('currentQuestion', 'answers', 'productSetups'));
        } elseif ($currentQuestion->question_type == 'MCQS' && $currentQuestion->is_multiple == '1' && sizeof($questionValues) > 0) {
            $productSetup = ProductSetup::with('productSetupValues.product')->where('id', $questionProductSetup->product_setup_id)->where('account_id', $account->id)->firstOrFail();
            return view('mcq_advice_logic.edit', compact('currentQuestion', 'answers', 'productSetups', 'questionValues', 'productSetup'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function createMultipleMcqAdviceLogic(McqIsMultipleAdviceLogicRequest $request)
    {
        try {
            $values = [];
            if ((request()->answer_count) && request()->answer_count > 0) {
                for ($count = 0; $count < request()->answer_count; $count++) {
                    $value = [];
                    $value_id = "value_id_" . $count;
                    $value[] = request()->$value_id;
                    $values[] = $value;
                    if (empty($values[$count][0])) {
                        return response()->json([
                            'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                            'message' => "Please select the values.",
                        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }
            }
            $account = getActiveAccount();
            $project = getActiveProject();
            $answers = request()->answer;
            $validated = $request->validated();
            $McqIsMultipleAdviceLogic = McqIsMultipleAdviceLogic::where('question_id', $request->input('question_id'));
            $McqIsMultipleAdviceLogic->delete();

            if (is_array($answers)) {
                for ($answerCount = 0; $answerCount < sizeof($answers); $answerCount++) {
                    $adviceLogic = McqIsMultipleAdviceLogic::create([
                        'account_id' => $account->id,
                        'project_id' => $project->id,
                        'question_id' => $request->input('question_id'),
                        'answer_id' => $answers[$answerCount],
                        'product_setup_id' => $validated['product_field']
                    ]);
                    $value_ids = $values[$answerCount];
                    for ($j = 0; $j < sizeof($value_ids[0]); $j++) {
                        $parts = explode('-', $value_ids[0][$j]);
                        $value_id = $parts[0];
                        $product_id = $parts[1];
                        $adviceLogicValue = McqIsMultipleAdviceLogicValue::create([
                            'advice_logic_id' => $adviceLogic->id,
                            // 'product_id' => $product_id,
                            'value_id' => $value_id,
                        ]);
                    }
                }
            }
            if (request()->route()->getName() == "multiple_question_advice_logic_create") {
                $message = "MCQ Advice Logic Set Successfully";
            } else {
                $message = "MCQ Advice Logic Updated Successfully";
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => $message,
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
    public function destroy($id)
    {
        //
    }
    public function getValues($account, $project)
    {
        try {
            $id = request()->id;
            $questionId = request()->question_id;
            $account = getActiveAccount();
            $productSetup = ProductSetup::with('productSetupValues.product')->where('id', $id)->where('account_id', $account->id)->firstOrFail();
            $values = '';
            foreach ($productSetup->productSetupValues as $productSetupValue) {
                if ($productSetup->is_list == "1") {
                    $values .= '<option value="' . $productSetupValue->id .  '-' . $productSetupValue->product_id .'">' . $productSetupValue->list_values . '</option>';
                } else if ($productSetup->is_list == "0") {
                    $values .= '<option value="' . $productSetupValue->id . '-' . $productSetupValue->product_id .'">' . $productSetupValue->value . '</option>';
                }
            }
            $data = [
                ['data' => $values,],
                ['labels' => $productSetup->field]
            ];
            return $data;
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'data' => $data,
                'message' => 'Product Setup Field Values got successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
