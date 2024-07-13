
<?php
include_once('layouts/header.php');  

include_once('layouts/sidebar.php');
?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content"> 
  <?php
include_once('layouts/topbar.php');
  ?>
                    
                 

                       <?php
                     include_once('plugins/grids.php');
                     include_once('plugins/chart.php');
                     include_once('plugins/bars.php');
                       ?>


                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

               <?php
                include_once('layouts/footer.php')
               ?>