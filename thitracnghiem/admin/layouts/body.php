<?php 
   include '../connect.php';
   
   $sqlch = "SELECT count(MACH) as MACH from khanhvan.CAUHOI";
   $querych = oci_parse($connection, $sqlch);
   oci_execute($querych);
   $countch = oci_fetch_assoc($querych);
   
   $sqlkt = "SELECT count(MAKT) as MAKT from khanhvan.KITHI";
   $querykt = oci_parse($connection, $sqlkt);
   oci_execute($querykt);
   $countkt = oci_fetch_assoc($querykt);
   
   $sqlts = "SELECT count(MATS) as MATS from khanhvan.THISINH where PER='0'";
   $queryts = oci_parse($connection, $sqlts);
   oci_execute($queryts);
   $countts = oci_fetch_assoc($queryts);
   
   $sqlad = "SELECT count(MATS) as ADMIN from khanhvan.THISINH where PER='1'";
   $queryad = oci_parse($connection, $sqlad);
   oci_execute($queryad);
   $countad = oci_fetch_assoc($queryad);
   
   
   
   ?>    
<div class="main-panel">
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin ">
<div class="card">
<div class="card-body bg-info text-white">
   <h4 class="card-title"><strong>Dashboard</strong>
   </h4>
   <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-success card-img-holder text-white" style="background-color: #feb096;">
            <div class="card-body">
               <img src="/thitracnghiem/image/circle.svg" class="card-img-absolute" alt="circle-image" />
               <h4 class="font-weight-normal mb-3">Tổng số câu hỏi<i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <a href="component/question/DSCH.php">
                  <h2 class="mb-5"><?php echo $countch['MACH'] ; ?></h2>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-success card-img-holder text-white" style="background-color: #feb096;">
            <div class="card-body">
               <img src="/thitracnghiem/image/circle.svg" class="card-img-absolute" alt="circle-image" />
               <h4 class="font-weight-normal mb-3">Số kỳ thi<i class="mdi mdi-diamond mdi-24px float-right"></i>
               </h4>
               <a href="component/exam/DSKT.php">
                  <h2 class="mb-5"><?php echo $countkt['MAKT'] ; ?></h2>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-danger card-img-holder text-white" style="background-color: #7bd8cf;">
            <div class="card-body">
               <img src="/thitracnghiem/image/circle.svg" class="card-img-absolute" alt="circle-image" />
               <h4 class="font-weight-normal mb-3">Tổng số người dùng <i class="mdi mdi-chart-line mdi-24px float-right"></i>
               </h4>
               <a href="component/ts/DSTS.php" >
                  <h2 class="mb-5"><?php echo $countts['MATS']; ?></h2>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
         <div class="card bg-gradient-danger card-img-holder text-white" style="background-color: #7bd8cf;">
            <div class="card-body">
               <img src="/thitracnghiem/image/circle.svg" class="card-img-absolute" alt="circle-image" />
               <h4 class="font-weight-normal mb-3">Tổng số admin <i class="mdi mdi-chart-line mdi-24px float-right"></i>
               </h4>
               <a href="component/administrator/ADMIN.php" >
                  <h2 class="mb-5"><?php echo $countad['ADMIN'] ?></h2>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content-wrapper ends -->