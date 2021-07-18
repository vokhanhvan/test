<?php
    session_start();
	include "layouts/header.php";
	require_once "connect.php";

	$username = $_SESSION['user'];
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
                            <h2>Thông Tin Thí Sinh</h2>
                            <br><br>
                            <form  action="edit_profile.php" method="POST" enctype="multipart/form-data" >
					        <div class="form-group">
					            <label class="col-3 badge badge-info">ID</label><input type="text" readonly class="form-control col-12" name="mats" value="<?php echo isset($user['MATS']) ? $user['MATS'] : ''?>" placeholder="login name " required="required">
					        </div>
					         <div class="form-group">
					            <label class="col-3 badge badge-info">Username</label><input type="text" readonly class="form-control col-12" name="login_name" value="<?php echo isset($user['USERNAME']) ? $user['USERNAME'] : ''?>" placeholder="login name " required="required">
					        </div>
					        <div class="form-group">
					            <label class="col-3 badge badge-info">Họ tên</label><input type="text" readonly class="form-control col-12" name="name"  value="<?php echo isset($user['HOTEN']) ? $user['HOTEN'] : ''?>" placeholder="họ tên" required="required">
					        </div>

					       <div class="form-group">
					            <label class="col-3 badge badge-info">Email</label><input type="email" readonly class="form-control col-12" name="mail" value="<?php echo isset($user['EMAIL']) ? $user['EMAIL'] : ''?>" placeholder="email" required="required">
					        </div>  
					    </form>
                        <div class="form-group" style="margin-top: 50px;">
                                <button  onclick="location.href = 'edit_profile.php?user=<?php echo $user['MATS'] ?>';" class="btn btn-outline-warning btn-lg btn-block" style="height: 10%;">chỉnh sửa</button>
                            </div>
                            
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