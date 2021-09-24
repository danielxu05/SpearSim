<?php  session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
</head>
<body>


<label id="catnum12" style="font-size:x-large; color:black; font-style:italic;" ></label>


<div id="start" style="width:90%; margin-left:auto; margin-right:auto; ">
    <h2>Email Management</h2>   
    <p>This task is part of a research study conducted by Dr. Cleotilde Gonzalez at Carnegie Mellon University. The purpose of the research is to explore the various factors that affect decisions in the cyber security domain over repeated choices in individuals and competitive situations with more two or more people. This project is funded by the Army Research Laboratory, ARL-CRA-Cylab-Pennsylvania State University.
    </p>
    <h5><b>Procedures</b></h5>
    <p>Throughout the experiment, you will be making a series of decisions involving one of three possible situations: 1) classification decisions, 2) choice decisions, and 3) decisions in competitive 2-person and more than two person games.  Regardless of the particular situation you are presented with, your decisions will be separated in a number of trials and you will be provided with feedback that reflects the accuracy of your decisions, according to the instructions provided in this experiment.  The feedback will be shown to you in a number of points which are accumulated throughout the trials, and at the end of the experiment this will be converted into the total amount you earned.  The accumulated number of points will represent the rewards you obtain for making accurate decisions.
    </p>
    <h5><b>Participant Requirements</b></h5>
    <p>Participation in this study is limited to individuals age 18 and older, currently residing in the United States, with at least basic computer proficiency, and the ability to read and understand English.
    </p>
    <h5><b>Risks</b></h5>
    <p>The risks and discomfort associated with participation in this study are no greater than those ordinarily encountered in daily life or during other online activities.
    </p>
    <h5><b>Benefits</b></h5>
    <p>There may be no personal benefit from your participation in the study but the knowledge received may be of value to humanity.
    </p>
    <h5><b>Compensation & Costs</b></h5>
    <p>You will be compensated for completing the game at the rate initially advertised. You will only be eligible for compensation if you have completed the game in full and supplied the appropriate confirmation code. There is no partial payment if you do not complete the study. You will not be penalized if you choose to withdraw from the study without completing it, but you will not be compensated either.
        There will be no cost to you if you participate in this study.
    </p>
    <h5><b>Confidentiality</b></h5>
    <p>The data captured for the research does not include any personally identifiable information about you.</p>

    <p>By participating in this research, you understand and agree that Carnegie Mellon may be required to disclose your consent form, data and other personally identifiable information as required by law, regulation, subpoena or court order.  Otherwise, your confidentiality will be maintained in the following manner:
    </p>
    <p>Your data and consent form will be kept separate. Your consent form will be stored in a locked location on Carnegie Mellon property and will not be disclosed to third parties. By participating, you understand and agree that the data and information gathered during this study may be used by Carnegie Mellon and published and/or disclosed by Carnegie Mellon to others outside of Carnegie Mellon.
    </p>
    <p>In addition, the sponsor of this study, the Army Research Laboratory, ARL-CRA-Cylab-Pennsylvania State University, will have access to your research information.
    </p>

    <h5><b>Right to Ask Questions & Contact Information</b></h5>
    <p>If you have any questions about this study, you should feel free to ask them by contacting the Principal Investigator now at:<br/>
        <i>Prof. Cleotilde Gonzalez<br/>
            Social and Decision Sciences Department<br/>
            Pittsburgh, PA 15213<br/>
            (412) 268-6242<br/>
            conzalez@andrew.cmu.edu<br/></i>
    </p>
    <p>If you have questions later, desire additional information, or wish to withdraw your participation please contact the Principal Investigator by mail, phone or e-mail in accordance with the contact information listed above.
    </p>
    <p>If you have questions pertaining to your rights as a research participant; or to report objections to this study, you should contact the Office of Research integrity and Compliance at Carnegie Mellon University. Email: irb-review@andrew.cmu.edu. Phone: 412-268-1901 or 412-268-5460.
    </p>
    <h5><b>Voluntary Participation</b></h5>
    <p>Your participation in this research is voluntary.  You may discontinue participation at any time during the research activity.
    </p>
    <form name="myForm" method="get" action="Intro.php">
        <input type="hidden" id="MTId" name="MTId" value="<?php echo($_GET['MTId']); ?>"/>
       

        <input type="submit" name="submit" class="btn-style" value="Submit" />
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
</div>
</body>
</html>
<?php
include '../class/class.rater.php';
$rater = new Rater($_GET['MTId']);
$rater->setWaittime($_GET['waittime']);
$rater->setStarttime(time());
$_SESSION['Rater']=$rater;
$_SESSION['cSpear']=0;
$rater->insertDB();
?>