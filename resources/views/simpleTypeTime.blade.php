<select id='DateHour' name="hour">

@for ($hour=0; $hour<24; $hour++)
    <?php $hour = $hour<10 ? "0".$hour : $hour; ?>
       <option value="{{$hour}}">{{ $hour }}</option>
@endfor

</select>

<select  id='TimeMinute' name="minute">

@for ($minute=0; $minute<60; $minute++)
    <?php $minute = $minute<10 ? "0".$minute : $minute; ?>
       <option value="{{$minute}}">{{ $minute }}</option>
@endfor

</select>
