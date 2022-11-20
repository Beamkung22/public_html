<div class="navbar nav_title" style="border: 0;">

    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>

  </div>



  <div class="clearfix"></div>



  <!-- menu profile quick info -->

  <div class="profile clearfix">

    <div class="profile_info">

      <span>Welcome,</span>

      <h2><?php echo $_SESSION['name']; ?></h2>

      <br>

      <h2>เงินของคุณ :</h2>

      <h2><?php echo number_format($_SESSION['price_member']) . " ฿"; ?></h2>

    </div>

  </div>

  <!-- /menu profile quick info -->



  <br />



  <!-- sidebar menu -->

  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">

      <h3>General</h3>

      <ul class="nav side-menu">

      <?php 

      if($_SESSION['status'] == "admin"){

      ?>

      <li><a><i class="fa fa-desktop"></i> หน้าจอ <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="selluser">หน้าลูกค้า</a></li>

            <li><a href="page_404.html">หน้าเดลเลอร์</a></li>

            <li><a href="showaward">หน้าดูรางวัล</a></li>

          </ul>

        </li>

        <li><a><i class="fa fa-edit"></i> การตั้งค่า <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="setup">ตั้งค่าหน้าบ้าน</a></li>

            <li><a href="award">ถูกรางวัล</a></li>

            <li><a href="number_sell">อั้นจำนวนขาย</a></li>

            <li><a href="number_award">อั้นเงินรางวัล</a></li>

            <li><a href="config_lotto">ค่าตายตัว</a></li>

            <li><a href="list_time">ตรวจสอบงวด</a></li>
            <li><a href="history_price">ตรวจสอบเลขอั้นขาย</a></li>

          </ul>

        </li> 

        <li><a><i class="fa fa-group"></i> จัดการบุคคล <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="mangemember">เพิ่มบุคคล</a></li>

            <li><a href="showmember">รายชื่อ</a></li>

            <li><a href="class">ระดับ</a></li>

          </ul>

        </li> 

        <li><a><i class="fa fa-file-text-o"></i> รายการเดิมพัน <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="listplay">การเดิมพันของคุณ</a></li>

            <li><a href="listplay_user">การเดิมพันของลูกค้า</a></li>

            <li><a href="page_404.html">การเดิมพันของเดลเลอร์</a></li>

          </ul>

        </li> 

        <li><a><i class="fa fa-file-text-o"></i> สรุปรายการ <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="report_user">ลูกค้า</a></li>

            <li><a href="report_product">เลข</a></li>

            <li><a href="page_404.html">เดลเลอร์</a></li>

          </ul>

        </li>

      <?php }else if($_SESSION['status'] == "customer"){ ?>

        <li><a><i class="fa fa-desktop"></i> เมนูหลัก <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="showaward">หนัาหลัก</a></li>

            <li><a href="selluser">ลงเดิมพัน</a></li>

          </ul>

        </li>

        <li><a><i class="fa fa-file-text-o"></i> รายการเดิมพัน <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="listplay">การเดิมพันของคุณ</a></li>

          </ul>

        </li> 

      <?php } ?>

      </ul>

    </div>

  </div>

  <!-- /sidebar menu -->



  <!-- /menu footer buttons -->

  <div class="sidebar-footer hidden-small">

    <a data-toggle="tooltip" data-placement="top" title="Settings">

      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>

    </a>

    <a data-toggle="tooltip" data-placement="top" title="FullScreen">

      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>

    </a>

    <a data-toggle="tooltip" data-placement="top" title="Lock">

      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>

    </a>

    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login/logout.php">

      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>

    </a>

  </div>