<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
	if(isset($_POST['capnhat'])){
	    $username=$_POST['user'];
	    $Password=md5($_POST['pass']);
	    $hoten=$_POST['hten'];
	    $email=$_POST['email'];
	    $per=1;
	    $t1=true;
	    $sqlts="select * from khanhvan.THISINH where PER='$per' order by MATS ASC";
		$runts=oci_parse($connection,$sqlts);
		oci_execute($runts);
		while ($ts=oci_fetch_array($runts)) {
			if($ts['USERNAME'] == $_POST['user']){
				$t1=false;
			}
		}
		if ($t1==false) {
			echo "<script> alert('User đã tồn tại');</script>";
		}else{

		    $sql="insert into khanhvan.THISINH(UserName,PassWord,HoTen,Email,PER) values('".$username."','".$Password."','".$hoten."','".$email."','".$per."')";   
			$compiled = oci_parse($connection, $sql);
			oci_execute($compiled);
			header('location:ADMIN.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head> 
</head> 
<body>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Thêm admin </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-2 badge badge-info">Username</label>
                    <input type="text" name="user" class="form-control " placeholder="">
                </div>
                <div class="form-group ">
                <label class="col-2 badge badge-info">Password </label>
                <input type="password" name="pass" class="form-control " placeholder=""> </div>
              <div>
                  <label class="col-2 badge badge-info">Họ tên</label>
                  <input type="text" name="hten" class="form-control " placeholder="">
              </div>
              <div>
                  <label class="col-2 badge badge-info">Email</label>
                  <input type="text" name="email" class="form-control " placeholder="">
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

		alert("Thêm thành công!");
				return true;
	}
</script>