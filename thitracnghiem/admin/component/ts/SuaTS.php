<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

?>
<!DOCTYPE html>
<html>
<head>
<style> 
</style>
</head>
<body>
<?php

	if(isset($_GET["id"])){
		$id=$_GET["id"];
	}

	if(isset($_POST['capnhat'])){
		$mats=$_POST['mats'];
	    $username=$_POST['user'];
	    $Password=md5($_POST['pass']);
	    $hoten=$_POST['hten'];
	    $email=$_POST['email'];

	    $sql="update khanhvan.THISINH set UserName='$username', PassWord='$Password' ,HoTen='$hoten', Email='$email' where MaTS='$mats'";   
	    $compiled = oci_parse($connection, $sql);
		oci_execute($compiled);
		header('location:DSTS.php');
	}

	$sql1="select * from khanhvan.THISINH where MaTS='$id'";
	$run=oci_parse($connection,$sql1);
	oci_execute($run);
	$dong= oci_fetch_array($run, OCI_ASSOC);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Chỉnh sửa thí sinh </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group ">
                <label class="col-2 badge badge-info">Mã thí sinh </label>
                <input type="text" name="mats" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['MATS'] ?>" placeholder=""> </div>
               <div class="form-group">
                    <label class="col-2 badge badge-info">Username</label>
                    <input type="text" name="user" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['USERNAME'] ?>" placeholder="">
                </div>
              <div>
                  <label class="col-2 badge badge-info">Password</label>
                  <input type="password" name="pass" class="form-control " value="<?php echo $dong['PASSWORD'] ?>" placeholder="">
              </div>
              <div>
                  <label class="col-2 badge badge-info">Họ tên</label>
                  <input type="text" name="hten" class="form-control " value="<?php echo $dong['HOTEN'] ?>" placeholder="">
              </div>
              <div>
                  <label class="col-2 badge badge-info">Email</label>
                  <input type="email" name="email" class="form-control " value="<?php echo $dong['EMAIL'] ?>" placeholder="">
              </div>
             <br>
              <button type="submit" name="capnhat" class="btn btn-secondary mr-2">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
	include '../../layouts/footer.php';
?>
<script>
	function kiemtraTS(){
		var username = document.forms["Form"]["user"].value;
		if(username==""){
			alert("Vui lòng nhập tên đăng nhập!");
				return false;
				}
		var password = document.forms["Form"]["pass"].value;
		if(password==""){
			alert("Vui lòng nhập password!");
				return false;
				}
    		else if(password.length < 8){
					alert("Password phải lớn hơn hoặc bằng 8 ký tự");
						return false;
						}
		var hoten = document.forms["Form"]["hten"].value;
		if(hoten==""){
			alert("Vui lòng nhập họ tên thí sinh!");
				return false;
				}
		var email = document.forms["Form"]["email"].value;
		if(email==""){
			alert("Vui lòng nhập email của thí sinh!");
				return false;
				}

		alert("Sửa thông tin thành công!");
				return true;
	}
</script>