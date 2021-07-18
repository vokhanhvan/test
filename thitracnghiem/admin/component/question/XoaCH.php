    <?php
	include'../../../connect.php';
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    }

    $sql="delete from khanhvan.DAPAN where MACH='$id'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
	$sqlch="delete from khanhvan.CAUHOI where MACH='$id'";   
    $compiledch = oci_parse($connection, $sqlch);
	oci_execute($compiledch);

    header('location:DSCH.php');
?>