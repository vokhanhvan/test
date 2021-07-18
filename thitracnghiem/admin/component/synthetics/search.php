<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';

	$search_value = $_POST["search"];

	if ($search_value=="") {
	  header('location: http://localhost/thitracnghiem/admin/component/synthetics'); 
	}
	$sql="SELECT * FROM khanhvan.TONGHOP where TONGHOP.HOTEN like '%$search_value%' ";
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
                           <table class="table bg-light text-dark table-hover ">
                <thead >
                  <tr>
                    <th> STT </th>
                    <th> Mã thí sinh</th>
                    <th> Họ tên</th>
                    <th> Mã đề </th>
                    <th> Mã kì thi </th>
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
                        <?php echo $dong['MAKT']?>
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