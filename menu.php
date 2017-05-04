  <body class="hold-transition skin-blue-light fixed sidebar-mini" Onload="bodyOnload();">
       <img src="images/black_ribbon_bottom_right.png" class="black-ribbon stick-bottom stick-right"/>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini" style="color: yellow"><b>R</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="color: yellow"><b>RM-</b>Loei System v.2.0</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                              <!-- Messages: style can be found in dropdown.less-->
            <?php if (!empty($_SESSION['rm_id'])) { ?>                  
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-warning">
                      <?php include_once 'template/plugins/funcDateThai.php';
                                            $user_dep = $_SESSION['rm_dep'];
                                            $sql = "select count(m1.mngrisk_id) AS inbox from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id 
                WHERE t1.res_dep = :user_dep and t1.move_status='N' and m1.mng_status='N' and t1.recycle='N'";
                                        $execute=array(':user_dep' => $user_dep);
                                        $conn_DB->imp_sql($sql);
                                        $result=$conn_DB->select_a($execute);
                                            echo $inbox = $result['inbox'];
                                            ?>
                      </span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">คุณมีรายการรอทบทวน <?=$inbox?> รายการ</li>
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        <?php
                                        $sql = "select s1.category,t1.level_risk,s1.name  as sub_name , t1.takerisk_id , t1.take_file1 , t1.take_rec_date,LEFT(t1.take_detail,35)  AS detail  from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id 
                LEFT OUTER JOIN subcategory s1 ON t1.subcategory = s1.subcategory 
                WHERE t1.res_dep = :user_dep and t1.move_status='N' and m1.mng_status='N' 
                ORDER BY t1.level_risk DESC";
                                        $execute=array(':user_dep' => $user_dep);
                                        $conn_DB->imp_sql($sql);
                                        $result2=$conn_DB->select($execute);
                                            for($i=0;$i<count($result2);$i++){ 
                                    if($result2[$i]['category']=='1'){
                                       $icon = "fa fa-bed"; 
                                    }elseif($result2[$i]['category']=='2'){
                                       $icon = 'fa fa-medkit'; 
                                    }elseif($result2[$i]['category']=='3'){
                                       $icon = 'fa fa-heartbeat'; 
                                    }elseif($result2[$i]['category']=='4'){
                                       $icon = 'fa fa-bug'; 
                                    }elseif($result2[$i]['category']=='5'){
                                       $icon = 'fa fa-leaf'; 
                                    }elseif($result2[$i]['category']=='6'){
                                       $icon = 'fa fa-money'; 
                                    }elseif($result2[$i]['category']=='7'){
                                       $icon = 'fa fa-pie-chart'; 
                                    }elseif($result2[$i]['category']=='8'){
                                       $icon = 'fa fa-file-text'; 
                                    }
                                    if($result2[$i]['level_risk']=='A' or $result2[$i]['level_risk']=='B' or $result2[$i]['level_risk']=='C'){
                                        $color='success';
                                    }elseif($result2[$i]['level_risk']=='D' or $result2[$i]['level_risk']=='E' or $result2[$i]['level_risk']=='F'){
                                        $color='yellow';
                                    }elseif($result2[$i]['level_risk']=='G' or $result2[$i]['level_risk']=='H' or $result2[$i]['level_risk']=='I'){
                                        $color='red';
                                    }?> 
                      <li><!-- start message -->
                        <a href="#"><?php if(!empty($result2[$i]['take_file1'])){?>
                            <div class="pull-left">
                            <img src="myfile/<?= $result2[$i]['take_file1']?>" class="img-circle" alt="User Image">
                        </div><?php }?>
                          <h4>
                            <i class="<?=$icon?> text-<?= $color?>"></i> <?= $result2[$i]['sub_name']?>:
                          </h4>
                          <p><?= $result2[$i]['detail']?>...</p>
                          <small><i class="fa fa-clock-o"> <?=DateThai1($result2[$i]['take_rec_date'])?></i></small>
                        </a>
                      </li><!-- end message --><?php }?>
                    </ul>
                   </li>
                  <li class="footer"><a href="#">ดูทั้งหมด</a></li>
                </ul>
              </li>
              <?php if ($_SESSION['rm_status'] == 'Y') { ?>
                              <!-- Notifications: style can be found in dropdown.less -->
                              <script language="JavaScript">
                                            function bodyOnload()
                                            {
                                                doCallAjax('countrisk')
                                                setTimeout("doLoop();", 30000);
                                            }
                                            function doLoop()
                                            {
                                                bodyOnload();
                                            }
                                        </script>
              <li class="dropdown notifications-menu" id="mySpan"></li>
            <?php }} if(empty($_SESSION['rm_id'])){?>
                <li class="dropdown messages-menu">
                    
                        <a href="#" onClick="return popup('login_page.php', popup, 300, 330);" title="เข้าสู่ระบบE-Claim">
                            <img src="images/key-y.ico" width="18"> เข้าสู่ระบบ
                  </a>
                   
                </li>
                <?php }else{
                    
                    $user_id = $_SESSION['rm_id'];
                                    if (!empty($user_id)) {
                                        
                                        $sql = "select CASE admin WHEN 'Y' THEN 'คณะกรรมการ/ผู้ดูลระบบ' "
                                                . "WHEN 'N' THEN 'ผู้ใช้งานทั่วไป' "
                                                . "WHEN 'A' THEN 'หัวหน้าฝ่าย' END AS rm_status,photo "
                                                . "from user WHERE user_id=:user_id";
                                        $execute=array(':user_id' => $user_id);
                                        $conn_DB->imp_sql($sql);
                                      $result=$conn_DB->select_a($execute);
                                      
                                      $empno_photo=$result['photo'];
                                        if (empty($empno_photo)) {
                                    $photo = 'person.png';
                                    $fold = "images/";
                                } else {
                                    $photo = $empno_photo;
                                    $fold = "photo/";
                                }
                                    }
                    
                    ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $fold.$photo?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $_SESSION['rm_fullname']?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $fold.$photo?>" class="img-circle" alt="User Image">
                    <p>
                      <?= $_SESSION['rm_fullname']?>
                      <small><?= $result['rm_status']?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <a href="index.php?page=content/add_user&id=<?= $conn_DB->sslEnc($user_id)?>" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                    </div>
                    <div class="pull-right">
                        <a href="#" onclick="sendget('process/logout.php','index_content')" class="btn btn-default btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
              <?php if($_SESSION['rm_status']=='Y') {?>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
              <?php }}?>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $fol.$pic?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>โรงพยาบาลจิตเวชเลยฯ</p>
              <a href="#"><i class="fa fa-circle text-success"></i> ระบบบริหารความเสี่ยง</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>
            <li class="">
                <?php if(isset($_SESSION['rm_id'])){?>
                <!--<a href="index.php">-->
                <a href="#" onclick="loadPage('#index_content','content/info_index.php')">
                <?php }else{?>
                    <a href="index.php">    
                <?php } ?>
                    <img src="images/gohome.ico" width="20"> <span>หน้าหลัก</span></a>
            </li>
            
            <?php if(isset($_SESSION['rm_id'])){ 
                if($_SESSION['rm_status']=='Y'){?>
                        <li class="treeview">
              <a href="#">
                  <img src="images/menu_items_options.ico" width="20">
                <span>เมนูคณะกรรมการ</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class=""> <a href="index.php?page=content/check_risk">
                    &nbsp;&nbsp;<img src="images/Transfer.ico" width="20"> <span>รายการแจ้งย้ายความเสี่ยง</span></a>
            </li>
                  <li class=""> <a href="#" onclick="loadPage('#index_content''content/test_index.php')">
                    &nbsp;&nbsp;<img src="images/icon_set2/eye.ico" width="20"> <span>ติดตาม/ประเมินผล</span></a>
            </li>
            <li class=""> <a href="#" onclick="sendget('test_index.php','index_content')">
                    &nbsp;&nbsp;<img src="images/bin1.png" width="20"> <span>รายการความเสี่ยงในถังขยะ</span></a>
            </li>
                  <li>
                  <a href="#">&nbsp;&nbsp;<img src="images/icon_set2/piechart.ico" width="20"> รายงานคณะกรรมการ <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#" onClick="window.open('content/pre_data_billimp.php?method=upd','','width=600,height=700'); return false;" title="Update ข้อมูล BILLDISP จาก HOS"><i class="fa fa-circle-o text-aqua"></i> ข้อมูล BILLDISP ที่นำเข้าแล้ว </a></li>
                    <li><a href="#" onClick="window.open('content/pre_data_billtran.php?method=upd','','width=600,height=700'); return false;" title="Update ข้อมูล BILLTRAN จาก HOS"><i class="fa fa-circle-o text-aqua"></i> ข้อมูล BILLTRAN ที่นำเข้าแล้ว </a></li>
                    </ul>
            </li>
              </ul>
            </li>
                       <li class="treeview">
              <a href="#">
                  <img src="images/menu_items_options.ico" width="20">
                <span>เมนูผู้ใช้ทั่วไป</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php } ?>
            <li class=""><a href="index.php?page=content/frm_write_risk">
                    <img src="images/icon_set2/compose.ico" width="20"> <span>เขียนความเสี่ยง</span></a>
            </li>
            <li class=""><a href="#" onclick="loadPage('#index_content','content/test_index.php')">
                    <img src="images/icon_set2/clipboard.ico" width="20"> <span>ความเสี่ยงที่ได้รับ</span></a>
            </li>
            <li class=""><a href="#" onclick="loadPage('#index_content','content/test.php')">
                    <img src="images/icon_set2/folder.ico" width="20"> <span>ประวัติการรายงานความเสี่ยง</span></a>
            </li>
            <li class="treeview">
              <a href="#">
                  <img src="images/icon_set2/piechart.ico" width="20">
                <span>รายงานหน่วยงาน</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                  <a href="#"><i class="fa fa-circle-o text-blue"></i> ส่งออก BILLDISP <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                <li><a href="#" onClick="window.open('content/select_date_billimp.php?method=exp_total','','width=400,height=250'); return false;" title="ส่งออกข้อมูล BILLDISP ทั้งหมด"><i class="fa fa-circle-o text-green"></i> ส่งออก BILLDISP(ทั้งหมด)</a></li>
                <li><a href="#" onClick="window.open('content/select_date_billimp.php?method=exp','','width=900,height=800'); return false;" title="ส่งออกข้อมูล BILLDISP เลือกได้ไม่เกิน 124 ราย"><i class="fa fa-circle-o text-green"></i> ส่งออก BILLDISP(เลือก)</a></li>
                  </ul>
                  </li>
                  <li>
                  <a href="#"><i class="fa fa-circle-o text-blue"></i> ส่งออก BILLTRAN <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#" onClick="window.open('content/select_date_billtran.php?method=exp_total','','width=400,height=250'); return false;" title="ส่งออกข้อมูล BILLTRAN ทั้งหมด"><i class="fa fa-circle-o text-green"></i> ส่งออก BILLTRAN(ทั้งหมด)</a></li>
                    <li><a href="#" onClick="window.open('content/select_date_billtran.php?method=exp','','width=900,height=800'); return false;" title="ส่งออกข้อมูล BILLTRAN เลือกได้ไม่เกิน 124 ราย"><i class="fa fa-circle-o text-green"></i> ส่งออก BILLTRAN(เลือก)</a></li>
                  </ul>
                  </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-orange"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> #</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> #</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php if(($_SESSION['rm_status'])=='Y'){ ?>
            </ul>
            </li>
            <li class=""><a href="#" onclick="window.open('form-format/manual_risk(admin).pdf','','width=750,height=1000'); return false;">
                    <img src="images/icon_set2/booklet.ico" width="20"> <span>คู่มือโปรแกรมความเสี่ยง</span></a>
            </li>
            <?php }}else{ ?>
            <li class=""><a href="#" onclick="sendget('knowledge.php','index_content')">
                    <img src="images/icon_set2/bookshelf.ico" width="20"> <span>ความรู้เกี่ยวกับความเสี่ยง</span></a>
            </li>
            <li class="treeview">
              <a href="#">
                  <img src="images/Import.ico" width="20">
                <span>ดาวน์โหลดแบบฟอร์ม</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                    <li><a href="form-format/RM 1.doc" title="แบบรายงานอุบัติการณ์ความเสี่ยง"><i class="fa fa-circle-o text-aqua"></i> แบบรายงานความเสี่ยง </a></li>
                    <li><a href="form-format/RCA.doc" title="แบบฟอร์ม RCA"><i class="fa fa-circle-o text-aqua"></i> แบบฟอร์ม RCA </a></li>
                    </ul>
            </li>
            <li class=""><a href="#" onclick="window.open('form-format/manual_risk.pdf','','width=750,height=1000'); return false;">
                    <img src="images/icon_set2/booklet.ico" width="20"> <span>คู่มือโปรแกรมความเสี่ยง</span></a>
            </li>
            <?php } ?>
            <li class=""><a href="#" onclick="loadPage('#index_content','content/about.php')">
                    <img src="images/Paper Mario.ico" width="20"> <span>เกี่ยวกับ</span></a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
