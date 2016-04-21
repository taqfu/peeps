<select id='DateMonth' name="month" >
<option></option>

@for($month=1 ; $month<13 ; $month++)
    <?php $month_val = $month<10 ? "0".$month : $month; ?>
        <option value='{{ $month_val }}' >{{ date("F",mktime(0, 0, 0, $month, 10)) }}</option> 
@endfor
</select>

<select id='DateDay' name="day">
<option></option>
@for($day=1 ; $day<32 ; $day++)
    <?php $day_val = $day<10 ? "0".$day : $day;?>
    <option value='{{ $day_val }}' >{{ $day }}</option
>@endfor

</select>

<select id='DateYear' name="year">
<option></option>

@for($year=date("Y")+10; $year>date("Y")-160 ; $year--)
            <option value='{{ $year }}' >{{ $year }}</option>
@endfor

</select>
