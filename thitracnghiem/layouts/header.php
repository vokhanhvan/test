
<?php
    include 'connect.php';

    $sql = "SELECT * FROM khanhvan.KITHI";
    $result = oci_parse($connection, $sql);
    oci_execute($result);
    $KITHI= [];
     if( $result){
      while ($a = oci_fetch_array($result)) {
       $KITHI[]= $a;
      }

     }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VNPT Hậu Giang | Website Thi Trắc Nghiệm</title>
    <!-- Css Styles -->
    <link rel="stylesheet" href="front-end/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front-end/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
</head>
 

<body>
    <header class="header-section-other">
        <div class="container-fluid">
            <div class="logo">
                <a href="./trangchu.php"><img src="front-end/img/logo-mb.png" width="250px" height="70px"  alt=""></a>
            </div>
            <div class="nav-menu">
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li ><a href="trangchu.php">Trang chủ</a></li>
                        <li><a href="trangchu.php">Thông tin</a>
                            
                        </li>
                        <li><?php echo isset($_SESSION['user'])?'<a href="./DSKiThiTS.php">Kỳ Thi</a>': '<a href="login.php">Kỳ Thi</a>'?>
                        </li>
                            
                        <li><?php echo isset($_SESSION['user']) ? '<a>'.$_SESSION['user'].'  </a>  <ul class="sub-menu">
                                <li><a href="profile_user.php">profile</a></li>
                                <li><a href="logout.php">logout</a></li>
                            </ul> ' : '<a href="login.php">  Đăng nhập </a>'?>

                           
                        </li>
                       

                    </ul>
                </nav>
            </div>
        </div>
    </header>
    

</body>