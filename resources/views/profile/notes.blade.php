<?php
function format_appropriately($string) {
    $urls = [];
    $url_captions = [];
    $words = preg_split("/\s/", $string);
    foreach ($words as $key => $word) {
        if (preg_match("/[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+/", $word) 
            && (strpos($word, "http")!=false || strpos($word, ".com")!=false)) {

            $url_captions[] = $word;
            $urls[] = str_replace("http://", "", $word);
        }
    }
    if (count($urls) > 0) {
        foreach ($urls as $key => $val) {
            $string = str_replace($url_captions[$key], "<a href='http://$urls[$key]'>$url_captions[$key]</a>", $string);
        }
    }
    return nl2br($string);
}
?>
@extends ('master')
@section ('content')
    @foreach ($person as $person)
    @endforeach
    @include ("profile.menu", ["route_name"=>Route::getCurrentRoute()->getName()])
    <h1 class='profileHeading'>
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
    <input type='button' id='showNewTagType' class='textButton' value='[ Show Tag Types ]' />
    <input type='button' id='hideNewTagType' class='textButton' value='[ Hide Tag Types ]' style='display:none;'/>
    <div id='newTagTypeList' style='display:none'>
        <form method="POST" action="{{ route('tagType.store') }}">
            {{ csrf_field() }}
            <input type='text' name='newTagTypeName'/>
            <input type='hidden' name='personID' value='{{ $person_id }}' />
            <input type='submit' value='Create Type Tag' />
        </form>
        @include ('TagTypes')
    </div>
    <div class='clear'>
    @foreach ($notes as $note)
        <div class='profileNoteContainer clear'>
            <form method="POST" action="{{ route('note.destroy', ['id'=> $note->id]) }}" class='deleteNoteForm'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='submit' value='X' class='textButton red' />
            </form>
            <div class="noteDate">
                {{ date('F j, y H:i', strtotime($note->created_at)) }}
            </div>
            <div class='profileNote'>
                 <?php echo format_appropriately( $note->note);?>
            </div>
        </div>
        @include ('Tags')
    @endforeach
    </div>
@endsection
