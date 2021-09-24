<script type="text/javascript">
///////// this code is for back button disable//////////////
        history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
<html>
    <link href="Style.css" rel="stylesheet">
<style>
table {
  border-collapse: collapse;

}

th, td {
  padding: 5px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
</style>
<script type="text/javascript"> 

 function validate() {
       

        if (document.myForm.Q1.value == false) {
            alert("Please answer question 1 to proceed");
            return false;
        }
        else if (document.myForm.Q2.value == false) {
            alert("Please answer question 2 to proceed");
            return false;
        }
        else if (document.myForm.Q3.value == false) {
            alert("Please answer question 3 to proceed");
            return false;
        }
        else if (document.myForm.Q4.value == false) {
            alert("Please answer question 4 to proceed");
            return false;
        }
        else if (document.myForm.Q5.value == false) {
            alert("Please answer question 5 to proceed");
            return false;
        }
        else if (document.myForm.Q6.value == false) {
            alert("Please answer question 6 to proceed");
            return false;
        }
        else if (document.myForm.Q7.value == false) {
            alert("Please answer question 7 to proceed");
            return false;
        }
        else if (document.myForm.Q8.value == false) {
            alert("Please answer question 8 to proceed");
            return false;
        }
        else if (document.myForm.Q9.value == false) {
            alert("Please answer question 9 to proceed");
            return false;
        }
        else if (document.myForm.Q10.value == false) {
            alert("Please answer question 10 to proceed");
            return false;
        }
        else if (document.myForm.Q11.value == false) {
            alert("Please answer question 11 to proceed");
            return false;
        }
        else if (document.myForm.Q12.value == false) {
            alert("Please answer question 12 to proceed");
            return false;
        }else if (document.myForm.Q13.value == false) {
            alert("Please answer question 13 to proceed");
            return false;
        }
        else if (document.myForm.Q14.value == false) {
            alert("Please answer question 16 to proceed");
            return false;
        }
        else if (document.myForm.Q15.value == false) {
            alert("Please answer question 15 to proceed");
            return false;
        }
        else if (document.myForm.Q16.value == false) {
            alert("Please answer question 16 to proceed");
            return false;
        }
        else if (document.myForm.Q17.value == false) {
            alert("Please answer question 17 to proceed");
            return false;
        }
        else if (document.myForm.Q18.value == false) {
            alert("Please answer question 18 to proceed");
            return false;
        }
        else if (document.myForm.Q19.value == false) {
            alert("Please answer question 19 to proceed");
            return false;
        }
        else if (document.myForm.Q20.value == false) {
            alert("Please answer question 20 to proceed");
            return false;
        }
        else if (document.myForm.Q21.value == false) {
            alert("Please answer question 21 to proceed");
            return false;
        }
        else if (document.myForm.Q22.value == false) {
            alert("Please answer question 22 to proceed");
            return false;
        }
        else if (document.myForm.Q23.value == false) {
            alert("Please answer question 23 to proceed");
            return false;
        }
        else if (document.myForm.Q24.value == false) {
            alert("Please answer question 24 to proceed");
            return false;
        }
        
        else{
            $(window).unbind('beforeunload');
        }
    }
	//onsubmit="return(validate());"
</script>




<body>


<div id="finalQuestions">

    <form name="myForm" method="post" action="Debrifing.php" onsubmit="return validate()">

       <center> <h2>Please indicate how much you agree with the following questions on a 5-point scale</h2></center>
<center>
<table  style="width: 1200px;  margin-left: 50px;margin-right: 50px;">

<tr>
<td >
<span style="font-size: 16; font-weight: bold;">1. When I’m prompted about a software update, I install it right away.</span> 
</td>
</tr>
<tr>
<td >
 <label  style="font-size: 16px;"><input type="radio" name="Q1" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=5>Strongly Agree</label>
 
</td>
</tr>



<tr>
<td>
 <span style="font-size: 16; font-weight: bold;">2. When my computer wants me to restart after applying an update, I put it off.</span> 
</td>
</tr>
<tr>
<td>
		<label style="font-size: 16px;"><input type="radio" name="Q2" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=5>Strongly Agree</label>
        
</td>
</tr>       
      
<tr>
<td>
<span style="font-size: 16; font-weight: bold;">3.  I try to make sure that the software I use are up-to-date.</span>
</td>
</tr>
<tr>
<td>    <label style="font-size: 16px;"><input type="radio" name="Q3" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=5>Strongly Agree</label>
</td>
</tr>       
      
<tr>
<td>
<span style="font-size: 16; font-weight: bold;">4. I manually lock my computer screen when I step away from it.</span>
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q4" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=5>Strongly Agree</label>
</td>
</tr>       
      
<tr>
<td>
<span style="font-size: 16; font-weight: bold;">5. I set my computer screen to automatically lock if I don’t use it for a prolonged period of time.</span> 
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q5" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=5>Strongly Agree</label>
</td>
</tr>       

<tr>
<td>
	<span style="font-size: 16; font-weight: bold;">6. I log out of my computer, turn it off, put it to sleep, or lock the screen when I’m done using it.</span>
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q6" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">7. I use a PIN or passcode to unlock my mobile phone.</span>
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q7" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">8. I use a password/passcode to unlock my laptop or tablet.</span> 
       
</td></tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q8" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
 <span style="font-size: 16; font-weight: bold;">9. If I discover a security problem, I continue what I was doing.</span> 
    	
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q9" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">10. When someone sends me a link, I open it without ﬁrst verifying where it goes.</span> 
       
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q10" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
 <span style="font-size: 16; font-weight: bold;">11. I verify that my anti-virus software has been regularly updating itself.</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q11" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">12. When browsing websites, I mouseover links to see where they go, before clicking them.</span>
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q12" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">13. I know what website I’m visiting based on its look and feel, rather than by looking at the URL bar.</span>
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q13" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">14. I regularly backup my computer </span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q14" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
<span style="font-size: 16; font-weight: bold;">15. When I hear about websites that have been hacked, I wait to change my passwords until I have been personally notiﬁed.</span> 
       
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q15" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
 <span style="font-size: 16; font-weight: bold;">16. I use some kind of encryption software to secure sensitive ﬁles or personal information.</span>
       
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q16" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td>
 <span style="font-size: 16; font-weight: bold;">17. I do not change my passwords, unless I have to.</span> 
       
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q17" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td> <span style="font-size: 16; font-weight: bold;">18. I use different passwords for different accounts that I have.</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q18" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td><span style="font-size: 16; font-weight: bold;">19. I do not include special characters in my password if it’s not required.</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q19" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td><span style="font-size: 16; font-weight: bold;">20. When I create a new online account, I try to use a password that goes beyond the site’s minimum requirements.</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q20" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td><span style="font-size: 16; font-weight: bold;">21. When I’m done using a website that I’m logged into, I manually log out of it.</span>
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q21" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td><span style="font-size: 16; font-weight: bold;">22. I submit information to websites without ﬁrst verifying that it will be sent securely (e.g., SSL, “https://”, a lock icon).</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q22" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=5>Strongly Agree</label>
</td>
</tr> 

<tr>
<td><span style="font-size: 16; font-weight: bold;">23. I use privacy software, “private browsing,” or “incognito” mode when I’m browsing online.</span> 
       
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q23" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=5>Strongly Agree</label>
</td>
</tr>     

<tr>
<td> <span style="font-size: 16; font-weight: bold;">24. I clear my web browsing history.</span> 
        
</td>
</tr>
<tr>
<td><label style="font-size: 16px;"><input type="radio" name="Q24" value=1>Strongly Disagree </label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=2>Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=3>Neither agree nor Disagree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=4>Agree</label>&nbsp&nbsp&nbsp&nbsp&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=5>Strongly Agree</label>
</td>
</tr>

</table>
<center>

<br>

<center><input type="submit" name="submit" class="btn-style" value="Submit">
</center>
</form>
</div>

</body>
</html>
<?php

?>
