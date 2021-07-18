<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	session_start();
	include'../../layouts/header.php'; 
	include'../../../connect.php';
if(isset($_POST['capnhat'])){
    $makt=$_POST['makt'];
    $phanloai=$_POST['phanloai'];
    $ndch=$_POST['ndch'];
    $sql="insert into khanhvan.CAUHOI(MaKT,NDCH,PHANLOAI) values('".$makt."','".$ndch."','".$phanloai."')";   
    $compiled = oci_parse($connection, $sql);
	oci_execute($compiled);
	header('location:DSCH.php');
	}

?>

	<?php
		$sql="select * from khanhvan.KITHI";
		$run=oci_parse($connection, $sql);
		oci_execute($run);
		$CH=[];
  		if ($run) {
    		while ($a=oci_fetch_array($run)) {
     		 $CH[]=$a;
    		}	
  		}
	?>	
		 <div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
            <h4 class="card-title">Thêm câu hỏi </h4>
            
            <form class="forms-sample" action="TaoCH.php" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-2 badge badge-info">Kỳ thi</label><br>
                    <select name="makt">
                    	<option value="" >----Chọn----</option>
                    	<?php foreach ($CH as $dong) { ?>
                    	<option  value="<?php echo $dong['MAKT']?>"><?php echo $dong['TENKT'] ?></option>
                    	<?php
						}
						?>
                    </select>
                </div>
                <div class="form-group">
                  <label class="col-2 badge badge-info">Loại câu hỏi</label><br>
                  <select name="phanloai">
                      <option value="" >----Chọn----</option>
                      <option value="0">Một đáp án đúng</option>
                      <option value="1">Nhiều đáp án đúng</option>
                    </select>
              </div>
              <div class="form-group">
                  <label class="col-2 badge badge-info">Nội dung</label>
                  <input type="text" name="ndch" class="form-control " placeholder="">
              </div>
              <br>
              <button type="submit" name="capnhat" class="btn btn-secondary mr-2">Save</button>
            </form>
            <br>

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

<!-- <script>
	function kiemtraCH(){
		var ndch = document.forms["Form"]["ndch"].value;
		if(ndch==""){
			alert("Vui lòng nhập câu hỏi!");
				return false;
				}
				
		alert("Thêm thành công!");
				return true;
	}
</script> -->
<script type="text/javascript">

function createSelect() {
  var sel = document.createElement("select");
  sel.name = "mada[]";
 document.body.appendChild(sel);
 var values=["Đúng","Sai"];
      
        for(i = 0; i < values.length; i++){
            var item = document.createElement("option");
            item.setAttribute("value", i);
            item.innerText=values[i]; 
            sel.appendChild(item);
            document.getElementById("div3").appendChild(sel);
        }

}


function createInput(){
  var txtNewInputBox = document.createElement('div');
  txtNewInputBox.innerHTML = "Đáp án <input type='text' name='tl[]'><br><br>";
  document.getElementById("div2").appendChild(txtNewInputBox);
}
</script>