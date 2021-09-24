
<!DOCTYPE html>
<html lang="en">
<head>
<title>Phishing Training</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.js"></script>
  <script src="../ckeditor4/ckeditor.js"></script>

<script src="../ckeditor4/adapters/jquery.js"></script>
</head>
<body>

<form method="post" name="myForm" id="myForm" action="Model.php" onsubmit="return onsubmitform();">

<div class="header">
<h1>Phishing Attacker Console</h1>
</div>
        <textarea name="email1" id="email1" rows="50" cols="150">
    </textarea> 
  </div>
<label id="Instruction" style="color: Red;font-size:large;font-weight: bold; font-style: italic " ></label>
<br>

<div id="launchB" name="LaunchB" >
        <center><input type="submit" class="btn-style" name="submit" value="Launch"/></center>
</div> 
<br>


</body>
<script>
CKEDITOR.replace('email1');

window.addEventListener('beforeunload', function (e) {
  // Cancel the event
  e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
  // Chrome requires returnValue to be set
  e.returnValue = 'Sure?';
});

var blinkTab = function(message) {
  var oldTitle = document.title,                                                           /* save original title */
      timeoutId,
      blink = function() { document.title = document.title == message ? ' ' : message; },  /* function to BLINK browser tab */
      clear = function() {                                                                 /* function to set title back to original */
        clearInterval(timeoutId);
        document.title = oldTitle;
        window.onmousemove = null;
        timeoutId = null;
      };

  if (!timeoutId) {
    timeoutId = setInterval(blink, 1000);
    window.onmousemove = clear;                                                            /* stop changing title on moving the mouse */
  }
};

var PageTitleNotification = {
    Vars:{
        OriginalTitle: document.title,
        Interval: null
    },    
    On: function(notification, intervalSpeed){
        var _this = this;
        _this.Vars.Interval = setInterval(function(){
             document.title = (_this.Vars.OriginalTitle == document.title)
                                 ? notification
                                 : _this.Vars.OriginalTitle;
        }, (intervalSpeed) ? intervalSpeed : 1000);
    },
    Off: function(){
        clearInterval(this.Vars.Interval);
        document.title = this.Vars.OriginalTitle;   
    }
}
PageTitleNotification.On("User logged out!");
$(document).click(function(e) {
    PageTitleNotification.Off();
});
function onsubmitform() {
return TRUE
}

</script>
</html>
