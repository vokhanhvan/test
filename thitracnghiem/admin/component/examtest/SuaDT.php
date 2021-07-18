
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
	$madt=$_POST['madt'];
    $makt=$_POST['makt'];
    $mats=$_POST['mats'];
    
    $sql="update khanhvan.DETHI set MADE='$madt',MAKT='$makt',MATS='$mats' where MADE='$madt'";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
	header('location:DSDT.php');
	}

	$sql1="select * from khanhvan.DETHI where MaDE='$id'";
	$run=oci_parse($connection,$sql1);
	oci_execute($run);
	$dong= oci_fetch_array($run, OCI_ASSOC);

	$sqlkt="select * from khanhvan.KITHI ";
	$runkt=oci_parse($connection, $sqlkt);
	oci_execute($runkt);
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Chỉnh sửa đề thi </h4>
   
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
            	<div>
                  <label class="col-2 badge badge-info">Mã đề</label>
                  <input type="text" name="madt" readonly class="form-control col-12" class="form-control " value="<?php echo $dong['MADE'] ?>" placeholder="">
              </div>
              <div class="form-group ">
                <label class="col-2 badge badge-info">Mã thí sinh </label>
                <input type="text" name="mats" class="form-control " value="<?php echo $dong['MATS'] ?>" placeholder=""> 
              </div>
              <div class="form-group">
                    <label class="col-2 badge badge-info">Kỳ thi</label>
                    <select name="makt" class="form-control" style="width: 50%">	
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
		var ts = document.forms["Form"]["MATS"].value;
		if(ts==""){
			alert("Vui lòng nhập mã thí sinh!");
				return false;
				}

		alert("Cập nhật thành công!");
				return true;
	}
</script>

