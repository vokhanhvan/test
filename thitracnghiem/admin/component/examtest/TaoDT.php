
<!DOCTYPE html>
<html>
<body>
<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
	if(isset($_POST['capnhat'])){
	    $makt=$_POST['makt'];
	    $mats=$_POST['mats'];

	    $sql="insert into khanhvan.DETHI(MATS,MAKT) values('".$mats."','".$makt."')";   
	    $compiled = oci_parse($connection, $sql);
		oci_execute($compiled);
		// header('location:DSDT.php');
	}
	$sqlts="select * from khanhvan.THISINH where per='0'";
	$run=oci_parse($connection, $sqlts);
	oci_execute($run);

	$sqlkt="select * from khanhvan.KITHI";
	$runkt=oci_parse($connection, $sqlkt);
	oci_execute($runkt);

?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Thêm đề thi</h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-2 badge badge-info">Mã thí sinh</label>
                    <select name="mats" class="form-control" style="width: 50%">	
					 	<option value="">Chọn</option>
					 	<?php
					 		while ($ts=oci_fetch_array($run,OCI_ASSOC)) {
					 			?>
					 			<option value="<?php echo $ts['MATS'] ?>"><?php echo $ts['MATS'] ?></option>
					 			<?php
					 		}
					 	?>
					 </select>
                </div> 
                <div class="form-group">
                    <label class="col-2 badge badge-info">Kỳ thi</label>
                    <select name="makt" class="form-control" style="width: 50%">	
					 	<option value="">Chọn</option>
					 	<?php
					 		while ($kt=oci_fetch_array($runkt,OCI_ASSOC)) {
					 			?>
					 			<option value="<?php echo $kt['MAKT'] ?>"><?php echo $kt['TENKT'] ?></option>
					 			<?php
					 		}
					 	?>
					 </select>
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
	function kiemtraDT(){
		var ts = document.forms["Form"]["mats"].value;
		if(ts==""){
			alert("Vui lòng nhập tên kỳ thi!");
				return false;
				}

		alert("Thêm thành công!");
				return true;
	}
</script>

