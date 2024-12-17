<style>
    .displayNone {
        display: none;
    }
</style>
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
                <form action="{{ route('multiple_question_advice_logic_update', [currentAccount(), currentProject()]) }}" class="gy-3" method="POST" enctype="multipart/form-data" data-form="ajax-form" data-callback="fetchData" data-editForm="editFormCallback">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                    <input type="hidden" name="answer_count" class="answer_count" value="{{ sizeof($currentQuestion->answers) }}">
                    <input type="hidden" class="questionValues" value="{{ sizeof($questionValues) }}">
                    <input type="hidden" class="productSetupId" value="{{ $questionValues[0]->product_setup_id }}">
                    <div class="row g-3 field">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Product Database Field</label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <div class="form-control-wrap ">
                                        <select class="form-select select-field product_setup_id" data-search="on" name="product_field" data-placeholder="Select Product Field">
                                            <option></option>
                                            @foreach ($productSetups as $setup)
                                            @for ($i = 0; $i < 1; $i++) <option data-id="{{ $setup->id }}" @if ($setup->id == $questionValues[0]->product_setup_id) selected @endif value="{{ $setup->id }}">
                                                {{ $setup->field }}
                                                </option>
                                                @endfor
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $k = 0;
                    @endphp
                    @foreach ($currentQuestion->answers as $answer)
                    <div class="my-3 field">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">MCQ option</label>
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
                                            <option value="{{ $selectedAnswer->id }}" @if ($selectedAnswer->id == $answer->id) selected @else disabled @endif>
                                                {{ $selectedAnswer->answer }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 options setup-field-values-with-values">
                        <div class="col-lg-3">
                            <div class="form-group value-labels">
                                <label class="form-label label-data-with-values">
                                    @foreach ($productSetups as $setup)
                                    @for ($i = 0; $i < 1; $i++) @if ($setup->id == $questionValues[0]->product_setup_id)
                                        {{ $setup->field }}
                                        @endif
                                        @endfor
                                        @endforeach
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between">
                                <span class="w-100">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-select form-select-with-values product-setup-with-values-select-{{ $k }}" multiple="multiple" data-search="on" data-placeholder="Select value" name="value_id_{{ $k }}[]">
                                                <option></option>
                                                @php
                                                $valuesCount = sizeof($questionValues[$k]->values);
                                                $valueSelected = 0;
                                                @endphp
                                                @for ($j = 0; $j < sizeof($productSetup->productSetupValues); $j++)
                                                    @if ($valueSelected < $valuesCount && $questionValues[$k]->values[$valueSelected]['value_id'] == $productSetup->productSetupValues[$j]->id)
                                                        <option value="{{ $productSetup->productSetupValues[$j]->id .'-' . $productSetup->productSetupValues[$j]->product_id }}" selected>
                                                            @if ($productSetup->is_list == "1")
                                                            {{ $productSetup->productSetupValues[$j]->list_values }}
                                                            @else
                                                            {{ $productSetup->productSetupValues[$j]->value }}
                                                            @endif
                                                        </option>
                                                        @php
                                                        $valueSelected = $valueSelected + 1;
                                                        @endphp
                                                        @else
                                                        <option value="{{ $productSetup->productSetupValues[$j]->id . '-' . $productSetup->productSetupValues[$j]->product_id }}">
                                                            @if ($productSetup->is_list == "1")
                                                            {{ $productSetup->productSetupValues[$j]->list_values }}
                                                            @else
                                                            {{ $productSetup->productSetupValues[$j]->value }}
                                                            @endif
                                                        </option>
                                                        @endif
                                                        @endfor
                                            </select>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 options setup-field-values displayNone">
                        <div class="col-lg-3">
                            <div class="form-group value-labels">
                                <label class="form-label label-data"></label>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="d-flex justify-content-between">
                                <span class="w-100">
                                    <div class="form-group">
                                        <div class="form-control-wrap values-select-{{ $k }}">
                                            <select class="form-select form-select-without-values value_id_select_{{ $k }}" multiple="multiple" data-search="on" data-placeholder="Select value" name="value_id_{{ $k }}[]">
                                            </select>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    @php
                    $k = $k + 1;
                    @endphp
                    @endforeach

                    <div class="row g-3">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-primary" data-button="submit">Update</button>
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
    $(document).on('change', '.select-field', function() {
        product_setup_id = $(".productSetupId").val();
        changed_product_setup_id = $(".product_setup_id").val();
        $(".setup-field-values-with-values").addClass("displayNone");
        var value = $("option:selected", this).val();
        var question_id = $("input[name=question_id]", this).val();
        $.ajax({
            method: "GET",
            url: "{{ route('mcq_advice_logic.get_values', [currentAccount(), currentProject()]) }}",
            data: {
                id: value,
                question_id: value
            },
            success: function(data) {
                console.log(data);
                $(".setup-field-values").removeClass("displayNone");
                $('.form-select-without-values').select2({
                    placeholder: "Select value"
                });
                var answersCount = <?php echo sizeof($currentQuestion->answers); ?>;
                for (var i = 0; i < answersCount; i++) {
                    if (product_setup_id == changed_product_setup_id) {
                        $('.product-setup-with-values-select-' + i).attr("name", 'value_id_' + i + '[]')
                    } else {
                        $('.product-setup-with-values-select-' + i).removeAttr("name")
                    }
                    // var label_count = i + 1;
                    // $(".label-data").text(data[1].labels + "     " + label_count);
                    $(".label-data").text(data[1].labels);
                    $(".value_id_select_" + i).html(data[0].data);
                }
                $(".answer_count").val(answersCount);
            }
        });
    });
</script>