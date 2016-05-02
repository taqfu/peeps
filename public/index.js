$(document.body).ready(function () {
    
    $(document).on("click", ".showCharacteristicNoteInput", function (event) {
        $("#characteristicNoteInput").show();    
        $("#content").css("opacity", ".3");
        characteristic_id = event.target.id.substr(18, event.target.id.length-18);
        $("#noteCharacteristicID").val(characteristic_id);
    });
    $(document).on("click", "#cancelCharacteristicNote", function (event) {
        $("#characteristicNoteInput").hide();    
        $("#content").css("opacity", "1");
        $("#noteCharacteristicID").val("");
    });
    $(document).on("click", "#createCharacteristic", function (event) {
        var typeID = $('input[name=characteristicType]:checked').val()
          .substr(6, $('input[name=characteristicType]:checked').val().length-6);
        var personID = $("#personID").val();
        var characteristicValueType = $("#characteristicValueType").val();
        createCharacteristic(characteristicValueType, typeID, personID);
    });
    $(document).on("keydown", "#characteristicString", function (event) {
        console.log("ASDFA");
        if (event.key==="Enter"){
            var typeID = $('input[name=characteristicType]:checked').val()
              .substr(6, $('input[name=characteristicType]:checked').val().length-6);
            var personID = $("#personID").val();
            var characteristicValueType = $("#characteristicValueType").val();
            createCharacteristic(characteristicValueType, typeID, personID);
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
    $(document).on("click", "#showNewTagType", function (event) {
        $("#showNewTagType").hide();
        $("#hideNewTagType").show();
        $("#newTagTypeList").show();
    });
    $(document).on("click", "#hideNewTagType", function (event) {
        $("#showNewTagType").show();
        $("#hideNewTagType").hide();
        $("#newTagTypeList").hide();
    });
    $(document).on("click", ".showNewTypeTags", function (event) {
        var noteID = event.target.id.substr(15, event.target.id.length-15);
        $("#showNewTypeTags" + noteID).hide();
        $("#hideNewTypeTags" + noteID).show();
        $("#listOfNewTypeTags" + noteID).show();
    });
    $(document).on("click", ".hideNewTypeTags", function (event) {
        var noteID = event.target.id.substr(15, event.target.id.length-15);
        $("#showNewTypeTags" + noteID).show();
        $("#hideNewTypeTags" + noteID).hide();
        $("#listOfNewTypeTags" + noteID).hide();
    });
    $(document).on("click", ".showNewPersonTags", function (event) {
        var noteID = event.target.id.substr(17, event.target.id.length-17);
        $("#showNewPersonTags" + noteID).hide();
        $("#hideNewPersonTags" + noteID).show();
        $("#listOfNewPersonTags" + noteID).show();
    });
    $(document).on("click", ".hideNewPersonTags", function (event) {
        var noteID = event.target.id.substr(17, event.target.id.length-17);
        $("#showNewPersonTags" + noteID).show();
        $("#hideNewPersonTags" + noteID).hide();
        $("#listOfNewPersonTags" + noteID).hide();
    });
    $(document).on("click", ".selectCharacteristicType", function (event) {
        var type_id = event.target.id.substr(10, event.target.id.length-10);
        
        $(".allCharacteristicTypes").prop("checked", false);
        $("#simpleType"+type_id).prop("checked", true);
    });
    $(document).on("click", ".selectCharacteristic", function (event) {
        var type_id = event.target.id.substr(10, event.target.id.length-10);
        var valueType = $("#simpleTypeValueType"+type_id).val();
        $("#characteristicValueType").val(valueType);
        valueType = capitalizeFirstLetter(valueType);
        $(".characteristicInputs").hide();
        $("#createCharacteristic").show();
        if (valueType==="Number"){
            $("#characteristicString").show(); 
        } else if (valueType==="Datetime"){
            $("#characteristicDate").show();
            $("#characteristicTime").show();
        } else if (valueType!=="Datetime"){
            $("#characteristic"+valueType).show();
        }
    });
    $(document).on("click", ".selectValueType", function (event) {
        $(".allValueTypes").prop("checked", false);
        $("#valueType"+event.target.value).prop("checked", true);
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
    $(document).on("click", ".showCharacteristicNote", function (event) {
        var characteristicID = event.target.id.substr(22, event.target.id.length-22);     
        $("#showCharacteristicNote" + characteristicID).hide();
        $("#hideCharacteristicNote" + characteristicID).show();
        $("#characteristicNotes" + characteristicID).show();
    });
    $(document).on("click", ".hideCharacteristicNote", function (event) {
        var characteristicID = event.target.id.substr(22, event.target.id.length-22);     
        $("#showCharacteristicNote" + characteristicID).show();
        $("#hideCharacteristicNote" + characteristicID).hide();
        $("#characteristicNotes" + characteristicID).hide();
    });
    
    $(document).on("change", ".toDo", function (event) {
        var toDoID = event.target.id.substr(4, event.target.id.length-4);     
        var toDoStatus =  $("#toDo"+toDoID).is(":checked");
        changeToDoStatus(toDoID, toDoStatus);
    });
});

function changeToDoStatus(id, status){

        console.log(id, status);
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"/peeps/public/toDo/"+id,
            type:"PUT",
            data:{toDostatus:status},
            success: function (response){
                window.location.reload();
            }
        })
}
function createCharacteristic(valueType, typeID, personID){
    if (valueType==="string"){ 
        var characteristicString = $("#characteristicString").val();
        if (characteristicString && characteristicString.trim()!=""){
            createCharacteristicFromString(personID, valueType, typeID, characteristicString);
        }
    } else if (valueType==="date"){ 
        if($("#DateYear").val()!==""  && $("#DateMonth").val()!=="" && $("#DateDay").val()!==""){
            var characteristicDate = $("#DateYear").val() + "-" + $("#DateMonth").val() + "-" + $("#DateDay").val();
            console.log(personID, valueType, typeID, characteristicDate);
            createCharacteristicFromDate(personID, valueType, typeID, characteristicDate);
        }
    } else if (valueType==="number"){
        var numberValue = Number($("#characteristicString").val());
        if (!isNaN(numberValue)){
            createCharacteristicFromNumber(personID, valueType, typeID, numberValue)
        }
    }
}
function createCharacteristicFromDate(personID, valueType, typeID, dateValue){
        console.log(personID, valueType, typeID, dateValue);
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"POST",
            url:"/peeps/public/characteristic",
            data: {person_id : personID, value_type : valueType, 
              simple_id : typeID, date_value : dateValue}
        })
            .done(function(result){
                console.log(result);
                window.location.reload();
            });
}
function createCharacteristicFromNumber(personID, valueType, typeID, numberValue){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"POST",
            url:"/peeps/public/characteristic",
            data: {person_id : personID, value_type : valueType, 
              simple_id : typeID, number_value : numberValue}
        })
            .done(function(result){
                console.log(result);
                window.location.reload();
            });
}
function createCharacteristicFromString(personID, valueType, typeID, stringValue){
        console.log(personID, valueType, typeID, stringValue);
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
                console.log(result);
                window.location.reload();
            });
}
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

