
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<form action="{{route('categories.store', currentAccount())}}" method="POST" id="category-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#categories-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Category</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label" for="name">Category Title</label>
            <input type="text" class="form-control" name="category_title" placeholder="Enter Category Title" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="name">Category Secondary Title</label>
            <input type="text" class="form-control" name="category_secondary_title" placeholder="Enter Category Title" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="name">Category Description</label>
            <textarea class="form-control" name="category_description" placeholder="Enter Category Description"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="default-06">Select Products</label>
            
            <div id="sortable" >
                
                <div class="sortable-item py-3 bg-white border-bottom border-light d-flex justify-content-between">
                    <span class="handle align-self-center mr-2"><em class="icon ni ni-move"></em></span>
                    <span class="w-100">
                        <div class="form-group">
                            <div class="form-control-wrap ">
                        
                                <select class="js-example-basic-multiple" name="products[]">
                                    <option></option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>
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
        placeholder: "Select a product"
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