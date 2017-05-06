<?php include '../head.php';
function __autoload($class_name) {
    include '../class/' . $class_name . '.php';
}
include_once ('../template/plugins/funcDateThai.php');
set_time_limit(0);
$conn_DB= new EnDeCode();
$read="../connection/conn_DB.txt";
$conn_DB->para_read($read);
$conn_DB->Read_Text();
$conn_DB->conn_PDO();

$takerisk_id = $_POST['data'];
$sql="select concat(u1.user_fname,' ',u1.user_lname) as user_write_name,t1.*,d1.name as department_name ,p1.name as place_name  ,c1.name as category_name ,s1.name as subcategory_name,t1.detail_recycle,t1.recycle 
,t1.move_status,t1.receive_date,
(select concat(u1.user_fname,' ',u1.user_lname) from takerisk t1 LEFT OUTER JOIN user u1 ON u1.user_id=t1.receiver where t1.takerisk_id='$takerisk_id') user_receiver,
(select concat(u1.user_fname,' ',u1.user_lname) from takerisk t1 LEFT OUTER JOIN user u1 ON u1.user_id=t1.return_user where t1.takerisk_id='$takerisk_id') return_user    
from takerisk t1
LEFT OUTER JOIN department d1 ON d1.dep_id=t1.res_dep
LEFT OUTER JOIN place p1 ON p1.place=t1.take_place
LEFT OUTER JOIN category c1 ON c1.category=t1.category
LEFT OUTER JOIN user u1 ON u1.user_id=t1.user_id
LEFT OUTER JOIN subcategory s1 ON s1.subcategory=t1.subcategory
where t1.takerisk_id= :takerisk_id";
$conn_DB->imp_sql($sql);
$execute=array(':takerisk_id' => $takerisk_id);
$result=$conn_DB->select_a($execute);
?>
            <h2 style="color: blue">รายละเอียด/ดำเนินการความเสี่ยง</h2>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <?php  if($_SESSION['rm_status']=='Y' or $_SESSION['rm_status']=='A'){?>
              <li><a href="listRiskInBox.php"><i class="fa fa-envelope"></i> ความเสี่ยงที่ได้รับ</a></li>
              <?php }?>
              <li class="active"><i class="fa fa-envelope"></i> รายละเอียด/ดำเนินการความเสี่ยง</li>
            </ol>
            <div class="row">
    <div class="col-md-12">
        <!-- ค้นหา -->
          
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title"> รายละเอียดความเสี่ยง โอกาสที่จะประสบกับความสูญเสีย หรือสิ่งไม่พึงประสงค์ โอกาสความน่าจะเป็นที่จะเกิดอุบัติการณ์ </h4>
                    <div class="box-tools pull-right">
                        <a href="#" onClick="window.open('detailRiskInBox_PDF.php?takerisk_id=<?= $takerisk_id?>','','width=700,height=900'); return false;" title="ปริ้นท์หน้านี้">
              <input type="image" src='images/printer.png' onclick="" align="right" title='ปริ้นท์หน้านี้'></a>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
              <table width='auto'>
              <thead>
              <tr><th width='30%' valign="top">HN : </th><td  width='70%'><?= $result['hn']?></td></tr>    
              <tr><th valign="top">AN : </th> <td><?= $result['an']?></td></tr>
              <tr><th valign="top">บุคลากรที่ประสบเหตุการณ์ : </th> <td><?= $result['take_other']?></td></tr>  
              <tr><th valign="top">วันที่เกิดเหตุ : </th> <td><?php echo DateThai1($result['take_date']);?></td></tr> 
               <tr><th valign="top">เวลา : </th> <td><?= $result['take_time']?></td></tr>
               <tr><th valign="top">วันที่บันทึกความเสี่ยง : </th> <td><?= DateThai1($result['take_rec_date'])?></td></tr>
               <tr><th valign="top">สถานที่เกิดเหตุ : </th> <td><?= $result['place_name']?></td></tr> 
               <tr><th valign="top">หน่วยงานที่เกี่ยวข้อง : </th> <td><?= $result['department_name']?></td></tr> 
               <tr><th valign="top">หมวดความเสี่ยง : </th> <td><?= $result['category_name']?></td></tr>
               <tr><th valign="top">รายการความเสี่ยง : </th> <td><?= $result['subcategory_name']?></td></tr>
               <tr><th valign="top">ระดับ : </th> <td><?= $level_risk=$result['level_risk']?></td></tr>  
               <tr><th valign="top">รายละเอียดเหตุการณ์ความเสี่ยง : </th> <td><?= $result['take_detail']?></td></tr> 
	       <tr><th valign="top">การแก้ไขเบื้องต้น : </th> <td><?= $result['take_first']?></td></tr> 
               <tr><th valign="top">ข้อเสนอแนะ : </th> <td><?= $result['take_counsel']?></td></tr>
               <tr><th valign="top">ไฟล์แนบ : </th> <td>
               <?php 
               if($result['take_file1']!=''){echo "<a href='myfile/".$result['take_file1']."' target='_blank'><span class='fa fa-download'></span> Download File"."<br />";}
               ?></td></tr>  
             <?php if(!empty($_GET['lookdep'])){  echo "<tr><th>ผู้เขียน : </th><td> ".$result['user_write_name']." </td></tr>"; }            ?>  
               
	     <?php 		
		if($_SESSION['rm_status']=='Y'){ echo "<tr><th>ผู้เขียน : </th><td> ".$result['user_write_name']." <font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>"; ?>
                                 <tr><th>ผู้แจ้งย้าย : </th><td> <?= $result['user_receiver']?>  &nbsp;&nbsp;<b>วันที่ :</b> <?php if($result['receive_date']!='0000-00-00'){ echo DateThai1($result['receive_date']);}?><font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>
               <?php } 
               if($result['return_risk']=='Y'){?>
               <tr><th>ผู้ส่งคืน : </th><td> <?= $result['return_user']?>  &nbsp;&nbsp;<b>วันที่ :</b> <?php if($result['return_date']!=NULL){ echo DateThai1($result['return_date']);}?><font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>   
                                            
               <?php }
               if($result['recycle']=='Y'){ ?>
               <tr><th valign="top">เหตุผลที่ย้ายลงถังขยะ : </th> <td><?= $result['detail_recycle']?></td></tr>
               <?php }?>
              </thead>

               <div class="text-right" style="float: right;width: auto">
               <?php 
               $takerisk = $result['takerisk_id'];
               $sql="select mng_status from mngrisk where takerisk_id=:takerisk";
               $conn_DB->imp_sql($sql);
                $execute=array(':takerisk' => $takerisk);
                $resultCheckMove = $conn_DB->select_a($execute);
               if(($resultCheckMove['mng_status']=='N' and $result['res_dep']==$_SESSION['rm_dep']) or $_SESSION['rm_status']=='A'){
               ?>
                   <a href='prcWriteRisk.php?method=move_risk&takerisk_id=<?=$result[takerisk_id]?>'>ส่งคืนความเสี่ยง <i class="fa fa-arrow-circle-left"></i></a><br><br>
                <?php } 
                if(($_SESSION['rm_status']=='Y' or $_SESSION['rm_status']=='A') and $result['recycle']=='N'){?>
                 <a href="#" onclick="return popup('pass_risk.php?takerisk_id=<?=$result['takerisk_id']?>',popup,400,300);">ส่งต่อความเสี่ยง <i class="fa fa-arrow-circle-right"></i></a>
                <?php } if($_SESSION['rm_status']=='Y' and $result['recycle']=='N'){?>
            <br><br><a href='frmWriteRisk.php?method=edit&takerisk_id=<?=$result['takerisk_id']?>'>แก้ไขข้อความไม่เหมาะสม <i class="fa fa-edit"></i></a>
            <br><br><a href='frmWriteRisk.php?check=1&method=edit&&takerisk_id=<?=$result['takerisk_id']?>'>แก้ไขหมวดและรายการความเสี่ยง <i class="fa fa-edit"></i></a>
            <br><br><a href='detail_recycle.php?takerisk_id=<?=$result['takerisk_id']?>'>ย้ายเข้าถังขยะ <i class="fa fa-trash-o"></i></a>
            <br><br><a href='prcNomal_RcaForm.php?takerisk_id=<?=$result['takerisk_id']?>'>ย้ายไปประเมิน <i class="fa fa-bolt"></i></a>
                <?php } ?>
		
                </div>
              </table>
                    </div>
            </div>
    </div>
</div>

