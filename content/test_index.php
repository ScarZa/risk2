<h1>Hello World!</h1>
<?php
$column = "{" .
        "\"เดือน\":[]," .
        "\"admit\":[\"ชาย1\", \"ชาย2\", \"หญิง\"]," .
        "\"discharge\":[\"ชาย1\", \"ชาย2\", \"หญิง\"]" .
        "}";
$data = "[" .
        "{\"month_name\":\"ตุลาคม\" ,\"adm1\":\"93\",\"adm2\":\"88\",\"adw\":\"51\",\"dchm1\":\"100\",\"dchm2\":\"84\",\"dchw\":\"38\"}," .
        "{\"month_name\":\"พฤศจิกายน\" ,\"adm1\":\"83\",\"adm2\":\"81\",\"adw\":\"48\",\"dchm1\":\"88\",\"dchm2\":\"88\",\"dchw\":\"62\"}" .
        "]";
$jsonColumn = json_encode($column);
?>
<form name="form1" action="" onsubmit="return false">
    <div class="form-group has-warning">
        <input type="text" name="data" value="test POST1">&nbsp;&nbsp;
    </div>
    <input type="text" name="data" value="test POST2">&nbsp;&nbsp;            
    <input type="text" name="data" value="test POST3">&nbsp;&nbsp;
    <input type="checkbox" name="data" value="test POST4">&nbsp;&nbsp;
    <script type="text/javascript" lang="javascript">
        var DP = new DatepickerThai();
        DP.GetDatepicker('#datepicker');
        DP.GetDatepicker('#datepicker2');
        DP.GetDatepicker('#datepicker3');
    </script>
    <input type="text" id="datepicker3" name="data" readonly>&nbsp;&nbsp;
    <textarea name="data"></textarea>
    <input type="radio" name="data" value="test POST5">&nbsp;&nbsp;
    <input type="radio" name="data" value="test POST6">&nbsp;&nbsp;
    <div class="form-group">
        <select name="data" class="form-control select2" style="width: 100%;">
            <option  placeholder="aa"></option>
            <option value="1">01</option>
            <option value="2">02</option>
        </select>
        <p>Date: <input type="text" id="datepicker" readonly /></p>
        <p>Date: <input type="text" id="datepicker2" readonly /></p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="sendpost('process/testAJAX.php', 'content');">POST</button>
    <button class="btn btn-success btn-sm" onclick="sendpostArray('process/testAJAX.php', 'content')">POST ARRAY</button>
</form>
<br>
<input type="hidden" name="txt" id="txt" value="test GET">&nbsp;&nbsp;
<button class="btn btn-info btn-sm" onClick="sendget('process/testAJAX.php', 'content', txt.value)">GET</button>
<div class="form-group has-success">
    <label class="control-label" for="inputSuccess">Input success</label>
    <input type="text" class="form-control" id="inputSuccess">
</div>
<br />
<div id="content">แสดงผล</div>
<script language="Javascript" type="text/javascript">
    var column2 = '{' +
            '"เดือน":[],' +
            '"admit":["ชาย10", "ชาย20", "หญิง0"],' +
            '"discharge":["ชาย10", "ชาย20", "หญิง0"]' +
            '}';
    var data2 = '[' +
            '{"month_name":"ตุลาคม" ,"adm1":"930","adm2":"880","adw":"510","dchm1":"1000","dchm2":"840","dchw":"380"},' +
            '{"month_name":"ตุลาคม" ,"adm1":"930","adm2":"880","adw":"510","dchm1":"1000","dchm2":"840","dchw":"380"},' +
            '{"month_name":"พฤศจิกายน" ,"adm1":"830","adm2":"810","adw":"480","dchm1":"880","dchm2":"880","dchw":"620"}' +
            ']';
    var tid = 'dbtable1';
    var tid2 = 'dbtable3';
    var tid3 = 'dbtable2';
    var jspcolumn = <?= $jsonColumn ?>;//เรียกข้อมูลที่ json encode
    var jspdata = JSON.stringify(<?= $data ?>);//แปลงข้อมูด้วยJSON.stringify

    var CTb1 = new createTable(jspcolumn, tid);
    CTb1.GetTable(jspdata, 'contentTB');
    //CTb1.GetBody();

    var CTb2 = new createTable(column2, tid2);
    CTb2.GetTable(data2, 'contentTB2');
    //$("#contentTB2").append(CTb2.GetBody());

    var CTb3 = new createTable(jspcolumn, tid3);
    //$("#contentTB3").html(CTb3.GetTableAjax('TestDataTable.json'));
    CTb3.GetTableAjax('JsonData/TestDataTable.json', 'contentTB3');

    var CTb4 = new createTable(jspcolumn);
    //$("#contentTB3").html(CTb3.GetHead());
    CTb4.GetTableAjax('JsonData/DataTable.json', 'contentTB4');
</script>
<script lang="Javascript" type="text/javascript">
    /*$.ajax({
     url : "DataTest",
     dataType : 'json',
     //data : ...,   สามารถส่งข้อมูลไปเพื่อประมวลผลแล้วส่งกลับมาได้ด้วย
     error : function() {
     
     alert("Error Occured");
     },
     success : function(data) {
     var receivedData = [];
     
     $.each(data.jsonArray, function(index) {
     $.each(data.jsonArray[index], function(key, value) {
     var point = [];
     
     point.push(key);
     point.push(value);
     receivedData.push(point);
     $('#showData').html(receivedData);
     }); 
     });
     
     }
     });*/
</script>
<?php
$month = "['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']";
$dataCharts = "[" .
        //"{\"name\":\"เดือน\",\"data\":[\"ม.ค.\",\"ก.พ.\",\"มี.ค.\",\"เม.ย.\",\"พ.ค.\",\"มิ.ย.\",\"ก.ค.\",\"ส.ค.\",\"ก.ย.\",\"ต.ค.\",\"พ.ย.\",\"ธ.ค.\"]},"+
        "{'name':'รวม','data':[4,6,8,10,17],}," .
        "{'name':'ชาย','data':[0,1,2,3,8]}," .
        "{'name':'หญิง','data':[4,5,6,7,9]}" .
        "]";
$dataBarCharts = "[" .
        "{'name':'ชาย','data':[-0,-1,-2,-3,-8,-10,-11,-12,-13,-14,-15,-16]}," .
        "{'name':'หญิง','data':[4,5,6,7,9,17,18,19,20,21,22,23]}" .
        "]";
$container = "container";
$title = "ทดสอบการสร้าง Charts";

//out.println(dataCharts);
?>

<script language="Javascript" type="text/javascript">
    ///////รับค่า String จาก JSP แล้วแปลงเป็น String ของ javascript จากนั้นก็แปลงเป็น object////////
    var DataCharts = JSON.stringify(<?= $dataCharts ?>)
    var jspCharts = JSON.parse(DataCharts);
    ///////รับค่า String จาก JSP แล้วแปลงเป็น String ของ javascript จากนั้นก็แปลงเป็น object////////
    var month = JSON.stringify(<?= $month ?>);
    var jspmonth = JSON.parse(month);
    var container = "container";
    var type = "column";
    var title = "ทดสอบการสร้าง Charts ด้วย Class Javascript";
    var subtitle = "รายเดือน";
    var unit = "คน";
</script>
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
<!--Column Chart -->
<script language="Javascript" type="text/javascript">
    var CCharts1 = new createCharts(container, type, title, unit, jspmonth, jspCharts, subtitle);
    //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(CCharts1.GetCL());
</script>
<!-- Line Chart -->
<script lang="Javascaript" type="text/javascript">
    var CCharts = new createCharts('container1', 'line', title, unit, jspmonth, jspCharts, 'แยกรายเดือนนะจ๊ะ');
    //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(CCharts.GetCL());
</script>
<!-- Bar Charts -->
<script type="text/javascript">
    var BarCharts = JSON.stringify(<?= $dataBarCharts ?>);
    var jspBarCharts = JSON.parse(BarCharts);
    var BarCharts = new createCharts('container3', 'bar', title, unit, jspmonth, jspBarCharts, 'แยกรายเดือนนะ');
    //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(BarCharts.GetBar());
</script>
<!-- Pie Chart -->
<?php
$dataPie = "[{" .
        "name: 'Brands'," .
        "data: [" .
        "['Microsoft Internet Explorer',56.33]," .
        "['Chrome',24.03]," .
        "['Firefox',10.38]," .
        "['Safari',4.77], " .
        "['Opera',0.91]," .
        "['Proprietary or Undetectable',0.2]" .
        "]}]";
?>
<script type="text/javascript">
    var PieCharts = JSON.stringify(<?= $dataPie ?>);
    var jspPieCharts = JSON.parse(PieCharts);
    var PieCharts = new createCharts('container4', 'pie', title, '', '', jspPieCharts, '');
    //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(PieCharts.GetPie());
</script>
<!-- Column Strack Charts -->
<?php
$dataStrack = "[{ name: 'John',data: [5, 3, 4, 7, 2],stack: 'male'}, "
        . "{ name: 'Joe',data: [3, 4, 4, 2, 5],stack: 'male'}, "
        . "{ name: 'Jane',data: [2, 5, 6, 2, 1],stack: 'female'},"
        . "{ name: 'Janet',data: [3, 0, 4, 4, 3],stack: 'female'}]";
?>  
<script type="text/javascript">
    var StrackCharts = JSON.stringify(<?= $dataStrack ?>);
    var jspStrackCharts = JSON.parse(StrackCharts);
    var StrackCharts = new createCharts('container2', 'column', title, unit, jspmonth, jspStrackCharts, subtitle);
    //$(document).ready(chart = new Highcharts.Chart(CCharts.GetCL()));  
    $(document).ready(StrackCharts.GetCLStrack());
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
<script lang="Javascript" type="text/javascript">
    var colors = Highcharts.getOptions().colors,
            categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'],
            data = [{
                    y: 56.33,
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',
                        categories: ['MSIE 6.0', 'MSIE 7.0', 'MSIE 8.0', 'MSIE 9.0', 'MSIE 10.0', 'MSIE 11.0'],
                        data: [1.06, 0.5, 17.2, 8.11, 5.33, 24.13],
                        color: colors[0]
                    }
                }, {
                    y: 10.38,
                    color: colors[1],
                    drilldown: {
                        name: 'Firefox versions',
                        categories: ['Firefox v31', 'Firefox v32', 'Firefox v33', 'Firefox v35', 'Firefox v36', 'Firefox v37', 'Firefox v38'],
                        data: [0.33, 0.15, 0.22, 1.27, 2.76, 2.32, 2.31, 1.02],
                        color: colors[1]
                    }
                }, {
                    y: 24.03,
                    color: colors[2],
                    drilldown: {
                        name: 'Chrome versions',
                        categories: ['Chrome v30.0', 'Chrome v31.0', 'Chrome v32.0', 'Chrome v33.0', 'Chrome v34.0',
                            'Chrome v35.0', 'Chrome v36.0', 'Chrome v37.0', 'Chrome v38.0', 'Chrome v39.0', 'Chrome v40.0', 'Chrome v41.0', 'Chrome v42.0', 'Chrome v43.0'
                        ],
                        data: [0.14, 1.24, 0.55, 0.19, 0.14, 0.85, 2.53, 0.38, 0.6, 2.96, 5, 4.32, 3.68, 1.45],
                        color: colors[2]
                    }
                }, {
                    y: 4.77,
                    color: colors[3],
                    drilldown: {
                        name: 'Safari versions',
                        categories: ['Safari v5.0', 'Safari v5.1', 'Safari v6.1', 'Safari v6.2', 'Safari v7.0', 'Safari v7.1', 'Safari v8.0'],
                        data: [0.3, 0.42, 0.29, 0.17, 0.26, 0.77, 2.56],
                        color: colors[3]
                    }
                }, {
                    y: 0.91,
                    color: colors[4],
                    drilldown: {
                        name: 'Opera versions',
                        categories: ['Opera v12.x', 'Opera v27', 'Opera v28', 'Opera v29'],
                        data: [0.34, 0.17, 0.24, 0.16],
                        color: colors[4]
                    }
                }, {
                    y: 0.2,
                    color: colors[5],
                    drilldown: {
                        name: 'Proprietary or Undetectable',
                        categories: [],
                        data: [],
                        color: colors[5]
                    }
                }],
            browserData = [],
            versionsData = [],
            i,
            j,
            dataLen = data.length,
            drillDataLen,
            brightness;


// Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

// Create the chart
    Highcharts.chart('container5', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Browser market share, January, 2015 to May, 2015'
        },
        subtitle: {
            text: 'Source: <a href="http://netmarketshare.com/">netmarketshare.com</a>'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
                name: 'Browsers',
                data: browserData,
                size: '60%',
                dataLabels: {
                    formatter: function () {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: '#ffffff',
                    distance: -30
                }
            }, {
                name: 'Versions',
                data: versionsData,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function () {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%' : null;
                    }
                }
            }]
    });
</script>
<?php include_once '../foot.php';?>