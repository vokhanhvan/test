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

	$sql1="select * from khanhvan.DAPAN where MACH='$id'";
	$run=oci_parse($connection,$sql1);
	oci_execute($run);
	$TS=[];
  if ($run) {
    while ($a=oci_fetch_array($run)) {
      $TS[]=$a;
    }
  }
?>
<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Đáp án</strong>
                      </h4>                
<!--                       <h4><a href="TaoDA.php" class="d-inline badge badge-pill badge-info">thêm mới</a>
                        <label class=" float-right">
                    </label>
                      </h4> -->
                    </h4>

            
                <div class="table-responsive">
                           <table class="table bg-light1 text-dark table-hover ">
                <thead >
                  <tr>
                    <th> STT </th>
                    <th> Mã câu hỏi</th>
                    <th> Nội dung đáp án </th>
                    <th> Sửa </th>
                    <th> Xóa </th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($TS as $dong) { ?>
                    <tr>
                      <td>
                        <?php echo "$i" ?>
                      </td>
                      <td>
                        <?php echo $dong['MACH']?>
                      </td>
                      <td>
                        <?php echo $dong['NDDA']?>
                      </td>
                        <td> <a href="SuaDA.php?mada=<?php echo $dong['MADA']; ?>" class="badge badge-pill badge-warning">Edit </a> </td>
                        <td> <a href="XoaDA.php?mada=<?php echo $dong['MADA']; ?>" onclick="return confirm('Are you sure?')" class="badge badge-pill badge-danger">Delete </a> </td>
                    </tr>
                <?php $i++;} ?>
                </tbody>
              </table>



               
            </div>
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


