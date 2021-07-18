<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link rel="stylesheet" href="/thitracnghiem/admin/front-end/css/bootstrap.min.css">
    <link rel="stylesheet" href="/thitracnghiem/admin/front-end/css/stylemain.css" type="text/css">
  </head>
  <body style="background-color: #4aa3e9;" >
    <div class="container-fluid ">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center col-lg-12 col-12 ">
        <div >
          <ul class="navbar-nav  ">
            
            <li class="nav-item active p-3 ">
              <a class="nav-link" href="/thitracnghiem/admin/index.php">
                <strong><span class="menu-title">Trang chủ</span></strong>
               
              </a>
            </li>
            <li class="nav-item active p-3 ">
              <a class="nav-link" href="/thitracnghiem/admin/component/ts/DSTS.php">
                <strong><span class="menu-title">Thí Sinh</span></strong>
               
              </a>
            </li>
            <li class="nav-item active p-3">
              <a class="nav-link" href="/thitracnghiem/admin/component/question/DSCH.php">
                <strong><span class="menu-title">Câu Hỏi</span></strong>
             
              </a>
            </li>
            <li class="nav-item active p-3">
              <a class="nav-link" href="/thitracnghiem/admin/component/exam/DSKT.php">
               <strong> <span class="menu-title">Kỳ Thi</span></strong>
              
              </a>
            </li>
            <li class="nav-item active p-3">
              <a class="nav-link" href="/thitracnghiem/admin/component/examtest/DSDT.php">
                <strong><span class="menu-title">Đề Thi</span></strong>
             
              </a>
            </li>
            <li class="nav-item active p-3">
              <a class="nav-link" href="/thitracnghiem/admin/component/synthetics/TT.php">
                <strong><span class="menu-title">Tổng Hợp</span></strong>
             
              </a>
            </li>

            <li class="nav-item active p-3">
              <a class="nav-link" href="/thitracnghiem/admin/component/administrator/ADMIN.php">
                <strong><span class="menu-title">Administrator</span></strong>
             
              </a>
            </li>
           <li class="nav-item nav-profile p-3 dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <label>
                  <div class="nav-profile-img">
                 <?php echo $_SESSION['user'] ?>
                </div>
                </label>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/thitracnghiem/admin/logout.php">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
      
          </ul>
          
        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">