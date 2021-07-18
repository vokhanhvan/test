<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

?>
<!DOCTYPE html>
<html>
<body>
<?php
  $result_total = oci_parse($connection,"SELECT count(MATS) from khanhvan.THISINH");
  oci_execute($result_total);
  $row = oci_fetch_array($result_total);
  $total_records= $row['COUNT(MATS)'];
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = 10;

  $total_page = ceil($total_records / $limit);
  if ($current_page> $total_page) {
    $current_page = $total_page;
    # code...
  }
  else if ($current_page< 1) {
    $current_page =1; 
    # code...
  }
  $start = ($current_page-1)*$limit;

	$sql="select * from khanhvan.THISINH where PER='0' order by MATS ASC OFFSET '$start' ROWS FETCH NEXT '$limit' ROWS ONLY";
	$run=oci_parse($connection,$sql);
	oci_execute($run);
	$TS=[];
	if ($run) {
		while ($a=oci_fetch_array($run)) {
			$TS[]=$a;
		}
	}
	// $i=0;
?>

	<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Danh sách thí sinh</strong>
                      </h4>                
                      <h4><a href="TaoThiSinh.php" class="d-inline badge badge-pill badge-info">thêm mới</a>
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
                    <th> Username </th>
                    <th> Họ tên</th>
                    <th> Email </th>
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
                        <?php echo $dong['USERNAME']?>
                      </td>
                          <td>
                        <?php echo $dong['HOTEN']?>
                      </td>
                      <td><?php echo $dong['EMAIL']?></td>
                        <td> <a href="SuaTS.php?id=<?php echo $dong['MATS']; ?>" class="badge badge-pill badge-warning">Edit </a> </td>
                        <td> <a href="XoaTS.php?id=<?php echo $dong['MATS']; ?>" onclick="return confirm('Are you sure?')" class="badge badge-pill badge-danger">Delete </a> </td>
                    </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
              <nav aria-label="...">
                <ul class="pagination">
                  <li class="page-item <?php echo ($current_page > 1 && $total_page >1) ? '' : 'disabled'?>">
                    <a class="page-link" href="DSCH.php?page=<?php echo $current_page-1; ?>">Prev</a>
                  </li>
                  <?php for ($i=1; $i<= $total_page ; $i++) { 
                    echo '<li class="page-item ';

                    if ($i == $current_page) {
                      echo 'active';
                    }
                     echo ' "><a class="page-link" href="DSCH.php?page='.$i.'">'.$i.'</a></li>';   
                  } ?>
                 
                 <!--  <li class="page-item active">
                    <a class="page-link" href="#">2 </span></a>
                  </li> -->
                 
                  <li class="page-item <?php echo ($current_page < $total_page && $total_page >1) ? '' : 'disabled'?>">
                    <a class="page-link" href="DSCH.php?page=<?php echo $current_page+1; ?>">Next</a>
                  </li>
                </ul>
              </nav>
               
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