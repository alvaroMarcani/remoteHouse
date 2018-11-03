/**
 * Created by ALVARO on 2/11/2018.
 */
var pathLightOn;
var pathLightOff;
var pathDoorOn;
var pathDoorOff;
var lightStatus;
var doorStatus;

function setDefault($pLOn, $pLOff, $pDOn, $pDOff){
    pathLightOn=$pLOn;
    pathLightOff=$pLOff;
    pathDoorOn=$pDOn;
    pathDoorOff=$pDOff;

    $("#actionLight").on('click', function () {
        if(lightStatus){
            setLight(false, true);
            lightStatus=false;
        }else{
            setLight(true, true);
            lightStatus=true;
        }
    });

    $("#actionDoor").on('click', function () {
        if(doorStatus){
            setDoor(false, true);
            doorStatus=false;
        }else{
            setDoor(true, true);
            doorStatus=true;
        }
    });

    $("#toggle-light").on('change', function () {
        if(lightStatus){
            setLight(false, false);
            lightStatus=false;
        }else{
            setLight(true, false);
            lightStatus=true;
        }
    });

    $("#toggle-door").on('change', function () {
        if(doorStatus){
            setDoor(false, false);
            doorStatus=false;
        }else{
            setDoor(true, false);
            doorStatus=true;
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
