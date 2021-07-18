<?php 
        session_start();
        include('Connect.php');
        include('layouts/header.php');
        // $_SESSION['time']=time();
        
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body  onload="start()" style="background-color: #a9d0f5;height: 350%;">
    <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        
    if(isset($_GET["id"])){
        $id=$_GET["id"];
    }
        $sql1="select * from khanhvan.KITHI where MaKT='$id'";
        $run1=oci_parse($connection,$sql1);
        oci_execute($run1);
        $dong1= oci_fetch_array($run1, OCI_ASSOC);
        $ngaybd=$dong1['NGAYBATDAU'];
        $ngaykt=$dong1['NGAYKETTHUC'];
        $today = date("Y-m-d");
    if(strtotime($today) < strtotime($ngaybd)){
        echo '<script type="text/javascript">alert("Chưa đến ngày thi!")</script>';
        ?>
        <meta http-equiv="refresh" content="0;url=DSKiThiTS.php">
        <?php
    }elseif(strtotime($today) > strtotime($ngaykt)){
        echo '<script type="text/javascript">alert("Thời gian thi đã kết thúc.");</script>';
        ?>
        <meta http-equiv="refresh" content="0;url=DSKiThiTS.php">
        <?php
    }else{
        if(isset($_SESSION['user'])){
            $username = $_SESSION['user'];
            }
            $sql="select * from khanhvan.DETHI join khanhvan.THISINH on DETHI.MATS=THISINH.MATS where MaKT='$id' and USERNAME = '$username'";
            $run=oci_parse($connection,$sql);
            oci_execute($run);
            $dong= oci_fetch_array($run, OCI_ASSOC);
            $made=$dong['MADE'];
        if($dong['LANTHI']>=1){
        
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
        
                if ($tongch==0) {
                    $diem=0;
                }else {
                    $diem=round(($kq*10)/$tongch,2);
                }
        ?>
    </div>
    <br>
    <h2 align="center"><b>KẾT QUẢ</b></h2>
    <br>
    <br>
    <div class="noidung" align="center">
        <label>&nbsp; Họ và tên thí sinh: <?php echo $name['HOTEN']; ?></label><br>
        <label>&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; Đề thi: <?php echo $made; ?></label><br>
        <label>&emsp;&emsp;  Tổng số câu: <?php echo $tongch; ?></label><br>
        <label>&emsp;&emsp; Số câu đúng: <?php echo $kq; ?></label><br>
        <label>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; Điểm: <?php echo $diem; ?></label><br><br><br>
        <button style="background-color: #EEEEEE;border: none;"><a href="TrangChu.php">Back</a></button>
    </div>
    </div>
    <?php

        }else{
        
           $sql="select * from khanhvan.KITHI where MaKT='$id'";
           $run=oci_parse($connection,$sql);
           oci_execute($run);
           while($dong= oci_fetch_array($run, OCI_ASSOC)){
            $p=$dong['PHUT'];
        ?>

    <div class="left">
        <p align="center"><b>Thời gian làm bài</b></p>
        <div class="time">
            <p id="demo" class="d-inline badge badge-pill badge-info" style="font-size: 20px"></p>
            <script>
            // Kiểm tra phía client
            // set thời gian làm bài
             var tgianConLai =<?php echo json_encode($p); ?>*60;
            // Kiểm tra load lại trang
            if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
              if(typeof tgianConLai !== 'undefined') {
                    // Lấy biến trong local đã lưu
                    tgianConLai = localStorage.getItem("tgConLai");
                }
            }
            // Update mỗi giây
            var x = setInterval(function() {
                tgianConLai = tgianConLai - 1;
                // Lưu biến vào local
                localStorage.setItem("tgConLai", tgianConLai);
                h = Math.floor(tgianConLai/3600);
                m = Math.floor((tgianConLai - h*3600)/60);
                s = Math.floor(tgianConLai-(h*60+m)*60);
                document.getElementById("demo").innerHTML = h + ":" + m + ":"+ s;
                // Check tgian
              if (tgianConLai < 0) {
                clearInterval(x);
                localStorage.removeItem("tgianConLai"); 
                document.getElementById("demo").innerHTML = "Hết giờ";
                window.onload = document.getElementById("submit-button").click();
              }
            }, 1000);
            </script>
            <?php 
                 }
                ?>
                <br><br><br>
                <div ><button id="submit-button" type="submit" class="d-inline badge badge-pill badge-info" name="nopbai" form="myform" value="submit">Nộp bài</button></div>
        </div>
        
    </div>
    <br>
    <h2 style="margin-left: 47%;font-weight:700;">ĐỀ THI</h2>
    <div class="dethi">
        <form id="myform" enctype="multipart/form-data" method="post" action="./ketquathi.php?id=<?php echo $id?>">
            <div class="content">
                <?php
                    if(isset($_SESSION['user'])){
                    $username = $_SESSION['user'];
                    
                    $sql = "select MADE from khanhvan.THISINH join khanhvan.DETHI on THISINH.MATS = DETHI.MATS where MAKT='$id' and USERNAME ='$username'";
                    $run=oci_parse($connection, $sql);
                    oci_execute($run);
                    $dong= oci_fetch_array($run);
                    $DT=$dong['MADE'];
                    }
                    ?>
                <input type="hidden" name="madethi" value="<?php echo $dong['MADE'] ?>">
                <input type="hidden" name="batdau" value="<?php echo date('m/d/Y h:i:s a', time()) ?>">
                <br>
                <?php
                    $sql="select SOCAU from khanhvan.KITHI where MaKT='$id'";
                       $run=oci_parse($connection,$sql);
                       oci_execute($run);
                       $dong= oci_fetch_array($run, OCI_ASSOC);
                    
                    $t = $dong['SOCAU'];
                    $i = 0;
                    
                    $sqlkiemtra="select * from khanhvan.CHITIETDETHI where MADE='$DT'";
                    $kiemtra=oci_parse($connection, $sqlkiemtra);
                    oci_execute($kiemtra);
                    $ktra=oci_fetch_array($kiemtra);

                    if (isset($ktra['MADE'])!=$DT) {
                        $sqldt="insert into CHITIETDETHI(MADE,MACH,NDCH)
                            select MADE,MACH,NDCH
                                    from (select CAUHOI.MACH,CAUHOI.MAKT,CAUHOI.NDCH,DETHI.MADE 
                                             from khanhvan.CauHoi,khanhvan.DETHI 
                                             where CAUHOI.MAKT=DETHI.MAKT AND MADE='$DT' 
                                             ORDER BY dbms_random.value) 
                                    where rownum<='$t'and MaKT='$id'";

                        $rundt=oci_parse($connection, $sqldt);
                        oci_execute($rundt);  
                    }

                    
            $sql="select distinct ctde.MACH,ctde.NDCH,ch.PHANLOAI from khanhvan.CHITIETDETHI ctde,khanhvan.CAUHOI ch where MADE='$DT' and ctde.MACH=ch.MACH";
            $run=oci_parse($connection,$sql);
            oci_execute($run);
            while($dong= oci_fetch_array($run, OCI_ASSOC)){
                        $i++;
                    ?>
                <?php 
                    echo "Câu ".$i.":"."\n";
                    ?>  
                    <input type="hidden" name="mach[]" value="<?php echo $dong['MACH'] ?>">
                    <input type="hidden" name="ndch[]" value="<?php echo $dong['NDCH'] ?>"/>
                <?php
                    echo $dong['NDCH']."<br>";
                $sqll="select * from khanhvan.DAPAN";
                $runn=oci_parse($connection, $sqll);
                oci_execute($runn);
                while($dong_DA= oci_fetch_array($runn, OCI_ASSOC)){
                    if($dong['MACH']==$dong_DA['MACH'] && $dong['PHANLOAI']==0){
                    ?>
                    
                    &nbsp &nbsp &nbsp<input type="radio" name="<?php echo $i ?>" value="<?php echo $dong_DA['MADA'] ?>"/>&nbsp<?php echo $dong_DA['NDDA']."<br>"; ?>
                     <?php 

                    }elseif($dong['MACH']==$dong_DA['MACH'] && $dong['PHANLOAI']==1){
                    ?>          
                    &nbsp &nbsp &nbsp<input type="checkbox" name="dachbox[]" value="<?php echo $dong_DA['MADA'] ?>"/>&nbsp<?php echo $dong_DA['NDDA']."<br>"; ?>
        <?php           
                    }

                }
                    echo "<br>";
            }
                    
                    ?>
            </div>
            </form>
            <br>
            
              <br>
    </div>
    <br>
    <br>
    
    <?php
        $sql="select * from khanhvan.DETHI join khanhvan.THISINH on DETHI.MATS=THISINH.MATS where MaKT='$id' and USERNAME = '$username'";
        $run=oci_parse($connection,$sql);
        oci_execute($run);
        $dong= oci_fetch_array($run, OCI_ASSOC);
        $made=$dong['MADE'];

        if(isset($_SESSION['user'])){
            $username = $_SESSION['user'];
            
            $sql = "select * from khanhvan.THISINH,khanhvan.DETHI,khanhvan.KITHI where USERNAME ='$username' and MADE='$made' and DETHI.MAKT=KITHI.MAKT ";
            $run=oci_parse($connection, $sql);
            oci_execute($run);
            $dong= oci_fetch_array($run);
        }
    ?>
    <div class="right">
        <p align="center"><b>Thông tin thí sinh</b></p><br>
        <p align="center"><b>Họ tên: <?php echo $dong['HOTEN']?></b></p>
        <p align="center"><b>Mã đề: <?php echo $dong['MADE']?></b></p>
        <p align="center"><b>Kỳ thi: <?php echo $dong['TENKT']?></b></p>
        <div class="time">
            
            <?php 
                }
                ?>
                
        </div>
        
    </div>
    <?php
        }
        // }
        ?>
        

</body>
</html>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
    $("#submit-button").click(function(){        
        $("#myform").submit(); // Submit the form
    });
});
</script>
