@extends ('master')
@section ('content')
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
<div class='clear' style='margin-bottom:16px;'>
<input type='button' id='showRelationshipTypes' class='textButton clear' value='[ Show Relationship Types ]' />
<input type='button' id='hideRelationshipTypes' class='textButton clear' value='[ Hide Relationship Types ]' />
</div>
<div id='listOfRelationshipTypes' class='clear'>
<form method="POST" action="{{ route('RelationshipType.store') }}">
    {{ csrf_field() }}
    <input type='text' name='newRelationshipTypeName' />
    <input type='submit' value='New Relationship Type' />
</form>
@foreach ($relationship_types as $relationship_type)
    <form method="POST" action="{{ route('RelationshipType.destroy', ['id'=>$relationship_type->id]) }}" style='float:left;clear:left;margin:0px;'>
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type='submit' value='x' class='textButton red' />
    {{ $relationship_type->name }}
    </form>
    <div style='float:left;margin-left:8px;color:grey;'>
    @if ($relationship_type->inverse_relationship_type_id==0)
         (No Inverse)
    @elseif ($relationship_type->inverse_relationship_type_id>0)
         ({{$relationship_type->name}})
    @endif
        <input type='button' id='showNewInverseRelationships{{$relationship_type->id}}' 
          class='textButton showNewInverseRelationships' value='[ Add ]' />
        <input type='button' id='hideNewInverseRelationships{{$relationship_type->id}}' 
          class='textButton hideNewInverseRelationships' value='[ Cancel ]' />
    </div>
    <div id='listOfNewInverseRelationships{{$relationship_type->id}}' class='listOfNewInverseRelationships clear'>
        @foreach ($relationship_types as $inverse_relationship_type)
            <form method="POST" action="{{ route('RelationshipType.update', ['id'=>$relationship_type->id]) }}" 
              style='margin:0px;float:left;'>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type='hidden' name='inverseRelationshipTypeID' value='{{$inverse_relationship_type->id}}' />
            <input type='submit' value='{{$inverse_relationship_type->name}}' class='textButton' />
        </form>
        @endforeach
    </div>
@endforeach
</div>
    <form method="POST" action="{{ route('person.store') }}">
        {{ csrf_field() }}
        <input type='hidden' name='ancillary' value='{{ $person_id }}'/>
        <input type='submit' value='New Person' />
    </form>
    @foreach ($people as $person)
        <div class='personListing'>
            <div style='float:left;'>
            <a name='person{{$person->id}}'></a>
            <a href="{{ route('summary', ['person_id'=>$person->id]) }}">
                @if (empty($person->name))
                    (No name yet.)
                @elseif  (!empty($person->name))
                    {{$person->name}}
                @endif
            </a>
            </div>
            @foreach ($relationships as $relationship)
                @if ( $relationship->secondary_person_id == $person->id)
                    <form method="POST" action="{{ route('relationship.destroy', ['id'=>$relationship->id]) }}" style='float:left; margin-left:8px;'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type='submit' value='x' class='textButton red' />
                        <span style='color:grey;'>
                        {{ $relationship->type->name }}
                        </span>
                    </form>
                @endif
            @endforeach
            <div style='float:left;margin-left:8px;'>
            <input type='button' id='showGroupTypesForPerson{{$person->id}}' value='[ + ]' class='textButton showGroupTypesForPerson'  />    
            <input type='button' id='hideGroupTypesForPerson{{$person->id}}' value='[ - ]' class='textButton hideGroupTypesForPerson'  />    
            </div>
            <div id='listOfGroupTypes{{$person->id}}' class='clear listOfGroupTypes'>
                <form method="POST" action="{{ route('relationship.store') }}">
                    {{ csrf_field() }}
                    <select name='relationshipTypeID'>
                        @foreach ($relationship_types as $relationship_type)
                            <option value='{{ $relationship_type->id }}'>{{ $relationship_type->name }}</option>
                        @endforeach
                    </select>
                    <input type='hidden' name='primaryPersonID' value='{{ $person_id }}' />
                    <input type='hidden' name='secondaryPersonID' value='{{ $person->id }}' />
                    <input type='submit' value='Add Relationship' />
                </form>
            </div>
        </div>
    @endforeach
@endsection
