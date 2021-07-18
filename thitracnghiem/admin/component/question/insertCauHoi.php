<?php
	//  Include thư viện PHPExcel_IOFactory vào
	
	session_start();
	include'../../layouts/header.php';
	require ('PHPExcel/Classes/PHPExcel.php');
	include'../../../connect.php';
	if(isset($_POST['btngui'])){
		$file=$_FILES['file']['tmp_name'];
		$objFile = PHPExcel_IOFactory::identify($file);
		$objData = PHPExcel_IOFactory::createReader($objFile);

		//Chỉ đọc dữ liệu
		$objData->setReadDataOnly(true);

		// Load dữ liệu sang dạng đối tượng
		$objPHPExcel = $objData->load($file);

		//Lấy ra số trang sử dụng phương thức getSheetCount();
		// Lấy Ra tên trang sử dụng getSheetNames();

		//Chọn trang cần truy xuất
		$sheet = $objPHPExcel->setActiveSheetIndex(0);

		//Lấy ra số dòng cuối cùng
		$Totalrow = $sheet->getHighestRow();
		//Lấy ra tên cột cuối cùng
		$LastColumn = $sheet->getHighestColumn();

		//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
		$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

		//Tạo mảng chứa dữ liệu
		$data = array();

		//Tiến hành lặp qua từng ô dữ liệu
		//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
		for ($i = 2; $i <= $Totalrow; $i++) {
		    //----Lặp cột
		    $MaKT = $sheet->getCellByColumnAndRow(0, $i)->getValue();;
		    $NDCH = $sheet->getCellByColumnAndRow(1, $i)->getValue();;
		    $PHANLOAI = $sheet->getCellByColumnAndRow(2, $i)->getValue();;
		    $MAX=0;
		    $sql="BEGIN MAXX(:MaKT,:NDCH,:PHANLOAI,:MAX); END;";
			$res=oci_parse($connection, $sql);
			oci_bind_by_name($res,':MaKT',$MaKT);
			oci_bind_by_name($res,':NDCH',$NDCH);
			oci_bind_by_name($res,':PHANLOAI',$PHANLOAI);
			oci_bind_by_name($res,':MAX',$MAX);
			oci_execute($res);
		    for ($j=3; $j < $TotalCol-1; $j++) { 
		    	$Dung = $sheet->getCellByColumnAndRow($TotalCol-1, $i)->getValue();;
		    	$array=explode(',', $Dung);
		    	$DA = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
		    	$n=0;
		    	for ($k=0; $k < sizeof($array) ; $k++) { 
			    		if ($array[$k]==$j) {
			    			$n=1;
			    			break;
			    	}else{
			    		continue;
			    	}
		    	}
		    	$sqlch="insert into khanhvan.DAPAN(MaCH,MaDA,NDDA,DADUNG) values ('".$MAX."','','".$DA."','".$n."')";
			    		$res1=oci_parse($connection, $sqlch);
						oci_execute($res1);
		    	
		    }

		}
		header('location:DSCH.php');
	}

?>
<html>
<head>
 	<meta charset="utf-8" />
</head>
<body>
	<H4>
		<form enctype="multipart/form-data" method="post">
			<div class="d-inline badge badge-pill badge-info">
				<label for="data"></label>
				<input type="file" name="file">
				<button type="submit" name="btngui">Import</button>
			</div>
	
		</form>
	</H4>
</body>
</html>
<?php
	include '../../layouts/footer.php';
?>
