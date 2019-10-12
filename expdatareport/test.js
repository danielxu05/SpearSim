/**
 * Created by prashanthrajivan on 11/9/16.
 */
function Q2_click(){
    if (document.myForm.Q_309.value == false) {
        alert("Please answer the question to proceed");
        return false;
    } 
    else 
    {
        $("#h_309").val(1);
        $("#2").hide();
        $("#2").show();} } 