<?php include_once '../head.php';
function __autoload($class_name) {
    include '../class/'.$class_name.'.php';
}
//include 'class/TablePDO.php';
set_time_limit(0);
$conn_DB= new EnDeCode();
$read="../connection/conn_DB.txt";
$conn_DB->para_read($read);
$conn_db=$conn_DB->Read_Text();
$conn_DB->conn_PDO();

$month="[";
    for ($i = -2; $i <= 9; $i++) {

                        $sqlMonth = "select * from month where m_id='$i'";
                        $conn_DB->imp_sql($sqlMonth);
                        $monthdata=$conn_DB->select_a();
    $month.="'".$monthdata['month_short']."'" . ',';
    }
    $month.="]";
                    ?>
<?php   include_once '../template/plugins/function_date.php';
        include_once '../template/plugins/funcDateThai.php';
if (empty($_GET['year'])) {
     if($date >= $bdate and $date <= $edate){
                             $y= $Yy;
                             $Y= date("Y");
                             $year = $Yy;
                             $years = $year + 543;
                            }else{
                            $y = date("Y");
                            $Y = date("Y") - 1;
                            $year = date('Y');
                            $years = $year + 543;
                            }
                        } else {
                            $YeaR=$_GET['year'];
                            $y = $_GET['year'] - 543;
                            $Y = $y - 1;
                            $year = $_POST['year'] - 543;
                            $years = $year + 543;
                        }
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                            $sql_sum = "select count(t1.takerisk_id) as sum from takerisk t1
                                                    inner join mngrisk m1 on t1.takerisk_id=m1.takerisk_id
                                                    Where   recycle='N' and subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'";
                            $conn_DB->imp_sql($sql_sum);
                            $sum_rm=$conn_DB->select_a();
                            $sql_D = "select count(t1.takerisk_id) as sumD from takerisk t1
                                                    inner join mngrisk m1 on t1.takerisk_id=m1.takerisk_id
                                                    where m1.admin_check='' and t1.recycle='N' and m1.mng_status='N' and t1.subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'";
                            $conn_DB->imp_sql($sql_D);
                            $sum_rmD = $conn_DB->select_a();
                            $sql_D2 = "select count(t1.takerisk_id) as sumD2 from takerisk t1
                                                    inner join mngrisk m1 on m1.takerisk_id=t1.takerisk_id
                                                    where m1.admin_check='' and t1.recycle='N' and m1.mng_status='Y' and t1.subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'";
                            $conn_DB->imp_sql($sql_D2);
                            $sum_rmD2 = $conn_DB->select_a();
                            $sql_G = "select count(t1.takerisk_id) as sumG from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                        where admin_check='G' and t1.recycle='N' 
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'";
                            $conn_DB->imp_sql($sql_G);
                            $sum_rmG = $conn_DB->select_a();
                            $sql_Y = "select count(t1.takerisk_id) as sumY from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                            where admin_check='Y' and t1.recycle='N'
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'";
                            $conn_DB->imp_sql($sql_Y);
                            $sum_rmY = $conn_DB->select_a();
                            $sql_R = "select count(t1.takerisk_id) as sumR from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                            where admin_check='R' and t1.recycle='N'
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'";
                            $conn_DB->imp_sql($sql_R);
                            $sum_rmR = $conn_DB->select_a();
                            ?>
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?= $sum_rm['sum']?></h3>
                  <p>ความเสี่ยงทั้งหมด</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bomb"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $sum_rmD['sumD']?></h3>
                  <p>รอทบทวน</p>
                </div>
                <div class="icon">
                  <i class="fa fa-question-circle"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                <div class="inner">
                  <h3><?= $sum_rmD2['sumD2']?></h3>
                  <p>รอประเมิน</p>
                </div>
                <div class="icon">
                  <i class="fa fa-question-circle"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?= $sum_rmY['sumY']?></h3>
                  <p>กำลังดำเนินการ</p>
                </div>
                <div class="icon">
                  <i class="fa fa-wrench"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?= $sum_rmR['sumR']?></h3>
                  <p>ทบทวนซ้ำ</p>
                </div>
                <div class="icon">
                  <i class="fa fa-times-circle"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?= $sum_rmG['sumG']?><sup style="font-size: 20px"></sup></h3>
                  <p>ผ่านประเมิน</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check-circle"></i>
                </div>
                <a href="#" class="small-box-footer">ดูรายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <div class="row">  
       <div class="col-lg-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Traffic Statistics:
                    <?php
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                        echo $date_start = DateThai1($date_start);
                        echo " ถึง ";
                        echo $date_end = DateThai2($date_end);
                    ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <center>รายงานความเสี่ยง : ทั้งหมด&nbsp;&nbsp;ปีงบประมาณ : <?=$years?></center>
                    <div class="col-lg-12"><div id="container1" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
                    <div class="col-lg-7"><div id="container2" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
                    <div class="col-lg-5"><div id="container3" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
                </div>
            </div>
        </div>
          </div>

<script language="Javascript" type="text/javascript">
    var month = JSON.stringify(<?= $month?>);
    var jspmonth = JSON.parse(month);
    var title1 = "จำนวนความเสี่ยงในแต่ละหมวดแยกรายเดือน";
    var title2 = "ความเสี่ยงแยกตามด้านในปีงบประมาณ <?=$years?>";
    var title3 = "ความเสี่ยงแยกระดับความรุนแรงในปีงบประมาณ <?=$years?>";
    var subtitle = "รายเดือน";
    var unit = "ครั้ง";
</script>
<!-- Line Chart -->
<script lang="Javascaript" type="text/javascript">
    var CCharts =  new AJAXCharts('container1','line',title1,unit,jspmonth,'JsonData/DC_line1.php',subtitle);
    $(CCharts.GetCL()); 
</script>
<!-- Pie Chart -->
<script type="text/javascript">  
    var PieCharts =  new AJAXCharts('container2','pie',title2,unit,'','JsonData/DC_pie1.php','');
    $(PieCharts.GetPie()); 
</script>
<!-- Pie Chart -->
<script type="text/javascript">
    var PieCharts =  new AJAXCharts('container3','pie',title3,unit,'','JsonData/DC_pie2.php','');
    $(PieCharts.GetPie()); 
</script>

<script language="Javascript" type="text/javascript">
    var column1 = '["เดือน","จำนวนเรื่อง"]';
    var column2 = '["ชื่อ-นามสกุล","จำนวนเรื่อง"]';
    var tid = 'dbtable1';
    var tid3 = 'dbtable3';
    var tid2 = 'dbtable2';
              
              var CTb1 = new createTable(column1);
              CTb1.GetTableAjax('JsonData/DT_Statistics.php','contentTB1');
              
              var CTb3 = new createTable(column2);
              CTb3.GetTableAjax('JsonData/DT_Top10.php','contentTB3');
</script>
<div class="row">
       <div class="col-md-4">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h5 class="box-title"><i class="fa fa-calendar"></i> Statistics:
                    <?php
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                        echo $date_start = DateThai1($date_start); 
                        echo " ถึง ";
                        echo $date_end = DateThai1($date_end);
                    ?>
                        </h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
        <span id="contentTB1"></span>
                </div></div></div>
    <div class="col-md-4">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-clock-o"></i> User Online </h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
        <div class="list-group">
                        <?php
                        include_once '../function/timeLoginFacebook.php';
                        $sql = "select * from user   order by time_login  DESC LIMIT 12";
                        $conn_DB->imp_sql($sql);
                        $result=$conn_DB->select();
                        for ($i=0;$i<count($result);$i++) {
                            $result[$i]['date_login'];
                            $result[$i]['time_login'];
                            $Format = date("d M Y H:i");
                            $Timestamp = $result[$i]['time_login'];
                            $Language = "th";
                            $TimeText = "true";
                            $time = generate_date_today("d M Y H:i", ($Timestamp), "th", true);
                            ?>
                            <a href="#" class="list-group-item">
                                <span class="pull-right badge bg-green"><?= $time?></span>
                                <i class="fa fa-user"></i> <?= $result[$i]['user_fname'] . ' ' . $result[$i]['user_lname']?>
                            </a>
    <?php } // end time login    ?>   
                    </div>
    </div></div></div>
    <div class="col-md-4">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-star"></i> ผู้เขียนความเสี่ยงสูงสุด TOP 10 </h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div id="contentTB3"></div>
    </div></div></div>
</div>
<?php include_once '../foot.php';?>