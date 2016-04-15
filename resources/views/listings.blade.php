@extends ('master')
@section ('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    <form method="POST" action="/peeps/public/person">
        {{ csrf_field() }}
        <input type='submit' value='New Person' />
    </form>
    Sort:
    <div class='sortMenu'>
    <A href="{!! route('listings', ["sort"=>"alphabetically"]) !!}" class='sortMenuItem'>Alphabetically</a>
    <A href="{!! route('listings', ["sort"=>"numerically"]) !!}" class='sortMenuItem'>   Numerically</a>
    </div>
    @foreach ($people as $person)
        <div>
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
        </div>
    @endforeach
@endsection
