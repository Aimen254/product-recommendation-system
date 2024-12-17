@extends('layouts.app')
<style>
    .handle {
        position: relative;
        font-size: 1.125rem;
        cursor: move;
        height: 1.25rem;
        width: 1.25rem;
        margin-right: .5rem;
    }

    .ui-state-highlight {
        background: #f5f6fa
    }

    .fancy-spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 5rem;
        height: 5rem;
    }

    .fancy-spinner div {
        position: absolute;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .fancy-spinner div.ring {
        border-width: 0.5rem;
        border-style: solid;
        border-color: transparent;
        animation: 2s fancy infinite alternate;
    }

    .fancy-spinner div.ring:nth-child(1) {
        border-left-color: #979fd0;
        border-right-color: #979fd0;
    }

    .fancy-spinner div.ring:nth-child(2) {
        border-top-color: #979fd0;
        border-bottom-color: #979fd0;
        animation-delay: 1s;
    }

    .fancy-spinner div.dot {
        width: 1rem;
        height: 1rem;
        background: #979fd0;
    }

    @keyframes fancy {
        to {
            transform: rotate(360deg) scale(0.5);
        }
    }
</style>
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @include('layouts.includes.survey_builder_tabs')
                    <div class="nk-block pt-0">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true"
                                    style="min-height: 400px">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="lead-text">Advices</span>
                                                </div>
                                                <div class="user-action align-self-center">
                                                    <button class="btn btn-sm btn-primary advice-form-btn" id="advice-form-btn" data-method="get"
                                                        data-action-url="{{ route('advice-logic.create', [currentAccount(), currentProject()]) }}"><em
                                                            class="icon ni ni-plus"></em><span>Add</span></button>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0 question-container">
                                            <div id="sortable" class="h-100">
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card-aside -->
                                <div class="card-inner card-inner-lg" id="advices-form">
                                    @include('advice_logic.create')
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
        $(document).ready(function() {
            $('.active-tab').addClass('active');
            fetchData();
            $('.form-select').select2({
                placeholder: $(this).attr('data-placeholder')
            });
        });


        $(document).on('change', '.select-question', function() {

            var value = $("option:selected", this).val();
            btn1 = $(this).parents('.question').next('.options').find('.answers-select');
            label = $(this).parents('.question').next('.options').find('.labels');
            conditionSelect = $(this).parents('.question').prev('.condition-logic').find('.condition-select');
            conditionSelect.attr('name', 'condition_' + value);
            $.ajax({
                method: "GET",
                url: "{{ route('questions.get_answers', [currentAccount(), currentProject()]) }}",
                data: {
                    uuid: value
                },
                success: function(data) {
                    $(btn1).html(data[0].data);
                    $(label).html(data[1].labels);
                    $('.form-select').select2({
                        placeholder: "Select answer"
                    });
                }
            });
        });

        $(document).on('click', '.new-condition', function(e) {

            btn1 = $(this).parents('.sortable-item');
            e.preventDefault();
            $.ajax({
                url: "{{ route('advice-logic.new_condition', [currentAccount(), currentProject()]) }}",
                data: {},
                success: function(data) {
                    $('.conditions').append(data);
                    $('.form-select').select2({
                        placeholder: "Select answer"
                    });
                }
            });
        });
        $(document).on('click', '.remove-answer-field', function(e) {

            e.preventDefault();
            if ($("#sortable-answers").children().length > 1) {
                $(this).parents('.answer').remove();
            } else {
                toastMessage('Minimum 1 answer is required', 'error');
            }
        });

        $(document).on('click', '.advice-form-btn', function(e) {

            e.preventDefault();
            $('.advice').removeClass('bg-lighter');
            $(this).parents('.advice').addClass('bg-lighter');
            $.ajax({
                method: $(this).attr('data-method'),
                url: $(this).attr('data-action-url'),

                success: function(data) {

                    $('#advices-form').html(data);
                    $('.form-select').select2({
                        placeholder: "Select question"
                    });


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
                }
            });
        });

        function fetchData() {

            $.ajax({
                url: "{{ route('advice-logic.get_advices', [currentAccount(), currentProject()]) }}",
                data: {},
                success: function(data) {
                    $('#sortable').html(data);
                }
            });
        }

        function editFormCallback(uuid) {

            console.log(uuid)
            $.ajax({
                method: "GET",
                url: "/accounts/" + "{{ currentAccount() }}" + "/projects/" + "{{ currentProject() }}" +
                    "/advice-logic/" + uuid + "/edit",

                success: function(data) {
                    $('#advices-form').html(data);
                    $('.form-select').select2({
                        placeholder: $(this).attr('data-placeholder')
                    });
                    setTimeout(function() {
                        $('#advice_' + id).addClass('bg-lighter');
                    }, 500);
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $("#sortable").sortable({
                handle: '.handle',
                placeholder: "ui-state-highlight",
                start: function(e, ui) {
                    ui.placeholder.height(ui.helper[0].scrollHeight);
                },
                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    console.log(data);
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

        $(document).ready(function() {

            $('body').on("click", ".scroll", function() {
                jQuery('html,body').animate({
                    scrollTop: 0
                }, 800);
            });
        });

        $("body").on('click', '.remove-fields', function(e) {
            e.preventDefault();
            $(this).parents('.remove-advice-logic').remove();
        });

        $("body").on('click', '.remove-fields-numeric', function(e) {
            e.preventDefault();
            $(this).parents('.remove-advice-logic-numeric').remove();
        });

        $(document).on('delete-advice-trigger', function(){
            console.log("add question button clicked");
            $('#advice-form-btn').click();
        });
    </script>
@endpush
