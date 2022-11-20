<?php include('../connect/class_conn.php');
$cls_conn=new class_conn; 
include('../functions/logicmain.php');
$change_language=new change_language; 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      include('ingredient/head.php'); 
    ?>
    <script src="../vendors/validator/validator.js"></script>

  <link href="../css/setting.css" rel="stylesheet">  
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
                include('body/page_showaward.php'); 
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
  </body>
</html>
