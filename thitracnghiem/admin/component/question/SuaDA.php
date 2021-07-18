<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
if(isset($_GET["mada"])){
	$da=$_GET["mada"];
	}

if(isset($_POST['capnhat'])){
	$mada=$_POST['mada'];
    $ndda=$_POST['ndda'];
    
    $sql="update khanhvan.DAPAN set NDDA='$ndda' where MADA='$mada'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
	header('location:DSCH.php');
	}

	$sql1="select * from khanhvan.DAPAN where MADA='$da'";
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
            <h4 class="card-title">Chỉnh sửa đáp án </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group ">
                <label class="col-2 badge badge-info">Mã đáp án </label>
                <input type="text" name="mada" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['MADA'] ?>" placeholder=""> </div>
               <div class="form-group">
                    <label class="col-2 badge badge-info">Nội dung</label>
                    <input type="text" name="ndda" class="form-control " value="<?php echo $dong['NDDA'] ?>" placeholder="">
                </div>
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
	function kiemtraCH(){
		var ch = document.forms["Form"]["ndda"].value;
		if(ch==""){
			alert("Vui lòng điền nội dung đáp án!");
				return false;
				}

		alert("Cập nhật thành công!");
				return true;
	}
</script>

