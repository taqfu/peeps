@extends ('master')
@section ('content')
    @foreach ($profile as $profile)
    @endforeach
    @include ("profile.menu", ["route_name"=>Route::getCurrentRoute()->getName()])
    <h1 class='profileHeading'>
        Social Network 
    </h1>
    <h1 class='profileHeading'>
        Of
    </h1>
    <h1 class='profileHeading'>
            {{ $profile->name }}
    </h1>
    @if ($profile->ancillary!=0)
        <h3 class='ancillary'>
            Auxillary to
            <a class='auxillaryLink ' href='/peeps/public/profile/{{ $profile->ancillary }}/network'>
                {{ $profile->main_ref->name }}
            </a>
        </h3>
    @endif
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
