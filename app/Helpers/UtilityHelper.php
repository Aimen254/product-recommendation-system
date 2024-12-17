<?php

use App\Models\Style;
use App\Models\ProjectSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
/**
 * minimize text
 *
 * @param $text, $limit
 * @return $text
 */

function addEllipsis($text, $max = 30)
{
    return strlen($text) > $max ? mb_substr($text, 0, $max, "UTF-8") . "..." : $text;
}
function customEllipsis($text, $max = 30)
{
    return strlen($text) > $max ? mb_substr($text, 0, $max, "UTF-8") : $text;
}
function testEllipsis($text, $max = 30, $count = 0)
{
    return limit_text($text,$max,$count);
}
function limit_text($text, $limit,$count) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]-1);
    }
    if(strlen($text) > 142) {
        $count++;
        $text = limit_text($text, $limit-1,$count);
    }
    if($count == 1){
        $str = '...';
        goto down;
      }
      else{
        $str = '';
      }
      down : $final = $text.$str;
    return $final;
}
function accounts()
{
    if(\Auth::user()->hasRole('Super Admin'))
    return App\Models\Account::latest()->get() ?? null;
    elseif(\Auth::user()->hasRole('Admin'))
    return \Auth::user()->accounts;
}

function currentAccount()
{
    return request()->route('account');
}

function currentProject()
{
    return request()->route('project');
}

function frontendProject(){
    return App\Models\Project::where('uuid', request()->route('survey'))->first() ?? abort(404);
}

function currentProjectUuid()
{
    return request()->route('uuid');
}

function getActiveAccount()
{
    if(\Auth::user()->hasRole('Super Admin'))
    return App\Models\Account::where('uuid', request()->route('account'))->first() ?? abort(404);
    elseif(\Auth::user()->hasRole('Admin'))
    return \Auth::user()->accounts->where('uuid', request()->route('account'))->first() ?? abort(404);
}

function getActiveProject()
{
    // if(\Auth::user()->hasRole('Super Admin'))
    return App\Models\Project::where('uuid', request()->route('project'))->first() ?? abort(404);
    // elseif(\Auth::user()->hasRole('Admin'))
    // return \Auth::user()->accounts->where('uuid', request()->route('project'))->first() ?? abort(404);
}

function getSelectedFont()
{
        $project =  App\Models\Project::where('uuid', currentProjectUuid())->first();
        $font = ProjectSetting::where(
            'project_id' , $project->id
            )->pluck('value','key');
        $font = $font && isset($font['general_font']) ? $font['general_font'] : 'open sans';
        return $font;


}
function getGeneralSettings()
{
    $project =  App\Models\Project::where('uuid', currentProjectUuid())->first();
    $background_color = ProjectSetting::where(
        'project_id' , $project->id
        )->pluck('value','key');
        return  $background_color && isset($background_color['general_background_color']) ?  $background_color['general_background_color'] : 'open sans';

}
function backgroundImage()
{
    $project =  App\Models\Project::where('uuid', currentProjectUuid())->first();
    $background_image = ProjectSetting::where(
        'project_id' , $project->id
        )->pluck('value','key');

    return $background_image && isset($background_image['image']) ? $background_image['image'] : '';

}

function switchAccount($account)
{
    if(request()->route('account')){
        if(request()->route('project')){

            return route('projects.index',$account);
        }
        $currentUrl =  request()->getRequestUri();
        $currentAccount = request()->route('account');
        return Str::replace($currentAccount, $account, $currentUrl);

    } else{
        return route('accounts.show',$account);
    }

}

function surveyProgress($response_id){
    $response = App\Models\ProjectResponse::where('id', $response_id)->first();
    return  (count($response->answers) / count($response->project->questions)) * 100;
}

function survey_answered_questions($response_id){
    $response = App\Models\ProjectResponse::where('id', $response_id)->first() ?? null;

    return count($response->answers).'/'.count($response->project->questions);
}

function getStyles($key){
    $style = ProjectSetting::where([
        'project_id' => getActiveProject()->id,
    ]);
    if(is_array($key)){
        return $style->whereIn('key', $key)->get();
    }
    $style = $style->where('key', $key)->first();
    return $style ? $style->value : null;
}

function getValue($collection, $key){
    $collection = $collection->where('key', $key)->first();
    return $collection ? $collection->value : null;
}
