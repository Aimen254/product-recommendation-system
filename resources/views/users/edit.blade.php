<form action="{{ route('users.update',  [currentAccount(), $user->uuid]) }}" method="POST" id="user-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#user-table" data-modal="#ajax_model">
    @csrf
    @method('put')
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit User</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" value="{{ $user->first_name }}" class="form-control" name="first_name"
                placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                value="{{ $user->last_name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" disabled  value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="fw-nationality">Role</label>
            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control" name="role">
                        @foreach ($roles as $role)
                            <option @if($user->getRoleNames()[0] == $role->name) selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row g-3 align-center">
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="form-label" for="site-off">Status</label>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" checked class="custom-control-input" name="reg-public" id="site-off">
                        <label class="custom-control-label" for="site-off"></label>
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
