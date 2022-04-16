
function validatedata(){
    var fNAME=document.student.fNAME.value;
    var lNAME=document.student.lNAME.value;
    var STUDENT_ID=document.student.STUDENT_ID.value;
    var SECTION=document.student.SECTION.value;
    if (fNAME==null || fNAME=="" || STUDENT_ID==null ||STUDENT_ID=="" || SECTION=="" ||SECTION==null){
        alert('Please fill all the data below');
        return false;
    }
}
