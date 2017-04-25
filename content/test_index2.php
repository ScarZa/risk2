<?php //include_once '../head.php';?>
            <h1>Hello World!</h1>
<form name="form1" action="" onsubmit="return false">
<div class="form-group has-warning"><input type="text" name="data" value="test POST1">&nbsp;&nbsp;</div>
<input type="text" name="data" value="test POST2">&nbsp;&nbsp;            
<input type="text" name="data" value="test POST3">&nbsp;&nbsp;
<input type="checkbox" name="data" value="test POST4">&nbsp;&nbsp;
<input type="radio" name="data" value="test POST5">&nbsp;&nbsp;
<input type="radio" name="data" value="test POST6">&nbsp;&nbsp;
<?= isset($_POST['data'])?$_POST['data']:''?>
<script type="text/javascript" lang="javascript">
    var DP = new DatepickerThai();
              DP.GetDatepicker('#datepicker');
              DP.GetDatepicker('#datepicker2');
              DP.GetDatepicker('#datepicker3');
              DP.GetDatepicker('#datepicker4');
              DP.GetDatepicker('#datepicker5');
              DP.GetDatepicker('#datepicker6');
              DP.GetDatepicker('#datepicker7');
</script>
<input type="text" id="datepicker3" name="data" readonly>&nbsp;&nbsp;
<textarea name="data"></textarea>
<div class="form-group">
<select name="data" class="form-control select2" style="width: 100%;">
    <option  placeholder="aa"></option>
    <option value="1">01</option>
    <option value="2">02</option>
</select>
    <p>Date: <input type="text" id="datepicker" readonly /></p>
    <p>Date: <input type="text" id="datepicker2" readonly /></p>
    <p>Date: <input type="text" id="datepicker4" readonly /></p>
    <p>Date: <input type="text" id="datepicker5" readonly /></p>
    <p>Date: <input type="text" id="datepicker6" readonly /></p>
    <p>Date: <input type="text" id="datepicker7" readonly /></p>
</div>
<button class="btn btn-primary btn-sm" onclick="sendpost('process/testAJAX.php','content');">POST</button>
<button class="btn btn-success btn-sm" onclick="sendpostArray('process/testAJAX.php','content')">POST ARRAY</button>
</form>
<input type="hidden" name="txt" id="txt" value="test GET">&nbsp;&nbsp;
<button class="btn btn-info btn-sm" onClick="sendget('process/testAJAX.php','content',txt.value)">GET</button>

<div id="content">แสดงผล</div>
<!--</section>-->
<?php include_once '../foot.php';?>