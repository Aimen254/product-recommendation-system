@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Accounts</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em
                                                                class="icon ni ni-search"></em></div><input type="text"
                                                            class="form-control" id="searchBar"
                                                            placeholder="Search">
                                                    </div>
                                                </div>
                                            </li>
                                            @if(Auth::user()->roles->pluck('name') == '["Super Admin"]')
                                            <li class="nk-block-tools-opt">
                                                <a data-toggle="modal" href=""
                                                    data-act="ajax-modal" data-complete-location="true" data-method="get"
                                                    data-action-url="{{ route('accounts.create') }}"
                                                    class="btn btn-primary">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>Add account</span>
                                                </a>
                                            </li>
                                            @endif
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
                                    <table class="nk-tb-list nk-tb-ulist" id="accounts-table">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">

                                                <th class="nk-tb-col py-2"><span class="sub-text">Account ID</span></th>
                                                <th class="nk-tb-col py-2"><span class="sub-text">Name</span></th>
                                                
                                                <th class="nk-tb-col py-2 tb-col-lg"><span class="sub-text">Users</span></th>
                                                <th class="nk-tb-col py-2 tb-col-lg"><span
                                                    class="sub-text">Max users</span></th>
                                                <th class="nk-tb-col py-2 "><span class="sub-text">Status</span>
                                                </th>
                                                <th class="nk-tb-col py-2 text-right"><span class="sub-text">Action</span>
                                                </th>

                                            </tr><!-- .nk-tb-item -->
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                        <div class="row g-gs" id="accounts">

                        </div>
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
        $currentAccount = '{{ currentAccount() }}';
        $(function() {
            var table = $('#accounts-table').DataTable({
                ajax: {
                    url: "{{ route('accounts.datatable')}}",
                },
                processing: false,
                serverSide: true,
                scrollX: false,
                autoWidth: false,
                stateSave: false,
                lengthChange: false,
                bAutoWidth: false,
                dom:'ltpr',
                language: {
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                    },
                    info: "",
                    emptyTable: "No Accounts Available",
                    infoFiltered:"",
                    select: {
                        rows: {
                            _: " (%d rows selected)",
                            0: "",
                            1: " (1 row selected)",
                        }
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        sClass: "nk-tb-col",
                        orderable: true,
                        sWidth: '15%'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        sClass: "nk-tb-col",
                        orderable: false,
                        sWidth: '30%'
                    },
                    {
                        data: 'users',
                        name: 'users',
                        sClass: "nk-tb-col",
                        orderable: false,
                        sWidth: '15%'
                    },
                    {
                        data: 'max_users',
                        name: 'max_users',
                        sClass: "nk-tb-col",
                        orderable: false,
                        sWidth: '15%'
                    },
                    
                    {
                        data: 'status',
                        name: 'status',
                        sClass: "nk-tb-col",
                        orderable: false,
                        sWidth: '10%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sClass: "nk-tb-col",
                        orderable: false,
                        searchable: false,
                        sWidth: '10%'
                    },
                ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    $(nRow).addClass('nk-tb-item');

                },
                "drawCallback": function(settings) {
                    
                    $('#accounts-table_paginate').css({
                        'padding': '10px 25px'
                    });
                   
                }
            });
            $('#searchBar').on( 'keyup', function () {
                table.search($('#searchBar').val()).draw();
            });
        });
        // datatable fetch end

        
    });
</script>
@endpush
