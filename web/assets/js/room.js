/**
 * Created by ALVARO on 2/11/2018.
 */
var pathLightOn;
var pathLightOff;
var pathDoorOn;
var pathDoorOff;
var lightStatus;
var doorStatus;

var roomId;

var $loading=$('.loader-bg');
var routeLight=Routing.generate('light_update');
var routeDoor=Routing.generate('door_update');

function setDefault($pLOn, $pLOff, $pDOn, $pDOff, $roomId){
    // $("#info-alert").hide();
    pathLightOn=$pLOn;
    pathLightOff=$pLOff;
    pathDoorOn=$pDOn;
    pathDoorOff=$pDOff;
    roomId=$roomId;

    $("#actionLight").on('click', function () {
        if(lightStatus){
            if(sendDataRoom(routeLight, false)){
                setLight(false, true);
                lightStatus=false;
            }else {
                lightStatus=true;
            }
        }else{
            if(sendDataRoom(routeLight, true)){
                setLight(true, true);
                lightStatus=true;
            }else{
                lightStatus=false;
            }
        }
    });

    $("#actionDoor").on('click', function () {
        if(doorStatus){
            if(sendDataRoom(routeDoor, false)){
                setDoor(false, true);
                doorStatus=false;
            }else {
                doorStatus=true;
            }
        }else{
            if(sendDataRoom(routeDoor, true)){
                setDoor(true, true);
                doorStatus=true;
            }else {
                doorStatus=false;
            }
        }
    });

    $("#toggle-light").on('change', function () {
        if(lightStatus){
            if(sendDataRoom(routeLight, false)){
                setLight(false, false);
                lightStatus=false;
            }else {
                lightStatus=true;
            }
        }else{
            if(sendDataRoom(routeLight, true)){
                setLight(true, false);
                lightStatus=true;
            }else{
                lightStatus=false;
            }
        }
    });

    $("#toggle-door").on('change', function () {
        if(doorStatus){
            if(sendDataRoom(routeDoor, false)){
                setDoor(false, false);
                doorStatus=false;
            }else {
                doorStatus=true;
            }
        }else{
            if(sendDataRoom(routeDoor, true)){
                setDoor(true, false);
                doorStatus=true;
            }else {
                doorStatus=false;
            }
        }
    });
}

function setRoom($light, $door) {
    // console.log($light+" "+$door);
    setLight($light);
    setDoor($door);
    lightStatus=$light;
    doorStatus=$door;
}

function setLight($light, $fromView) {
    if($light){
        $("#room_bg").removeClass("room-bg room-off").addClass("room-on");
        $("#light").attr("src", pathLightOn);
        if($fromView){$('#toggle-light').bootstrapToggle('on')}
    }else{
        $("#room_bg").removeClass("room-bg room-on").addClass("room-off");
        $("#light").attr("src", pathLightOff);
        if($fromView){$('#toggle-light').bootstrapToggle('off')}
    }
}

function setDoor($door, $fromView) {
    if($door){
        $("#door").attr("src", pathDoorOn);
        if($fromView){$('#toggle-door').bootstrapToggle('on')}
    }else{
        $("#door").attr("src", pathDoorOff);
        if($fromView){$('#toggle-door').bootstrapToggle('off')}
    }
}

function sendDataRoom(route, status) {
    response=true;
    $loading.show();
    $.get(route, {
        'id':roomId,
        'status':status
    },function (data, status) {
        response=(data === 'true');
        if(response){
            setMessage("true");
        }else{
            setMessage("false")
        }
    })
        .fail(function() {
            response=false;
            setMessage("fail");
            console.log( "error" );
        })
        .always(function() {
            $loading.hide();
            console.log( "finished" );
        })
    ;
    return response;
}

function setMessage(type) {
    message="";
    status="";
    switch (type){
        case "true":
            message="Se han guardado los cambios en la Base de Datos";
            status="success";
            break;
        case "false":
            message="No se ha logrado guardar los cambios en la Base de Datos";
            status="danger";
            break;
        case "fail":
            message="El servicio ha fallado, vuelva a intentar mas tarde mientras se repara";
            status="danger";
            break;
        default:
            break;
    }
    $class="alert alert-"+status;
    $("#info-alert").removeClass().addClass($class).text(message).show();
    setTimeout(function() {
        $('#info-alert').fadeOut('fast');
    }, 6000);
}