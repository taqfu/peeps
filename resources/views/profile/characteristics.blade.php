@extends ('master')
@section ('content')
<?php 
    define('URL_CHARACTERISTIC', 8);
?>
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
              name='characteristicType' value='simple{{$simple_type->id}}' class='allCharacteristicTypes' />
            <input id='simpleTypeValueType{{ $simple_type->id }}' type='hidden' value='{{ $simple_type->value_type}}' />
            <form method="POST" action="{{ route('simpleType.destroy', ['id'=> $simple_type->id]) }}" class='deleteSimpleType'>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type='hidden' name='personID' value='{{ $person_id }}' />
                <input type='submit' value='x' class='textButton red' />
            </form>
            <input id='selectType{{$simple_type->id}}' type='button' 
              value='{{$simple_type->name}}' class='selectCharacteristicType textButton'/>
        </div>
    @endforeach
    </div>
    <div id='createCharacteristicInputs' class='clear'>
            <input type='hidden' id="personID" value="{{ $person_id }}" />
            <input type='hidden' id="characteristicValueType" value="string" />
            <input type='text'   id="characteristicString" />
            <div id ='characteristicDate'>
                @include ('simpleTypeDate')
            </div>
            <div id='characteristicTime'>
                @include ('simpleTypeTime')
            </div>
            <input type='button' id='createCharacteristic' value='Create' />
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
            @if ($characteristic->simple_id==URL_CHARACTERISTIC)
                <a href="{{ $characteristic->string }}">
            @endif
            {{ $characteristic->string }}
            @if ($characteristic->simple_id==URL_CHARACTERISTIC)
                </a>
            @endif
        </div>
    @endforeach
@endsection
