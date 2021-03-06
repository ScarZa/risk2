<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ระบบบริหารความเสี่ยง</title>
        <LINK REL="SHORTCUT ICON" HREF="<?= isset($pic) ? $fol . $pic : '' ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="template/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="template/plugins/font-awesome-4.6.3/css/font-awesome.min.css">
        <!-- jQuery 2.1.4 -->
        <script src="template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
         <!-- Ionicons -->
        <link href="template/bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="template/plugins/iCheck/flat/blue.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="template/plugins/iCheck/all.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="template/plugins/datatables/dataTables.bootstrap.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="template/plugins/select2/select2.min.css">
       <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <script src="template/plugins/excellentexport.js"></script>
        
<!--HighChart-->
    <script src="template/plugins/Highcharts/code/highcharts.js"></script>
    <script src="template/plugins/Highcharts/code/modules/exporting.js"></script>
    <script src="template/plugins/Highcharts/code/modules/data.js"></script>
    <script src="template/plugins/Highcharts/code/modules/drilldown.js"></script>
    <script src="template/plugins/Highcharts/code/highcharts-3d.js"></script>
    
        <script language="Javascript" type="text/javascript" src="js/sendGetPost.js"></script>
        <script src="js/createTable.js" type="text/javascript"></script>
        
        <script src="js/AJAXCharts.js" type="text/javascript"></script>
        <script src="template/plugins/json2/json2.js" type="text/javascript"></script><!-- JSON2 -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
                <style type="text/css">
            .black-ribbon {   position: fixed;   z-index: 9999;   width: 70px; }
            @media only all and (min-width: 768px) { .black-ribbon { width: auto; } }

            .stick-left { left: 0; }
            .stick-right { right: 0; }
            .stick-top { top: 0; }
            .stick-bottom { bottom: 0; }
        </style>
        <script type="text/javascript">
            function resizeIframe(obj)// auto height iframe
            {
                {
                    obj.style.height = 0;
                }
                ;
                {
                    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
                }
            }
        </script>
        <script type="text/javascript">
            function getRefresh() {
                $("#autoRefresh").show("slow");
                $("#autoRefresh").load("content/refresh_risk.php", '', callback);
            }

            function callback() {
                $("#autoRefresh").fadeIn("slow");
                setTimeout("getRefresh();", 1000);
            }

            $(document).ready(getRefresh);
        </script>
        <script language="JavaScript">
            var HttPRequest = false;
            function doCallAjax(Sort) {
                HttPRequest = false;
                if (window.XMLHttpRequest) { // Mozilla, Safari,...
                    HttPRequest = new XMLHttpRequest();
                    if (HttPRequest.overrideMimeType) {
                        HttPRequest.overrideMimeType('text/html');
                    }
                } else if (window.ActiveXObject) { // IE
                    try {
                        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                        }
                    }
                }
                if (!HttPRequest) {
                    alert('Cannot create XMLHTTP instance');
                    return false;
                }
                var url = 'content/refresh_risk.php';
                var pmeters = 'mySort=' + Sort;
                HttPRequest.open('POST', url, true);
                HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //HttPRequest.setRequestHeader("Content-length", pmeters.length);
                //HttPRequest.setRequestHeader("Connection", "close");
                HttPRequest.send(pmeters);
                HttPRequest.onreadystatechange = function ()
                {
                    if (HttPRequest.readyState == 3)  // Loading Request
                    {
                        document.getElementById("mySpan").innerHTML = "Now is Loading...";
                    }
                    if (HttPRequest.readyState == 4) // Return Request
                    {
                        document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                    }
                }
            }
        </script>
        <script type="text/javascript">
            function popup(url, name, windowWidth, windowHeight) {
                myleft = (screen.width) ? (screen.width - windowWidth) / 2 : 100;
                mytop = (screen.height) ? (screen.height - windowHeight) / 2 : 100;
                properties = "width=" + windowWidth + ",height=" + windowHeight;
                properties += ",scrollbars=yes, top=" + mytop + ",left=" + myleft;
                window.open(url, name, properties);
            }
        </script>
        <script type="text/javascript">
            function inputDigits(sensor) {
                var regExp = /[0-9.-/]$/;
                if (!regExp.test(sensor.value)) {
                    alert("กรอกตัวเลขเท่านั้นครับ");
                    sensor.value = sensor.value.substring(0, sensor.value.length - 1);
                }
            }
        </script>
        <!--scrip check ตัวอักษร-->
        <script type="text/javascript">
            function inputString(sensor) {
                var regExp = /[A-Za-zก-ฮะ-็่-๋์/]$/;
                if (!regExp.test(sensor.value)) {
                    alert("กรอกตัวอักษรเท่านั้นครับ");
                    sensor.value = sensor.value.substring(0, sensor.value.length - 1);
                }
            }

        </script>
        <script type="text/javascript">
            function nextbox(e, id) {
                var keycode = e.which || e.keyCode;
                if (keycode == 13) {
                    document.getElementById(id).focus();
                    return false;
                }
            }
        </script>
        <?php
    if (null !== (filter_input(INPUT_GET, 'popup'))) {
        $popup = filter_input(INPUT_GET, 'popup');
        $popup_name = filter_input(INPUT_GET, 'popname');
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_ENCODED);
        $date = filter_input(INPUT_GET, 'date');
        $cod_popup = "window.open('content/pop_$popup_name.php?date=$date&id=$id','','width=470,height=450'); return false;";
    }

    function insert_date($take_date_conv) {
            $take_date = explode("-", $take_date_conv);
            $take_date_year = @$take_date[2] - 543;
            $take_date = "$take_date_year-" . @$take_date[1] . "-" . @$take_date[0] . "";
            return $take_date;
        }

        function edit_date($take_date) {

            $take_date = explode("-", $take_date);
            $pyear = $take_date[0] + 543;
            $take_date = "$take_date[2]-$take_date[1]-$pyear";
            return $take_date;
        }
    ?>
    </head>
    