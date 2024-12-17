<form action="{{route('accounts.update',$account)}}" method="POST" id="accounts-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#accounts-table" data-modal="#ajax_model">
    @csrf
    @method('PUT')
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Account toevoegen</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">

       <div class="form-group">
        <label class="form-label" for="name">Account name</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter account name" value="{{$account->name}}" required>
        </div>
    </div>



    <div class="form-group">
        <label class="form-label" for="max-users">Number of users</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control" id="max-users" name="max_users" value="{{$account->max_users}}" placeholder="Enter the max. number of users for this account here" required>
        </div>
    </div>
    <div class="row g-3 align-center">
        <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label" for="status">Account Status</label>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" @if($account->status=="active") checked @endif name="status" id="status">
                    <label class="custom-control-label" for="status"></label>
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
