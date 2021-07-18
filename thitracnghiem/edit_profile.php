<?php
    session_start();
	include "layouts/header.php";
	require_once "connect.php";

	$username = $_SESSION['user'];

	if(isset($_POST['capnhat'])){
	    $hoten=$_POST['name'];
	    $email=$_POST['mail'];

	    $sql="update khanhvan.THISINH set HoTen='$hoten', Email='$email' where USERNAME='$username'";   
	    $compiled = oci_parse($connection, $sql);
		oci_execute($compiled);
		header('location:profile_user.php');
	}
	$sql_select_user = "SELECT * FROM khanhvan.THISINH WHERE UserName = '$username' ";
	$result = oci_parse($connection, $sql_select_user);
	oci_execute($result);
    $user=oci_fetch_assoc($result);

?>
<div class="row">
	<section class="info-section col-12">
      
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-text">
                        <div class="info-title" style="width: 400px;margin: 0 auto;">
                        	<br>
                            <h2>Chỉnh Sửa Thông Tin </h2>
                            <br>
                            <form  action="" method="POST" enctype="multipart/form-data" >
                            <div class="form-group">
					            <label class="col-3 badge badge-info">ID</label><input type="text" class="form-control" readonly class="form-control col-9" name="login_name"  value="<?php echo isset($user['MATS']) ? $user['MATS'] : ''?>" placeholder="Username" required="required">
					        </div>
					        <div class="form-group">
					            <label class="col-3 badge badge-info">Username</label><input type="text" class="form-control" readonly class="form-control col-9" name="login_name"  value="<?php echo isset($user['USERNAME']) ? $user['USERNAME'] : ''?>" placeholder="Username" required="required">
					        </div>
					        <div class="form-group">
					            <label class="col-3 badge badge-info">Họ tên</label><input type="text" class="form-control" name="name" value="<?php echo isset($user['HOTEN']) ? $user['HOTEN'] : ''?>" placeholder="Họ tên" required="required">
					        </div>

					        <div class="form-group">
					            <label class="col-3 badge badge-info">Email</label><input type="email" class="form-control" name="mail" value="<?php echo isset($user['EMAIL']) ? $user['EMAIL'] : ''?>" placeholder="Email" required="required">
					        </div>
					           
					        <div class="form-group">
					            <button type="submit" name="capnhat" class="btn btn-outline-warning btn-lg btn-block" style="height: 10%;">Xác Nhận</button>
					        </div>
					        <br><br><br>
					    </form>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</section>
</div>


<?php 
include "layouts/footer.php";
?>