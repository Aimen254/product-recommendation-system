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
    <div class="card">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <form action="{{ route('number_question_logic_create', [currentAccount(), currentProject()]) }}"
                    class="" method="POST" enctype="multipart/form-data" data-form="ajax-form"
                    data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    <input type="hidden" name="selected_question_id" value="{{ $currentQuestion->id }}">
                    <input type="hidden" name="data[id]" value="">
                    <input type="hidden" name="_perform" value="add">

                    @php
                        $counter = count($numberLogics) ? count($numberLogics) : 1;
                    @endphp
                    @if ($numberLogics->isEmpty())
                        <div class="condition-remove row question py-2">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">Operator</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex justify-content-between">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="append-select">
                                            </div>
                                            <select class="form-select form-control operator-select" data-search="off"
                                                name="data[details][1][logic]" data-placeholder="Select Logic">
                                                <option value=""></option>
                                                <option class="default" value="default"> Default </option>
                                                <option value="equal to"> Equal to </option>
                                                <option value="not equal to"> Not Equal to </option>
                                                <option value="greater than"> Greater than </option>
                                                <option value="less than"> Less than </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="answer-field condition-remove row data-count_val" data-count="{{ $counter }}">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label">If answer is</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="data[details][1][value]"
                                        placeholder="value">
                                </div>
                            </div>
                        </div>

                        <div class="condition-remove row question py-2">
                            <div class="col-lg-2">
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
                                            <select class="form-select form-control select-question" data-search="on"
                                                name="data[details][1][question]" data-placeholder="Select question">
                                                <option value=""></option>
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

                    {{-- Added record --}}

                    @if ($numberLogics->count())
                        @foreach ($numberLogics as $numberLogic)
                            <input type="hidden" name="question_id" value="{{ $numberLogic->selected_question_id }}">
                            <input type="hidden" name="_perform" value="edit">
                            <div class="pt-5 remove-edit-condition">
                                <div class="row question py-2 remove-edit-condition">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-label">Operator</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <div class="append-select">
                                                    </div>
                                                    <select class="form-select operator-select" data-search="off"
                                                        name="data[details][{{ $loop->iteration }}][logic]"
                                                        data-placeholder="Select Logic">
                                                        <option></option>
                                                        <option class="default"
                                                            @if ($numberLogic->firstOperator == 'default') selected @else @endif
                                                            value="default"> Default </option>
                                                        <option value="equal to"
                                                            @if ($numberLogic->firstOperator == 'equal to') selected @else @endif>
                                                            Equal to </option>
                                                        <option value="not equal to"
                                                            @if ($numberLogic->firstOperator == 'not equal to') selected @else @endif> Not
                                                            Equal to </option>
                                                        <option value="greater than"
                                                            @if ($numberLogic->firstOperator == 'greater than') selected @else @endif>
                                                            Greater than </option>
                                                        <option value="less than"
                                                            @if ($numberLogic->firstOperator == 'less than') selected @else @endif>
                                                            Less than </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="py-1 pl-1 remove-fields">
                                        <em class="icon ni ni-cross-circle-fill text-danger" style="font-size: 16px;"></em></a>
                                </div>

                                <div class="row answer-field data-count_val remove-edit-condition"
                                    data-count="{{ $counter }}">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-label">If answer is</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control"
                                                name="data[details][{{ $loop->iteration }}][value]"
                                                placeholder="value" value="{{ $numberLogic->firstValue }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row question py-2 remove-edit-condition">
                                    <div class="col-lg-2">
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
                                                        name="data[details][{{ $loop->iteration }}][question]"
                                                        data-placeholder="Select question">
                                                        <option></option>
                                                        @foreach ($questions as $question)
                                                            @if ($currentQuestion->id != $question->id)
                                                                <option value="{{ $question->id }}"
                                                                    @if ($question->id == $numberLogic->next_question_id) selected @else @endif>
                                                                    {{ $question->secondary_title }}</option>
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
                    @endif
                    <div id="remove-condition" class="add_new_logic">

                    </div>
                    
                    <a href="javascript:void(0);" class="new-question-logic" > <em
                            class="icon ni ni-plus-circle-fill mr-1"></em>Add another condition</a>

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
$(function() {
    var selectedVal;  // may want to assign a default
    var selectedValues = [];
    
    //check default option
    $('body').on('change', '.operator-select', function() {
         selectedVal = $(this).val();
        
        if (selectedVal == "default") {
            $(".new-question-logic").hide();
        } else {   
            $(".new-question-logic").show();         
           // $('.default').prop('disabled', true);        
        }
       
    });
    $('.form-select').select2({
        placeholder: $(this).attr('data-placeholder')
    });

        //check default option
        $('body').on('change', '.operator-select', function() {
            selectedVal = $(this).val();

            if (selectedVal == "default") {
                $(".new-question-logic").hide();
                $(".answer-field").hide();
            } else {
                $(".new-question-logic").show();
                $(".answer-field").show();
               // $('.default').prop('disabled', true);
            }

        });
        $('.form-select').select2({
            placeholder: $(this).attr('data-placeholder')
        });

        //render in question logic
        $('body').off('click').on('click', '.new-question-logic', function() {
            $(".operator-select").each(function() {
                selectedValues.push(selectedVal);
            })
            $.ajax({
                type: "get",
                url: "{{ route('add-question-logic', [currentAccount(), currentProject()]) }}",
                success: function(response) {
                    selectedValues = selectedValues.filter(item => item);
                    var tmpHtml = document.createElement('html');
                    tmpHtml.innerHTML = response;
                    for (i = 0; i < selectedValues.length; i++) {
                        if (selectedValues[i] == 'greater than' || selectedValues[i] ==
                            'less than') {
                            var x = tmpHtml.getElementsByClassName(selectedValues[i])[0]
                                .disabled = true;
                        }
                    }


                    let counter = $(".data-count_val").data("count");
                    let final_count = counter + 1;
                    $(".data-count_val").data("count", final_count);
                    let num_name_val = 'data[details][' + final_count + '][value]';
                    let question_name_val = 'data[details][' + final_count + '][question]';
                    let logic_name_val = 'data[details][' + final_count + '][logic]';


                    let value_elem = (document).getElementsByName(
                        'data[details][1][value]')[0];

                    value_elem.setAttribute('name', num_name_val);

                    let question_elem = (document).getElementsByName(
                        'data[details][1][question]')[0];

                    question_elem.setAttribute('name', question_name_val);

                    let logic_elem = (document).getElementsByName(
                        'data[details][1][logic]')[0];
                    logic_elem.setAttribute('name', logic_name_val);
                    $(".add_new_logic").append(tmpHtml);
                    $(".new-question-logic").hide();
                    $('.default').prop('disabled', true);
                }
            });
        });

    });

    $(document).on('click', '.remove-condition-fields', function(e) {
        e.preventDefault();
        $(this).parents('.condition-remove').remove();
    });

    $(document).on('click', '.remove-fields', function(e) {
        e.preventDefault();
        $(this).parents('.remove-edit-condition').remove();
    });


    $(document).ready(function() {
        $(".new-question-logic").hide();
        var operatorValue = $(".operator-select").val();
        if(operatorValue == 'default')
        {
            $(".answer-field").hide();
        }else{
            $(".answer-field").show();
        }
        
        
        if (operatorValue == 'default' || operatorValue == '') {
            $(".new-question-logic").hide();
        } else {
            $(".new-question-logic").show(); 
        }

    });        
</script>
