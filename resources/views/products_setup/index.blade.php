@extends('layouts.app')
@section('content')
<style>
    .sorting_disabled {
        display: none;
    }
</style>
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="lead-text">{{ getActiveAccount()->name }}
                                                    Settings</span>
                                            </div>
                                        </div><!-- .user-card -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner p-0">
                                        <ul class="link-list-menu">
                                            <li><a href="{{ route('settings.index', currentAccount()) }}"><em class="icon ni ni-setting"></em></em><span>General
                                                        settings</span></a></li>
                                            <li><a href="{{ route('users.index', currentAccount()) }}"><em class="icon ni ni-account-setting-alt"></em><span>Account
                                                        users</span></a></li>
                                            <li><a href="{{ route('products_setup.index', currentAccount()) }}" class="active"><em class="icon ni ni-list"></em><span>Products
                                                    </span></a></li>
                                        </ul>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card-aside -->
                            {{-- table content start --}}
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-sm pb-4">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title">Product Fields Setup</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div><input type="text" class="form-control" id="searchBar" placeholder="Search">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt"><a class="btn btn-primary" data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('products_setup.create', currentAccount()) }}"><em class="icon ni ni-plus"></em><span class="add-user-btn">Add
                                                                    Product Field</span></a></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner p-0">
                                                <table class="nk-tb-list nk-tb-ulist" id="product-setup-tables">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col"><span class="sub-text">Field</span></th>
                                                            <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                                                            @if (auth()->user()->hasRole('Super Admin'))
                                                            <th class="nk-tb-col text-right"><span class="sub-text">Action</span></th>
                                                            @endif
                                                        </tr><!-- .nk-tb-item -->
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <!-- .nk-tb-list -->
                                                <table class="nk-tb-list nk-tb-ulist" id="product-setup-table">
                                                    <tbody>
                                                    </tbody>
                                                </table><!-- .nk-tb-list -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- table content end --}}

                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Fetch data using datatable start
        $(function() {
            var table = $('#product-setup-table').DataTable({
                ajax: {
                    url: "{{ route('products_setup.datatable', currentAccount()) }}",
                },
                processing: false,
                serverSide: true,
                scrollX: false,
                autoWidth: false,
                stateSave: false,
                lengthChange: false,
                bAutoWidth: false,
                dom: 'ltpr',
                language: {
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                    },
                    info: "",
                    emptyTable: "No Fields Available",
                    infoFiltered: "",
                    select: {
                        rows: {
                            _: " (%d rows selected)",
                            0: "",
                            1: " (1 row selected)",
                        }
                    }
                },
                columns: [{
                        data: 'field',
                        name: 'field',
                        sClass: "nk-tb-col",
                        orderable: false,
                    },
                    {
                        data: 'type',
                        name: 'type',
                        sClass: "nk-tb-col",
                        orderable: false,
                    },
                    @if(auth()->user()->hasRole('Super Admin'))
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        sClass: "nk-tb-col",
                    },
                    @endif
                ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');
                },
                "drawCallback": function(settings) {

                    $('#product-setup-table_paginate').css({
                        'padding': '10px 25px'
                    });

                }
            });
            $('#searchBar').on('keyup', function() {
                table.search($('#searchBar').val()).draw();
            });
        });
        // datatable fetch end
    });
    
</script>
@endpush
