<?php
	include'../../../connect.php';
    if(isset($_GET["mada"])){
    $mada=$_GET["mada"];
    }
    $sql="delete from khanhvan.DAPAN where MADA='$mada'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);

    header('location:DSCH.php');
?>