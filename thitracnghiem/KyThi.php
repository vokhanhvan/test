<?php
    session_start();
	include "layouts/header.php";
	require_once "connect.php";

	$username = $_SESSION['user'];
	$sql_select_user = "SELECT * FROM khanhvan.KITHI,khanhvan.DETHI WHERE KITHI.MAKT = DETHI.MAKT ";
	$result = oci_parse($connection, $sql_select_user);
	oci_execute($result);
    $user=oci_fetch_assoc($result);

?>

<?php 
include "layouts/footer.php";
?>