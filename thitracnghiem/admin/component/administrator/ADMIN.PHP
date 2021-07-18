<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

?>
<!DOCTYPE html>
<html>
<body>
<?php
	$sql="select * from khanhvan.THISINH where PER='1'";
	$run=oci_parse($connection,$sql);
	oci_execute($run);
	$AD=[];
	if ($run) {
		while ($a=oci_fetch_array($run)) {
			$AD[]=$a;
		}
	}
?>
<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Danh sách admin</strong>
                      </h4>                
                      <h4><a href="INSERT.php" class="d-inline badge badge-pill badge-info">thêm mới</a>
                        <label class=" float-right">
                    </label>
                      </h4>
                    </h4>

            
                <div class="table-responsive">
                           <table class="table bg-light1 text-dark table-hover ">
                <thead >
                  <tr>
                    <th> STT </th>
                    <th> Mã số</th>
                    <th> Username </th>
                    <th> Họ tên</th>
                    <th> Email </th>
                    <th> Sửa </th>
                    <th> Xóa </th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($AD as $dong) { ?>
                    <tr>
                      <td>
                        <?php echo "$i" ?>
                      </td>
                      <td>
                        <?php echo $dong['MATS']?>
                      </td>
                       <td>
                        <?php echo $dong['USERNAME']?>
                      </td>
                          <td>
                        <?php echo $dong['HOTEN']?>
                      </td>
                      <td><?php echo $dong['EMAIL']?></td>
                        <td> <a href="UPDATE.php?id=<?php echo $dong['MATS']; ?>" class="badge badge-pill badge-warning">Edit </a> </td>
                        <td> <a href="DELETE.php?id=<?php echo $dong['MATS']; ?>" onclick="return confirm('Are you sure?')" class="badge badge-pill badge-danger">Delete </a> </td>
                    </tr>
                <?php $i++; } ?>
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