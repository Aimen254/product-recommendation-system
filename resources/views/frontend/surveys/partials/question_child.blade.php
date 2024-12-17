@push('styles')
<style>
    .previous {
        position: fixed;
        top: 50%;
    }

    .next {
        position: fixed;
        top: 50%;
        left: 92%;
    }

    i {
        color: {{ $ProjectSetting && isset($ProjectSetting['arrow_color']) ? $ProjectSetting['arrow_color'] : '#D60C8C' }} !important;
        font-size: 36px;
    }

    .previous:hover i {
        color: #002B5C;
    }

    .next span,
    .next a,
    .previous span,
    .previous a {
        border: 2px solid;
        border-color: {{ $ProjectSetting && isset($ProjectSetting['arrow_color']) ? $ProjectSetting['arrow_color'] : '#D60C8C' }} !important;
        border-radius: 50%;
        height: 70px !important;
        display: block;
        width: 70px;
    }

    .previous:hover a,
    .previous:hover span {
        border: 2px solid #002B5C;
    }

    .next:hover i {
        color: #002B5C;
    }

    .next:hover a,
    .next:hover span {
        border: 2px solid #002B5C;
    }

    .mcqs-next-button {
        margin-top: 60px;
    }

    .mobile-icon {
        display: none;
    }

    .desktop-icon {
        display: block;
    }

    .vorige {
        display: none;
    }

    /* @media (min-widt: 992px){ */
    label {
        float: left;
        margin: 5px 0px;
    }

    .cbox {
        margin-left: -820px;
        margin-top: 23px;
        width: 15px;
        height: 15px;
    }

    .clear {
        clear: both;
    }

    /* } */



    @media only screen and (max-width: 389px) {
  .cbox {
    margin-left: -548px;
  }
  .start-button {
    display: inline-block;
    width: auto;
    white-space: nowrap;
    overflow: hidden;
    word-wrap: break-word;
  }
  /* .buttons label {
    line-height: 31px;
  
} */
}
@media only screen and (min-width: 381px) and (max-width: 413px) {
  .cbox {
    margin-left: -574px;
  }
}
@media only screen and (min-width: 414px) and (max-width: 780px) {
  .cbox {
    margin-left: -518px;
  }
}

@media only screen and (min-width: 414px) and (max-width: 736px) {
  .cbox {
    margin-left: -619px;
  }
}

@media only screen and (min-width: 737px) and (max-width: 812px) {
  .cbox {
    margin-left: -548px;
  }
}

@media only screen and (min-width: 813px) and (max-width: 896px) {
  .cbox {
    margin-left: -619px;
  }
}

@media only screen and (min-width: 897px) and (max-width: 844px) {
  .cbox {
    margin-left: -573px;
  }
}






/* @media only screen and (min-width: 360px) and (max-width: 780px) {
  .cbox {
    margin-left: -620px;
  }
} */

/* @media only screen and (min-width: 781px) and (max-width: 812px) {
  .cbox {
    margin-left: -620px;
  }
}

@media only screen and (min-width: 813px) and (max-width: 926px) {
  .cbox {
    margin-left: -498px;
  }
}

@media only screen and (min-width: 927px) and (max-width: 1024px) {
  .cbox {
    margin-left: -498px;
  }
} */



/* @media only screen and (min-width: 1025px) {
  .cbox {
    margin-left: -498px;
  }
} */





@media (max-width: 992px) {
  .mcqs-next-button {
    margin-top: 10px;
    margin-left: -11px;
  }

  .previous {
    display: none;
  }

  .next {
    display: none;
  }

  .next span,
  .next a,
  .previous span,
  .previous a {
    border: none;
  }

  .previous:hover a,
  .previous:hover span {
    border: none;
  }

  .next:hover a,
  .next:hover span {
    border: none;
  }

  .desktop-icon {
    display: none;
  }

  .icons {
    position: fixed;
    bottom: 10px;
    left: 47%;
  }

  /* .cbox {
    margin-left: -620px;
  } */

  .vorige {
    font-size: {{ $ProjectSetting && isset($ProjectSetting['previous_text_font_size']) ? $ProjectSetting['previous_text_font_size'] : '15' }};
    display: block;
    font-family: {{ $ProjectSetting && isset($ProjectSetting['previous_text_font_family']) ? $ProjectSetting['previous_text_font_family'] : 'Poppins' }};
    color: {{ $ProjectSetting && isset($ProjectSetting['previous_button_text_color']) ? $ProjectSetting['previous_button_text_color'] : '#D60C8C' }};
  }

  .mobile-icon {
    display: block;
    color: {{ $ProjectSetting && isset($ProjectSetting['arrow_color']) ? $ProjectSetting['arrow_color'] : '#D60C8C' }} !important;
    font-size: 32px;
  }
}








    input[type=email] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=text] {
        width: 50%;
        padding: 10px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=number] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .col-xs-6 {
        width: 50% !important;
    }

    input[type="text"],
    input[type="number"],
    input[type="email"] {
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['new_question_font_weight']) ? $ProjectSetting['new_question_font_weight'] : '100' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['new_question_font_family']) ? $ProjectSetting['new_question_font_family'] : 'roboto' }};
    }

    .next_button {
        background: {{ $ProjectSetting && isset($ProjectSetting['end_button_background_color']) ? $ProjectSetting['end_button_background_color'] : 'blue' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['skip_button_font_weight']) ? $ProjectSetting['skip_button_font_weight'] : '100' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['skip_button_text_font_family']) ? $ProjectSetting['skip_button_text_font_family'] : 'roboto' }} !important;
        color: {{ $ProjectSetting && isset($ProjectSetting['button_text_color']) ? $ProjectSetting['button_text_color'] : 'blue' }};
    }
    .skip {
        background: {{ $ProjectSetting && isset($ProjectSetting['skip_button_background_color']) ? $ProjectSetting['skip_button_background_color'] : 'blue' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['next_button_font_weight']) ? $ProjectSetting['next_button_font_weight'] : '100' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['next_button_text_font_family']) ? $ProjectSetting['next_button_text_font_family'] : 'roboto' }} !important;
        color: {{ $ProjectSetting && isset($ProjectSetting['skip_button_text_color']) ? $ProjectSetting['skip_button_text_color'] : 'blue' }};
    }

    .title-text {
        font-size: {{ $ProjectSetting && isset($ProjectSetting['question_title_font_size']) ? $ProjectSetting['question_title_font_size'] . ' !important' : 12 }};
    }

    .page-heading {
        font-size: {{ $ProjectSetting && isset($ProjectSetting['question_description_font_size']) ? $ProjectSetting['question_description_font_size'] . ' !important' : 10 }};
    }

  
    @media (max-width: 760px) { 
       input[type="email"],
       input[type="text"] {
            width: 100%;
        }
        
       .error-message,
        .text-validation {
            width: 100%;
    }
  












 

    /* input[type=checkbox]:checked+.question {
            background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;

    }

    input[type=checkbox]:checked+.image-background {
            background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;

    } */

    input[type=checkbox] {
        accent-color: #000000;
        
    }
    /* @media screen and (max-width: 767px) {
    .start-button:hover {
        cursor: pointer;
        background: {{ $ProjectSetting && isset($ProjectSetting['question_page_button_background_color']) ? $ProjectSetting['question_page_button_background_color'] : '#002B5C' }} !important; 
      }
    .image-background:hover {
        cursor: pointer;
        background: {{ $ProjectSetting && isset($ProjectSetting['new_question_background_color']) ? $ProjectSetting['new_question_background_color'] : '#002B5C' }} !important; 
    }
  } */
</style>
@endpush
<div class="container">
    {{-- <div class="progress" style="max-width: 700px;
    margin: auto;
    height: 15px;
    border-radius: 30px;background-color: #c3c3c3;">
        <div class="progress-bar" role="progressbar"
            style="width: {{ surveyProgress($response->id) }}%; background-color:#D60C8C;" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="200"></div>
        <span style="position: absolute;
        left: 49%;
        font-size: 12px;
        font-weight: bold;
        color: white;
        line-height: 1; align-self:center">{{ surveyProgress($response->id) }}%</span>
    </div> --}}
</div>

<div class="container-fluid" id="question-container">
    <div class="container">
        <div class="row" style="max-width:950px; margin:auto">
            @foreach ($questions as $question)
                @php
                    $prevAnswer = App\Models\ProjectResponseAnswer::where(['question_id' => $question->id, 'project_response_id' => $response->id])->first();
                    $answer = $prevAnswer ? $prevAnswer->answer : null;
                @endphp
                @if ($question->question_type == 'Images')
                    <style>
                        .cbox {
                            margin-left: -193px;
                            margin-top: 230px;
                            width: 15px;
                            height: 15px;
                        }

                        @media (max-width: 992px) {
                            .cbox {
                                margin-left: -130px;
                            }
                        }
                    </style>
                @endif
                <div class="col-md-12">
                    <div class="logo text-center mt-5">
                        <img class="logo_image"
                            src="{{ $welcomePageData->image ? asset('storage/images/' . $welcomePageData->image) : asset('images/default.png/') }}">
                    </div>
                    <div class="title text-center mt-4">
                        <h4 class="title-text title-color question-title">
                            <input type="hidden" class="question-id"
                                value="{{  isset($question->id) ? $question->id : '' }}">
                            <input type="hidden" class="question-type"
                                value="{{ isset($question->question_type) ? $question->question_type : '' }}">
                            {{ $question->title }}
                        </h4>
                    </div>
                    <div class="description text-center mt-0 mb-3">
                        <p class="page-heading mb-5 mt-3">
                            {{ $question->description }}
                        </p>
                        @if ($question->question_type == 'Email')
                            <div class="form-group">
                                <input type="email" value="{{ $answer }}" name="email"
                                    {{ $question->choice }} class="form-control1 submit-onblur input-style {{ $question->choice }}"
                                    placeholder="{{ $ProjectSetting && isset($ProjectSetting['email_placeholder_text'])
                                        ? $ProjectSetting['email_placeholder_text']
                                        : 'Enter Email address' }}"
                                    data-id="{{ $question->id }}">
                                <div class="error-message text-danger"></div>
                            </div>
                        @elseif($question->question_type == 'Text')
                            <input type="text" name="text" value="{{ $answer }}" id="card"
                                {{ $question->choice }} class="form-control1 submit-onblur input-style {{ $question->choice }}"
                                placeholder="{{ $ProjectSetting && isset($ProjectSetting['text_placeholder_text'])
                                    ? $ProjectSetting['text_placeholder_text']
                                    : 'Enter Text' }}"
                                data-id="{{ $question->id }}">
                            <div class="text-validation text-danger"></div>
                    </div>
                @elseif($question->question_type == 'Numeric')
                    <input type="number" name="numeric" value="{{ $answer }}" min="0" pattern="[0-9]*"
                        inputmode="numeric" id="numericfield" class="form-control1 submit-onblur input-style"
                        placeholder="{{ $ProjectSetting && isset($ProjectSetting['number_placeholder_text'])
                            ? $ProjectSetting['number_placeholder_text']
                            : 'Enter Numbers Only' }}"
                        required data-id="{{ $question->id }}">
                    <div class="numeric-validation text-danger"></div>
                </div>
                
            @endif
            @if ($question->question_type == 'Text' ||
                $question->question_type == 'Numeric' ||
                $question->question_type == 'Email')
                <center><button class="btn btn-default submit-input next_button">
                        {{ $ProjectSetting && isset($ProjectSetting['next_button_text']) ? $ProjectSetting['next_button_text'] : 'Volgende' }}
                    </button></center>
            @endif
        </div>
    </div>
    @foreach ($question->answers()->get() as $answer)
    @php
        $prevAnswer = App\Models\ProjectResponseAnswer::where(['question_id' => $question->id, 'project_response_id' => $response->id])->first();
        $prevAnswers = App\Models\ProjectResponseAnswer::where(['question_id' => $question->id, 'project_response_id' => $response->id])->pluck('answer_id')->toArray();
        $prevAnswerId = $prevAnswer ? $prevAnswer->answer_id : null;
    @endphp
        @if ($answer)
            @if ($answer->answer_type == 'image')
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                @elseif($question->question_type == 'email')
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    @else
                        <div class="col-lg-6 my-2 col-md-6 col-sm-6 text-center mcqs-mobile">
            @endif
            <div class="buttons">
                @php
                    $prevAnswer = App\Models\ProjectResponseAnswer::where(['question_id' => $question->id, 'project_response_id' => $response->id])->first();
                    $prevAnswers = App\Models\ProjectResponseAnswer::where(['question_id' => $question->id, 'project_response_id' => $response->id])->pluck('answer_id')->toArray();
                    $prevAnswerId = $prevAnswer ? $prevAnswer->answer_id : null;
                @endphp
                @if (($question->question_type == 'MCQS' ||
                    $question->question_type == 'Images' ||
                    $question->question_type == null) &&
                    $question->is_multiple)
                    <input type="checkbox" class="cbox" value="{{ $answer->id }}" id="answer_{{ $answer->id }}"
                        @if (in_array($answer->id, $prevAnswers)) checked @endif name="check_multipleanswer[]"
                        data-id="{{ $question->id }}" />
                @else
                    <input type="radio" value="{{ $answer->id }}" id="answer_{{ $answer->id }}"
                        @if ($prevAnswerId == $answer->id) checked @endif name="check_answer" />
                @endif


                @if ($question->question_type == 'Images')
                    @if($question->is_multiple)
                    <label class="image-background checkbox_mcq" for="answer_{{ $answer->id }}" background:
                        @if ($prevAnswerId == $answer->id) #002B5C @else {{ $ProjectSetting && isset($ProjectSetting['new_question_background_color'])
                            ? $ProjectSetting['new_question_background_color']
                            : '#002B5C' }} @endif>
                        <img src="{{ asset('storage/images/' . $answer->answer) }}" style="border-radius: 25px"
                            width="200" height="200px">
                        <div class="my-3 mx-2 text-center new-question">{{ $answer->image_description }}</div>
                    </label>
                    @else
                    <label class="jump-next image-background radio_mcq" for="answer_{{ $answer->id }}" background:
                        @if ($prevAnswerId == $answer->id) #002B5C @else {{ $ProjectSetting && isset($ProjectSetting['new_question_background_color'])
                            ? $ProjectSetting['new_question_background_color']
                            : '#002B5C' }} @endif>
                        <img src="{{ asset('storage/images/' . $answer->answer) }}" style="border-radius: 25px"
                            width="200" height="200px">
                        <div class="my-3 mx-2 text-center new-question">{{ $answer->image_description }}</div>
                    </label>
                    @endif
                @elseif(($question->question_type == 'MCQS' || $question->question_type == null) && ($question->is_multiple))
                <label class="start-button circle-button question checkbox_mcq" for="answer_{{ $answer->id }}"
                    background:
                    @if ($prevAnswerId == $answer->id) #002B5C @else {{ $ProjectSetting && isset($ProjectSetting['question_page_button_background_color'])
                        ? $ProjectSetting['question_page_button_background_color']
                        : '#002B5C' }} @endif>
                    {{ $answer->answer }}
                </label>
                @else
                <label class="start-button  jump-next circle-button question radio_mcq" for="answer_{{ $answer->id }}"
                    background:
                    @if ($prevAnswerId == $answer->id) #002B5C @else {{ $ProjectSetting && isset($ProjectSetting['question_page_button_background_color'])
                        ? $ProjectSetting['question_page_button_background_color']
                        : '#002B5C' }} @endif>
                    {{ $answer->answer }}
                </label>
                @endif
            </div>
</div>
@endif
@endforeach
{{-- @if ($question->is_multiple)
    <center><button class="btn btn-default next_button mcqs-next-button save-multiplechoice">
            {{ $ProjectSetting && isset($ProjectSetting['next_button_text']) ? $ProjectSetting['next_button_text'] : 'Save' }}
        </button></center>
@endif --}}

@endforeach
</div>
@foreach ($questions as $question)
@if ($question->is_multiple)
<center><button class="btn btn-default my-5 next_button mcqs-next-button save-multiplechoice move-next d-none">
    {{ $ProjectSetting && isset($ProjectSetting['next_button_text']) ? $ProjectSetting['next_button_text'] : 'Volgende' }}
</button></center>

<center><button class="btn btn-default my-5 next_button mcqs-next-button save-multiplechoice skip">
    {{ $ProjectSetting && isset($ProjectSetting['skip_button_text']) ? $ProjectSetting['skip_button_text'] : 'Skip' }}
</button></center>
@else


@endif

</div>
{{-- <div id="paginate">
        {!! $questions->links() !!}
    </div> --}}
<div class="previous">
    <span
        class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-500 cursor-default leading-5 rounded-md">
        <i class="far fa-less-than previous-button desktop-icon"></i>
    </span>
</div>
@endforeach
{{-- <div class="next">
    <span
        class="relative inline-flex pt-2 items-center px-4 py-3 text-sm font-medium text-gray-700 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
        <i class="far fa-greater-than next-button add-class-save desktop-icon"></i>
    </span>
</div> --}}
</div>
</div>