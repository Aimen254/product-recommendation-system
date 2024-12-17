<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use App\Models\AdviceLogic;
use App\Models\Answer;
use App\Models\Category;
use App\Models\NumberQuestionLogic;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectResponse;
use App\Models\ProjectResponseAnswer;
use App\Models\ProjectSetting;
use App\Models\Question;
use App\Models\QuestionLogic;
use App\Models\WelcomePage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use session;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget('project_response');
        $project = Project::where('uuid', $request->uuid)->firstOrFail();
        $ProjectSetting = $project->projectSetting()->pluck('value', 'key');
        $welcomePageData = WelcomePage::where('project_id', $project->id)->first();
        if (!$welcomePageData) {
            return view('frontend.surveys.maintenance');
        }
        return view('frontend.surveys.index', compact('welcomePageData', 'project', 'ProjectSetting'));
    }

    public function startSurvey(Request $request)
    {
        $project = Project::where('uuid', $request->uuid)->firstOrFail();

        if ($request->session()->has('project_response')) {
            $response = ProjectResponse::where('uuid', session('project_response'))->first();
        } else {
            $response = ProjectResponse::create([
                'uuid' => Str::uuid(),
                'project_id' => $project->id,
            ]);
            session(['project_response' => $response->uuid]);
        }
        // fixed orderby
        $ProjectSetting = $project->projectSetting()->pluck('value', 'key');
        $questions = Question::where('project_id', $project->id)->orderBy('order', 'ASC')->simplePaginate(1);

        return view("frontend.surveys.questions")->with(
            [
                'questions' => $questions,
                'welcomePageData' => $project->welcomePage,
                'ProjectSetting' => $ProjectSetting,
                'response' => $response,
            ]
        );
    }


    public function saveMultipleChoiceAnswers(Request $request)
    {
        // dd($request->question_id);

        try {
            $question = Question::where('id', $request->questionId)->firstOrFail();
            $project = Project::where('uuid', $request->uuid)->firstOrFail();
            $projectResponse = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $projectSetting = $project->projectSetting()->pluck('value', 'key');
            if ($request->isSkip == 'false') {
                $answers = Answer::whereIn('id', $request->answers)->get();
                $answers->each(function ($answer, $key) use ($request, $projectResponse, $question, $project) {
                    ProjectResponseAnswer::Create(
                        // [
                        //     'project_response_id' => $projectResponse->id,
                        //     'answer_id' => $answer->id,
                        // ],
                        [
                            'project_response_id' => $projectResponse->id,
                            'answer_id' => $answer->id,
                            'question_id' => $request->questionId,
                            'uuid' => Str::uuid(),
                            'answer' => $answer->answer,
                            'question' => $question->title,
                            'project_id' => $project->id
                        ]
                    );
                });
            }

            if ($request->isSkip == 'true') {
                ProjectResponseAnswer::where('question_id', $request->questionId)->delete();
            }

            // Next Question Logic
            $nextQuestionLogic = NumberQuestionLogic::where('selected_question_id', $request->questionId)->first();
            if ($nextQuestionLogic) {
                $questions = Question::where([
                    'project_id' => $project->id,
                    'id' => $nextQuestionLogic->next_question_id,
                ])->limit(1)->get();
                // Load next question
                return view('frontend.surveys.partials.question_child')->with(
                    [
                        'questions' => $questions,
                        'ProjectSetting' => $projectSetting,
                        'response' => $projectResponse,
                        'welcomePageData' => $project->welcomePage,
                    ]

                )->render();
            } else {
                return redirect()->route('survey.advices', currentProjectUuid());
            }
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'response saved successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function saveAnswers(Request $request)
    {
        try {
            // number logic for @start
            $numberLogics = NumberQuestionLogic::where('selected_question_id', $request->questionId)->get();
            $answer = '';
            if ($numberLogics->count() > 0) {
                $value = $request->value;
                foreach ($numberLogics as $index => $logic) {
                    $operator = $logic->firstOperator;

                    if ($operator == 'equal to' && $logic->firstValue == $request->number) {

                        if ($logic->firstValue == $request->number) {
                            $nextQuestion = $logic->next_question_id;
                            break;
                        }
                    } elseif ($operator == 'greater than' && $request->number > $logic->firstValue) {

                        if ($request->number > $logic->firstValue) {
                            $nextQuestion = $logic->next_question_id;
                            break;
                        }
                    } elseif ($operator == 'less than' && $request->number < $logic->firstValue) {

                        if ($request->number < $logic->firstValue) {
                            $nextQuestion = $logic->next_question_id;
                            break;
                        }
                    } elseif (!(empty($request->text))) {

                        $nextQuestion = $logic->next_question_id;
                    } elseif ($operator == 'default') {

                        $nextQuestion = $logic->next_question_id;
                    } elseif ($request->email == null && $request->value == null) {

                        $nextQuestion = $logic->next_question_id;
                        $answer = null;
                        break;
                    } elseif (!(empty($request->text || $request->email))) {

                        $nextQuestion = $logic->next_question_id;
                    } else {
                        $nextQuestion = null;
                        goto label1;
                    }
                }
            }
            // number logic @end
            label1:
            // mcqs type and mcqs with images
            if (!($request->value) && $request->answer_id) {
                $answer = Answer::where('id', $request->answer_id)->firstOrFail();
                $question = Question::where('id', $answer->question_id)->firstOrFail();
            }

            $projectResponse = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();

            if ($request->value) {
                $answer = $request->value;
                $answer_id = 1;
            } else {
                if ($request->answer_id) {
                    $answer_id = $request->answer_id;
                } else {
                    $answer_id = 0;
                }
            }
            // if question have input box on frontend
            if ($request->questionId) {
                $question_id = $request->questionId;
                $data = Question::where('id', $question_id)->first();
                $question = $data->title;
            } else {
                // if is multiple choice or multiple choice with images
                $question_id = $answer->question_id;
                $question = $answer->question->title;
                $answer = $answer->answer;
            }
            ProjectResponseAnswer::updateOrCreate(
                [
                    'question_id' => $question_id,
                    'project_response_id' => $projectResponse->id,
                ],
                [
                    'uuid' => Str::uuid(),
                    'answer_id' => $answer_id,
                    'answer' => $answer,
                    'question' => $question,
                    'project_id' => $projectResponse->project_id
                ]
            );

            $project = Project::where('uuid', $request->uuid)->firstOrFail();

            $projectSetting = $project->projectSetting()->pluck('value', 'key');
            // next question logic starts from here
            $numberLogic = NumberQuestionLogic::where('selected_question_id', $request->questionId)->first();
            if ($request->answer_id) {
                $nextQuestionLogic = QuestionLogic::where('selected_answer_id', $request->answer_id)->first();
            } else {
                $nextQuestionLogic = null;
            }
            if ($nextQuestionLogic) {
                // if next question logic for mcqs or mcqs with images exist
                if ($nextQuestionLogic->next_question_id != null) {
                    $questions = Question::where([
                        'project_id' => $project->id,
                        'id' => $nextQuestionLogic->next_question_id,
                    ])->limit(1)->get();
                } else {
                    return redirect()->route('survey.advices', currentProjectUuid());
                }
            } elseif ($request->number && $numberLogics->count() > 0 || $request->text && $numberLogics->count() > 0 || $request->value && $numberLogics->count() > 0 || $request->email == null && $numberLogics->count() > 0) {
                // next question logic for question type number, text and email
                if ($nextQuestion != null) {
                    $questions = Question::where([
                        'project_id' => $project->id,
                        'id' => $nextQuestion,
                    ])->limit(1)->get();
                } else {
                    return redirect()->route('survey.advices', currentProjectUuid());
                }
            } else {
                return redirect()->route('survey.advices', currentProjectUuid());
            }
            return view('frontend.surveys.partials.question_child')->with(
                [
                    'questions' => $questions,
                    'ProjectSetting' => $projectSetting,
                    'response' => $projectResponse,
                    'welcomePageData' => $project->welcomePage,
                ]

            )->render();
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // This function is for fetching previous question
    public function fetchPreviousQuestions(Request $request)
    {
        // Two cases one in which current question is saved. Second is when last question is not yet
        //  saved then we have to pick last question from table. In case of advice on mobile device we always
        //  pick last question that was loaded before advice page

        if ($request->ajax()) {
            $project = Project::where('uuid', $request->uuid)->firstOrFail();
            $response = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $responseAnswer = ProjectResponseAnswer::where(['project_response_id' => $response->id, 'question_id' => $request->questionId])->first();
            $responseAnswer1 = ProjectResponseAnswer::where(['project_response_id' => $response->id])->first();
            if ($responseAnswer == null) {
                $next_record = ProjectResponseAnswer::where('project_response_id', $response->id)->latest('id')->first();
                $questions = Question::where(['project_id' => $project->id, 'id' => $next_record->question_id])->get();
            } else {
                $previous_record = ProjectResponseAnswer::where('id', '<', $responseAnswer->id)->orderBy('id', 'desc')->first();

                if ($previous_record) {
                    $questions = Question::where(['project_id' => $project->id, 'id' => $previous_record->question_id])->get();
                } else {
                    $last = ProjectResponseAnswer::where(['project_response_id' => $response->id])->latest()->first();
                    $questions = Question::where(['project_id' => $project->id, 'id' => $last->question_id])->get();
                }
            }

            $response = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $ProjectSetting = $project->projectSetting()->pluck('value', 'key');
            $welcomePageData = WelcomePage::where('project_id', $project->id)->firstOrFail();

            return view('frontend.surveys.partials.question_child', compact('questions', 'ProjectSetting', 'response', 'welcomePageData'))->render();
        }
    }

    // This function is for fetching Next question
    public function fetchNextQuestions(Request $request)
    {
        if ($request->ajax()) {
            $project = Project::where('uuid', $request->uuid)->firstOrFail();
            $response = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $responseAnswer = ProjectResponseAnswer::where(['project_response_id' => $response->id, 'question_id' => $request->questionId])->first();
            if ($responseAnswer) {
                $next_record = ProjectResponseAnswer::where('id', '>', $responseAnswer->id)->orderBy('id')->first();
                $questions = Question::where(['project_id' => $project->id, 'id' => $next_record->question_id])->get();
            }
            $response = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $ProjectSetting = $project->projectSetting()->pluck('value', 'key');
            $welcomePageData = WelcomePage::where('project_id', $project->id)->firstOrFail();
            return view('frontend.surveys.partials.question_child', compact('questions', 'ProjectSetting', 'response', 'welcomePageData'))->render();
        }
    }
    // Advices Section 
    public function advices(Request $request)
    {
        if ($request->session()->has('project_response')) {
            $response = ProjectResponse::where('uuid', session('project_response'))->firstOrFail();
            $adviceLogics = AdviceLogic::where('project_id', $response->project_id)->get();
            $project = $response->project;
            $ProjectSetting = $project->projectSetting()->pluck('value', 'key');
            $advice = null;
            $prevConditionMatched = true;
            $optionMatched = false;

            foreach ($adviceLogics as $adviceLogic) {
                $advice = null;
                $prevConditionMatched = true;
                $optionMatched = false;
                if ($adviceLogic->conditions) {
                    foreach ($adviceLogic->conditions as $condition) {
                        if ($prevConditionMatched || $condition->condition == "or") {
                            $optionMatched = false;
                            foreach ($condition->options as $logicOption) {
                                $questionResponse = $response->answers->where('question_id', $condition->question_id)->first();
                                if ($questionResponse) {
                                    $question = Question::where('id', $questionResponse->question_id)->first();
                                    if ($question->question_type == "Numeric" && !(empty($questionResponse->answer))) {
                                        if ($logicOption->operator == 'equal to' && $logicOption->value == $questionResponse->answer) {
                                            $advice = $adviceLogic->advice;
                                            $optionMatched = true;
                                        }
                                        if ($logicOption->operator == 'greater than' && $questionResponse->answer > $logicOption->value) {
                                            $advice = $adviceLogic->advice;
                                            $optionMatched = true;
                                        }
                                        if ($logicOption->operator == 'less than' && $questionResponse->answer < $logicOption->value) {
                                            $advice = $adviceLogic->advice;
                                            $optionMatched = true;
                                        }
                                    }
                                    if ($questionResponse->answer_id === $logicOption->answer_id) {
                                        $advice = $adviceLogic->advice;
                                        $optionMatched = true;
                                    }
                                }
                            }
                            if ($optionMatched) {
                                $prevConditionMatched = true;
                            } else {
                                $prevConditionMatched = false;
                                $advice = null;
                            }
                        }
                    }
                }
                if ($advice) {
                    break;
                }
            }
            if ($advice) {
                $advice->update(['impressions' => $advice->impressions + 1]);
                $response->update(['finished' => 1, 'advice_id' => $advice->id]);
                // query to get the products for mcq_is_multiple_answers
                $productQuery = Product::query();
                $productQuery->select("products.*");
                $productQuery->join('product_selected_values', function ($join1) {
                    $join1->on('product_selected_values.product_id', '=', 'products.id');
                });
                $productQuery->join('mcq_is_multiple_advice_logic_values', function ($join2) {
                    $join2->on('mcq_is_multiple_advice_logic_values.value_id', '=', 'product_selected_values.value_id');
                });
                $productQuery->join('mcq_is_multiple_advice_logics', function ($join3) {
                    $join3->on('mcq_is_multiple_advice_logics.id', '=', 'mcq_is_multiple_advice_logic_values.advice_logic_id');
                });
                $productQuery->join('project_response_answers', function ($join4) {
                    $join4->on('project_response_answers.question_id', '=', 'mcq_is_multiple_advice_logics.question_id');
                    $join4->on('project_response_answers.answer_id', '=', 'mcq_is_multiple_advice_logics.answer_id');
                    $join4->on('project_response_answers.project_id', '=', 'mcq_is_multiple_advice_logics.project_id');
                });
                $productQuery->join('project_responses', function ($join5) {
                    $join5->on('project_responses.id', '=', 'project_response_answers.project_response_id');
                });
                $products = $productQuery->where("project_responses.finished", "1")
                    ->where("project_responses.project_id", $response->project_id)
                    ->where("project_responses.uuid", session('project_response'))->groupBy("products.id")->get();
                return view('frontend.surveys.advices', compact('advice', 'project', 'ProjectSetting', 'products'));
            } else {
                if ($project->getDefaultAdvice['value']) {
                    $advice = Advice::where([
                        'id' => $project->getDefaultAdvice['value'],
                    ])->first();
                    $advice->update(['impressions' => $advice->impressions + 1]);
                    $response->update(['finished' => 1, 'advice_id' => $advice->id]);
                    // query to get the products for mcq_is_multiple_answers
                    $productQuery = Product::query();
                    $productQuery->select("products.*");
                    $productQuery->join('product_selected_values', function ($join1) {
                        $join1->on('product_selected_values.product_id', '=', 'products.id');
                    });
                    $productQuery->join('mcq_is_multiple_advice_logic_values', function ($join2) {
                        $join2->on('mcq_is_multiple_advice_logic_values.value_id', '=', 'product_selected_values.value_id');
                    });
                    $productQuery->join('mcq_is_multiple_advice_logics', function ($join3) {
                        $join3->on('mcq_is_multiple_advice_logics.id', '=', 'mcq_is_multiple_advice_logic_values.advice_logic_id');
                    });
                    $productQuery->join('project_response_answers', function ($join4) {
                        $join4->on('project_response_answers.question_id', '=', 'mcq_is_multiple_advice_logics.question_id');
                        $join4->on('project_response_answers.answer_id', '=', 'mcq_is_multiple_advice_logics.answer_id');
                        $join4->on('project_response_answers.project_id', '=', 'mcq_is_multiple_advice_logics.project_id');
                    });
                    $productQuery->join('project_responses', function ($join5) {
                        $join5->on('project_responses.id', '=', 'project_response_answers.project_response_id');
                    });
                    $products = $productQuery->where("project_responses.finished", "1")
                        ->where("project_responses.uuid", session('project_response'))->where("project_responses.project_id", $response->project_id)->groupBy("products.id")->get();
                    return view('frontend.surveys.advices', compact('advice', 'project', 'ProjectSetting', 'products'));
                } else {
                    return view('frontend.surveys.maintenance');
                }
            }
        } else {
            return abort(404);
        }
    }

    public function updateProductImpression(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update(['impressions' => $product->impressions + 1]);
        return response()->json([
            'message' => 'Product Impressions Updated Successfully',
        ]);
    }

    public function updateCategoryImpression(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->update(['impressions' => $category->impressions + 1]);
        return response()->json([
            'message' => 'Category Impressions Updated Successfully',
        ]);
    }
    public function productDescription(Request $request)
    {
        try {
            $category = Category::findOrFail($request->id);
            $read_more_btn_text = $request->read_more_btn_text;
            $read_less_btn_text = $request->read_less_btn_text;
            if ($request->type == 'read_less') {
                return view('frontend.surveys.partials.read_more_description', compact('category', 'read_less_btn_text', 'read_more_btn_text'))->render();
            } else {
                return view('frontend.surveys.partials.read_less_description', compact('category', 'read_less_btn_text', 'read_more_btn_text'))->render();
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
