@extends('layouts.app')
@section('content')
<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                @include('layouts.includes.survey_builder_tabs')

                <div class="nk-block pt-0">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true" style="min-height: 400px">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="user-card">
                                            <div class="user-info">

                                                <span class="lead-text">Questions</span>

                                            </div>
                                            <div class="user-action align-self-center">
                                                <button class="btn btn-sm btn-primary question-form-btn" id="question-form-btn" data-method="get" data-action-url="{{ route('questions.create', [currentAccount(), currentProject()]) }}"><em class="icon ni ni-plus"></em><span>Add</span></button>
                                            </div>
                                        </div><!-- .user-card -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner p-0 question-container">
                                        <div id="sortable" class="h-100">

                                        </div>

                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card-aside -->
                            <div class="card-inner card-inner-lg" id="questions-form">

                                @include('questions.create')
                            </div><!-- .card-inner -->

                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var answer_type = null;
    $(document).ready(function() {
        $('.active-tab').addClass('active');
        fetchData();
        initAnswersSorting();
    });

    $(document).on('click', '.add-answer-field', function(e) {
        e.preventDefault();
        var mcq_length_count = $('.add-answer-field').length;
        if ($('.answer-type').val()) {
            answer_type = $('.answer-type').val();
        }
        console.log(answer_type);
        if (answer_type == 'MCQS' || answer_type == null) {
            $(`<div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                    <span class="handle align-self-center"><em
                            class="icon ni ni-move"></em></span>
                                <span class="w-100">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="hidden" name="type" value="mcqs">
                                    <input type="text" class="form-control mcq_answer" id="answer` + mcq_length_count + `"
                                        name="answer[]" value=""
                                        placeholder="Enter answer..." maxlength="40">
                                        <span id="charNum` + mcq_length_count + `">40 characters remaining</span>
                                </div>
                            </div>
                        </span>
                    <div class="user-action align-self-center d-flex ml-2">
                        <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                        <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                    </div>
                </div>`).insertAfter($(this).parents('.answer'));
                // function call count mcqs answer characters length to 40
                charCounter();
        }

        if (answer_type == 'Images') {
            $(`<div class="answer py-3 bg-white border-bottom border-light d-flex justify-content-between">
                    <span class="handle align-self-center"><em
                            class="icon ni ni-move"></em></span>
                                <span class="w-100">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="hidden" name="type" value="image">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input upload-image" required name="answer[]">
                                    <label class="custom-file-label update-image-label" for="customFile">Choose file</label>
                                </div>
                                <input type="text" class="form-control mt-2" name="image_description[]" required value="" placeholder="Enter text here">
                                </div>
                            </div>
                        </span>
                    <div class="user-action align-self-center d-flex ml-2">
                        <a href="#" class="py-1 add-answer-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                        <a href="#" class="py-1 pl-1 remove-answer-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                    </div>
            </div>`).insertAfter($(this).parents('.answer'));    
        }

    });
    $(document).on('click', '.remove-answer-field', function(e) {
        e.preventDefault();
        if ($("#sortable-answers").children().length > 2) {
            $(this).parents('.answer').remove();
        } else {
            toastMessage('Minimum 2 choices are required', 'error');
        }
    });

    $(document).on('click', '.question-form-btn', function(e) {
        e.preventDefault();
        $('.question').removeClass('bg-lighter');
        $(this).parents('.question').addClass('bg-lighter');
        $.ajax({
            method: $(this).attr('data-method'),
            url: $(this).attr('data-action-url'),

            success: function(data) {
                $('#questions-form').html(data);
                initAnswersSorting();
            }
        });
    });

    $(document).on('click', '.clone-question', function(e) {
        e.preventDefault();
        $.ajax({
            method: $(this).attr('data-method'),
            url: $(this).attr('data-action-url'),

            success: function(data) {
                fetchData();
                editFormCallback(data.question.uuid, data.question.id);
            }
        });
    });

    function fetchData() {
        $.ajax({
            url: "{{ route('questions.get_questions', [currentAccount(), currentProject()]) }}",
            data: {},
            success: function(data) {
                $('#sortable').html(data);
                initAnswersSorting();
            }
        });
    }

    function editFormCallback(uuid, id) {
        $.ajax({
            method: "GET",
            url: "/accounts/" + "{{ currentAccount() }}" + "/projects/" + "{{ currentProject() }}" +
                "/questions/" + uuid + "/edit",

            success: function(data) {
                $('#questions-form').html(data);
                setTimeout(function() {
                    $('#question_' + id).addClass('bg-lighter');
                }, 500);
            }
        });
    }
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        var sort = $("#sortable").sortable({
            handle: '.handle',
            placeholder: "ui-state-highlight",
            start: function(e, ui) {
                ui.placeholder.height(ui.helper[0].scrollHeight);
            },
            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                // POST to server using $.post or $.ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('questions.sort', [currentAccount(), currentProject()]) }}",
                    success: function(response) {
                        toastMessage(response.message, 'success');
                    },
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
<script>
    function initAnswersSorting() {
        $("#sortable-answers").sortable({
            handle: '.handle',
            placeholder: "ui-state-highlight",
            start: function(e, ui) {
                ui.placeholder.height(ui.helper[0].scrollHeight);
            },
        });
        $("#sortable").disableSelection();
    }

    $(document).on('click', '.condition', function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        $.ajax({
            url: url,
            data: {},
            success: function(data) {
                $('.conditions').append(data);
                $('.form-select').select2({
                    placeholder: "Select answer",
                });
                return
            }
        });
    });

    $('body').on('click', '.remove-logic', function() {
        let url = $(this).data('url');
        window.swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this record",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                window.swal.fire({
                    title: "",
                    text: "Please wait...",
                    showConfirmButton: false,
                    backdrop: true
                });

                window.axios.delete(url).then(response => {
                    if (response.status === 200) {
                        window.swal.close();
                        // Show toast message
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        $(this).parents('.field').hide();
                    }
                }).catch(error => {
                    window.swal.close();
                    // Show toast message
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            }
        });
    });

    // Fetch Answer type on select
    $('body').on('change', '.select-answer-type', function() {
        answer_type = $(this).val();
        $.ajax({
            type: 'get',
            url: "{{ route('get_questions_type', [currentAccount(), currentProject()]) }}",
            data: {
                data: answer_type
            },
            success: function(response) {
                $('#question_type').html(response);
            }
        });
    });

    $(document).on("change", ".upload-image", function() {
        let element = $(this).siblings('label');
        ! function(e) {
            if (e.files && e.files[0]) {
                $(element).html(e.files[0].name);
            }

        }(this)
    });

    $(document).on('delete-question-trigger', function() {
        $('#question-form-btn').click();
    });

    // function call count mcqs answer characters length to 40
    charCounter();
    // count mcqs answer characters length to 40
    function charCounter() {
        $('.mcq_answer').on('keyup', function() {
            var id = $(this).attr("id");
            let obj = document.getElementById(id);
            var no_arr = id.split("answer");
            var no = no_arr[1];
            var maxLength = 40;
            var strLength = obj.value.length;
            var charRemain = (maxLength - strLength);

            if (charRemain < 0) {
                document.getElementById("charNum" + no).innerHTML = '<span style="color: red;">You have exceeded the limit of ' + maxLength + ' characters</span>';
            } else {
                document.getElementById("charNum" + no).innerHTML = charRemain + ' characters remaining';
            }
        });
    }
</script>
@endpush