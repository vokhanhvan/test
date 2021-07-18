<style type="text/css">
.noidung{
	margin-left: auto;
	margin-right: auto;
	border-style: ridge;
	width: 50%;
	background-color: aquamarine;
	height: 45%;
}
.content{
	margin-left: 20px;
	margin-top: 20px;
}
</style>


<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	session_start();
	include('Connect.php');
	include('layouts/header.php');
	$ketthuc = date('m/d/Y h:i:s a', time());
	$dung = true;

if(isset($_POST['nopbai'])){
		//$arr = $_POST;
		$madethi = $_POST['madethi'];
		$batdau = $_POST['batdau'];


	$sqll="select * from khanhvan.DAPAN join khanhvan.CAUHOI on DAPAN.MACH=CAUHOI.MACH";
	$runn=oci_parse($connection, $sqll);
	oci_execute($runn);
	while($dong_DA= oci_fetch_array($runn, OCI_ASSOC)){
		foreach ($_POST['mach'] as $key => $value) {
					$mach = "$value";
					$ndch = $_POST['ndch'][$key];
					$key++;


			if($value==$dong_DA['MACH'] && $dong_DA['PHANLOAI']==1){
				if(isset($_POST['dachbox'])){
					foreach($_POST['dachbox'] as $key_1 => $value_1){
					//$arr = $_POST['dachbox'];			
						$arr = "$value_1";
						//if(isset($arr[$key])){
								//$chon = $arr[$key];
					$sql_1="select * from khanhvan.DAPAN where MACH='$mach'";
					$run_1=oci_parse($connection, $sql_1);
					oci_execute($run_1);

						while($dong_1= oci_fetch_array($run_1, OCI_ASSOC)){

							if($arr==$dong_1['MADA'] && $dong_1['DADUNG']==1){
								$sql="insert into khanhvan.CHITIETDETHI(MADE,MACH,NDCH,DAPANCHON,THOIGIANBATDAU,THOIGIANKETTHUC,KETQUA) values('".$madethi."','".$mach."','".$ndch."','".$arr."','".$batdau."','".$ketthuc."','Đúng')";   
								$compiled = oci_parse($connection, $sql);
								oci_execute($compiled);

								$sql_del="delete from khanhvan.CHITIETDETHI where MACH='$mach' and KETQUA IS NULL";
								$compiled_del = oci_parse($connection, $sql_del);
								oci_execute($compiled_del);
				

							}	
							elseif($arr==$dong_1['MADA'] && $dong_1['DADUNG']==0){
								$sql="insert into khanhvan.CHITIETDETHI(MADE,MACH,NDCH,DAPANCHON,THOIGIANBATDAU,THOIGIANKETTHUC,KETQUA) values('".$madethi."','".$mach."','".$ndch."','".$arr."','".$batdau."','".$ketthuc."','Sai')";   
								$compiled = oci_parse($connection, $sql);
								oci_execute($compiled);	

								$sql_del="delete from khanhvan.CHITIETDETHI where MACH='$mach' and KETQUA IS NULL";
								$compiled_del = oci_parse($connection, $sql_del);
								oci_execute($compiled_del);

							}

						}
					}

				}

		
			}elseif($value==$dong_DA['MACH'] && $dong_DA['PHANLOAI']==0){
				if(isset($_POST[$key])){
					$dachon = $_POST[$key];

					$sql="select * from khanhvan.DAPAN where MADA='$dachon'";
					$run=oci_parse($connection, $sql);
					oci_execute($run);	
					$dong= oci_fetch_array($run, OCI_ASSOC);
						if($dong['DADUNG']==1){
							$sql="update khanhvan.CHITIETDETHI set DAPANCHON='$dachon',THOIGIANBATDAU='$batdau',THOIGIANKETTHUC='$ketthuc',KETQUA='Đúng' where MADE='$madethi' and MACH='$mach'";   
							$compiled = oci_parse($connection, $sql);
							oci_execute($compiled);	
						}else if($dong['DADUNG']==0){		
							$sql="update khanhvan.CHITIETDETHI set DAPANCHON='$dachon',THOIGIANBATDAU='$batdau',THOIGIANKETTHUC='$ketthuc',KETQUA='Sai' where MADE='$madethi' and MACH='$mach'";   
							$compiled = oci_parse($connection, $sql);
							oci_execute($compiled);	
					
						}
				}else{
						$sql="update khanhvan.CHITIETDETHI set DAPANCHON='',THOIGIANBATDAU='',THOIGIANKETTHUC='',KETQUA='' where MADE='$madethi' and MACH='$mach'";   
						$compiled = oci_parse($connection, $sql);
						oci_execute($compiled);	
				}
			}

			
		}
		
	}
}
?>

<?php

	$sql_ds="delete from khanhvan.CHITIETDETHI where rowid not in (SELECT MIN(rowid) FROM khanhvan.CHITIETDETHI GROUP BY MACH, DAPANCHON)";
	$compiled_ds = oci_parse($connection, $sql_ds);
	oci_execute($compiled_ds);
	
?>
   <br>
<h2 align="center"><b>Kết quả</b></h2>
<br>
<div class="noidung">
   <form id="form" name="form" enctype="multipart/form-data" method="" action="">
      <div class="content">
         <?php
            if(isset($_POST['nopbai'])){
            	$i=0;
            	$made = $_POST['madethi'];
            	$mach = $_POST['mach'];

            	if (isset($_POST['madethi'])) {
            		$_SESSION['lanthi_'.$_POST['madethi']]=1;
            		$sql = "UPDATE khanhvan.DETHI SET LANTHI=LANTHI+1 WHERE MADE='$made'";
					$run=oci_parse($connection, $sql);
					oci_execute($run);
            	}

            	$soch="select * from khanhvan.DETHI,khanhvan.KITHI where MADE='$made' AND DETHI.MAKT=KITHI.MAKT";
            	$runch=oci_parse($connection, $soch);
            	oci_execute($runch);
            	$tong=oci_fetch_array($runch);
            	$tongch=$tong['SOCAU'];
            
            	$sqlkq="select count(distinct mach) from khanhvan.CHITIETDETHI where MADE='$made' and KETQUA='Sai' or KETQUA IS NULL";
            	$runkq=oci_parse($connection, $sqlkq);
            	oci_execute($runkq);
            	$KETQUA=oci_fetch_array($runkq);
            	$kq=$tongch - $KETQUA['COUNT(DISTINCTMACH)'];
            	
            	$username=$_SESSION['user'];
            	$user="select * from khanhvan.THISINH where USERNAME='$username'";
            	$runuser=oci_parse($connection, $user);
            	oci_execute($runuser);
            	$name=oci_fetch_array($runuser);

            	$sqldt="select KITHI.TENKT from khanhvan.DETHI,khanhvan.KITHI where MADE='$made' and DETHI.MAKT=KITHI.MAKT";
            	$rundt=oci_parse($connection, $sqldt);
            	oci_execute($rundt);
            	$dethi=oci_fetch_array($rundt);
            	if ($tongch==0) {
            		$diem=0;
            	}else {
					$diem=round(($kq*10)/$tongch,2);
            	}
            	

            	$sqlth="insert into khanhvan.TONGHOP(MADE,MATS,TENKT,DIEM,HOTEN) values('".$made."','".$name['MATS']."','".$dethi['TENKT']."','".$diem."','".$name['HOTEN']."')";
            	$runth=oci_parse($connection, $sqlth);
            	oci_execute($runth);

            }
            ?>
      </div>
   </form>
   <div align="center">
   <label>&nbsp; Họ và tên thí sinh: <?php echo $name['HOTEN']; ?></label><br>
   <label>&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Đề thi: <?php echo $made; ?></label><br>
   <label>&emsp;&emsp;  Tổng số câu: <?php echo $tongch; ?></label><br>
   <label>&emsp;&emsp; Số câu đúng: <?php echo $kq; ?></label><br>
   <label>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; Điểm: <?php echo $diem; ?></label><br><br><br>
   <button style="background-color: #EEEEEE;border: none;"><a href="TrangChu.php">Back</a></button>
</div>
</div>