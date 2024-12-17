<form class="new-user-form" action="{{ route('users.store', currentAccount()) }}" method="POST" id="user-form" enctype="multipart/form-data"
    data-form="ajax-form" data-datatable="#user-table" data-modal="#ajax_model">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        @if(Auth::user()->hasRole('Super Admin'))
        <div class="form-group">
            <label class="form-label" for="fw-nationality">Role</label>
            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control" name="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="row g-3 align-center">
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="form-label" for="site-off">Status</label>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="reg-public" id="site-off">
                        <label class="custom-control-label" for="site-off"></label>
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