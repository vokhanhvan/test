<div class="sub-menu">
<?php 
   session_start();
   include('Connect.php');
   include('layouts/header.php');
   if(isset($_SESSION['user'])){
           $username = $_SESSION['user'];
           $sql ="SELECT * FROM khanhvan.THISINH join khanhvan.DETHI dt on THISINH.MATS = dt.MATS join khanhvan.KITHI on dt.MAKT = KITHI.MAKT WHERE THISINH.UserName = '$username' order by dt.MAKT asc";
           $run=oci_parse($connection,$sql);
           oci_execute($run);
           ?>
<body style="background-color: white;" >
   <div class="container-fluid ">
      <div class="container-fluid page-body-wrapper">
         <div class="main-panel">
            <div class="content-wrapper">
               <div class="row">
                  <div class="col-12 grid-margin ">
                     <?php
                        while($dong= oci_fetch_array($run, OCI_ASSOC)){
                        ?>
                     <div class="card">
                        <div class="card-body bg-info text-white">
                           <div class="row">
                              <div class="col-md-4 stretch-card grid-margin">
                                 <div class="card bg-gradient-danger card-img-holder text-white" style="background-color: #0574cb;">
                                    <div class="card-body">
                                       <a href="./ChiTietDe.php?id=<?php echo $dong['MAKT']?>" onclick="return confirm('Bạn muốn vào thi?')">
                                          <h2 class="mb-5"><?php echo $dong['TENKT']?></h2>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php   
                        }
                        } 
                            
                        ?>  
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>