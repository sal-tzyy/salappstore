<?php
require 'connection.php';

$id = $_POST['id'];

$sql = 'update tbl_product set status = 0 where id = '. $id;

// $sql = 'delete from tbl_product where id = '. $id;
if(mysqli_query($conn, $sql)){
    echo "Record has been delete. <br> Delete Successfully...";
}else{
    echo " Can not delete this record....<br> Please Check Again..."; 
}
?>