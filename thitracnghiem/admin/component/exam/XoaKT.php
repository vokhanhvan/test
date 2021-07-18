<?php
    include'../../../connect.php';
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    }

    $sql="delete from khanhvan.KITHI where MAKT='$id'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
    header('location:DSKT.php');

?>