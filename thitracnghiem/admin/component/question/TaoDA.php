<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
	session_start();
	include'../../layouts/header.php';
	include'../../../connect.php';
if(isset($_GET["mach"])){
  $mach=$_GET["mach"];
}
  if(isset($_POST['capnhat'])){
  $mach=$_POST['mach'];
    if (isset($_POST['tl'])) {
    
      foreach ($_POST['tl'] as $key => $value){
        if ($value!=NULL) {
          $traloi = "$value";
          $dapan = $_POST['mada'][$key];

          $sql="insert into khanhvan.DAPAN(MaCH,NDDA,DADUNG) values('".$mach."','".$traloi."','".$dapan."')";   
          $compiled = oci_parse($connection, $sql);
          oci_execute($compiled);
        }
      }
    }
      header('location:DSCH.php');

  }

  $sql1="select * from khanhvan.CAUHOI where MACH='$mach'";
  $run=oci_parse($connection,$sql1);
  oci_execute($run);
  $dong= oci_fetch_array($run, OCI_ASSOC);
   
  
  
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body bg-light text-dark col-6" style="margin-left: 25%">
          	<button type="submit" name="them" class="btn btn-secondary mr-2" onclick="createSelect(); createInput(); ">Thêm</button>
            <h4 class="card-title">Thêm đáp án </h4>
   
            <form class="forms-sample" action="TaoDA.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-2 badge badge-info">Câu hỏi</label>
                <div class="ip">
                    
                    <input type="text" name="mach" readonly class="form-control col-3" class="form-control " value="<?php echo $dong['MACH'] ?>" placeholder=""></div>
                    <br><br><br><br>
                </div>
               <div class="form-group">
               	<label class="col-2 badge badge-info">Đáp án</label>
               	<div class="ip">
                    
                    <input type="text" name="tl[]" class="form-control " placeholder=""></div>
                    <div class="sl">
                    <select name="mada[]">
                    	<option value="1">Đúng</option>
                    	<option value="0">Sai</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
               	<label class="col-2 badge badge-info">Đáp án</label>
               	<div class="ip">
                    
                    <input type="text" name="tl[]" class="form-control " placeholder=""></div>
                    <div class="sl">
                    <select name="mada[]">
                    	<option value="1">Đúng</option>
                    	<option value="0">Sai</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
               	<label class="col-2 badge badge-info">Đáp án</label>
               	<div class="ip">
                    
                    <input type="text" name="tl[]" class="form-control " placeholder=""></div>
                    <div class="sl">
                    <select name="mada[]">
                    	<option value="1">Đúng</option>
                    	<option value="0">Sai</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
               	<label class="col-2 badge badge-info">Đáp án</label>
               	<div class="ip">
                    
                    <input type="text" name="tl[]" class="form-control " placeholder=""></div>
                    <div class="sl">
                    <select name="mada[]">
                    	<option value="1">Đúng</option>
                    	<option value="0">Sai</option>
                    </select>
                    </div>
                </div>
                <div class="ip" id="div2"> <div class="sl" id="div3"></div> </div>
              <button type="submit" name="capnhat" class="btn btn-secondary mr-2">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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

</body>
</html>
<?php
	include '../../layouts/footer.php';
?>
