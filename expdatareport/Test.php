<?php
/**
 * Created by PhpStorm.
 * User: prashanthrajivan
 * Date: 11/20/16
 * Time: 11:57 AM
 */
$item1=990525;
$item2=208208;
$home="http://localhost:63342/ExpDataReport/StartClass.php?_ijt=tpf0svp5udkbdc0iivtfbbp1ar";
$add=$home."/cart/addSkuByButton.do;jsessionid=0000RSqxtdShvtVm0lVAb29p-9N:1659q38ci?ajaxATCRequest=true&sourcePage=&cmd_addCart.button.INDEX[0]=Add%20to%20Cart&trackingCategory=1000000000&entryFormList[0].selected=on&entryFormList[0].sku=";
$toCart="&entryFormList[0].qty=";
$cart=$home."/cart/shoppingCart.do;jsessionid=0000RSqxtdShvtVm0lVAb29p-9N:1659q38ci";

session_start(); //do I need this?
//setup
$c=curl_init();
curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c,CURLOPT_COOKIESESSION,true); //should I use this? I've also tried COOKIEFILE without success
curl_setopt($c,CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c,CURLOPT_HEADER, 1);

//set a session ID
curl_setopt($c,CURLOPT_COOKIE, "jsessionid=0000RSqxtdShvtVm0lVAb29p-9N:1659q38ci; path=/; domain=www.somedomain.com");

//visit main domain
curl_setopt($c,CURLOPT_URL, $home);
curl_exec($c);

//programattically visit sub pages
curl_setopt($c,CURLOPT_URL, $add.$item1.$toCart);
curl_exec($c);
curl_setopt($c,CURLOPT_URL, $add.$item2.$toCart);
curl_exec($c);
curl_setopt($c, CURLOPT_RETURNTRANSFER, false);
curl_setopt($c,CURLOPT_HEADER, false);

//actually visit final page
curl_setopt($c,CURLOPT_URL, $cart);
curl_exec($c);
curl_close($c);
?>

<!-- <h2>Based on the attacks you launched, note the extent to which you exploited the following emotions in your attacks</h2>
         <h3>Greed:</h3>
         <input type="radio" name="greed" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="greed" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="greed" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="greed" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="greed" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
         <h3>Curiosity</h3>
         <input type="radio" name="curiosity" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="curiosity" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="curiosity" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="curiosity" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="curiosity" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
         <h3>Fear</h3>
         <input type="radio" name="fear" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="fear" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="fear" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="fear" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="fear" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
         <h3>Urgency</h3>
         <input type="radio" name="urgency" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="urgency" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="urgency" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="urgency" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="urgency" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
         <h3>Sound Genuine</h3>
         <input type="radio" name="genuine" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="genuine" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="genuine" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="genuine" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="genuine" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
         <br><br><span style="font-size: 20px; font-weight: bold;">Other Emotions (Enter what it is in the space. If not, leave it empty and select "None"):</span>&nbsp<input type="text" name="OtherName" id="OtherName" style="width: 150px; border-style: solid; border-width: medium" value="" ><br><br>
         <input type="radio" name="other" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
         <input type="radio" name="other" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
         <input type="radio" name="other" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
         <input type="radio" name="other" value=4><label style="font-size: 16px;">Often</label>&nbsp
         <input type="radio" name="other" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp-->
