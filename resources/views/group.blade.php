@extends ('master')
@section ('content')
    <a href="{{ route('listings') }}">Back To Listings</a>
    <h1> {{ $group[0]->type->name }}</h1>
    @foreach ($group as $members)
        <div>
            <a href="{{ route('summary', ['person_id'=>$members->member->id]) }}">
                {{ $members->member->name }}
            </a>
        </div>
    @endforeach
@endsection
