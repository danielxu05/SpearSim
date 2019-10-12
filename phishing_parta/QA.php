<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <script src="UI/jquery-ui.js"></script>
    <script src="Deception.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    function onsubmitform() {
        $(window).unbind('beforeunload');
    }
</script>
<?php
session_start();?>
<body>
<div id="wrapperC">
    <h2>Please answer the following questions</h2></div>
    <!--<div id="toggle"> -->
    <label id="Error1" name="Error1" style="color:red; display:none;">Please answer the question to continue</label>
    <label id="Error2" name="Error2" style="color:red; display:none;">Wrong Answer. Please try again: </label>&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- </div> -->
    <button id="ButtonIns" onclick="Ins_click();return false;" style="font-size: small; display:none;">
        View Experiment Instructions
    </button>

<div id="wrapperL">
    <div id="Question1">
        <input type="hidden" id="Q1h" name="Q1h" value="0" />
    <h2>Q1: What is the name of your role in this study?
    </h2>
        <label style="font-size: 20px;"><input type="radio" name="role" value="Def">Defacer</label> <br />
        <label style="font-size: 20px;"><input type="radio" name="role" value="hat">White Hat</label> <br />
        <label style="font-size: 20px;"><input type="radio" name="role" value="Phi">Phisher</label> <br />
        <label style="font-size: 20px;"><input type="radio" name="role" value="Defe">Defender</label> <br />

        <label name="Correct1" id="Correct1" style="color:green; display:none;">You are correct! - You will be playing the role of a "Phisher" who uses phishing attacks to deceive people</label><br />
        <br />
        <button id="Button1" onclick="Q1_click();return false;" style="font-size: large">
            Submit
            </button>
    </div>

    <div id="Question2" style="display:none;">
        <input type="hidden" id="Q2h" name="Q2h" value="0" />
        <h2>Q2: During each trial in the study, choose all applicable activities you would be performing:
        </h2>
        <label style="font-size: 20px;"><input type="checkbox" name="Pactivities" value="Write"> Write a phishing email attack</label> <br>
        <label style="font-size: 20px;"><input type="checkbox" name="Pactivities" value="Reply"> Reply to emails</label> <br>
        <label style="font-size: 20px;"><input type="checkbox" name="Pactivities" value="Launch"> Launch phishing attacks</label> <br>
        <label style="font-size: 20px;"><input type="checkbox" name="Pactivities" value="Feedback"> Get feedback on your success</label> <br>
        <label style="font-size: 20px;"><input type="checkbox" name="Pactivities" value="Build"> Build a phishing website</label> <br>

        <label name="Correct2" id="Correct2" style="color:green; display:none;">You are correct! - During each trial, you will (1) Write a phishing email attack, (2) Launch phishing attacks and (3) Get feedback on your success.
          <br />  You <i>will not</i> be replying to mails and <i>will not</i> be building a website </label><br />
        <br />
        <button id="Button2" onclick="Q2_click();return false;" style="font-size: large">
            Submit
        </button>
    </div>

    <div id="Question3" style="display:none;">
        <input type="hidden" id="Q3h" name="Q3h" value="0" />
    <h2>Q3: Choose all the applicable strategies you must use to earn rewards in each trial in the experiment:
    </h2>
        <label style="font-size: 20px;"><input type="checkbox" name="Strategies" value="Creative"> Be creative with words in the email</label> <br />
        <label style="font-size: 20px;"><input type="checkbox" name="Strategies" value="Change"> Evade detection by changing email content</label> <br />
        <label style="font-size: 20px;"><input type="checkbox" name="Strategies" value="Reuse"> Evade detection by reusing email content</label> <br />
        <label style="font-size: 20px;"><input type="checkbox" name="Strategies" value="Deceive"> Lure users to respond through persuasion</label> <br />
        <label style="font-size: 20px;"><input type="checkbox" name="Strategies" value="Exploit"> Exploit weaknesses in human psychology and emotions to deceive people</label> <br />

        <label name="Correct3" id="Correct3" style="color:green; display:none;">You are correct! - You have to change the email content to evade detection. You have to be creative with words and exploit human emotions to deceive people.
            <br />  Reusing emails is <i> least likely </i> to give you rewards </label><br />
        <br />
        <button id="Button3" onclick="Q3_click();return false;" style="font-size: large">
            Submit
        </button>
    </div>


    <div id="Question4" style="display:none;">
        <input type="hidden" id="Q4h" name="Q4h" value="0" />
        <h2>Q4: What is the cost for launching each attack?</h2>
        <label style="font-size: 20px;"><input type="radio" name="point" value="100">100 points</label><br />
        <label style="font-size: 20px;"><input type="radio" name="point" value="150">150 points</label><br />
        <label style="font-size: 20px;"><input type="radio" name="point" value="200">200 points</label><br />
        <label style="font-size: 20px;"><input type="radio" name="point" value="250">250 points</label><br />

        <label name="Correct4" id="Correct4" style="color:green; display:none;">You are correct! - You will be paying 200 points for launching each attack</label><br />

        <br />
        <button id="Button4" onclick="Q4_click();return false;" style="font-size: large">
            Submit
        </button>
    </div>

    <div id="Question5" style="display:none;">
    <form method="get" action="Simulation.php" onsubmit="return onsubmitform();">
        <h2>Your training is complete. You Passed!</h2>
        <h3>Please click the below button to start the experiment.</h3>
        <input type="submit" name="submit" id="submit" class="btn-style" value="Start Experiment" />
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
    </div>
</div>
    <div id="Instructions" style="display:none;">
        <button id="ButtonClose" onclick="Close_click();return false;" style="font-size: large">
            <- Return to the question
        </button> <br/>
        <h2>Experiment Instructions</h2>
        <p>You will play the role of a computer hacker (an online criminal) who will use Phishing attacks to deceive others(take someone for a ride). Hence you will be called a <i>“Phisher”</i>
        </p>
        <p>Phishers target people through fraudulent, deceptive e-mails that exploit weaknesses of human psychology and emotions. Phishers write e-mails such that it causes regular people (a.k.a victims) to believe what is said in the e-mail. Several victims eventually respond to such emails thereby, compromising their personal security and identity.
        </p>
        <p>As a phisher you will be asked to write multiple fraudulent, deceptive emails and launch them repeatedly over several trials/rounds. <b>Your ultimate goal is to make as much money</b> as possible by deceiving other people successfully. After you launch an email in each trial, you will receive feedback about the success and the money you made.
        </p>
        <p><b>You will not be actually sending out these emails to real people.</b> It will only be sent to computer simulated humans for research purposes.
        </p>
        <p>You will perform 8 trials of "writing phishing emails". A sample will be provided to you at the beginning. Use the initial sample phishing email to edit and write your own phishing emails. During each trial in the experiment you will: (1) write a phishing email attack (2) launch the attack to make money and (3) get feedback on your success.
        </p>
        <p>
            <b>Cost and Gains </b>
            You will start the task with 2000 points. Each attack will cost you 200 points, so in each trial you will lose 200 points, but you will earn a reward according to how well you meet these two objectives:
        </p>
        <ol>
            <li>Evade/avoid detection by an attack detection software (see figure and read description below) </li>
            <li>Deceive/trick people to give their personal information (see figure and read description  below) </li>
        </ol>
        So after 8 trials you can end up with a <b>maximum of 4000 points and a minimum of 0 points</b> depending on your performance on these objectives.

        <p>
            <b>Payment</b>
            Your total points will accumulate across trials. At the end, your total points for performance will be converted to real dollars at a rate of <b>$1 for 1000 points</b>. Your cumulative earnings will be added to your $1.50 base payment.
        </p>
        <IMG BORDER="0" SRC="Picture21.png",height="230" width="600">
        <p>
            <b>How to evade detection?</b>
            The detection software is quite simple. It only looks for keywords in emails already known to be associated with phishing emails. Hence, to evade detection, it is recommended <b>that you edit and change your phishing content</b> during each trial. You <i>do not need</i> to change the entire email, but you will need to make, at least, moderate amount of changes to the email content (e.g., couple of sentences). Evading detection is necessary for your phishing email to successfully reach the human on the other end (as shown in figure). Only then you can deceive them and gain maximum rewards.
        </p>

        <p>
            <b>How to deceive people?</b>
            This is entirely up to your judgement and intuition. We ask you to <b>be intuitive and creative</b> about deciding what would <b>persuade and lure</b> a user into clicking the link in the email and providing information. We have observed a variety of phishing tactics that <i>exploit weaknesses in human psychology and emotions</i> (e.g., greed, curiosity, authoritative and urgency); pretend to be friends or colleagues; offer help and opportunity; sound urgent and set deadlines. You don’t have to use complicated words or sentence structure.<br/><br/>
            Since deception is subjective, you need to keep trying. Sometimes you will get a big reward and other times you might not. However, if you are <i><b>not being creative, deceptive</b></i> or purposeful, you are very <i>unlikely</i> to gain any rewards.
        </p>

        <br />
        <button id="ButtonClose" onclick="Close_click();return false;" style="font-size: large">
            <- Return to the question
        </button><br />
    </div>


</body>
</html>