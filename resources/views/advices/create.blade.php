<form action="{{ route('advices.store', currentAccount()) }}" method="POST" id="advice-form" data-form="ajax-form"
    data-datatable="#advices-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Advice</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">Advice Title</label>
            <input type="text" class="form-control" name="advice_title" placeholder="Enter advice Title" required>
        </div>
        <div class="form-group">
            <label for="name">Secondry Title</label>
            <input type="text" class="form-control" name="secondary_title" placeholder="Enter advice Secondary Title" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="default-06">Select Categories</label>
            <div id="sortable">

                <div class="sortable-item py-3 bg-white border-bottom border-light d-flex justify-content-between">
                    <span class="handle align-self-center mr-2"><em class="icon ni ni-move"></em></span>
                    <span class="w-100">
                        <div class="form-group">
                            <div class="form-control-wrap ">

                                <select class="js-example-basic-multiple" name="categories[]">
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->id }} {{$category->secondary_title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </span>
                    <div class="user-action align-self-center d-flex ml-2">
                        <a href="#" class="py-1 add-sortable-item-field"><em
                                class="icon ni ni-plus-circle-fill text-teal"></em></a>
                        <a href="#" class="py-1 pl-1 remove-sortable-item-field"><em
                                class="icon ni ni-cross-circle-fill text-danger"></em></a>
                    </div>
                </div>

            </div>

        </div>

    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary">Add</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            // minimumResultsForSearch: Infinity,
            placeholder: "Select a category"
        });
    });
    $(document).ready(function() {
        $("#sortable").sortable({
            handle: '.handle',
            placeholder: "ui-state-highlight",
            start: function(e, ui) {
                ui.placeholder.height(ui.helper[0].scrollHeight);
            },

        });
    });
</script>
