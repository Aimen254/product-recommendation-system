<style>
    .title-color {
        color: {{ $ProjectSetting && isset($ProjectSetting['welcome_page_title_color']) ? $ProjectSetting['welcome_page_title_color'] : '#002B5C' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['question_title_font_family']) ? $ProjectSetting['question_title_font_family'] : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['question_title_font_weight']) ? $ProjectSetting['question_title_font_weight'] : '900' }};

    }
    /* .start-button:hover {
    background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;

} */
    /* .image-background:hover {
    background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;

} */
@media screen and (min-width: 992px) {
    input[type="radio"]:hover, .radio_mcq:hover {
        background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;
        cursor: pointer;
    }
    input[type="checkbox"]:hover, .checkbox_mcq:hover {
        background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;
        cursor: pointer;
    }
}
    input[type="radio"]:checked+.radio_mcq {
        background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;
        cursor: pointer;
    }
    
    input[type="checkbox"]:checked+.checkbox_mcq {
        background: {{ $ProjectSetting && isset($ProjectSetting['question_hover_color']) ? $ProjectSetting['question_hover_color'] : '#002B5C' }} !important;
        cursor: pointer;
    }

    .page-heading {
        color: {{ $ProjectSetting && isset($ProjectSetting['welcome_page_description_color']) ? $ProjectSetting['welcome_page_description_color'] : '#002B5C' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['question_description_font_family']) ? $ProjectSetting['question_description_font_family'] : 'pt serif' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['question_description_font_weight']) ? $ProjectSetting['question_description_font_weight'] : '400' }};

    }

    .question {
        color: {{ $ProjectSetting && isset($ProjectSetting['question_page_button_text_color']) ? $ProjectSetting['question_page_button_text_color'] : '#ffffff' }} !important;
        background: {{ $ProjectSetting && isset($ProjectSetting['question_page_button_background_color']) ? $ProjectSetting['question_page_button_background_color'] : '#D60C8C' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['question_title_font_family']) ? $ProjectSetting['question_title_font_family'] : 'overpass' }} !important;
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['question_title_font_weight']) ? $ProjectSetting['question_title_font_weight'] : '600' }} !important;
    }

    .new-question {
        color: {{ $ProjectSetting && isset($ProjectSetting['new_question_color']) ? $ProjectSetting['new_question_color'] : '#ffffff' }} !important;
        font-family: {{ $ProjectSetting && isset($ProjectSetting['new_question_font_family']) ? $ProjectSetting['new_question_font_family'] : 'overpass' }} !important;
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['new_question_font_weight']) ? $ProjectSetting['new_question_font_weight'] : '600' }} !important;
    }

    .image-background {
        cursor: pointer;
        border-radius: 25px;
        background: {{ $ProjectSetting && isset($ProjectSetting['new_question_background_color']) ? $ProjectSetting['new_question_background_color'] : '#D60C8C' }};
    }

    .buttons label {
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['mcqs_answer_font_weight']) ? $ProjectSetting['mcqs_answer_font_weight'] : '100' }} !important;
        font-size: {{ $ProjectSetting && isset($ProjectSetting['mcqs_answer_font_size']) ? $ProjectSetting['mcqs_answer_font_size'] : '9' }} !important;

    }
    .next_button:hover{
        color: {{ $ProjectSetting && isset($ProjectSetting['btn_hover_color']) ? $ProjectSetting['btn_hover_color'] : '#002B5C' }} !important;
    }

    /* New question styling */
</style>
@extends('frontend.layouts.app')
@section('content')
    <div id="question">
        @include('frontend.surveys.partials.question_child')
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#paginate nav  a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                if ($(this).attr('rel') == 'next') {
                    if ($('input[name=check_answer]').is(':checked')) {
                        fetch_data(page);
                    } else {
                        toastMessage('Please select an option', 'error');
                    }
                } else {
                    fetch_data(page);
                }
            });


            function fetch_data(page = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('fetch_questions', currentProjectUuid()) }}",
                    // url: "{{ route('saveAnswers', currentProjectUuid()) }}",
                    method: "POST",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $('#question').html(data);
                    }
                });
            }

            // saving answers
            $("body").on("click", ".jump-next", function() {
                let answer_id = $(this).siblings('input[name=check_answer]').val();
                let flag = 6;
                if ($("#paginate nav .next a").length) {
                    var page = $("#paginate nav .next a").attr('href').split('page=')[1];
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('saveAnswers', currentProjectUuid()) }}",
                    data: {
                        answer_id: answer_id,
                        // page: page
                    },
                    success: function(data) {
                        if (flag == 1) {
                            $('.logo').remove();

                            $('#question').html(
                                `<div class="text-center mt-5 pt-5"><img src="{{ asset('images/1484.png') }}"/><h1>Een moment geduld alsjeblief...</h1></div>`
                            );
                            setTimeout(function() {
                                location.replace(
                                    "{{ route('survey.advices', currentProjectUuid()) }}"
                                );
                            }, 2000);

                        } else {
                            $('#question').html(data);
                        }
                    }
                });
            });

            $('body').on('click', '.submit-input', function() {
                let value = $(".submit-onblur").val();
                let questionId = $(".submit-onblur").data("id");
                let email = $(".submit-onblur").closest('input[name=email]').val();
                let text = $(".submit-onblur").closest('input[name=text]').val();
                var number = $(".submit-onblur").closest('input[name=numeric]').val();

                if (email == '' && $('input[name=email]').hasClass('required')) { 
                    $('.error-message').text("Email Address is required");
                }
                else if (email && $('input[name=email]').hasClass('required') || $('input[name=email]').hasClass('optional')) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (!emailReg.test(value)) {
                        $('.error-message').text("Enter a valid Email Address");
                    } else { 
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                        $.ajax({
                            type: 'post',
                            url: "{{ route('saveAnswers', currentProjectUuid()) }}",
                            data: {
                                value: value,
                                text: text,
                                email: email,
                                questionId: questionId,
                            },
                            success: function(data) {
                                console.log("Answer Saveddd Successfully");
                                $('#question').html(data);
                            }
                        });
                    }
                } else {
                if (text == '' && $('input[name=text]').hasClass('required')) { 
                    $('.text-validation').text("Text field is required");
                }
                else if (text && $('input[name=text]').hasClass('required') || $('input[name=text]').hasClass('optional')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: "{{ route('saveAnswers', currentProjectUuid()) }}",
                        data: {
                            value: value,
                            number: number,
                            text: text,
                            email: email,
                            questionId: questionId,
                        },
                        success: function(data) {
                            console.log("Answer Saved Successfully");
                            $('#question').html(data);
                        }
                    });
                }
                else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: "{{ route('saveAnswers', currentProjectUuid()) }}",
                        data: {
                            value: value,
                            number: number,
                            text: text,
                            email: email,
                            questionId: questionId,
                        },
                        success: function(data) {
                            console.log("Answer Saved Successfully");
                            $('#question').html(data);
                        }
                    });
                }
            }
            });

            // validating length start
            var minLength =
                {{ $ProjectSetting && isset($ProjectSetting['new_question_text_min_length']) ? $ProjectSetting['new_question_text_min_length'] : 1 }};
            var maxLength =
                {{ $ProjectSetting && isset($ProjectSetting['new_question_text_max_length']) ? $ProjectSetting['new_question_text_max_length'] : 100 }}; //format for integer value 
            var errorMessage =
                "{{ $ProjectSetting && isset($ProjectSetting['new_question_text_error_message']) ? $ProjectSetting['new_question_text_error_message'] : 'invalid' }} "; //format for string
            $(document).ready(function() {
                $('body').on('keydown keyup change', '#card', function() {
                    var char = $(this).val();
                    var charLength = $(this).val().length;

                    if (charLength < minLength) {
                        $('.text-validation').text(errorMessage + minLength);
                        $(this).removeClass('submit-onblur');
                        $(this).siblings('div').addClass('text-danger');
                    } else if (charLength > maxLength) {

                        $('.text-validation').text('Length is not valid, maximum ' +
                            maxLength +
                            ' allowed.');
                        $(this).removeClass('submit-onblur');
                        $(this).val(char.substring(0, maxLength));
                        $(this).siblings('div').addClass('text-danger');
                    } else {

                        $(this).addClass('submit-onblur');
                        $(this).siblings('div').removeClass('text-danger');
                        $(this).siblings('div').addClass('text-danger');
                        $('.text-validation').text('');
                    }
                });

                $('.submit-input').click(function() {
                    var num = $("#numericfield").val();
                    if (num == '') {
                        $('.numeric-validation').text('Required field');
                        $('.numeric-validation').removeClass('submit-onblur');
                    } else {
                        $('.numeric-validation').text('');
                        $('.numeric-validation').addClass('submit-onblur');
                    }



                });

                //required check for number
            });
           
            function fetchPreviousQuestion(questionId = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('fetch_previous_question', currentProjectUuid()) }}",
                    method: "POST",
                    data: {
                        questionId: questionId
                    },
                    success: function(data) {
                      $('#question').html(data);
                      let questionType = $('.question-type').val();
               if ((questionType == 'Images') || (questionType == 'MCQS')) {
                $('.move-next').removeClass('d-none');
                 $('.skip').hide();
                } else {
                   $('.move-next').addClass('d-none');
                $('.skip').show();
             }
                        
                    }
                });
            }
            function fetchNextQuestion(questionId = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('fetch_next_question', currentProjectUuid()) }}",
                    method: "POST",
                    data: {
                        questionId: questionId
                    },
                    success: function(data) {
                        $('#question').html(data);
                    }
                });
            }
            $('body').on('click', '.previous-button', function() {
                var fq = fetchPreviousQuestion($('.question-id').val());
            });

            $('body').on('click', '.next-button', function() {
                let questionType = $('.question-type').val();
                if ((questionType == 'Images') || (questionType == 'MCQS') || (questionType == null)) {                    
                    if ($('input[name=check_answer]').is(':checked')) {
                        fetchNextQuestion($('.question-id').val());
                    } else {
                        toastMessage('Please select an option', 'error');
                    }
                }
            });
            var answers = new Array();
            var questionId = null;
            $('body').on('change', '.cbox', (function() {
                 questionId = $(this).data("id");
                if ($(this).is(':checked')){
                    answers.push($(this).val());
                }
                 else {
                     answers.splice(answers.findIndex(item => item == $(this).val()),1);
                    console.log(answers);
                }
                if(answers.length > 0){

                    console.log("before",answers.length);
                    $('.move-next').removeClass('d-none');
                    $('.skip').hide();
                }
                // when mcq length is less than 0
                else{
                    console.log("after",answers.length);
                    $('.skip').show();
                    $('.move-next').addClass('d-none');
                }
                
            }));
            $('body').on('click', '.save-multiplechoice', function() {
                var isSkip = $(this).hasClass('skip') ? true : false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('save-multiplechoice-answers', currentProjectUuid()) }}",
                    data: {
                        answers: answers ? answers : [],
                        questionId: $('.question-id').val(),
                        isSkip: isSkip,
                    },
                    success: function(response) {
                        answers = [];
                        $('#question').html(response);
                    }
                });
            });
       
        });


 //document.ready bracket end
    </script>
@endpush
