<select id='DateMonth' name="month" >

@for($month=1 ; $month<13 ; $month++)
    <?php $month_val = $month<10 ? "0".$month : $month; ?>
        <option value='{{ $month_val }}' >{{ date("F",mktime(0, 0, 0, $month, 10)) }}</option> 
@endfor
</select>

<select id='DateDay' name="day">
@for($day=1 ; $day<32 ; $day++)
    <?php $day_val = $day<10 ? "0".$day : $day;?>
    <option value='{{ $day_val }}' >{{ $day }}</option
>@endfor

</select>

<select id='DateYear' name="year">

@for($year=date("Y")-160 ; $year<date("Y")+10 ; $year++)
        @if ($year==date("Y"))
            <option value='{{ $year }}' selected>{{ $year }}</option>
        @elseif ($year!==date("Y"))
            <option value='{{ $year }}' >{{ $year }}</option>
        @endif
@endfor

</select>
