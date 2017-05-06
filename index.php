<?php
include_once 'up_header.php';
include_once 'header.php';
include_once 'menu.php';
$conn_DB = new EnDeCode();
?>
 <script lang="Javascript" type="text/javascript">
         function loadPage(show,page){
             
             $(show).load(page,{data:'test'}, function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
                
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
        }
    </script>
<section class="content">
    <div id="index_content"></div>   
        
<?php if (isset($_SESSION['rm_id'])) { 
    if(!empty($_GET['page'])){
        $page= $_GET['page'].'.php';
        $data = isset($_GET['data'])?$conn_DB->sslDec($_GET['data']):'';
    }else{
    $page='content/info_index.php';$data='';} ?>
    
   <script lang="Javascript" type="text/javascript">
        $("#index_content").load("<?= $page?>",{data:'<?=$data?>'}, function(responseTxt, statusTxt, xhr){               
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
        </script>
    <?php } else {
    if ($db == false) {
        $check = md5(trim('check'));
        ?>
        <center>
            <h3>ยังไม่ได้ตั้งค่า Config <br>กรุณาตั้งค่า Config เพื่อเชื่อมต่อฐานข้อมูล</h3>
            <a href="#" class="btn btn-danger" onClick="return popup('set_conn_db.php?method=<?= $check ?>&host=main', popup, 400, 600);" title="Config Database">Config Database</a>

        </center> 
    <?php } ?>
    NO LOGIN.
<?php } ?>
    </section>
    <?php
include_once 'menu_footer.php';
include_once 'footer.php';
?>