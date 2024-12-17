<div class="row g-gs">
    @if ($projects->count())
        @foreach ($projects as $project)
            <div class="col-sm-6 col-lg-3 col-md-4 col-xxl-3" id="project">
                <div class="card card-bordered h-100">
                    <a href="{{ route('welcome_page.index', [currentAccount(), $project->uuid]) }}">
                        <div class="card h-100">
                            <div class="card-header store-header">

                                <img src="{{ $project->image ? asset('storage/images/' . $project->image) : asset('images/default.png') }}"
                                    class="card-img-top" alt="">

                            </div>
                        </div>
                    </a>
                    <div class="card-inner">
                        <div class="project">
                            <div class="project-head mb-1">
                                <div class="project-info">
                                    <h6 class="title"><a class="project-title"
                                            href="{{ route('welcome_page.index', [currentAccount(), $project->uuid]) }}">{{ $project->title }}</a>
                                    </h6>
                                </div>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1"
                                        data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a
                                                    href="{{ route('welcome_page.index', [currentAccount(), $project->uuid]) }}"><em
                                                        class="icon ni ni-eye"></em><span>View Project</span></a></li>
                                            <li><a data-toggle="modal" href="" data-act="ajax-modal"
                                                    data-callback="fetchData" data-complete-location="true"
                                                    data-method="get"
                                                    data-action-url={{ route('projects.edit', [currentAccount(), $project->uuid]) }}><em
                                                        class="icon ni ni-edit"></em><span>Edit Project</span></a></li>
                                            <li><a href="javascript:void(0)" class="delete"
                                                    data-callback="fetchData"
                                                    data-url={{ route('projects.destroy', [currentAccount(), $project->uuid]) }}><em
                                                        class="icon ni ni-trash"></em><span>Delete Project</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="project-progress">
                                <div class="project-progress-details">
                                    <div class="project-progress-task"><em class="icon ni ni-clock"></em><span>Modified:
                                            {{ Carbon\Carbon::parse($project->updated_at)->isoFormat('D MMM YYYY') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @elseif($search)
    <div class="col-12 text-center">
        <img src="{{ asset('images/search-engines-animate.svg') }}" alt="" width="400px">
        <h2>No results found</h2>
    </div>
    @else
    <div class="col-12 text-center">
        <img src="{{ asset('images/artist-animate.svg') }}" alt="" width="500px">
        <h2>Let's create your first project</h2>
        <a class="btn btn-primary mt-3" data-toggle="modal" href="" data-act="ajax-modal"
            data-complete-location="true" data-method="get"
            data-action-url="{{ route('projects.create', currentAccount()) }}"><em class="icon ni ni-plus"
            data-callback="fetchData"></em><span>Add Project</span></a>
    </div>
    @endif
</div>
<div id="paginate" class="mt-3">
    {!! $projects->links('pagination::bootstrap-4') !!}
</div>
