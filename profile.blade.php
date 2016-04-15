@extends ('master')
@section ('content')
    <a href='/peeps/public/' class='left backLink'>Back</a>
    <form method="POST" action="/peeps/public/type/simple" class='left'>
        {{ csrf_field() }}
        <input type='text' name="newSimpleTypeName" />
        <input type='hidden' name="person_id" value="{{ $person_id }}" />
        <input type='submit' value='New Simple Type'/>
    </form>
    <div class='clear'>
    @foreach ($simple_types as $simple_type)
        <input id='simpleType{{$simple_type->id}}' type='radio' 
          name='characteristicType' value='simple{{$simple_type->id}}' class='allCharacteristicTypes' />
        <input id='selectType{{$simple_type->id}}' type='button' 
          value='{{$simple_type->name}}' class='selectCharacteristicType textButton'/>
    @endforeach
    </div>
    <div class='clear'>
            {{ csrf_field () }}
            <input type='hidden' id="personID" value="{{ $person_id }}" />
            <input type='hidden' id="characteristicValueType" value="string" />
            <input type='text'   id="characteristicString" />
            <input type='button' id='createCharacteristic' value='Create Characteristic' />
    <?php $old_simple_type=0; ?>
    </div>
    @foreach ($characteristics as $characteristic)
        @if ($old_simple_type!=$characteristic->simple_id)
        <h2 class='new'> {{ $characteristic->type->name}} </h2>
        <?php $old_simple_type = $characteristic->simple_id; ?>
        @endif
        <form method="POST" action="/peeps/public/characteristic/{{$characteristic->id}}" class='deleteForm'>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type='submit' value='x' class='textButton red'/>
        </form>
        <div class='characteristicValue'>
            {{ $characteristic->string }}
        </div>
    @endforeach
@endsection
