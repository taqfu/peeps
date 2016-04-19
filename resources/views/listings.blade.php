@extends ('master')
@section ('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <form method="POST" action="{{ route('person.store') }}">
        {{ csrf_field() }}
        <input type='submit' value='New Person' />
    </form>
    <form method="POST" action="{{ route('groupType.store') }}">  
        {{ csrf_field() }}
        <input type='text' name='newGroupTypeName' />
        <input type='submit' value='New Group' />
    </form>
    <input id='showGroupTypeNames' type='button' class='textButton' value='[ Show Group Types ]'/>
    
    <input id='hideGroupTypeNames' type='button' class='textButton' value='[ Hide Group Types ]'/>
    <div id='listOfGroupTypes' class='listOfGroupTypes'>
    @foreach ($group_types as $group_type)
        <div class='groupTypeName clear'>
        <form method="POST" action="{{ route('groupType.destroy', ['id'=>$group_type->id]) }}" class='deleteForm'>
            {{ csrf_field() }}
            {{ method_field("DELETE") }}
            <input type='submit' value='x' />
        </form>
            {{ $group_type->name }}
        </div>


    @endforeach
    </div>
    <div class='clear sortList'>
        Sort:
    </div>
    <div class='sortMenu'>
    <A href="{!! route('listings', ["sort"=>"alphabetically"]) !!}" class='sortMenuItem'>Alphabetically</a>
    <A href="{!! route('listings', ["sort"=>"numerically"]) !!}" class='sortMenuItem'>   Numerically</a>
    </div>
    @foreach ($people as $person)
        <div class='personListing'>
            <a href='/peeps/public/profile/{{$person->id}}'>
                @if ($sort === "id")
                Person #{{ $person->id }} - 
                @endif
                @if (empty($person->name))
                    (No name yet.)
                @elseif  (!empty($person->name))
                    {{$person->name}}
                @endif
            </a>
            <input id='showGroupTypesForPerson{{$person->id}}' type='button' 
              class='textButton showGroupTypesForPerson' value='[ + ]' />
            <input id='hideGroupTypesForPerson{{$person->id}}' type='button' 
              class='textButton hideGroupTypesForPerson' value='[ - ]' />
            <div class='groupsForPerson'>
                @foreach ($groups as $group)
                    @if ($group->person_id == $person->id)
                        <form method='POST' action="{{ route('group.destroy', ['id'=>$group->id]) }}" class='deleteForm'>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type='submit' value='x' class='textButton red' />
                        </form>
                        <div class='groupForPerson'>
                            {{ $group->type->name }}
                        </div>
                    @endif
                @endforeach
            </div>
            <div id='listOfGroupTypes{{$person->id}}' class='clear listOfGroupTypes'>
                Add to group:
                @foreach ($group_types as $group_type)
                    <form method="POST" action="/peeps/public/group" class='newGroupForm'>
                        {{ csrf_field() }}
                        <input type='hidden' name='personID' value='{{ $person->id }}' />
                        <input type='hidden' name='typeID' value='{{ $group_type->id }}' />
                        <input type='submit' value='{{ $group_type->name }}' class='textButton' />
                    </form>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
