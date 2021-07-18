
<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
	$sql="select * from khanhvan.KITHI";
	$run=oci_parse($connection,$sql);
	oci_execute($run);
	$KT=[];
	if ($run) {
		while ($a=oci_fetch_array($run)) {
			$KT[]=$a;
		}
	}
?>

	<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Danh sách kỳ thi</strong>
                      </h4>                
                      <h4><a href="TaoKyThi.php" class="d-inline badge badge-pill badge-info">thêm mới</a>
                        <label class=" float-right">
                       <div class="nav-item active">
                      </div>
                    </label>
                      </h4>
                    </h4>

            
                <div class="table-responsive">
                           <table class="table bg-light1 text-dark table-hover ">
                <thead >
                  <tr>
                    <th> STT </th>
                    <th> Tên kỳ thi </th>
                    <th> Thời gian thi </th>
                    <th> Số câu </th>
                    <th> Ngày bắt đầu </th>
                    <th> Ngày kết thúc </th>
                    <th> Sửa </th>
                    <th> Xóa </th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($KT as $dong) { ?>
                    <tr>
                      <td>
                        <?php echo "$i" ?>
                      </td>
                       <td>
                        <?php echo $dong['TENKT']?>
                      </td>
                      <td>
                        <?php 
                            echo $dong['PHUT']." Phút" ;
                        ?>
                      </td>
                      <td>
                        <?php echo $dong['SOCAU']?>
                      </td>
                      <td>
                        <?php echo date("d-m-yy",strtotime($dong['NGAYBATDAU']));?>
                      </td>
                      <td>
                        <?php echo date("d-m-yy",strtotime($dong['NGAYKETTHUC']));?>
                      </td>
                        <td> <a href="SuaKT.php?id=<?php echo $dong['MAKT']; ?>" class="badge badge-pill badge-warning">Edit </a> </td>
                        <td> <a href="XoaKT.php?id=<?php echo $dong['MAKT']; ?>" onclick="return confirm('Are you sure?')" class="badge badge-pill badge-danger">Delete </a> </td>
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
<?php
	include '../../layouts/footer.php';
?>
