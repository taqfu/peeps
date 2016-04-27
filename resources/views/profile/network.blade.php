@extends ('master')
@section ('content')
    <a href='/peeps/public/' class='profileMenu'>Listings </a>
    <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    <a href='/peeps/public/profile/{{$person_id}}/characteristics' class='profileMenu'>Characteristics</a>
    <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
    <a href='/peeps/public/profile/{{$person_id}}/todo' class='profileMenu'>To Do</a>
    <h1 class='profileHeading'>
        Social Network 
    </h1>
    <h1 class='profileHeading'>
        Of
    </h1>
    <h1 class='profileHeading'>
        @foreach ($profile as $main)
            {{ $main->name }}
        @endforeach
    </h1>
    <form method="POST" action="{{ route('person.store') }}">
        {{ csrf_field() }}
        <input type='hidden' name='ancillary' value='{{ $person_id }}'/>
        <input type='submit' value='New Person' />
    </form>
    @foreach ($people as $person)
        <div class='personListing'>
            <a name='person{{$person->id}}'></a>
            <a href="{{ route('summary', ['person_id'=>$person->id]) }}">
                @if (empty($person->name))
                    (No name yet.)
                @elseif  (!empty($person->name))
                    {{$person->name}}
                @endif
            </a>
            <input type='button' id='showGroupTypesForPerson{{$person->id}}' value='[ + ]' class='textButton showGroupTypesForPerson'  />    
            <input type='button' id='hideGroupTypesForPerson{{$person->id}}' value='[ - ]' class='textButton hideGroupTypesForPerson'  />    
            <div id='listOfGroupTypes{{$person->id}}' class='clear listOfGroupTypes'>
                <input type='text' /> <input type='button' value='Add Relation' />
            </div>
        </div>
    @endforeach
@endsection
