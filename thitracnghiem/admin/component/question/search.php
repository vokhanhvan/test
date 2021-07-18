<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

	$search_value = $_POST["search"];

	if ($search_value=="") {
	  header('location: http://localhost/thitracnghiem/admin/component/ts'); 
	}
	$sql="SELECT * FROM khanhvan.CAUHOI,khanhvan.KITHI where CAUHOI.MAKT=KITHI.MAKT and (CAUHOI.NDCH like '%$search_value%' or KITHI.TENKT like '%$search_value%')";
	$res=oci_parse($connection, $sql);
	oci_execute($res);
	$TS= [];
	if( $res){
	  while($row=oci_fetch_array($res)){
	  $TS[]= $row;
	   }       
	 }

?>

<div class="main-panel">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 grid-margin ">
        <div class="card">
          <div class="card-body bg-info text-white">
            <h4 class="card-title"><strong>Danh sách câu hỏi</strong>
                      </h4>                
                      <h4><a href="TaoCH.php" class="d-inline badge badge-pill badge-info">thêm mới</a>
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
                    <th> Nội dung câu hỏi</th>
                     <th> Kỳ thi </th>
                    <th> Tạo đáp án </th>
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
                        <?php echo $dong['NDCH']?>
                      </td>
                      <td>
                        <?php echo $dong['TENKT']?>
                      </td>
                      <td><a href="TaoDA.php?id=<?php echo $dong['MACH']; ?>" class="badge badge-pill badge-warning">Tạo đáp án </a></td>
                        <td> <a href="SuaCH.php?id=<?php echo $dong['MACH']; ?>" class="badge badge-pill badge-warning">Edit </a> </td>
                        <td> <a href="XoaCH.php?id=<?php echo $dong['MACH']; ?>" onclick="return confirm('Are you sure?')" class="badge badge-pill badge-danger">Delete </a> </td>
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

 <?php
	include '../../layouts/footer.php';
?>
