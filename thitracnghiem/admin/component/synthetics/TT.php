<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

?>
<!DOCTYPE html>
<html>

<body>
<?php
	$sql="select * from khanhvan.TONGHOP,khanhvan.THISINH where THISINH.MATS=TONGHOP.MATS";
	$run=oci_parse($connection,$sql);
	oci_execute($run);
	$TS=[];
	if ($run) {
		while ($a=oci_fetch_array($run)) {
			$TS[]=$a;
		}
	}

	if(isset($_POST['btnsearch'])){
	    $name=$_POST['search'];
	    $search="select * from khanhvan.TONGHOP,khanhvan.THISINH where THISINH.HOTEN='$name'";
	    $c=oci_parse($connection, $search);
	    oci_execute($c);
	}
?>
<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Tổng hợp</strong>
                      </h4>                
                      <h4>
                        <label class=" float-right">
                       <div class="nav-item active">
                        <form class=" form-inline" method="post" action="search.php">
                          <input class="form-control mr-sm-1" type="text" placeholder="Search" name="search">
                          <button class="btn btn-success" type="submit">Search</button>
                        </form>
                      </div>
                    </label>
                      </h4>
                    </h4>

            
                <div class="table-responsive">
                           <table class="table bg-light1 text-dark table-hover ">
                <thead >
                  <tr>
                    <th> STT </th>
                    <th> Mã thí sinh</th>
                    <th> Họ tên</th>
                    <th> Mã đề </th>
                    <th> Tên kỳ thi </th>
                    <th> Điểm </th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($TS as $dong) { ?>
                    <tr>
                      <td>
                        <?php echo "$i" ?>
                      </td>
                      <td>
                        <?php echo $dong['MATS']?>
                      </td>
                       <td>
                        <?php echo $dong['HOTEN']?>
                      </td>
                      <td>
                      	<?php echo $dong['MADE']?>
                      </td>
						<td>
                        <?php echo $dong['TENKT']?>
                      </td>
                       <td>
                        <?php echo $dong['DIEM']?>
                      </td>
                        
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