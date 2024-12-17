@foreach ($adviceLogics as $adviceLogic)
    <div id="advice_{{$adviceLogic->id}}"  class="advice p-3 border-bottom border-light d-flex justify-content-between">
        
        <span class="align-self-center"><a href="#" class="advice-form-btn text-dark scroll" data-action-url="{{route('advice-logic.edit', [currentAccount(), currentProject(),$adviceLogic->uuid])}}"
            data-method="get">{{  $adviceLogic->advice->secondary_title}}</a></span>
        <div class="user-action align-self-center">
            <div class="dropdown"><a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"
                    aria-expanded="false"><em class="icon ni ni-more-v"></em></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li class="scroll">
                            <a href="#" class="advice-form-btn scroll" data-action-url="{{route('advice-logic.edit', [currentAccount(), currentProject(),$adviceLogic->uuid])}}"
                                data-method="get">
                                <em class="icon ni ni-edit scroll"></em>
                                <span class="scroll">Edit Advice</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-callback="fetchData" class="delete" data-triggerred="delete-advice-trigger"  data-url=" {{route('advice-logic.destroy', [currentAccount(), currentProject(), $adviceLogic->uuid])}}" >
                                <em class="icon ni ni-trash"></em>
                                <span>Delete Advice</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
