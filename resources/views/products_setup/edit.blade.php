<form action="{{ route('products_setup.update', [currentAccount(), $productFields->uuid]) }}" method="POST" id="product-setup-form" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#product-setup-table" data-modal="#ajax_model">
    @csrf
    @method('put')
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit Product Field</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label" for="product_field_name">Name</label>
            <input type="text" class="form-control" value="{{ $productFields->field }}" name="product_field_name" placeholder="Enter Product Field Name">
        </div>

        <div class="form-group">
            <label class="form-label" for="data_type">Select Type</label>
            <div class="form-control-wrap">
                <select name="data_type" class="form-select form-control select-data-type" data-search="off" data-placeholder="Select Type" tabindex="-1">
                    <option value="text" {{ $productFields->type == 'text' ? 'selected' : '' }}>text</option>
                    <option value="numeric" {{ $productFields->type == 'numeric' ? 'selected' : '' }}>numeric</option>
                    <option value="image" {{ $productFields->type == 'image' ? 'selected' : '' }}>image</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="site-off">List</label>
            <div class="row g-3 align-center">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" {{ $productFields->is_list == 1 ? 'checked' : '' }} class="custom-control-input" name="is_list" value="1" id="site-off">
                        <label class="custom-control-label" for="site-off"></label>
                        <span>This field contains list of values</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($productFields->type == 'image')
        <div class="image-field">
            @else
            <div class="image-field d-none">
                @endif
                @if($productFields->is_list == '1')
                <div class="form-group image-multiple-field">
                    @else
                    <div class="form-group image-multiple-field d-none">
                        @endif
                        @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                        <div class="sortable-file-products" class="h-100">
                            <div class="product py-1 bg-white d-flex justify-content-between">
                                <span class="w-100">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <!-- <input type="hidden" name="type" value="image"> -->
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input upload-image" value="{{$productSetupValue->list_values}}" id="image_file" name="image[]">
                                                <label class="custom-file-label update-image-label" for="image[]">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <div class="user-action align-self-center d-flex ml-2">
                                    <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                    <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($productFields->is_list == '0')
                    <div class="form-group image-single-field">
                        @else
                        <div class="form-group image-single-field d-none">
                            @endif
                            <div class="form-control-wrap">
                                @php $i=0; @endphp
                                @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                                @if($i==0)
                                <!-- <input type="hidden" name="type" value="image"> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input upload-image" value="{{$productSetupValue->value}}" id="image_file" name="image[]">
                                    <label class="custom-file-label update-image-label" for="image">Choose file</label>
                                </div>
                                @endif
                                @php $i=$i+1; @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if ($productFields->type == 'text')
                    <div class="text-field">
                        @else
                        <div class="text-field d-none">
                            @endif
                            @if($productFields->is_list == '1')
                            <div class="form-group text-multiple-field">
                                @else
                                <div class="form-group text-multiple-field d-none">
                                    @endif
                                    @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                                    <div class="sortable-text-products" class="h-100">
                                        <div class="product py-1 bg-white d-flex justify-content-between" data-product-id="1">
                                            <span class="w-100">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" value="{{$productSetupValue->list_values}}" name="text[]" placeholder="Enter Field Value...">
                                                    </div>
                                                </div>
                                            </span>
                                            <div class="user-action align-self-center d-flex">
                                                <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                                <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                @if($productFields->is_list == '0')
                                <div class="form-group text-single-field">
                                    @else
                                    <div class="form-group text-single-field d-none">
                                        @endif
                                        @php $i=0; @endphp
                                        @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                                        @if($i==0)
                                        <input type="text" class="form-control" value="{{$productSetupValue->value}}" name="text[]" placeholder="Enter Field Value...">
                                        @endif
                                        @php $i=$i+1; @endphp
                                        @endforeach
                                    </div>
                                </div>
                                @if ($productFields->type == 'numeric')
                                <div class="number-field">
                                    @else
                                    <div class="number-field d-none">
                                        @endif
                                        @if($productFields->is_list == '1')
                                        <div class="form-group number-multiple-field">
                                            @else
                                            <div class="form-group number-multiple-field d-none">
                                                @endif
                                                @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                                                <div class="sortable-numeric-products" class="h-100">
                                                    <div class="product py-1 bg-white d-flex justify-content-between" data-product-id="1">
                                                        <span class="w-100">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input type="number" class="form-control" name="number[]" value="{{$productSetupValue->list_values}}" placeholder="Enter Field Value...">
                                                                </div>
                                                            </div>
                                                        </span>
                                                        <div class="user-action align-self-center d-flex">
                                                            <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                                            <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @if($productFields->is_list == '0')
                                            <div class="form-group number-single-field">
                                                @else
                                                <div class="form-group number-single-field d-none">
                                                    @endif
                                                    @php $i=0; @endphp
                                                    @foreach ($productSetupValues->productSetupValues as $productSetupValue)
                                                    @if($i==0)
                                                    <input type="number" class="form-control" name="number[]" value="{{$productSetupValue->value}}" placeholder="Enter Field Value...">
                                                    @endif
                                                    @php $i=$i+1; @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- .modal-body -->
                                <div class="modal-footer bg-white">
                                    <ul class="btn-toolbar g-3">
                                        <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
                                        <li><button href="#" type="submit" class="btn btn-primary">Update</button></li>
                                    </ul>
                                </div><!-- .modal-footer -->
</form>
<script>
    $("body").on("change", '.custom-file-input', function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $(".select-data-type").on("change", function() {
        var selected = $(".select-data-type").val();
        var checked = $(".custom-control-input").is(":checked");
        console.log($(this).val());
        $("input[name='text']").val('');
        $("input[name='text[]']").val('');
        $("input[name='number']").val('');
        $("input[name='number[]']").val('');
        $("input[name='image']").val('');
        $("input[name='image[]']").val('');
        var checked = $(".custom-control-input").is(":checked");
        if (!checked && $(this).val() == "image") {
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".image-field").removeClass("d-none");
            $(".image-single-field").removeClass("d-none");
            $(".image-multiple-field").addClass("d-none");
        } else if (!checked && $(this).val() == "text") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".text-field").removeClass("d-none");
            $(".text-single-field").removeClass("d-none");
            $(".text-multiple-field").addClass("d-none");
        } else if (!checked && $(this).val() == "numeric") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").removeClass("d-none");
            $(".number-single-field").removeClass("d-none");
            $(".number-multiple-field").addClass("d-none");
        } else if (checked && $(this).val() == "image") {
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".image-field").removeClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".image-multiple-field").removeClass("d-none");
        } else if (checked && $(this).val() == "text") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".text-field").removeClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".text-multiple-field").removeClass("d-none");
        } else if (checked && $(this).val() == "numeric") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").removeClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".number-multiple-field").removeClass("d-none");
        } else {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
        }
    });

    $(".custom-control-input").on("change", function() {
        var selected = $(".select-data-type").val();
        $("input[name='text']").val('');
        $("input[name='text[]']").val('');
        $("input[name='number']").val('');
        $("input[name='number[]']").val('');
        $("input[name='image']").val('');
        $("input[name='image[]']").val('');
        if ($(this).is(":checked") && selected == "image") {
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".image-field").removeClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".image-multiple-field").removeClass("d-none");
        } else if ($(this).is(":checked") && selected == "text") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".text-field").removeClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".text-multiple-field").removeClass("d-none");
        } else if ($(this).is(":checked") && selected == "numeric") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").removeClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".number-multiple-field").removeClass("d-none");
        } else if (!$(this).is(":checked") && selected == "image") {
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".image-field").removeClass("d-none");
            $(".image-single-field").removeClass("d-none");
            $(".image-multiple-field").addClass("d-none");
        } else if (!$(this).is(":checked") && selected == "text") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".text-field").removeClass("d-none");
            $(".text-single-field").removeClass("d-none");
            $(".text-multiple-field").addClass("d-none");
        } else if (!$(this).is(":checked") && selected == "numeric") {
            $(".image-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").removeClass("d-none");
            $(".number-single-field").removeClass("d-none");
            $(".number-multiple-field").addClass("d-none");
        } else {
            $(".text-field").addClass("d-none");
            $(".text-multiple-field").addClass("d-none");
            $(".text-single-field").addClass("d-none");
            $(".number-field").addClass("d-none");
            $(".number-multiple-field").addClass("d-none");
            $(".number-single-field").addClass("d-none");
            $(".image-field").addClass("d-none");
            $(".image-single-field").addClass("d-none");
            $(".image-multiple-field").addClass("d-none");
        }
    });

    // add dynamic product setup values
    $(document).on('click', '.add-product-field', function(e) {
        e.preventDefault();
        var selected = $(".select-data-type").val();
        var checked = $(".custom-control-input").is(":checked");
        if (checked && selected == "text") {
            let $new_field = $(`<div class="product py-1 bg-white d-flex justify-content-between">
                            <span class="w-100">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" class="field-type form-control" name="text[]" placeholder="Enter Text">
                                    </div>
                                </div>
                            </span>
                            <div class="user-action align-self-center d-flex">
                                <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                            </div>
                        </div>`).insertAfter($(this).parents('.product'));
        } else if (checked && selected == "image") {
            let $new_field = $(` <div class="product py-1 bg-white d-flex justify-content-between">
                            <span class="w-100">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" class="field-type custom-file-input upload-image" id="image_file" name="image[]">
                                            <label class="custom-file-label update-image-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <div class="user-action align-self-center d-flex ml-2">
                                <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                            </div>
                        </div>`).insertAfter($(this).parents('.product'));
        } else if (checked && selected == "numeric") {
            let $new_field = $(`<div class="product py-1 bg-white d-flex justify-content-between">
                            <span class="w-100">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="number" class="field-type form-control" name="number[]" placeholder="Enter Number">
                                    </div>
                                </div>
                            </span>
                            <div class="user-action align-self-center d-flex">
                                <a href="#" class="py-1 add-product-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
                                <a href="#" class="py-1 pl-1 remove-product-field"><em class="icon ni ni-cross-circle-fill text-danger"></em></a>
                            </div>
                        </div>`).insertAfter($(this).parents('.product'));
        }
    });

    // remove dynamic product setup field values
    $(document).on('click', '.remove-product-field', function(e) {
        e.preventDefault();
        var selected = $(".select-data-type").val();
        var checked = $(".custom-control-input").is(":checked");
        if (checked && selected == "image") {
            if ($(".sortable-file-products").children().length > 1) {
                $(this).parents('.product').remove();
            } else {
                toastMessage('Minimum 1 choice is required', 'error');
            }
        } else if (checked && selected == "text") {
            if ($(".sortable-text-products").children().length > 1) {
                $(this).parents('.product').remove();
            } else {
                toastMessage('Minimum 1 choice is required', 'error');
            }
        } else {
            if ($(".sortable-numeric-products").children().length > 1) {
                $(this).parents('.product').remove();
            } else {
                toastMessage('Minimum 1 choice is required', 'error');
            }
        }
    });
</script>