<?php
	include'../../../connect.php';
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    }

    $sql="delete from khanhvan.THISINH where MATS='$id'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
    header('location:DSTS.php');
?>