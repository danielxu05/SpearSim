<?php
#include 'class.email.php';
include 'class.rater.php';
#include 'class.attacker.php';
#include 'class.user.email.php';
#$user = new Attacker('wow');
#$user->insertDB();
$rater = new Rater('testraterid');
echo('\n');
echo($rater->setmturkcredential());

#$rater->insertDB();
#$email = new Email($user,2,1);
#$email->setEmailCont('sadehduasdxnsalk');
#$email->insertDB();
$ec = new EmailClassification($rater->getUserID());
$ec->setPhishID(2);
$ec->setResponse(1);
$ec->setspearIndicator(1);
$ec->insertDB();



?>