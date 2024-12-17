<div class="sortable-item py-3 bg-white border-bottom border-light d-flex justify-content-between">
    <span class="handle align-self-center mr-2"><em class="icon ni ni-move"></em></span>
    <span class="w-100">
        <div class="form-group">
            <div class="form-control-wrap ">

                <select class="js-example-basic-multiple" name="categories[]" data-search="off">
                    <option></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->id }} {{$category->secondary_title }}</option>
                    @endforeach
                </select>

            </div>
        </div>
    </span>
    <div class="user-action align-self-center d-flex ml-2">
        <a href="#" class="py-1 add-sortable-item-field"><em class="icon ni ni-plus-circle-fill text-teal"></em></a>
        <a href="#" class="py-1 pl-1 remove-sortable-item-field"><em
                class="icon ni ni-cross-circle-fill text-danger"></em></a>
    </div>
</div>
