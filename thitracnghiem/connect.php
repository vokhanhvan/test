<?php 
$username="khanhvan";
$password="khanhvan";
$db="(DESCRIPTION =
(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
(CONNECT_DATA =
(SERVER = DEDICATED)
(SERVICE_NAME = orcl)
)
)";

$connection = oci_connect($username, $password, $db,'UTF8');

if (!$connection) {
	$e = oci_error();
	echo htmlentities($e["message"]);
}
else 
	// echo ("Connect successfully!!");
?>
