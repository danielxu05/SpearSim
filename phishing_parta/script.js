
$(document).ready(function(){
    interval = setInterval(function() {
        getData(nfile)
    }, 5000);
})
function getData(nfile){
    var url = nfile;
    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            var temp = data['status'];
            if(temp>0){
                $("#waitingsection").hide();

                var s= document.getElementById('resultscore');
                var earn = document.getElementById('Earn');
                var gain = document.getElementById('Gain');

                if (temp<3){
                    s.innerHTML = 'Your attack was successful!';
                    earn.innerHTML = capital +1000;
                    gain.innerHTML = 1000
                }else{
                    s.innerHTML= 'Your attack was failure';
                    gain.innerHTML = 0
                }
                document.getElementById("result").style.display = "block";
                $("#image").hide()
                clearInterval(interval);
                PageTitleNotification.On("We got your result!");
            }
        },
       statusCode: {
          404: function() {
            alert('There was a problem with the server.  Try again soon!');
          }
        }
     });
}
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
$(document).click(function(e) {
    PageTitleNotification.Off();
});