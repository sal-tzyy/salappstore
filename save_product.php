<?php
if(isset($_POST['submit'])){
    
    require 'connection.php';

    $id = $_POST['id'];     
    $product = $_POST['product'];           
    $storage = $_POST['storage'];           
    $price = $_POST['price'];              
    $qty = $_POST['qty'];                   
    $cat_id = $_POST['cat_id'];   
    $status = 1;
    $d = date('Y-m-d');

    $target_dir = "img/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

   
    $file_name = basename($_FILES["product_image"]["name"]);
    $target_file = $target_dir . $file_name;

    
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        
       
        $sql = "INSERT INTO tbl_product ( product, storage, price, qty, cat_id,img, status, created) 
        VALUES ( '$product', '$storage', '$price', '$qty', '$cat_id', '$file_name', '$status', '$d')";
        
        if(mysqli_query($conn, $sql)){
            header('location: product.php');
            exit();
        } else {
            echo "Can not insert data to DataBase: " . mysqli_error($conn);
        }
       
    } else {
        echo "Sorry, there was an error uploading your file.";  
    }
}
?>