<form action="{{ route('products.store', currentAccount()) }}" method="POST" id="product-form" enctype="multipart/form-data" data-form="ajax-form" data-datatable="#products-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Add New Product</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group text-center">
            <label class="form-label" for="default-06">Product Image</label>
            <div class="form-control-wrap">
                <div class="profile-picture-upload">
                    <img src="{{ asset('images/default.png') }}" alt="" class="imagePreviewLogo imagePreview d-block mx-auto mt-1 mb-4">
                    <a class="action-button mode-upload" data-preview=".imagePreviewLogo" data-fileinput=".fileinputlogo"> <em class="icon ni ni-upload"></em> Upload</a>
                    <input type="file" class="hidden fileinputlogo" name="img" accept="image/*" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Product Title</label>
            <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title">
        </div>
        <div class="form-group">
            <label for="name">Product Description</label>
            <textarea class="form-control summernote" name="product_description" aria-label="With textarea" spellcheck="false"></textarea>
            <span class="text" id="charNum">Only 142 characters will be visible on frontend</span>
        </div>
        <div class="form-group">
            <label for="name">Product url</label>
            <input type="text" class="form-control" name="product_url" placeholder="Enter Product url">
        </div>

        <!-- Get the Product Setup Field Names with their values -->
        @foreach ($productSetupGroups as $group)
        <div class="form-group">
            <label for="field">{{ $group['fieldName'] }}</label>
            <select class="form-select" multiple="multiple" data-search="on" name="{{ $group['fieldName'] }}[]" data-placeholder="Select value">
                <option></option>
                @foreach ($group['fieldValues'] as $valueId => $value)
                <option value="{{ $valueId }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        @endforeach
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
    $('.summernote').summernote({
        toolbar: [
            ["para", ["ul", "ol"]],
        ],
        // counting characters
        callbacks: {
            onKeyup: function(obj) {
                var maxLength = 142;
                var strLength = $($('.summernote').summernote('code')).text().length;
                var charRemain = (maxLength - strLength);

                if (charRemain < 0) {
                    document.getElementById("charNum").innerHTML =
                        `<span style="color: red;">Exceeded Charecters:    ${charRemain} 
                         </span> <br>
                        <span style="color: red;">You have exceeded the limit of
                        ${maxLength} characters</span>`;
                } else {
                    document.getElementById("charNum").innerHTML = charRemain + ' characters remaining';
                }
            },
            onPaste: function(e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData(
                    'Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
    $(document).ready(function() {
        $('.form-select').select2({
            placeholder: "Select value"
        });
    });
</script>