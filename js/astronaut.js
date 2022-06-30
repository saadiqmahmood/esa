
function validateform() 
{
    var astronaut_name=document.myform.astronaut_name.value;
    var no_missions=document.myform.no_missions.value;


    if (astronaut_name==null || astronaut_name==""){
        alert("Please enter Astronaut Name");
        return false;
    } else if (no_missions==null || no_missions==""){
        alert("Please enter Number of Missions");
        return false;
    } 
}