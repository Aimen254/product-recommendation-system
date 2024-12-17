<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Front-end Routes
$appRoutes = function () {
    Route::get('/', function () {
        return Redirect::to(env('ADMIN_URL') . 'login');
    });
    Route::get('/login', function () {
        return Redirect::to(env('ADMIN_URL') . 'login');
    });
    Route::get('{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'index'])->name('survey.index');
    Route::get('{uuid}/start', [App\Http\Controllers\Frontend\SurveyController::class, 'startSurvey'])->name('survey.start');
    Route::post('fetch_questions/{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'fetchQuestions'])->name('fetch_questions');
    Route::post('saveAnswers/{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'saveAnswers'])->name('saveAnswers');
    Route::post('save-multiplechoice-answers/{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'saveMultipleChoiceAnswers'])->name('save-multiplechoice-answers');
    // Advice Route
    Route::get('survey/{uuid}/advices', [App\Http\Controllers\Frontend\SurveyController::class, 'advices'])->name('survey.advices');
    // update product impressions route
    Route::post('update-product-impressions', [App\Http\Controllers\Frontend\SurveyController::class, 'updateProductImpression'])->name('update-product-impressions');
    // update Category impressions route
    Route::post('update-category-impressions', [App\Http\Controllers\Frontend\SurveyController::class, 'updateCategoryImpression'])->name('update-category-impressions');
    Route::get('advice/product/description', [App\Http\Controllers\Frontend\SurveyController::class, 'productDescription'])->name('advice-product-description');
    // Fetching previous and next question Routes
    Route::post('fetch_previous_question/{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'fetchPreviousQuestions'])->name('fetch_previous_question');
    Route::post('fetch_next_question/{uuid}', [App\Http\Controllers\Frontend\SurveyController::class, 'fetchNextQuestions'])->name('fetch_next_question');
};

$adminRoutes = function () {

    Route::get('/', function () {
        return Redirect::to('login');
    });

    Route::get('/register', function () {
        return Redirect::to('login');
    });
    // Backend Routes
    // Feedback routes
    Route::get('get/feedback', [App\Http\Controllers\Backend\FeedbackController::class, 'create'])->name('feedback');
    Route::post('send/feedback', [App\Http\Controllers\Backend\FeedbackController::class, 'sendFeedback'])->name('send-feedback');
    Route::post('save/feedback/email', [App\Http\Controllers\Backend\FeedbackController::class, 'saveFeedbackEmail'])->name('save-feedback-email');


    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return redirect('accounts');
    })->name('dashboard');

    Route::group([
        'prefix' => 'accounts/{account}',
        'namespace' => 'App\Http\Controllers\Backend',
        'middleware' => ['auth:sanctum', 'verified']
    ], function ($account) {

        // Settings Route
        Route::post('settings/save', [App\Http\Controllers\Backend\SettingController::class, 'save'])->name('settings.save');
        Route::resource('settings', SettingController::class);
        Route::get('fetch-data', [App\Http\Controllers\Backend\SettingController::class, 'getDomainInfo'])->name('settings.get-domain-info');

        // Product Routes
        Route::resource('products', ProductController::class);
        Route::get('get_products', [App\Http\Controllers\Backend\ProductController::class, 'getProducts'])->name('products.datatable');
        Route::get('export_products', [App\Http\Controllers\Backend\ProductController::class, 'exportProducts'])->name('export-products');
        Route::get('load_import_products_modal', [App\Http\Controllers\Backend\ProductController::class, 'loadImportProductsModal'])->name('load-import-products-modal');
        Route::post('import_products', [App\Http\Controllers\Backend\ProductController::class, 'importProducts'])->name('import-products');
        Route::get('load_upload_images_modal', [App\Http\Controllers\Backend\ProductController::class, 'loadUploadImagesModal'])->name('load-upload-images-modal');
        Route::post('upload_images', [App\Http\Controllers\Backend\ProductController::class, 'uploadImages'])->name('upload-images');

        // Product Setup routes
        Route::resource('products_setup', ProductSetupController::class);
        Route::get('get_products_fields', [App\Http\Controllers\Backend\ProductSetupController::class, 'datatable'])->name('products_setup.datatable');

        // User Routes
        Route::resource('users', UserController::class);
        Route::post('add_existing_user', [App\Http\Controllers\Backend\UserController::class, 'addExistingUser'])->name('add_existing_user');
        Route::get('load_new_users_view', [App\Http\Controllers\Backend\UserController::class, 'loadNewUsersForm'])->name('load_new_users_view');
        Route::get('load_existing_users_view', [App\Http\Controllers\Backend\UserController::class, 'loadExistingUsersForm'])->name('load_existing_users_view');
        Route::get('get_users', [App\Http\Controllers\Backend\UserController::class, 'getUsers'])->name('users.datatable');
        Route::post('activate', [App\Http\Controllers\Backend\UserController::class, 'activate'])->name('activate');
        Route::post('deactivate', [App\Http\Controllers\Backend\UserController::class, 'deactivate'])->name('deactivate');

        // Category Routes
        Route::resource('categories', CategoryController::class);
        Route::get('get-categories', [App\Http\Controllers\Backend\CategoryController::class, 'getCategories'])->name('categories.datatable');
        Route::get('get-product-options', [App\Http\Controllers\Backend\CategoryController::class, 'getProducts'])->name('categories.get_products');
        Route::get('export_categories', [App\Http\Controllers\Backend\CategoryController::class, 'exportCategories'])->name('export-categories');
        Route::get('load_import_categories_modal', [App\Http\Controllers\Backend\CategoryController::class, 'loadImportCategoriesModal'])->name('load-import-categories-modal');
        Route::post('import_categories', [App\Http\Controllers\Backend\CategoryController::class, 'importCategories'])->name('import-categories');

        // Advice Routes
        Route::resource('advices', AdviceController::class);
        Route::get('get_advices', [App\Http\Controllers\Backend\AdviceController::class, 'getAdvices'])->name('advices.datatable');
        Route::get('get-category-options', [App\Http\Controllers\Backend\AdviceController::class, 'getCategories'])->name('advices.get_categories');
        Route::get('export_advices', [App\Http\Controllers\Backend\AdviceController::class, 'exportAdvices'])->name('export-advices');
        Route::get('load_import_advices_modal', [App\Http\Controllers\Backend\AdviceController::class, 'loadImportAdvicesModal'])->name('load-import-advices-modal');
        Route::post('import_advices', [App\Http\Controllers\Backend\AdviceController::class, 'importAdvices'])->name('import-advices');

        // Project Routes
        Route::resource('projects', ProjectController::class);
        Route::get('/search', [App\Http\Controllers\Backend\ProjectController::class, 'search'])->name('search');
        Route::post('fetch_projects', [App\Http\Controllers\Backend\ProjectController::class, 'fetchProjects'])->name('fetch_projects');

        Route::group(['prefix' => 'projects/{project}'], function ($project) {

            // Questions Routesp
            Route::resource('questions', QuestionController::class);
            Route::get('zapier-integration', [App\Http\Controllers\Backend\QuestionController::class, 'zapierIntegration'])->name('zapier-integration');
            Route::get('get_questions', [App\Http\Controllers\Backend\QuestionController::class, 'getQuestions'])->name('questions.get_questions');
            Route::get('clone_question/{uuid}', [App\Http\Controllers\Backend\QuestionController::class, 'cloneQuestion'])->name('questions.clone');
            Route::post('questions/sort_questions', [App\Http\Controllers\Backend\QuestionController::class, 'sortQuestions'])->name('questions.sort');
            Route::post('questions/sort_answers', [App\Http\Controllers\Backend\QuestionController::class, 'sortAnswers'])->name('questions.sort_answers');
            Route::get('get_questions_type', [App\Http\Controllers\Backend\QuestionController::class, 'getAnswerType'])->name('get_questions_type');

            // Advice Logic Bulder Routes
            Route::resource('advice-logic', AdviceLogicController::class);
            Route::get('get_advices', [App\Http\Controllers\Backend\AdviceLogicController::class, 'getAdvices'])->name('advice-logic.get_advices');
            Route::get('get-condition-options', [App\Http\Controllers\Backend\AdviceLogicController::class, 'newCondition'])->name('advice-logic.new_condition');
            Route::get('get_answers', [App\Http\Controllers\Backend\AdviceLogicController::class, 'getAnswers'])->name('questions.get_answers');
            Route::get('clone-advice-logic/{uuid}', [App\Http\Controllers\Backend\AdviceLogicController::class, 'cloneAdviceLogic'])->name('advice-logic.clone');

            // Welcome Page Routes
            Route::resource('welcome_page', WelcomePageController::class);

            // Styles Routes
            Route::get('styles', [App\Http\Controllers\Backend\ProjectSettingController::class, 'index'])->name('styles.index');
            Route::get('welcome', [App\Http\Controllers\Backend\ProjectSettingController::class, 'welcome'])->name('styles.welcome');
            Route::get('question', [App\Http\Controllers\Backend\ProjectSettingController::class, 'question'])->name('styles.question');
            Route::get('advice', [App\Http\Controllers\Backend\ProjectSettingController::class, 'advice'])->name('styles.advice');
            Route::post('styles/update-general-styles', [App\Http\Controllers\Backend\ProjectSettingController::class, 'updateGeneralSettings'])->name('styles.update-general-styles');
            Route::get('new_question', [App\Http\Controllers\Backend\ProjectSettingController::class, 'newQuestion'])->name('styles.new-question');

            // Backend Response Route
            Route::get('responses', [App\Http\Controllers\Backend\ResponseController::class, 'index'])->name('response.index');
            Route::get('get_response', [App\Http\Controllers\Backend\ResponseController::class, 'getResponse'])->name('get_response');
            Route::get('responses/{uuid}', [App\Http\Controllers\Backend\ResponseController::class, 'responseAnswer'])->name('response.answer');
            Route::get('get_response_answer/{response_id}', [App\Http\Controllers\Backend\ResponseController::class, 'responseDataTable'])->name('get_response_answer');

            // Questions Logic Builder Routes
            Route::get('/question_logic/{uuid}', [App\Http\Controllers\Backend\QuestionLogicController::class, 'index'])->name('question_logic');
            Route::post('question_logic_create', [App\Http\Controllers\Backend\QuestionLogicController::class, 'store'])->name('question_logic_create');
            Route::post('number_question_logic_create', [App\Http\Controllers\Backend\QuestionLogicController::class, 'createNumberQuestionLogic'])->name('number_question_logic_create');
            Route::post('email_question_logic_create', [App\Http\Controllers\Backend\QuestionLogicController::class, 'createEmailQuestionLogic'])->name('email_question_logic_create');
            Route::post('text_question_logic_create', [App\Http\Controllers\Backend\QuestionLogicController::class, 'createTextQuestionLogic'])->name('text_question_logic_create');
            Route::post('multiple_question_logic_create', [App\Http\Controllers\Backend\QuestionLogicController::class, 'createMultipleQuestionLogic'])->name('multiple_question_logic_create');
            Route::delete('remove-question-logic/{id?}', [App\Http\Controllers\Backend\QuestionLogicController::class, 'delete'])->name('remove-question-logic');
            Route::get('add-question-logic', [App\Http\Controllers\Backend\QuestionLogicController::class, 'addNewLogic'])->name('add-question-logic');

            // MCQS is_multiple Set Advice Logic Routes
            Route::get('/multiple_question_advice_logic/{uuid}', [App\Http\Controllers\Backend\McqIsMultipleAdviceLogicController::class, 'index'])->name('mcq_advice_logic');
            Route::get('get_values', [App\Http\Controllers\Backend\McqIsMultipleAdviceLogicController::class, 'getValues'])->name('mcq_advice_logic.get_values');
            Route::post('multiple_question_advice_logic_create', [App\Http\Controllers\Backend\McqIsMultipleAdviceLogicController::class, 'createMultipleMcqAdviceLogic'])->name('multiple_question_advice_logic_create');
            Route::post('multiple_question_advice_logic_update', [App\Http\Controllers\Backend\McqIsMultipleAdviceLogicController::class, 'createMultipleMcqAdviceLogic'])->name('multiple_question_advice_logic_update');
        });
    });

    Route::namespace('App\Http\Controllers\Backend')->middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::get('accounts/get-accounts', [App\Http\Controllers\Backend\AccountController::class, 'getAccounts']);
        Route::resource('accounts', AccountController::class);
        Route::get('accounts-dt', [App\Http\Controllers\Backend\AccountController::class, 'datatable'])->name('accounts.datatable');

        // Profile  Routes  
        Route::get('edit_profile', [App\Http\Controllers\Backend\ProfileController::class, 'index'])->name('edit_profile');
        Route::post('update_personal_info', [App\Http\Controllers\Backend\ProfileController::class, 'updatePersonalInfo'])->name('update_personal_info');
        Route::get('change_password', [App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('change_password');
        Route::get('two-factor', [App\Http\Controllers\Backend\ProfileController::class, 'twoFactor'])->name('two-factor');
        Route::post('update_password', [App\Http\Controllers\Backend\ProfileController::class, 'updatePassword'])->name('update_password');
        Route::get('superadmin-feedback', [App\Http\Controllers\Backend\ProfileController::class, 'feedback'])->name('superadmin-feedback');
    });
};

Route::domain('{domain}')->group(function ($domain) use ($adminRoutes, $appRoutes) {
    if (request()->getHost() == env('ADMIN_DOMAIN') || request()->getHost() == env('APP_DOMAIN')) {
        Route::group(array('domain' => env('ADMIN_DOMAIN')), $adminRoutes);
        Route::group(array('domain' => env('APP_DOMAIN')), $appRoutes);
    } else {
        Route::group(array('domain' => request()->getHost(), 'middleware' => 'verifyDomain'), $appRoutes);
    }
});
