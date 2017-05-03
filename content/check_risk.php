<?php include '../head.php';
function __autoload($class_name) {
    include '../class/' . $class_name . '.php';
}
set_time_limit(0);
?>
            <h2 style="color: blue">รายการพิจารณา/ตรวจสอบ ความเสี่ยง</h2>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-wrench"></i> รายการแจ้งย้ายความเสี่ยง</li>
            </ol>
             
<script language="Javascript" type="text/javascript">
    var column1 = '{"รายการความเสี่ยงที่รอ RM man มาตรวจสอบ":["เลขที่","รายการ","เกิดขึ้นเมื่อ","ได้รับเมื่อ"]}';
    var tid = 'dbtable1';
    var tid3 = 'dbtable3';
    var tid2 = 'dbtable2';
              var CTb = new createTable(column1,tid);
              CTb.GetTableAjax('JsonData/DT_CR.php','contentTB');
</script>
<div class="row">
    <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-star"></i> รายการความเสี่ยงที่รอ RM man มาตรวจสอบและ ส่งต่อให้ฝ่าย/หน่วยงานที่เกี่ยวข้องได้ดำเนินการแก้ไขต่อไป </h4>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
        <div id="contentTB"></div>
                </div>
            </div>
    </div>
</div>
<?php include '../foot.php'; ?> 