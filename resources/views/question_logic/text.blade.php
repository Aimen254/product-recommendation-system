<div class="nk-block-head nk-block-head-lg pb-0">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <div class="nk-block-des">
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                    class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
@php
    if ($numberLogics->count()) {
        $route = 'text_question_logic_edit';
    } else {
        $route = 'text_question_logic_create';
    }
@endphp
<div class="nk-block">
    <div class="card">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <form action="{{ route('text_question_logic_create', [currentAccount(), currentProject()]) }}"
                    class="" method="POST" enctype="multipart/form-data" data-form="ajax-form"
                    data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    <input type="hidden" name="selected_question_id" value="{{ $currentQuestion->id }}">

                    {{-- Edit block @start --}}
                    @if ($numberLogics->count() > 0)
                        @if ($currentQuestion->choice == 'required')
                            <label class="form-label">Required*</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>
                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}"
                                                                @if ($question->id == $numberLogics[0]->next_question_id) selected @endif>
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($currentQuestion->choice == 'optional')
                            <label class="form-label">If answer is Empty</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>
                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}"
                                                                @if ($question->id == $numberLogics[0]->next_question_id) selected @endif>
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">If answer is filled</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>
                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}"
                                                                @if (isset($numberLogics[1]) && $question->id == $numberLogics[1]->next_question_id) selected @endif>
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Edit block end --}}

                        {{-- create block start --}}
                    @else
                        @if ($currentQuestion->choice == 'required')
                            <label class="form-label">Required*</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>

                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}">
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($currentQuestion->choice == 'optional')
                            <label class="form-label">If answer is Empty</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>

                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}">
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="form-label">If answer is filled</label>
                            <div class="row question py-2">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Next Question</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="append-select">
                                                </div>

                                                <select class="form-select select-question" data-search="on"
                                                    name="question[]" data-placeholder="Select question">
                                                    <option></option>
                                                    @foreach ($questions as $question)
                                                        @if ($currentQuestion->id != $question->id)
                                                            <option value="{{ $question->id }}">
                                                                {{ $question->secondary_title }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    {{-- create block end --}}
                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary"
                                    data-button="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->
<script>
    $('.form-select').select2({
        placeholder: $(this).attr('data-placeholder')
    });

    $('.second_value').hide();

    $('body').on('change', '#select_option', function() {
        var selected_option = $(this).val();
        if (selected_option == "Greater than and Less than" || selected_option ==
            "Greater than Equal to and Less than equal to") {
            $('.second_value').show();
        } else {
            $('.second_value').hide();
        }
    });
</script>
