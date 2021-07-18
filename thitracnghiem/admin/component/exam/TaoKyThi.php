
<!DOCTYPE html>
<html>
<body>
<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
	if(isset($_POST['capnhat'])){
    $tenkt=$_POST['tenkt'];
    $phut=$_POST['phut'];
    $socau=$_POST['socau'];
    $ngaybatdau=$_POST['ngaybatdau'];
    $ngayketthuc=$_POST['ngayketthuc'];
    $sql="insert into khanhvan.KITHI(TenKT,PHUT,SOCAU,NGAYBATDAU,NGAYKETTHUC) values('".$tenkt."','".$phut."','".$socau."',TO_DATE('$ngaybatdau','YYYY-MM-DD'),TO_DATE('$ngayketthuc','YYYY-MM-DD'))";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
	header('location:DSKT.php');
	}

?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Thêm kỳ thi </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-2 badge badge-info">Tên kỳ thi</label>
                    <input type="text" name="tenkt" class="form-control " placeholder="">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Thời gian thi</label>
                    <input type="text" name="phut" style="width: 13%" class="form-control " placeholder="Phút" >
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Số câu</label>
                    <input type="text" name="socau" class="form-control " placeholder="">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Ngày bắt đầu</label>
                    <input id="today" type="date" name="ngaybatdau" class="form-control " placeholder="">
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Ngày kết thúc</label>
                    <input id="day" type="date" name="ngayketthuc" class="form-control " placeholder="">
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

		alert("Thêm thành công!");
				return true;
	}
</script>

