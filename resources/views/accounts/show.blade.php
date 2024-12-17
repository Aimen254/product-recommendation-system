@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ $account->name }}</h3>
                                <div class="nk-block-des text-soft">
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">

                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-6 ">
                                {{-- new view @s --}}
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Projects</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('projects.index', currentAccount()) }}"
                                                    class="link">{{ $projects->count() > 4 ? 'View All' : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Title</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Description</span></div>
                                            <div class="nk-tb-col tb-col-lg text-right"><span>Creation Date</span></div>
                                            
                                        </div>
                                        @foreach ($projects as $project)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="align-center">
                                                        <div class="user-avatar sq bg-lighter"><span><img
                                                                    class="rounded"
                                                                    src="{{ asset('storage/images/' . $project->image) }}"
                                                                    alt=""></span></div>
                                                        <span class="tb-sub ml-2"><a href="{{ route('welcome_page.index', [currentAccount(), $project->uuid]) }}">{{ $project->title }}</a></span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-sub">{{ addEllipsis($project->description, $max = 50) }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span
                                                        class="tb-sub tb-amount text-right">{{ Carbon\Carbon::parse($project->created_at)->isoFormat('D MMM YYYY') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($projects->isEmpty())
                                        <div class="text-center  my-3">No Project Available</div>
                                    @endif
                                </div>
                                {{-- new view @e --}}
                            </div>
                            <div class="col-6 ">
                                {{-- new view @s --}}
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Users</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('users.index', currentAccount()) }}" class="link">{{ $users->count() > 4 ? 'View All' : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Title</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Description</span></div>
                                            <div class="nk-tb-col tb-col-lg text-right"><span>Creation Date</span></div>
                                            
                                        </div>
                                        @foreach ($users as $user)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <div class="align-center">
                                                    <span class="tb-sub ml-2">{{ $user->first_name . " " . $user->last_name }}</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span class="tb-sub">{{ $user->getRoleNames()[0] }}</span>
                                            </div>
                                            <div class="nk-tb-col text-right">
                                                <span
                                                    class="tb-sub tb-amount">{{ Carbon\Carbon::parse($user->created_at)->isoFormat('D MMM YYYY') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                {{-- new view @e --}}
                            </div>
                        </div>

                        <div class="row g-gs">
                            <div class="col-6 ">
                                {{-- new view @s --}}
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Products</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('products.index', currentAccount()) }}"
                                                    class="link">{{ $products->count() > 4 ? 'View All' : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col tb-col-lg"><span>Title</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Code</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Description</span></div>
                                            <div class="nk-tb-col tb-col-lg text-right"><span>Url</span></div>
                                        </div>

                                        @foreach ($products as $product)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="align-center">
                                                        <div class="user-avatar sq bg-lighter"><span><img
                                                                    class="rounded"
                                                                    src="{{ asset('storage/images/' . $product->image) }}"
                                                                    alt=""></span></div>
                                                        <span class="tb-sub ml-2">{{ $product->title }}</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-sub">{{ $product->code }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span
                                                        class="tb-sub">{{ addEllipsis($product->description, $max = 50) }}</span>
                                                </div>
                                                <div class="nk-tb-col text-right">
                                                    <span class="tb-sub tb-amount"><a href="{{ $product->url }}"
                                                            target="_blank"><em class="icon ni ni-link"></em></a></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($products->isEmpty())
                                        <div class="text-center  my-3">No Product Available</div>
                                    @endif
                                </div>
                                {{-- new view @e --}}
                            </div>
                            <div class="col-6 ">
                                {{-- new view @s --}}
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Categories</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('categories.index', currentAccount()) }}"
                                                    class="link">{{ $categories->count() > 4 ? 'View All' : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Title</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Description</span></div>
                                            <div class="nk-tb-col tb-col-lg text-right"><span>Products</span></div>
                                        </div>
                                        @foreach ($categories as $category)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="align-center">
                                                        <span class="tb-sub ml-2">{{ $category->title }}</span>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span
                                                        class="tb-sub">{{ addEllipsis($category->description, $max = 50) }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg text-right">
                                                    <span
                                                        class="tb-sub">{{ $category->products()->count() }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($categories->isEmpty())
                                        <div class="text-center  my-3">No Category Available</div>
                                    @endif
                                </div>
                                {{-- new view @e --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
