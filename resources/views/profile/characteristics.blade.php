@extends ('master')
@section ('content')
@foreach ($people as $person)
@endforeach

<?php 
    define('URL_CHARACTERISTIC', 8);
?>
    <div id='characteristicNoteInput'>
        <div>
            Please input your note:
        </div>
        <div>
        <form method='POST' action="{{ route('note.store') }}">
            {{ csrf_field() }}
            <input type='hidden' name='noteType' value='text' />
            <input type='hidden' id='noteCharacteristicID' name='characteristicID'/>
            <input type='hidden' name='personID'  value='{{ $person_id }}'/>
            <textarea style='width:400px;height:150px;' name='newNote'></textarea>
            <input type='submit' value='Create Note'>
            <input type='button' id='cancelCharacteristicNote' value='Cancel' />
        </form>
        </div>

    </div>
    <div id='content'>
    <a href='/peeps/public/' class='profileMenu'>Listings</a>
    <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    <a href='/peeps/public/profile/{{$person_id}}/network' class='profileMenu'>Social Network</a>
    <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
    <a href='/peeps/public/profile/{{$person_id}}/todo' class='profileMenu'>To Do</a>
    <h1>
        {{ $person->name }}
    </h1>
    <form method="POST" action="{{ route('simpleType.store') }}" class='newSimpleTypeForm'>
        {{ csrf_field() }}
        <div style='margin-bottom:8px;'>
        Type:
            <input id='valueTypeString' type='radio' name='valueType' value='string' class='allValueTypes' checked/>
            <input type='button' class='selectValueType textButton' value='String' />
            <input id='valueTypeNumber' type='radio' name='valueType' value='number' class='allValueTypes' />
            <input type='button' class='selectValueType textButton' value='Number' />
            <input id='valueTypeDate' type='radio' name='valueType' value='date'  class='allValueTypes'/>
            <input type='button' class='selectValueType textButton' value='Date' />
            <input id='valueTypeTime' type='radio' name='valueType' value='time'  class='allValueTypes'/>
            <input type='button' class='selectValueType textButton' value='Time' />
            <input id='valueTypeDatetime' type='radio' name='valueType' value='datetime' class='allValueTypes'/>
            <input type='button' class='selectValueType textButton' value='Datetime' />
        </div>
        <input type='text' name="newSimpleTypeName" />
        <input type='hidden' name="person_id" value="{{ $person_id }}" />
        <input type='submit' value='New Simple Type'/>
    </form>
    <div class='clear'>
    @foreach ($simple_types as $simple_type)
        <div class='deleteSimpleType'>
            <input id='simpleType{{$simple_type->id}}' type='radio'  
              name='characteristicType' value='simple{{$simple_type->id}}' class='allCharacteristicTypes selectCharacteristic' />
            <input id='simpleTypeValueType{{ $simple_type->id }}' type='hidden' value='{{ $simple_type->value_type}}' />
            <form method="POST" action="{{ route('simpleType.destroy', ['id'=> $simple_type->id]) }}" class='deleteSimpleType'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='hidden' name='personID' value='{{ $person_id }}' />
                <input type='submit' value='x' class='textButton red' />
            </form>
            <input id='selectType{{$simple_type->id}}' type='button' 
              value='{{$simple_type->name}}' class='selectCharacteristicType textButton selectCharacteristic'/>
        </div>
    @endforeach
    </div>
    <div id='createCharacteristicInputs' class='clear'>
            <input type='hidden' id="personID" value="{{ $person_id }}" />
            <input type='hidden' id="characteristicValueType"/>
            <input type='text'   id="characteristicString" class='characteristicInputs' />
            <div id ='characteristicDate' class='characteristicInputs'>
                @include ('simpleTypeDate')
            </div>
            <div id='characteristicTime' class='characteristicInputs'>
                @include ('simpleTypeTime')
            </div>
            <input type='button' id='createCharacteristic' class='characteristicInputs' value='Create' />
    </div>
    <?php $old_simple_type=0; ?>
    @foreach ($characteristics as $characteristic)
        @if ($old_simple_type!=$characteristic->simple_id)
        <h2 class='new'> {{ $characteristic->type->name}} </h2>
        <?php $old_simple_type = $characteristic->simple_id; ?>
        @endif
        <form method="POST" action="{{ route('characteristic.destroy', ['id'=> $characteristic->id]) }}" class='deleteForm'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton red'/>
        </form>
        <div class='characteristicValue'>
            @if ($characteristic->value_type=="string")
                @if ($characteristic->simple_id==URL_CHARACTERISTIC)
                    <a href="{{ $characteristic->string }}">
                @endif
                {{ $characteristic->string }}
                @if ($characteristic->simple_id==URL_CHARACTERISTIC)
                    </a>
                @endif
            @elseif  ($characteristic->value_type=="date")
                {{ date("M d, Y", strtotime($characteristic->date)) }}
            @elseif ($characteristic->value_type=="number")
                {{ $characteristic->number }}
            @endif
        </div>
        <div class='characteristicNote'>
            <input type='button' id='noteCharacteristic{{ $characteristic->id }}' 
              class='textButton showCharacteristicNoteInput' value='[ + ]' />
            @if (count($characteristic->notes)>0)
                <input id='showCharacteristicNote{{ $characteristic->id }}' type='button' class='textButton showCharacteristicNote' value='[ ? ]' />
                <input id='hideCharacteristicNote{{ $characteristic->id }}' type='button' class='textButton hideCharacteristicNote' value='[ ? ]' />
            @endif
                <span id='characteristicNotes{{$characteristic->id }}' class='allCharacteristicNotes'>
            @foreach ($characteristic->notes as $note) 
                <span style='font-weight:bold;'>
                    {{ date("m/d/y g:i", strtotime($note->created_at))}} 
                </span>
                {{ $note->note }}
                
            @endforeach
                </span>
        </div>
    @endforeach
    </div>
@endsection
