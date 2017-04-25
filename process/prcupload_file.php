<?php
session_save_path("../session/");
session_start();
function __autoload($class_name) {
    include '../class/' . $class_name . '.php';
}
set_time_limit(0);
$connDB = new EnDeCode();
$read = "../connection/conn_DB.txt";
$connDB->para_read($read);
$connDB->Read_Text();
$connDB->conn_PDO();

$method = isset($_POST['method'])?$_POST['method']:'';
if($method=='insert_risk'){
if (isset($_FILES["filUpload"])) {
$upload = new File_Upload("filUpload", "../myfile");
                $take_file1 = $upload->upload();
                $data = array($take_file1);
                $table = "takerisk";
                $where="user_id=:user_id order by takerisk_id desc limit 1";
                $field=array("take_file1");
                $execute=array(':user_id' => $_SESSION['rm_id']);
                $edit_person=$connDB->update($table, $data, $where, $field, $execute);
                echo "<script>alert('Upload file successfully!');</script>";
                echo "<script>window.top.window.showResult('1');</script>";
            } else {
                $take_file1 = '';
            }
}elseif($method=='test'){
if (isset($_FILES["filUpload"])) {
$upload = new File_Upload("filUpload", "../myfile");
                $take_file1 = $upload->upload();
                echo "<script>alert('Upload file successfully!');</script>";
                echo "<script>window.top.window.showResult('1');</script>";
}
}
$connDB->close_PDO();