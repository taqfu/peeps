@extends ("master")
@section ("content")
    <a href='/peeps/public/' class='profileMenu'>Listings</a>
<a href='/peeps/public/profile/{{$person_id}}/characteristics' class='profileMenu'>Characteristics</a>
    <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
<div class='clear'>
    Display Name:
    @foreach ($people as $person)
    @endforeach
    <span style='font-style:italic;'>
    @if (empty($person->name))
        None.
    @elseif (!empty($person->name))
        {{ $person->name }}
    @endif
    </span>
    <input  type='button' id='showNamesAvailable' value='[ + ]' class='textButton' />
    <input type='button' id='hideNamesAvailable' value='[ - ]' class='textButton' style='display:none' />
    <div id='listOfNamesAvailable' style='display:none;'>
    @forelse ($characteristics as $characteristic)
        <form method="POST" action="/peeps/public/person/{{$person_id}}" class='noMargin'>
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        
        @if ($characteristic->string===$person->name)
            <input type='submit' name='newPersonName' value='{{ $characteristic->string }}' 
              class='textButton' style='font-weight:bold' />
        @else
            <input type='submit' name='newPersonName' value='{{ $characteristic->string }}' class='textButton' />
        @endif
        </form>
    @empty
        <div style='font-style:italic;color:grey;'>
            No names have been registered for this profile yet.
        </div>
    @endforelse
    </div>
</div>
@endsection
