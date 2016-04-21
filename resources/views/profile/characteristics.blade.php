@extends ('master')
@section ('content')
<?php 
    define('URL_CHARACTERISTIC', 8);
?>
    <div id='noteInput' style='position:fixed;top:35%;left:30%;border:1px solid black;text-align:center;width:400;height:200;'>
        <div>
            Please input your note:
        </div>
        <div>
        <form method='POST' action="{{ route('note.store') }}">
        <input type='hidden' name='noteType' value='text' />
        <input type='hidden' id='noteCharacteristicID' name='characteristicID'/>
        <input type='hidden' name='personID'  value='0'/>
        <textarea style='width:400px;height:150px;' name='newNote'></textarea>
        <input type='submit'>
        </form>
        </div>
    </div>
    <div id='content'>
    <a href='/peeps/public/' class='profileMenu'>Listings</a>
    <a href='/peeps/public/profile/{{$person_id}}' class='profileMenu'>Summary</a>
    <a href='/peeps/public/profile/{{$person_id}}/notes' class='profileMenu'>Notes</a>
    <form method="POST" action="{{ route('simpleType.store') }}" class='newSimpleTypeForm'>
        {{ csrf_field() }}
        <div style='margin-bottom:8px;'>
        Type:
            <input id='valueTypeText' type='radio' name='valueType' value='text' class='allValueTypes' checked/>
            <input type='button' class='selectValueType textButton' value='Text' />
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

            @endif
        </div>
        <div class='characteristicNote'>
            <input type='button' class='textButton' value='[ ? ]' />
            <input type='button' class='textButton' value='[ + ]' />
        </div>
    @endforeach
    </div>
@endsection
