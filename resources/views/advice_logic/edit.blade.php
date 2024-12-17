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
<div class="nk-block">
    <div class="card ">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <form
                    action="{{ route('advice-logic.update', [currentAccount(), currentProject(), $adviceLogic->id]) }}"
                    class="gy-3" method="POST" enctype="multipart/form-data" data-form="ajax-form"
                    data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Advice</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap ">
                                    <select class="form-select" data-placeholder="Select adivce" data-search="on"
                                        name="advice" required>
                                        <option></option>
                                        @foreach ($advices as $advice)
                                            <option @if ($advice->id == $adviceLogic->advice->id) selected @endif
                                                value="{{ $advice->id }}">{{ $advice->secondary_title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="conditions">
                        @php $countConditions = 0;  @endphp
                        @foreach ($adviceLogic->conditions as $condition)
                            @php
                                $questionId = App\Models\Question::where('id', $condition->question_id)->first();
                                $questionType = $questionId->question_type;
                            @endphp
                            @if ($condition->question)
                                <div class="condition my-3 remove-advice-logic">
                                    @if ($condition->condition !== 'base')
                                        <div class="row g-3 condition-logic remove-advice-logic-numeric">
                                            <div class="col-lg-4 offset-lg-5">
                                                <div class="d-flex justify-content-between">
                                                    <span class="w-100">
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select class="form-control condition-select"
                                                                    name="condition_{{ $condition->question->uuid }}"
                                                                    required>
                                                                    <option value="">Select condition</option>
                                                                    <option
                                                                        @if ($condition->condition == 'or') selected @endif
                                                                        value="or">OR</option>
                                                                    <option
                                                                        @if ($condition->condition == 'and') selected @endif
                                                                        value="and">AND</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($questionType != 'Numeric')
                                        <div class="row g-3 question">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">Question</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select select-question" data-search="on"
                                                                name="question[]" data-placeholder="Select question">
                                                                <option></option>
                                                                @foreach ($questions as $question)
                                                                    <option
                                                                        @if ($condition->question_id == $question->id) selected @endif
                                                                        value="{{ $question->uuid }}">
                                                                        {{ $question->secondary_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <a href="#" class="py-1 pl-1 remove-fields">
                                                    <em class="icon ni ni-cross-circle-fill text-danger"
                                                        style="font-size: 16px;"></em></a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row g-3 options">
                                        @if ($questionType == 'MCQS' || $questionType == null)
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">Selected options</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="d-flex justify-content-between">
                                                    <span class="w-100">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap answers-select">
                                                                <select class="form-select" multiple="multiple"
                                                                    data-search="on"
                                                                    name="choice_{{ $condition->question->uuid }}[]"
                                                                    data-placeholder="Select answer">
                                                                    @foreach ($condition->question->answers as $answer)
                                                                        <option
                                                                            @if ($condition->options->contains('answer_id', $answer->id)) selected @endif
                                                                            value="{{ $answer->uuid }}">
                                                                            {{ $answer->answer }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($questionType == 'Images')
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label">Selected options</label><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="d-flex justify-content-between">
                                                    <span class="w-100">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap answers-select">
                                                                <select class="form-select" multiple="multiple"
                                                                    data-search="on"
                                                                    name="choice_{{ $condition->question->uuid }}[]"
                                                                    data-placeholder="Select answer">
                                                                    @foreach ($condition->question->answers as $answer)
                                                                        <option
                                                                            @if ($condition->options->contains('answer_id', $answer->id)) selected @endif
                                                                            value="{{ $answer->uuid }}">
                                                                            {{ $answer->image_description }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- numeric @s --}}
                                        @if ($questionType == 'Numeric')
                                            @foreach ($condition->options as $key => $option)
                                                <div class="row g-3 question remove-advice-logic-numeric">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Question</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select select-question"
                                                                        data-search="on" name="question[]"
                                                                        data-placeholder="Select question">
                                                                        <option></option>
                                                                        @foreach ($questions as $question)
                                                                            <option
                                                                                @if ($condition->question_id == $question->id) selected @endif
                                                                                value="{{ $question->uuid }}">
                                                                                {{ $question->secondary_title }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a href="#" class="py-1 pl-1 remove-fields-numeric remove-advice-logic-numeric">
                                                            <em class="icon ni ni-cross-circle-fill text-danger"
                                                                style="font-size: 16px;"></em></a>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Operator</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select" data-search="on"
                                                                        name="logic_{{ $condition->question->uuid }}[]"
                                                                        data-placeholder="Select answer">
                                                                        <option
                                                                            @if ($option->operator == 'equal to') selected @endif
                                                                            value="equal to"> Equal to
                                                                        </option>
                                                                        <option
                                                                            @if ($option->operator == 'not equal to') selected @endif
                                                                            value="not equal to"> not equal to
                                                                        </option>
                                                                        <option
                                                                            @if ($option->operator == 'greater than') selected @endif
                                                                            value="greater than"> greater than
                                                                        </option>
                                                                        <option
                                                                            @if ($option->operator == 'less than') selected @endif
                                                                            value="less than"> less than
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Value</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-control-wrap">
                                                            <input type="number"
                                                                name="value_{{ $condition->question->uuid }}[]"
                                                                value="{{ $option->value }}" class="form-control"
                                                                placeholder="Enter only number">
                                                        </div>
                                                    </div>
                                                    @php
                                                        $condition1 = $condition->condition;
                                                    @endphp
                                                    @if ($condition->condition == $condition1 && $questionType == 'Numeric' && $condition->options->count() > 1 && ($key < $condition->options->count() - 1))
                                                    <div class="row condition-logic remove-advice-logic" style="width: 100%;">
                                                        <div class="col-lg-4 offset-lg-5">
                                                            <div class="d-flex justify-content-between">
                                                                <span class="w-100">
                                                                    <div class="form-control-wrap ">
                                                                        <div class="form-control-select">
                                                                           <select class="form-control condition-select"
                                                                                name="condition_{{ $condition->question->uuid }}"
                                                                                required>
                                                                                <option value="">Select condition</option>
                                                                                <option
                                                                                    @if ($condition->condition == 'or' || $condition->condition == 'base') selected @endif
                                                                                    value="or">OR</option>
                                                                                <option
                                                                                    @if ($condition->condition == 'and') selected @endif
                                                                                    value="and">AND</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                </div>
                                            @endforeach
                                           
                                        @endif
                                        {{-- numeric @e --}}
                                    </div>
                                </div>
                                @php $countConditions++; @endphp
                            @endif
                        @endforeach

                        @if (!$countConditions)
                            <div class="condition my-3">
                                <div class="row g-3 question">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Question</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <select class="form-select select-question" data-search="on"
                                                        name="question[]" data-placeholder="Select question">
                                                        <option></option>
                                                        @foreach ($questions as $question)
                                                            <option value="{{ $question->uuid }}">
                                                                {{ $question->secondary_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 options">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label">Selected options</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="d-flex justify-content-between">
                                            <span class="w-100">
                                                <div class="form-group">
                                                    <div class="form-control-wrap answers-select">

                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </span>
                    <a href="#" class="new-condition"> Add another condition</a>
                    <div class="row g-3">
                        <div class="col-lg-8 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary"
                                    data-button="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->
