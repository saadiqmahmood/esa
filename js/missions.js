function validateform() 
{

    var name=document.myform.name.value;
    var destination=document.myform.destination.value;
    var launch_date=document.myform.launch_date.value;
    var mission_type=document.myform.mission_type.value;
    var crew_size=document.myform.crew_size.value;

    if (name==null || name==""){
        alert("Please enter Mission Name");
        return false;
    } else if (destination==null || destination==""){
        alert("Please enter Mission Destination");
        return false;
    } else if (launch_date==null || launch_date==""){
        alert("Please enter Launch Date");
        return false;
    } else if (mission_type==null || mission_type==""){
        alert("Please enter Mission Type");
        return false;
    } else if (crew_size==null || crew_size==""){
        alert("Please enter Crew Size");
        return false;
    }
}
    
   