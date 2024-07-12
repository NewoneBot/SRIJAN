<?php
ob_start();
ini_set('display_errors', 1);

include 'admin_class.php';
$curd = new Action();


$action = $_GET['action'];

if($action == 'delete_staff'){
    // echo "test".$action;
	$save = $curd->delete_staff();
	if($save)
		echo $save;
}
if($action == 'delete_batch'){
    // echo "test".$action;
	$save = $curd->delete_batch();
	if($save)
		echo $save;
}




?>