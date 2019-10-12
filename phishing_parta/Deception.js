/**
 * Created by prashanthrajivan on 9/12/16.
 */
function  Close_click() {
    $("#wrapperC").show();
    $("#Error2").show();
    $("#wrapperL").show();
    $("#ButtonIns").show();
    $("#Instructions").hide();
}

function Ins_click() {
    $("#wrapperL").hide();
    $("#wrapperC").hide();
    $("#Error2").hide();
    $("#ButtonIns").hide();
    $("#Instructions").show();
}

function Q1_click(){

    //if the hidden value is true - move them to the next question
    if($("#Q1h").val() == "1"){

        $("#Question1").hide();
        $("#Question2").show();
    }
    else{
        //check if an option is selected - if not ask them to choose an option
        if ( (typeof ($('input[name=role]:checked').val()) === "undefined")){
            $("#Error1").show();
            $("#Error1").effect("shake");
        }
        else{
            $("#Error1").hide();
            $("#Error2").hide();
            $("#ButtonIns").hide();
            //if an option is selected - check to see if it is the correct answer
            if(($('input[name=role]:checked').val()) == "Phi"){
                //if it is the correct answer -
                // provide a text to explain why it is correct,
                $("#Correct1").show();

                // flag the hidden value
                $("#Q1h").val("1");
                // change the text of button to continue
                $("#Button1").text("Next Question");
            }
            else{
                //if it is the wrong answer - say the answer is wrong and that to try again
                $("#Error1").hide();
                $("#Error2").show();
                $("#Error2").effect("shake");
                $("#ButtonIns").show();
                //provide them a link to instructions
            }
        }
    }

}//end of function

function Q2_click(){

    //if the hidden value is true - move them to the next question
    if($("#Q2h").val() == "1"){

        $("#Question2").hide();
        $("#Question3").show();
    }
    else{
        //check if an option is selected - if not ask them to choose an option
        if ( (typeof ($('input[name=Pactivities]:checked').val()) === "undefined")){
            $("#Error1").show();
            $("#Error1").effect("shake");
        }
        else{
            $("#Error1").hide();
            $("#Error2").hide();
            $("#ButtonIns").hide();
            //if an option is selected - check to see if it is the correct answer
            tempvar = "";
            $('input[name=Pactivities]').each(function (index) {
                if ($(this).is(':checked')) {
                    tempvar += $(this).attr('value') + ".";
                }
            });
            //Write.Launch.Feedback
            if(tempvar == "Write.Launch.Feedback."){
                //if it is the correct answer -
                // provide a text to explain why it is correct,
                $("#Correct2").show();
                // flag the hidden value
                $("#Q2h").val("1");
                // change the text of button to continue
                $("#Button2").text("Next Question");
            }
            else{
                //if it is the wrong answer - say the answer is wrong and that to try again
                $("#Error1").hide();
                $("#Error2").show();
                $("#Error2").effect("shake");
                $("#ButtonIns").show();
                //provide them a link to instructions
            }
        }
    }
}


function Q3_click(){
//if the hidden value is true - move them to the next question
    if($("#Q3h").val() == "1"){

        $("#Question3").hide();
        $("#Question4").show();
    }
    else{
        //check if an option is selected - if not ask them to choose an option
        if ( (typeof ($('input[name=Strategies]:checked').val()) === "undefined")){
            $("#Error1").show();
            $("#Error1").effect("shake");
        }
        else{
            $("#Error1").hide();
            $("#Error2").hide();
            $("#ButtonIns").hide();
            //if an option is selected - check to see if it is the correct answer
            tempvar = "";
            $('input[name=Strategies]').each(function (index) {
                if ($(this).is(':checked')) {
                    tempvar += $(this).attr('value') + ".";
                }
            });
            //Creative.Change.Deceive.Exploit.
            if(tempvar == "Creative.Change.Deceive.Exploit."){
                //if it is the correct answer -
                // provide a text to explain why it is correct,
                $("#Correct3").show();
                // flag the hidden value
                $("#Q3h").val("1");
                // change the text of button to continue
                $("#Button3").text("Next Question");
            }
            else{
                //if it is the wrong answer - say the answer is wrong and that to try again
                $("#Error1").hide();
                $("#Error2").show();
                $("#Error2").effect("shake");
                $("#ButtonIns").show();
                //provide them a link to instructions
            }
        }
    }
}

function Q4_click(){

    //if the hidden value is true - move them to the next question
    if($("#Q4h").val() == "1"){

        $("#Question4").hide();
        $("#wrapperC").hide();
        $("#Question5").show();
    }
    else{
        //check if an option is selected - if not ask them to choose an option
        if ( (typeof ($('input[name=point]:checked').val()) === "undefined")){
            $("#Error1").show();
            $("#Error1").effect("shake");
        }
        else{
            $("#Error1").hide();
            $("#Error2").hide();
            $("#ButtonIns").hide();
            //if an option is selected - check to see if it is the correct answer
            if(($('input[name=point]:checked').val()) == "200"){
                //if it is the correct answer -
                // provide a text to explain why it is correct,
                $("#Correct4").show();
                // flag the hidden value
                $("#Q4h").val("1");
                // change the text of button to continue
                $("#Button4").text("Next Question");
            }
            else{
                //if it is the wrong answer - say the answer is wrong and that to try again
                $("#Error1").hide();
                $("#Error2").show();
                $("#Error2").effect("shake");
                $("#ButtonIns").show();
                //provide them a link to instructions
            }
        }
    }

}
