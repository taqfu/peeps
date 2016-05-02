@extends ("master")
@section ("content")
    @foreach ($people as $person)
    @endforeach
    @include ("profile.menu", ["route_name"=>Route::getCurrentRoute()->getName()])
    <div class='clear'>
    @if ($person->ancillary!=0)
        <h3 class='ancillary'>
            Auxillary to
            <a class='auxillaryLink ' href='/peeps/public/profile/{{$person->ancillary}}/network'>
                {{ $person->main_ref->name }}
            </a>
        </h3>
    @endif
    Display Name:
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
        <form method="POST" action="{{ route('person.update', ['id'=> $person_id]) }}" class='noMargin'>
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
