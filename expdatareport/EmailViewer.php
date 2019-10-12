<html>
<head>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","getuser.php?q="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: prashanthrajivan
 * Date: 10/26/16
 * Time: 9:22 AM
 */?>
<body>
<form>
    <select name="users" onchange="showUser(this.value)">
        <option value="">Select a person:</option>
        <option value="A1E4K9G6ZKPKX4">P1</option>
        <option value="ANTH5IGN5CHN6">P2</option>
        <option value="ACN0C9HPYDTED">P3</option>
        <option value="A1TMZLYXQAK8Q0">P4</option>
        <option value="AL0IT4RSPIWGK">P5</option>
        <option value="A2UHMLMFCP9J72">P6</option>
        <option value="A2WT6FV92737W6">P7</option>
        <option value="A1DIGREVLNOXT3">P8</option>
        <option value="A110KENBXU7SUJ">P9</option>
        <option value="AFKHZQ5SW7CSL">P10</option>
    </select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>