@foreach ($questions as $question)
    <div id="question_{{ $question->id }}" class="question p-3 border-bottom border-light d-flex justify-content-between">
        <span class="handle align-self-center">
            <em class="icon ni ni-move"></em>
        </span>
        <span class="align-self-center"><a href="#" class="question-form-btn text-dark"
                data-action-url="{{ route('questions.edit', [currentAccount(), currentProject(), $question->uuid]) }}"
                data-method="get">{{ $question->secondary_title }}</a></span>
        <div class="user-action align-self-center">
            <div class="dropdown"><a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#" aria-expanded="false"><em class="icon ni ni-more-v"></em></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li>
                            <a href="#" class="question-form-btn" data-action-url="{{ route('questions.edit', [currentAccount(), currentProject(), $question->uuid]) }}"
                                data-method="get">
                                <em class="icon ni ni-edit "></em>
                                <span>Edit Question</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-callback="fetchData" class="clone-question" data-method="get"
                                data-action-url=" {{ route('questions.clone', [currentAccount(), currentProject(), $question->uuid]) }}">
                                <em class="icon ni ni-copy"></em>
                                <span>Clone Question</span>
                            </a>
                        </li>
                        <li>
                            <a class="question-form-btn" data-action-url="{{ route('question_logic', [currentAccount(), currentProject(), $question->uuid]) }}"
                                data-method="get" href="javascript:void(0)">
                                <em class="icon ni ni-puzzle"></em>
                                <span>Set Logic</span>
                            </a>
                        </li>
                        @if ($question->question_type == 'MCQS' && $question->is_multiple == '1')
                            <li>
                                <a class="question-form-btn" data-action-url="{{ route('mcq_advice_logic', [currentAccount(), currentProject(), $question->uuid]) }}"
                                    data-method="get" href="javascript:void(0)">
                                    <em class="icon ni ni-bulb"></em>
                                    <span>Set Advice Logic</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="javascript:void(0)" data-callback="fetchData" data-triggerred="delete-question-trigger" class="delete"
                                data-url=" {{ route('questions.destroy', [currentAccount(), currentProject(), $question->uuid]) }}">
                                <em class="icon ni ni-trash"></em>
                                <span>Delete Question</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
