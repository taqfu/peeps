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
    $(document).on("click", "#showGroupTypeNames", function (event) {
        $("#showGroupTypeNames").hide();
        $("#hideGroupTypeNames").show();
        $("#listOfGroupTypes").show();
    });
    $(document).on("click", "#hideGroupTypeNames", function (event) {
        $("#showGroupTypeNames").show();
        $("#hideGroupTypeNames").hide();
        $("#listOfGroupTypes").hide();
    });
    $(document).on("click", ".showGroupTypesForPerson", function (event) {
        person_id = event.target.id.substr(23, event.target.id.length-23);
        $("#showGroupTypesForPerson" + person_id).hide();
        $("#hideGroupTypesForPerson" + person_id).show();
        $("#listOfGroupTypes" + person_id).show();
    });
    $(document).on("click", ".hideGroupTypesForPerson", function (event) {
        person_id = event.target.id.substr(23, event.target.id.length-23);
        $("#showGroupTypesForPerson" + person_id).show();
        $("#hideGroupTypesForPerson" + person_id).hide();
        $("#listOfGroupTypes" + person_id).hide();
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
