@foreach ($accounts as $account)
<div class="col-sm-6 col-lg-4 col-xxl-3">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="project">
                <div class="project-head mb-0">
                    <a href="{{route('accounts.show',$account->uuid)}}" class="project-title">
                        
                        <div class="project-info">
                            <h6 class="title">{{$account->name}}</h6>
                            
                        </div>
                    </a>
                    <div class="drodown">
                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="{{route('accounts.show',$account->uuid)}}"><em class="icon ni ni-eye"></em><span>Open Account</span></a></li>
                                <li><a data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url="{{ route('accounts.edit',$account->uuid) }}" ><em class="icon ni ni-edit"></em><span>Edit Account</span></a></li>
                                <li><a href="javascript:void(0)" class="delete_account"  data-url="{{route('accounts.destroy', $account->uuid)}}"><em class="icon ni ni-trash"></em><span>Delete Account</span></a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               
               
            </div>
        </div>
    </div>
</div>
@endforeach


