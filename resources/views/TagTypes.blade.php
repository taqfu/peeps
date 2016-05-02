@foreach ($tag_types as $tag_type)
    <div style='clear:both;'>
    <form method="POST" action="{{ route('tagType.destroy', ['id'=>$tag_type->id]) }}" class='deleteForm' />
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type='hidden' name='personID' value="{{ $person_id }}" />
        <input type='submit' value='x' class='textButton red' />
    </form>
    <div style='float:left;'>
    {{$tag_type->name }}
    </div>
    </div>
@endforeach
