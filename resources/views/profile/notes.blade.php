@extends ('master')
@section ('content')
    @foreach ($people as $person)
    @endforeach
    <a href='/peeps/public/' class='profileMenu'>Listings </a>
    <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    <a href='/peeps/public/profile/{{$person_id}}/characteristics' class='profileMenu'>Characteristics</a>
    <a href='/peeps/public/profile/{{$person_id}}/network' class='profileMenu'>Social Network</a>
    <a href='/peeps/public/profile/{{$person_id}}/todo' class='profileMenu'>To Do</a>
    <h1 class='profileHeading'>
        {{ $person->name }}
    </h1>
    <div class='newNoteContainer'>
    <form method="POST" action="{{ route('note.store') }}" class='newNoteForm'>
        {{ csrf_field() }}
        <input type='hidden' name='noteType' value='text' />
        <input type='hidden' name='personID' value='{{ $person_id }}' />
        <input type='hidden' name='characteristicID' value='0' />
        <textarea name='newNote' class='noteInput' ></textarea>
        <input type='submit' class='right' />
    </form> 
    </div>
    @foreach ($notes as $note)
        <div class='profileNoteContainer'>
            <form method="POST" action="{{ route('note.destroy', ['id', $note->id]) }}" class='deleteNoteForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='X' class='textButton red' />
            <form>
            <div class="noteDate">
                {{ date('F j, y H:i', strtotime($note->created_at)) }}
            </div>
            <div class='profileNote'>
                {!! nl2br( $note->note) !!}
            </div>
        </div>
    @endforeach
@endsection
