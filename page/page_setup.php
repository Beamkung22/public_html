<?php include('../connect/class_conn.php');
$cls_conn=new class_conn; 
include('../functions/logicmain.php');
include('../functions/check_status_page.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      include('ingredient/head.php'); 
    ?>
  <link href="../css/setting.css" rel="stylesheet">  
  <link href="../css/numbershow.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include('ingredient/menu.php'); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
                <?php include('ingredient/upper.php'); ?>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php 
                include('body/page_setup.php'); 
            ?>
          </div>
          <br />
        <!-- /page content -->

        <!-- footer content -->
        <?php 
          include('ingredient/footer.php'); 
        ?>
        <!-- /footer content -->
      </div>
    </div>
    
    <?php 
      include('ingredient/script.php'); 
    ?>	
    <script src="../js/jquery.smartWizard_setup.js"></script>
  </body>
</html>
