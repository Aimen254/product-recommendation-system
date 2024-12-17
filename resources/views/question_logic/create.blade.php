<div class="nk-block-head nk-block-head-lg pb-0">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <div class="nk-block-des">
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card ">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                @php
                if($currentQuestion->is_multiple){
                $route = 'multiple_question_logic_create';
                }
                else{
                $route = 'question_logic_create';
                }
                @endphp
                <form action="{{ route($route, [currentAccount(), currentProject()]) }}" class="" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf

                    <input type="hidden" name="selected_question_id" value="{{ $currentQuestion->id }}">
                    {{--Logic for next question if multiple checkbox is on  --}}
                    @if($currentQuestion->is_multiple)
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
                                        <select class="form-select select-question" data-search="on" name="question[]" data-placeholder="Select question" required>
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
                    {{-- multiple checkbox question is end  --}}
                    <!-- @if ($logicConditions->isEmpty() && !($currentQuestion->is_multiple))
                    @foreach ($currentQuestion->answers as $answer)
                    <div class="my-3 field">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">If answer is</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <div class="form-control-wrap ">
                                        <div class="append-select">
                                        </div>
                                        <select class="form-select select-answer" name="answer[]" data-placeholder="Select Answer">
                                            <option></option>
                                            @foreach ($currentQuestion->answers as $selectedAnswer)
                                            @if($selectedAnswer->answer_type == 'image')
                                            <option value="{{ $selectedAnswer->id }}" @if($selectedAnswer->id==$answer->id) selected @else disabled @endif > {{$selectedAnswer->image_description}}</option>
                                            @else
                                            <option value="{{ $selectedAnswer->id }}" @if($selectedAnswer->id==$answer->id) selected @else disabled @endif > {{$selectedAnswer->answer}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <select class="form-select select-question" data-search="on" name="question[]" data-placeholder="Select question">
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
                    </div>
                    @endforeach
                    @endif -->
                    @if (!($currentQuestion->is_multiple))
                    @foreach ($currentQuestion->answers as $answer)
                    <div class="my-3 field">
                        <!-- If answer is -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">If answer is</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="append-select">
                                        </div>
                                        <select class="form-select select-answer" name="answer[]" data-placeholder="Select Answer">
                                            <option></option>
                                            @foreach ($currentQuestion->answers as $selectedAnswer)
                                            @if ($selectedAnswer->answer_type == 'image')
                                            <option value="{{ $selectedAnswer->id }}" {{ $selectedAnswer->id == $answer->id ? 'selected' : 'disabled' }}>
                                                {{ $selectedAnswer->image_description }}
                                            </option>
                                            @else
                                            <option value="{{ $selectedAnswer->id }}" {{ $selectedAnswer->id == $answer->id ? 'selected' : 'disabled' }}>
                                                {{ $selectedAnswer->answer }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Next Question -->
                        <div class="row question py-2">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Next Question</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex justify-content-between">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="append-select">
                                            </div>
                                            <select class="form-select select-question" data-search="on" name="question[]" data-placeholder="Select question">
                                                <option></option>
                                                @foreach ($questions as $question)
                                                <option {{ $answer->logic && $answer->logic->next_question_id == $question->id ? 'selected' : '' }} value="{{ $question->id }}">
                                                    {{ $question->secondary_title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @foreach ($currentQuestion->answers as $selectedAnswer)
                    @if ($currentQuestion->is_multiple && $selectedAnswer->answer_type == 'MCQS' )
                    <div class="row question py-2">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Next Question</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="append-select"></div>
                                        <select class="form-select select-question" data-search="on" name="question[]" data-placeholder="Select question">
                                            @foreach ($questions as $question)
                                            @if ($currentQuestion->id != $question->id)
                                            <option value="{{ $question->id }}" @if ($question->id == $numberLogics[0]->next_question_id) selected @endif>
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
                    @endforeach
                    <span class="conditions">
                    </span>
                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary" data-button="submit">Save</button>
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
</script>