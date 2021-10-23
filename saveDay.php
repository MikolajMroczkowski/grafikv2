<?php
if($_GET){
    if(isset($_GET['day'])&&$_GET['day'] != ''&&isset($_GET['year'])&&$_GET['year'] != ''&&isset($_GET['mounth'])&&$_GET['mounth'] != '')
    session_start();
}
?>