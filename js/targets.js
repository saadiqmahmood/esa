function validateform() 
{

    var target_name=document.myform.target_name.value;
    var first_mission=document.myform.first_mission.value;
    var type=document.myform.type.value;
    var no_mission=document.myform.no_mission.value;

    if (target_name==null || target_name==""){
        alert("Please enter Target Name");
        return false;
    } else if (first_mission==null || first_mission==""){
        alert("Please enter Date of First Mission");
        return false;
    } else if (type==null || type==""){
        alert("Please enter Target Type");
        return false;
    } else if (no_mission==null || no_mission==""){
        alert("Please enter Target Number of Missions");
        return false;
    }
}