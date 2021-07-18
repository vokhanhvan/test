<?php 
	// require_once "connect.php";
	session_start();
	session_unset(); 

	// destroy the session 
	session_destroy(); 

	header('location: http://localhost/thitracnghiem/TrangChu.php');



 ?>