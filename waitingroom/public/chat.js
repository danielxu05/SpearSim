
$(function(){
	var socket = io.connect('http://54.213.253.53:3000')
	//buttons and inputs
	var username = $("#username")
	var send_username = $("#send_username")
	$("#waitsection").hide()
	var waittime = 0
	var start;
	function countdown(){
		var minutes = 15
		var countDownDate = new Date().getTime()+minutes*60000;
		// Update the count down every 1 second
		var x = setInterval(function() {
		// Get today's date and time
		var now = new Date().getTime();
		// Find the distance between now and the count down date
		var distance = countDownDate - now;
		// Time calculations for days, hours, minutes and seconds
	
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		// Display the result in the element with id="demo"
		document.getElementById("demo").innerHTML =minutes + "m " + seconds + "s ";
		waittime = Math.floor((now - start)/1000)
		// If the count down is finished, write some text
		if (distance < 0) {
			socket.emit('nogroup',{'username':username.val()})
			window.location.href = 'http://'+window.location.hostname+'/EmailMG/sorry3.html';
		}
		}, 1000);
	}
	//Emit a username
	send_username.click(function(){
		if (validateForm(username.val())==true){
			socket.emit('change_username', {username : username.val()})
			$("#change_username").hide()
			$("#waitsection").show()
			start = new Date().getTime()
			countdown()
		}
	})	

	socket.on('participanttwice',function(){
		document.getElementById('demo').innerHTML = "Sorry, You cannot participant the experinment twice."
		window.location.href = 'http://'+window.location.hostname+'/EmailMG/sorry4.html';
	})

	socket.on('ping',function(temp,player_type,userid){
		if(temp){
			if (player_type){
				link = 'http://'+window.location.hostname+'/EmailMG/phishing_parta/Demographics.php?MTId='+userid+'&waittime='+waittime
			}else{
				link = 'http://'+window.location.hostname+'/EmailMG/expdatareport/Demographics.php?MTId='+userid+'&waittime='+waittime
			}
			window.location.href = link;
		}
	})

	function validateForm(id)	{

		var mailformat = /^\w+([\.-]?\w+)*@([\.-]?\w+).edu$/;
		var mailformat1 = /^\w+([\.-]?\w+)*@([\.-]?\w+).([\.-]?\w+).edu$/;
		if(id.match(mailformat)|| id.match(mailformat1))
		{
		return true;
		}
		else
		{
			alert("Please provide a valid university Email adress.");
		return false;
		}
	};
})

