<?php 
    include 'connect.php';
   
    session_start();
    if($_POST) {        

        $login_name = $_POST['login_name'];
        $password = $_POST['password'];
        $password=md5($password);
            $s = oci_parse($connection, "select  UserName,PassWord,MaTS from khanhvan.THISINH where UserName='$login_name' and PassWord='$password' and PER='0'");       
            oci_execute($s);
            $row = oci_fetch_all($s, $res);

            $ad = oci_parse($connection, "select  UserName,PassWord,MaTS from khanhvan.THISINH where UserName='$login_name' and PassWord='$password' and PER='1'");       
            oci_execute($ad);
            $rowad = oci_fetch_all($ad, $res);
            if($row){
                    $_SESSION['user']=$login_name;
                    $_SESSION['time_start_login'] = time();
                    header("location: TrangChu.php");
            }else if ($rowad) {
                    $_SESSION['user']=$login_name;
                    $_SESSION['time_start_login'] = time();
                    header("location: admin/index.php");
            }else{

                //echo "wrong password or username";
            }

        }  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<title></title>
 <link rel="stylesheet" href="front-end/css/bootstrap.min.css" type="text/css">
 <link rel="stylesheet" href="front-end/css/style_login.css" type="text/css">

</head>
<body style="background-image: url('/thitracnghiem/image/nen.png');background-repeat:no-repeat;background-size:cover; ">
<div class="signup-form" >
    <form action="" method="post">
        <h2>login</h2>
        <!-- <p class="hint-text">Create your account. Its free and only takes a minute.</p> -->
       
        <div class="form-group">
            <input type="text" class="form-control" name="login_name" placeholder="login name" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>       
        <div class="form-group">
            <button type="submit" class="btn btn-outline-warning btn-lg btn-block">Đăng nhập</button>
        </div>
     
        

    </form>
</div>
</body>
</html>  