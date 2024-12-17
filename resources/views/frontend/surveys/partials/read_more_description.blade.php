{{ testEllipsis($category->description, $max = 25) }}
<a href="javascript:void(0);" data-text-read-more="{{ $read_more_btn_text }}" data-text-read-less="{{ $read_less_btn_text }}" data-id="{{$category->id}}" data-type="read_more" class="read-more {{str_word_count($category->description) > 25 ? '' : 'd-none'}}"> {{$read_more_btn_text}}</a> 
