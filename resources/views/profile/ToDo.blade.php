@extends ('master')
@section ('content')

@foreach ($people as $person)
@endforeach
    <a href='/peeps/public/' class='profileMenu'>Listings</a>
    <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    <a href='/peeps/public/profile/{{$person_id}}/characteristics' class='profileMenu'>Characteristics</a>
    <a href='/peeps/public/profile/{{$person_id}}/network' class='profileMenu'>Social Network</a>
    <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
<h1>
{{ $person->name }}
</h1>
<form method="POST" action="{{ route('toDo.store') }}">
    {{ csrf_field() }}
    <input type='text' name='newToDo' maxlength='255'/>
    <input type='hidden' name='person_id' value="{{ $person_id }}" />
    <input type='submit' value='Create To Do' />
</form>
@foreach ($to_do_items as $to_do)
    <form method="POST" action="route('toDo.update', " >

    </form>
    @if ($to_do->completed_at!=null)
        <input id='toDo{{$to_do->id}}' type='checkbox' class='toDo' checked/>
    @elseif ($to_do->completed_at==null)
        <input id='toDo{{$to_do->id}}' type='checkbox' class='toDo' />
    @endif
    <form method="POST" action="{{ route('toDo.destroy', ['id'=> $to_do->id]) }}" class='deleteForm'>
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type='submit' value='x' class='textButton red'/>
    </form>
    <span
        @if ($to_do->completed_at!=null)
            style='text-decoration:line-through;color:grey;'
        @endif
    >
    {{ $to_do->name }}
    </span>
    @if ($to_do->completed_at!=null)
        <span style='color:grey;font-style:italic;'> (Completed {{ date ("m/d/y/ h:i", strtotime($to_do->completed_at)) }}) </span>
    @endif
@endforeach
@endsection
