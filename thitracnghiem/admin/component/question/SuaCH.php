<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
if(isset($_GET["id"])){
	$id=$_GET["id"];
	}

if(isset($_POST['capnhat'])){
	$mach=$_POST['mach'];
  $makt=$_POST['makt'];
  $phanloai=$_POST['phanloai'];
  $ndch=$_POST['ndch'];
    
    $sql="update khanhvan.CAUHOI set MaKT='$makt',NDCH='$ndch',PHANLOAI='$phanloai' where MACH='$mach'";   
    $compiled = oci_parse($connection, $sql);
	 oci_execute($compiled);
	header('location:DSCH.php');
	}

	$sql1="select * from khanhvan.CAUHOI where MACH='$id'";
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
            <h4 class="card-title">Chỉnh sửa câu hỏi </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group ">
                <label class="col-2 badge badge-info">Mã Câu hỏi </label>
                <input type="text" name="mach" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['MACH'] ?>" placeholder=""> </div>
               <div class="form-group">
                    <label class="col-2 badge badge-info">Mã kỳ thi</label>
                    <input type="text" name="makt" class="form-control " value="<?php echo $dong['MAKT'] ?>" placeholder="">
                </div>
                <div class="form-group">
                    <label class="col-2 badge badge-info">Loại câu hỏi</label><br>
                   <select name="phanloai">
                      <option value="0">Một đáp án đúng</option>
                      <option value="1">Nhiều đáp án đúng</option>
                    </select>
                </div>
              <div>
                  <label class="col-2 badge badge-info">Nội dung</label>
                  <input type="text" name="ndch" class="form-control " value="<?php echo $dong['NDCH'] ?>" placeholder="">
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
	function kiemtraCH(){
		var ch = document.forms["Form"]["ndch"].value;
		if(ch==""){
			alert("Vui lòng nội dung câu hỏi!");
				return false;
				}

		alert("Cập nhật thành công!");
				return true;
	}
</script>

