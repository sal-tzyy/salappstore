<?php
include 'connection.php';

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $storage = mysqli_real_escape_string($conn, $_POST['storage']);
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $old_picture = $_POST['old_picture'];

    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != "") {
        $new_image_name = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];
        $new_image_name = uniqid() . '-' . basename($new_image_name);
        $upload_path = "img/" . $new_image_name;

        if (move_uploaded_file($image_tmp, $upload_path)) {
            $img_to_db = $new_image_name;
            if (!empty($old_picture) && file_exists("img/" . $old_picture)) {
                unlink("img/" . $old_picture);
            }
        } else {
            $img_to_db = $old_picture;
        }
    } else {
        $img_to_db = $old_picture;
    }

    $sql_update = "UPDATE tbl_product SET 
            product = '$product', 
            price = '$price', 
            qty = '$qty', 
            storage = '$storage',
            cat_id = '$cat_id', 
            img = '$img_to_db' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("location: product.php?status=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql_name = "SELECT * FROM tbl_product WHERE id = $id";
    $result_name = mysqli_query($conn, $sql_name);
    $product = mysqli_fetch_assoc($result_name);

    if (!$product) {
        header("location: product.php");
        exit();
    }
} else {
    header("location: product.php");
    exit();
}

$sql_cat = "SELECT * FROM tbl_category";
$result_cat = mysqli_query($conn, $sql_cat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { 
            box-sizing: border-box; 
            font-family: 'Prompt', sans-serif; 
        }
        body { 
            background-image: url('https://i.pinimg.com/736x/91/c2/4d/91c24dfc8961e5edbd7b6ef76c7198b6.jpg');
            background-size: cover;         
            background-position: center;    
            background-repeat: no-repeat;   
            background-attachment: fixed;   
            margin: 0; 
            padding: 40px 20px;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
        }
        .form-container { 
            background: rgba(0, 0, 0, 0.65); 
            backdrop-filter: blur(10px);
            padding: 30px 40px; 
            width: 100%; 
            max-width: 800px; 
            border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4); 
            border-top: 5px solid #a7e7fe; 
        }
        h2 { 
            color: #fff; 
            margin-bottom: 25px; 
            text-align: center; 
            font-weight: 600; 
            font-size: 26px; 
            grid-column: span 2;
        }
        
        /* រៀបចំប្រអប់ input ឱ្យដាក់ផ្ដេកជា ២ ຖັນស្អាត */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 20px;
        }

        .form-group { 
            margin-bottom: 5px; 
        }

        /* សម្រាប់ช่อง ID, Category, Picture និង Button ឱ្យវាស៊ីទំហំពេញមួយជួរ */
        .full-width {
            grid-column: span 2;
        }

        label { 
            display: block; 
            margin-bottom: 6px; 
            color: #f1f1f1; 
            font-weight: 500; 
            font-size: 14px; 
        }
        
        input[type="text"], select, input[type="file"] { 
            width: 100%; 
            padding: 10px 14px; 
            border: 1px solid rgba(255, 255, 255, 0.3); 
            border-radius: 8px; 
            font-size: 14px; 
            background-color: rgba(255, 255, 255, 0.15); 
            color: #fff; 
        }
        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: #a7e7fe;
            background-color: rgba(255, 255, 255, 0.25);
        }
        select option {
            background-color: #333;
            color: #fff;
        }
        input[readonly] { 
            background-color: rgba(255, 255, 255, 0.08) !important; 
            color: #bbb !important; 
            cursor: not-allowed; 
        }

        .preview-img { 
            margin-top: 10px; 
            display: flex; 
            align-items: center;
            gap: 15px; 
        }
        .preview-img span {
            color: #fff;
            font-size: 13px;
        }
        .preview-img img {
            width: 55px; 
            height: 55px; 
            object-fit: cover; 
            border-radius: 8px; 
            border: 1px solid rgba(255, 255, 255, 0.3); 
        }
        .btn-submit {
            background: linear-gradient(135deg, #faf9fa 0%, #6fbdf5 100%); 
            color: #333; 
            border: none; 
            padding: 12px; 
            width: 100%; 
            border-radius: 8px; 
            font-size: 16px; 
            font-weight: 600; 
            cursor: pointer; 
            margin-top: 15px; 
            grid-column: span 2;
        }
        .btn-submit:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    
    <div class="form-container">
        <h2>Update Product</h2>
       
        <form action="" method="POST" enctype="multipart/form-data" class="form-grid">
            
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <!-- ID ពេញមួយជួរ -->
            <div class="form-group full-width">
                <label>ID :</label>
                <input type="text" readonly value="<?php echo $product['id']; ?>">
            </div>
            
            <!-- Product Name ខាងឆ្វេង -->
            <div class="form-group">
                <label>Product Name :</label>
                <input type="text" name="product" value="<?php echo htmlspecialchars($product['product']); ?>" required>
            </div>
            
            <!-- Price ខាងស្តាំ -->
            <div class="form-group">
                <label>Price ($) :</label>
                <input type="text" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            
            <!-- Quantity ខាងឆ្វេង -->
            <div class="form-group">
                <label>Quantity :</label>
                <input type="text" name="qty" value="<?php echo htmlspecialchars($product['qty']); ?>" required>
            </div>

            <!-- Storage ខាងស្តាំ -->
            <div class="form-group">
                <label>Storage :</label>
                <input type="text" name="storage" value="<?php echo htmlspecialchars($product['storage']); ?>">
            </div>
            
            <!-- Category ពេញមួយជួរ -->
            <div class="form-group full-width">
                <label>Category :</label>
                <select name="cat_id" required>
                    <option value="">Select Category</option>
                    <?php
                    while($row = mysqli_fetch_assoc($result_cat)){
                        $selected = ($row['id'] == $product['cat_id']) ? 'selected' : '';
                        echo '<option value="'.$row['id'].'" '.$selected.'>'.htmlspecialchars($row['name']).'</option>';
                    }
                    ?>
                </select>
            </div>
            
            <!-- Picture ពេញមួយជួរ -->
            <div class="form-group full-width">
                <label>Picture :</label>
                <input type="file" name="photo">
                <input type="hidden" name="old_picture" value="<?php echo $product['img']; ?>">
                
                <?php if(!empty($product['img'])): ?>
                    <div class="preview-img">
                        <span>Current Image:</span>
                        <img src="img/<?php echo $product['img']; ?>" alt="Product Image">
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Button Update ពេញមួយជួរ -->
            <input type="submit" class="btn-submit" name="update" value="Update Product">
        </form>
    </div>

</body>
</html>