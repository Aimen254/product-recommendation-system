<form action="{{route('projects.update',[currentAccount(),$project->uuid])}}" method="POST" id="project-form" enctype="multipart/form-data"
    data-form="ajax-form" data-callback="fetchData" data-datatable="#projects-table" data-modal="#ajax_model">
    @csrf
    @method('put')
    <div class="modal-header align-center">
        <div class="nk-file-title">

            <div class="nk-file-name">
                <div class="nk-file-name-text"><span class="title">Edit Project</span></div>
            </div>
        </div>
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    </div>
    <div class="modal-body">
        <div class="form-group text-center">
            <label class="form-label" for="default-06">Logo</label>
            <div class="form-control-wrap">
                <div class="profile-picture-upload">
                    <img src="{{ $project->image ?  asset('storage/images/'.$project->image ) :  asset('images/default.png')}}" alt=""
                        class="imagePreviewLogo imagePreview d-block mx-auto mt-1 mb-4">
                    <a class="action-button mode-upload"
                        data-preview=".imagePreviewLogo"
                        data-fileinput=".fileinputlogo"> <em class="icon ni ni-upload"></em> Upload</a>
                    <input type="file" class="hidden fileinputlogo"
                    name="img" accept="image/*"  />
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <label for="name">Project Title</label>
            <input type="text" class="form-control" value="{{$project->title}}" name="project_title" placeholder="Enter Project Title">
        </div>
        <div class="form-group">
            <label for="name">Project Description</label>
            <textarea class="form-control" name="project_description" aria-label="With textarea" spellcheck="false" placeholder="Enter Project Description">{{$project->description}}</textarea>
        </div>
        

    </div><!-- .modal-body -->
    <div class="modal-footer bg-white">
        <ul class="btn-toolbar g-3">
            <li><a href="#" data-dismiss="modal" class="btn btn-outline-light btn-white">Discard</a></li>
            <li><button href="#" type="submit" class="btn btn-primary" id="save_state">Update</button></li>
        </ul>
    </div><!-- .modal-footer -->
</form>
