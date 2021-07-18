
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
	$makt=$_POST['makt'];
    $tenkt=$_POST['tenkt'];
    $phut=$_POST['phut'];
    $socau=$_POST['socau'];
    $ngaybatdau=$_POST['ngaybatdau'];
    $ngayketthuc=$_POST['ngayketthuc'];
    $sql="update khanhvan.KITHI set TenKT='$tenkt',PHUT='$phut',SOCAU='$socau',NGAYBATDAU=TO_DATE('$ngaybatdau','YYYY-MM-DD'),NGAYKETTHUC=TO_DATE('$ngayketthuc','YYYY-MM-DD') where MaKT='$makt'";   
    $compiled = oci_parse($connection, $sql);
  	oci_execute($compiled);
  	header('location:DSKT.php');
	}

	$sql1="select * from khanhvan.KITHI where MaKT='$id'";
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
            <h4 class="card-title">Chỉnh sửa kỳ thi </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
              <div class="form-group ">
                <label class="col-2 badge badge-info">Mã kỳ thi </label>
                <input type="text" name="makt" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['MAKT'] ?>" placeholder=""> </div>
               <div class="form-group">
                    <label class="col-2 badge badge-info">Tên kỳ thi</label>
                    <input type="text" name="tenkt" class="form-control " value="<?php echo $dong['TENKT'] ?>" placeholder="">
                </div>
                <div class="form-group">
                    <label class="col-2 badge badge-info">Thời gian thi</label>
                    <input type="text" name="phut" style="width: 10%" class="form-control " value="<?php echo $dong['PHUT'] ?>">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Số câu</label>
                    <input type="text" name="socau" class="form-control " placeholder="" value="<?php echo $dong['SOCAU'] ?>">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Ngày bắt đầu</label>
                    <input type="date" name="ngaybatdau" class="form-control " placeholder="" value="<?php echo date("yy-m-d",strtotime($dong['NGAYBATDAU'])); ?>">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Ngày kết thúc</label>
                    <input type="date" name="ngayketthuc" class="form-control " placeholder="" value="<?php echo date("yy-m-d",strtotime($dong['NGAYKETTHUC'])); ?>">
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
	function kiemtraKT(){
		var ten_kt = document.forms["Form"]["tenkt"].value;
		if(ten_kt==""){
			alert("Vui lòng nhập tên kỳ thi!");
				return false;
				}

		alert("Cập nhật thành công!");
				return true;
	}
</script>

