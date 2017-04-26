<?php include_once '../head.php';
    $column = "{".
        "\"เดือน\":[],".
        "\"admit\":[\"ชาย1\", \"ชาย2\", \"หญิง\"],".
        "\"discharge\":[\"ชาย1\", \"ชาย2\", \"หญิง\"]".
    "}";
    $data = "[".
        "{\"month_name\":\"ตุลาคม\" ,\"adm1\":\"93\",\"adm2\":\"88\",\"adw\":\"51\",\"dchm1\":\"100\",\"dchm2\":\"84\",\"dchw\":\"38\"},".
        "{\"month_name\":\"พฤศจิกายน\" ,\"adm1\":\"83\",\"adm2\":\"81\",\"adw\":\"48\",\"dchm1\":\"88\",\"dchm2\":\"88\",\"dchw\":\"62\"}".
    "]";
    $jsonColumn = json_encode($column);
    
    $month = "['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']";
    $dataCharts = "[".
    //"{\"name\":\"เดือน\",\"data\":[\"ม.ค.\",\"ก.พ.\",\"มี.ค.\",\"เม.ย.\",\"พ.ค.\",\"มิ.ย.\",\"ก.ค.\",\"ส.ค.\",\"ก.ย.\",\"ต.ค.\",\"พ.ย.\",\"ธ.ค.\"]},"+
    "{'name':'รวม','data':[4,6,8,10,17],},".
    "{'name':'ชาย','data':[0,1,2,3,8]},".
    "{'name':'หญิง','data':[4,5,6,7,9]}".
"]";
    $dataBarCharts = "[".
    "{'name':'ชาย','data':[-0,-1,-2,-3,-8,-10,-11,-12,-13,-14,-15,-16]},".
    "{'name':'หญิง','data':[4,5,6,7,9,17,18,19,20,21,22,23]}".
"]";
    $container = "container";$title = "ทดสอบการสร้าง Charts";
    
                       //out.println(dataCharts);
               
    $dataStrack = "[{ name: 'John',data: [5, 3, 4, 7, 2],stack: 'male'}, "
            ."{ name: 'Joe',data: [3, 4, 4, 2, 5],stack: 'male'}, "
            ."{ name: 'Jane',data: [2, 5, 6, 2, 1],stack: 'female'},"
            ."{ name: 'Janet',data: [3, 0, 4, 4, 3],stack: 'female'}]";
    
                // Pie Chart //
               
                    $dataPie = "[{".
            "name: 'Brands',".
            "data: [".
                "['Microsoft Internet Explorer',56.33],".
                "['Chrome',24.03],".
                "['Firefox',10.38],".
                "['Safari',4.77], ".
                "['Opera',0.91],".
                "['Proprietary or Undetectable',0.2]".
            "]}]";
                    ?>

<div class="col-md-12">
    <div class="col-md-6"><div id="container" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
    <div class="col-md-6"><div id="container1" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
</div>
<div class="col-md-12">
    <div class="col-md-6"><div id="container3" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
    <div class="col-md-6"><div id="container4" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
</div>
<div class="col-md-12">
    <div class="col-md-6"><div id="container2" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
    <div class="col-md-6"><div id="container5" style="width: 100%; height: 100%; margin: 0 auto"></div></div>
</div>
<script language="Javascript" type="text/javascript">
    ///////รับค่า String จาก JSP แล้วแปลงเป็น String ของ javascript จากนั้นก็แปลงเป็น object////////
    var DataCharts = JSON.stringify(<?= $dataCharts?>)
    var jspCharts = JSON.parse(DataCharts);
    ///////รับค่า String จาก JSP แล้วแปลงเป็น String ของ javascript จากนั้นก็แปลงเป็น object////////
    var month = JSON.stringify(<?= $month?>);
    var jspmonth = JSON.parse(month);
    var container = "container";
    var type = "column";
    var title = "ทดสอบการสร้าง Charts ด้วย Class Javascript";
    var subtitle = "รายเดือน";
    var unit = "คน";
</script>
<!--Column Chart -->
<script language="Javascript" type="text/javascript">
var CCharts1 =  new createCharts(container,type,title,unit,jspmonth,jspCharts,subtitle);
      //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(CCharts1.GetCL()); 
</script>
<!-- Line Chart -->
<script lang="Javascaript" type="text/javascript">
    var CCharts =  new createCharts('container1','line',title,unit,jspmonth,jspCharts,'แยกรายเดือนนะจ๊ะ');
      //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(CCharts.GetCL()); 
</script>
<!-- Bar Charts -->
<script type="text/javascript">
    var BarCharts = JSON.stringify(<?= $dataBarCharts?>);
    var jspBarCharts = JSON.parse(BarCharts);
    var BarCharts =  new createCharts('container3','bar',title,unit,jspmonth,jspBarCharts,'แยกรายเดือนนะ');
    $(document).ready(BarCharts.GetBar()); 
</script>
<script type="text/javascript">
    var PieCharts = JSON.stringify(<?= $dataPie?>);
    var jspPieCharts = JSON.parse(PieCharts);
    var PieCharts =  new createCharts('container4','pie',title,'','',jspPieCharts,'');
    $(document).ready(PieCharts.GetPie()); 
</script>
<!-- Column Strack Charts -->
<script type="text/javascript">
    var StrackCharts = JSON.stringify(<?= $dataStrack?>);
    var jspStrackCharts = JSON.parse(StrackCharts);
    var StrackCharts =  new createCharts('container2','column',title,unit,jspmonth,jspStrackCharts,subtitle);
    $(document).ready(StrackCharts.GetCLStrack()); 
</script>
<script language="Javascript" type="text/javascript">
    var column2 = '{'+
        '"เดือน":[],'+
        '"admit":["ชาย10", "ชาย20", "หญิง0"],'+
        '"discharge":["ชาย10", "ชาย20", "หญิง0"]'+
    '}';
    var data2 = '['+
        '{"month_name":"ตุลาคม" ,"adm1":"930","adm2":"880","adw":"510","dchm1":"1000","dchm2":"840","dchw":"380"},'+
        '{"month_name":"ตุลาคม" ,"adm1":"930","adm2":"880","adw":"510","dchm1":"1000","dchm2":"840","dchw":"380"},'+
        '{"month_name":"พฤศจิกายน" ,"adm1":"830","adm2":"810","adw":"480","dchm1":"880","dchm2":"880","dchw":"620"}'+
    ']';    
    var tid = 'dbtable1';
    var tid3 = 'dbtable3';
     var tid2 = 'dbtable2';
              var jspcolumn = <?= $jsonColumn ?>;//เรียกข้อมูลที่ json encode
              var jspdata = JSON.stringify(<?= $data ?>);//แปลงข้อมูด้วยJSON.stringify
              
              var CTb1 = new createTable(jspcolumn,tid);
              CTb1.GetTable(jspdata,'contentTB');
              //CTb1.GetBody();
              
              var CTb2 = new createTable(column2,tid2);
              CTb2.GetTable(data2,'contentTB2');
              //$("#contentTB2").append(CTb2.GetBody());
              
              var CTb3 = new createTable(jspcolumn,tid3);
              //$("#contentTB3").html(CTb3.GetTableAjax('TestDataTable.json'));
              CTb3.GetTableAjax('JsonData/TestDataTable.json','contentTB3');
              
              var CTb4 = new createTable(jspcolumn);
              //$("#contentTB3").html(CTb3.GetHead());
              CTb4.GetTableAjax('JsonData/DataTable.json','contentTB4');
</script>
<div class="row">
    <div class="col-md-6">
        <span id="contentTB"></span>
    </div>
    <div class="col-md-6">
        <span id="contentTB2"></span>
    </div>
    <div class="col-md-6">
        <span id="contentTB3"></span>
    </div>
    <div class="col-md-6">
        <span id="contentTB4"></span>
    </div>
    <div class="col-md-6">
        <span id="showData"></span>
    </div>
</div>
<?php include_once '../foot.php';?>