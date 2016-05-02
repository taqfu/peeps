@extends ('master')
@section ('content')

@foreach ($people as $person)
@endforeach
    @include ("profile.menu", ["route_name"=>Route::getCurrentRoute()->getName()])
<h1>
{{ $person->name }}
</h1>
    @if ($person->ancillary!=0)
        <h3 class='ancillary'>
            Auxillary to
            <a class='auxillaryLink ' href='/peeps/public/profile/{{$person->ancillary}}/network'>
                {{ $person->main_ref->name }}
            </a>
        </h3>
    @endif
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
