<?php

session_start();
include_once("MODEL/user.php");
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>
<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>
<?php
echo "<h1>BAI 5</h1>";

?>
<br>
<button onclick="testAjax();" type="button">Test Javascript</button>
<div id="contentAjax">

</div>

</div>
<?php include_once("footer.php") ?>
<script>
    function testAjax() {
        // var a= "Xin chao";
        // alert(a);
        // var contenElement = document.getElementById("contentAjax");
        // console.log(contenElement);
        // contenElement.innerHTML = a;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


                document.getElementById("contentAjax").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "testajax.php?username=abc", true);
        xhttp.send();

    }
</script>