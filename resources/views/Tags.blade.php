<div>
    @foreach ($note->type_tags as $type_tag)
    <form method="POST" action="{{ route('typeTag.destroy', ['id'=>$type_tag->id]) }}" class='deleteForm'/>
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <input type='hidden' name='personID' value='{{ $person_id }}' />
        <input type='submit' value='x' class='textButton red' />
        {{ $type_tag->type->name }}
    </form>
    @endforeach
    @foreach ( $note->person_tags as $person_tag)
        <form method="POST" action="{{ route('personTag.destroy', ['id'=>$person_tag->id]) }}" class='deleteForm'/>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='hidden' name='personID' value='{{ $person_id }}' />
            <input type='submit' value='x' class='textButton red'/>
            <a href="{{route('summary', ['person_id'=>$person_tag->person_id]) }}" />{{ $person_tag->person->name }} </a>
        </form>
    @endforeach 
</div>
<div class='clear'>
<input type='button' id='showNewTypeTags{{ $note->id }}' class='showNewTypeTags' value='Add Tag' />
<input type='button' id='hideNewTypeTags{{ $note->id }}' class='hideNewTypeTags' value='Hide Tags'/>
<input type='button' id='showNewPersonTags{{ $note->id }}' class='showNewPersonTags' value='Add Person' />
<input type='button' id='hideNewPersonTags{{ $note->id }}' class='hideNewPersonTags' value='Hide Person' />
</div>
<div id='listOfNewTypeTags{{ $note->id }}' class='listOfNewTypeTags'>
@foreach ($tag_types as $tag_type)
    <form method="POST" action="{{ route('typeTag.store') }}"/>
        {{ csrf_field() }}
        <input type='hidden' name='personID' value='{{ $person_id }}' />
        <input type='hidden' name='tagTypeID' value='{{$tag_type->id}}' />
        <input type='hidden' name='tagNoteID' value='{{$note->id}}' />
        <input type='submit' value="[ {{ $tag_type->name }} ]" class='textButton' />        
    </form>
@endforeach
</div>
<div id='listOfNewPersonTags{{ $note->id }}' class='clear listOfNewPersonTags'>
    @foreach ($people as $person)
        <form method="POST" action="{{ route('personTag.store') }}"  style='float:left;'/>
            {{ csrf_field() }}
            <input type='hidden' name='personID' value='{{ $person->id }}' />
            <input type='hidden' name='noteID' value='{{ $note->id }}' />
            <input type='hidden' name='profileID' value='{{ $person_id }}' />
            <input type='submit' value='{{ $person->name }}' class='textButton' />
            <div style='float:left;margin-right:16px;margin-left:16px;'>/ </div>

        </form>
    @endforeach   

</div>
