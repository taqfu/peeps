$(document.body).ready(function () {
    $(document).on("click", "#createCharacteristic", function (event) {
        var typeID = $('input[name=characteristicType]:checked').val()
          .substr(6, $('input[name=characteristicType]:checked').val().length-6);
        var personID = $("#personID").val();
        var characteristicValueType = $("#characteristicValueType").val();
        var characteristicString = $("#characteristicString").val();
        if (characteristicString && characteristicString.trim()!=""){
            createCharacteristic(personID, characteristicValueType, typeID, characteristicString);
        }
    });
    $(document).on("keydown", "#characteristicString", function (event) {
        if (event.key==="Enter"){
            var typeID = $('input[name=characteristicType]:checked').val()
              .substr(6, $('input[name=characteristicType]:checked').val().length-6);
            var personID = $("#personID").val();
            var characteristicValueType = $("#characteristicValueType").val();
            var characteristicString = $("#characteristicString").val();
            if (characteristicString && characteristicString.trim()!=""){
                createCharacteristic(personID, characteristicValueType, typeID, characteristicString);
            }
        }
    });
    $(document).on("click", "#showNamesAvailable", function (event) {
        $("#showNamesAvailable").hide();
        $("#hideNamesAvailable").show();
        $("#listOfNamesAvailable").show(); 
    });
    $(document).on("click", "#hideNamesAvailable", function (event) {
        $("#showNamesAvailable").show();
        $("#hideNamesAvailable").hide();
        $("#listOfNamesAvailable").hide(); 
    });
    $(document).on("click", ".selectCharacteristicType", function (event) {
        var type_id = event.target.id.substr(10, event.target.id.length-10);
        console.log(type_id);
        $(".allCharacteristicTypes").prop("checked", false);
        $("#simpleType"+type_id).prop("checked", true);
    });
    
});


function createCharacteristic(personID, valueType, typeID, stringValue){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"POST",
            url:"/peeps/public/characteristic",
            data: {person_id : personID, value_type : valueType, 
              simple_id : typeID, string_value : stringValue}
        })
            .done(function(result){
                window.location.reload();
            });
}
