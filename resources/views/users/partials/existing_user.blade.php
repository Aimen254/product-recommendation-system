<form class="existing-user-form" action="{{ route('add_existing_user', currentAccount()) }}" method="POST" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#user-table" data-modal="#ajax_model">
    @csrf
<div class="modal-body">
    <div class="form-group">
        <div class="form-control-wrap">
            <select name="user_id"
                class="form-select form-control form-control-md"
                data-search="on" data-placeholder="Existing Users">
                <option value="0">Select a User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"> {{ $user->first_name .' '. $user->last_name }}</option>
                @endforeach
            </select>
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