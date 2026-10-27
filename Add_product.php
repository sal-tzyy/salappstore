<?php
$servername = "localhost"; 
$username = "root";        
$password = "";           
$dbname = "m3_db";    

$conn = mysqli_connect($servername, $username, $password, $dbname); 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | Add Product</title>

    <!-- Bootstrap 3 -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

   
    <style>
      .x_panel {
        border-radius: 10px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: none !important;
        background-image:url('https://i.pinimg.com/736x/61/ed/13/61ed1396897291a86432583bb2779b02.jpg');
        padding: 25px 30px;
        margin-top: 15px;
      }
      .x_title {
        border-bottom: 2px solid #f1f4f8 !important;
        padding-bottom: 15px !important;
        margin-bottom: 25px !important;
      }
      .x_title h2 {
        font-weight: 700 !important;
        color: #2A3F54 !important;
        font-size: 20px !important;
      }
      .form-group {
        margin-bottom: 20px !important;
      }
      /* ធ្វើឱ្យប្រអប់ Input និង Select ថ្លា និងមានរចនាប័ទ្ម Glassmorphism */
.form-control, input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 6px 12px;
    height:40px;
    background: rgba(255, 255, 255, 0.08) !important; /* ភាពថ្លា (Glass Effect) */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 8px;
    color: #ffffff !important; /* អក្សរខាងក្នុងពណ៌ស */
    font-size: 15px;
    outline: none;
    transition: all 0.3s ease;
}

/* ពេលយក Mouse ដាក់លើ ឬ Click ចូលប្រអប់ */
.form-control:focus, input[type="text"]:focus, input[type="number"]:focus, select:focus {
    background: rgba(255, 255, 255, 0.15) !important;
    border-color: #00d2ff !important;
    box-shadow: 0 0 12px rgba(0, 210, 255, 0.3);
}

/* កែពណ៌អក្សរក្នុង Option របស់ Select ឱ្យងាយមើល */
select option {
    background: #1e1e1e;
    color: #ffffff;
}

/* កែប្រែ Input ប្រភេទ File (Choose File) ឱ្យត្រូវម៉្សុយគ្នា */
input[type="file"] {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #ffffff;
    padding: 8px;
}
}
      .form-control {
        border-radius: 6px !important;
        height: 42px !important;
        border: 1px solid #97bde5 !important;
        box-shadow: none !important;
        transition: all 0.3s ease;
        font-size: 14px;
      }
      .form-control:focus {
        border-color: #1ABB9C !important;
        box-shadow: 0 0 0 3px rgba(26, 187, 156, 0.15) !important;
      }
      
    
      .img-preview-container {
        margin-top: 12px;
        width: 160px;
        height: 160px;
        border: 2px dashed #CBD5E0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #F8FAFC;
        position: relative;
      }
      .img-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
      }
      .img-preview-container span {
        color: #A0AEC0;
        font-size: 13px;
        text-align: center;
        padding: 10px;
      }

      
      .btn-submit-custom {
        background-color: #1ABB9C !important;
        border-color: #1ABB9C !important;
        color: #ffffff !important;
        font-weight: 700;
        padding: 12px 32px;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(26, 187, 156, 0.25);
      }
      .btn-submit-custom:hover {
        background-color: #15967d !important;
        border-color: #15967d !important;
        box-shadow: 0 6px 15px rgba(26, 187, 156, 0.4);
      }
      .btn-cancel-custom {
        background-color: #EDF2F7 !important;
        border-color: #EDF2F7 !important;
        color: #4A5568 !important;
        font-weight: 600;
        padding: 12px 26px;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.3s ease;
        margin-left: 12px;
        text-decoration: none !important;
        display: inline-block;
      }
      .btn-cancel-custom:hover {
        background-color: #E2E8F0 !important;
        color: #2D3748 !important;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index .php" class="site_title"><i class="fa fa-paw"></i> <span>Welcome Beltei</span></a>
            </div>

            <div class="clearfix"></div>

          
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Vuthy Lysal</h2>
              </div>
            </div>

            <br />

            
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Product <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="product.php">Product List</a></li>
                      <li><a href="Add_product.php">Add Product</a></li>
                     
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li> 
                </ul>
              </div>
            </div>

            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings"><span class="glyphicon glyphicon-cog"></span></a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen"><span class="glyphicon glyphicon-fullscreen"></span></a>
              <a data-toggle="tooltip" data-placement="top" title="Lock"><span class="glyphicon glyphicon-eye-close"></span></a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html"><span class="glyphicon glyphicon-off"></span></a>
            </div>
          </div>
        </div>

      
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown">
                    <img src="images/img.jpg" alt="">Vuthy Lysal
                    <span class="fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

    
        <div class="right_col" role="main" style="min-height: 100vh;">
          <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
              
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-plus-circle" style="margin-right: 8px; color: #1ABB9C;"></i>Add New Product</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="save_product.php" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                 
                    <form action="" method="POST" enctype="multipart/form-data">
    
    <!-- 1. Product ID -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product ID </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <input type="text" name="id" class="form-control" required>
      </div>
    </div>

    <!-- 2. Product Name -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name: </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <input type="text" name="product" class="form-control" required>
      </div>
    </div>

    <!-- 3. Storage -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Storage: </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <input type="text" name="storage" class="form-control" required>
      </div>
    </div>

    <!-- 4. Price -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Price ($): </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <input type="text" name="price" class="form-control" required>
      </div>
    </div>

    <!-- 5. Quantity -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity: </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <input type="number" name="qty" class="form-control" required>
      </div>
    </div>

    <!-- 6. Category -->
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Category: </label>
      <div class="col-md-7 col-sm-8 col-xs-12">
        <select name="cat_id" class="form-control" style="width: 100%">
          <option value="">Select Category</option>
          <?php
          $sql_cat = "SELECT * FROM tbl_category";
          $result_cat = mysqli_query($conn, $sql_cat);
          if (mysqli_num_rows($result_cat) > 0) {
              while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                  echo '<option value="' . $row_cat['id'] . '">' . $row_cat['name'] . '</option>';
              }
          } else {
              echo '<option value="">No categories found</option>';
          }
          ?>
        </select>
      </div>
    </div>

    <!-- 7. Product Picture -->
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color: #ffffff;">Product Picture: </label>
    <div class="col-md-7 col-sm-8 col-xs-12">
        <!-- បន្ថែម id="productImageInput" -->
        <input type="file" name="product_image" id="productImageInput" class="form-control" accept="image/*" onchange="previewImage(event)">
        
        <div class="img-preview-container" style="margin-top: 10px; width: 160px; height: 160px; border: 2px dashed #CBD5E0; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.05);">
            <!-- បន្ថែម id="imagePreview" -->
            <img id="imagePreview" src="" alt="Not Chose Picture" style="max-width: 100%; max-height: 100%; display: none; border-radius: 6px;" />
            <span id="placeholderText" style="color: #ccc; font-size: 13px;">No image</span>
        </div>
    </div>
</div>
      </div>
    </div>
<div class="ln_solid" style="margin-top: 30px;"></div>
                    <div class="form-group">
                      <div class="col-md-7 col-sm-8 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-submit-custom">
                          <i class="fa fa-check-circle" style="margin-right: 6px;"></i> Submit 
                        </button>
                        <a href="product.php" class="btn btn-cancel-custom">
                          <i class="fa fa-times-circle" style="margin-right: 6px;"></i> Cancel
                        </a>
                      </div>
                    </div>
                </form>


                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

      
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template
          </div>
          <div class="clearfix"></div>
        </footer>

      </div>
    </div>

  
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <script src="vendors/nprogress/nprogress.js"></script>
    <script src="build/js/custom.min.js"></script>

    
    <script>
      function previewImage(event) {
        var reader = new FileReader();
        var imageField = document.getElementById('imagePreview');
        var previewText = document.getElementById('previewText');

        reader.onload = function(){
          if(reader.readyState == 2){
            imageField.src = reader.result;
            imageField.style.display = 'block';
            previewText.style.display = 'none';
          }
        }
        if(event.target.files[0]){
          reader.readAsDataURL(event.target.files[0]);
        }
      }
      function previewImage(event) {
        const fileInput = event.target;
        const previewImg = document.getElementById('imagePreview');
        const placeholderText = document.getElementById('placeholderText');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block'; // បង្ហាញរូបភាព
                if (placeholderText) {
                    placeholderText.style.display = 'none'; // លាក់អក្សរ "No image"
                }
            }
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    </script>
  </body>
</html>