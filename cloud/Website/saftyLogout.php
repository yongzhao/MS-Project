<?php

//kill all session variables and cookies when the customer decides to sign out

session_start();
session_destroy(); //kill all session
setcookie('refriq','');
setcookie('refrip','');
setcookie('bulbq','');
setcookie('bulbp','');
setcookie('phoneq','');
setcookie('phonep','');
setcookie('mdq','');
setcookie('mdp','');
setcookie('otherp','');
//cookie for lv2
setcookie('bulb2q','');
setcookie('bulb2p','');
setcookie('aircq','');
setcookie('aircp','');
setcookie('heaterq','');
setcookie('heaterp','');
setcookie('pcq','');
setcookie('pcp','');
setcookie('other2p','');
//cookies for critical battery level
setcookie('batterylevel','');
header('Location: SaftyLogout.html');
?>