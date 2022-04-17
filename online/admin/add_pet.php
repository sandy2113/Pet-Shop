<?php include 'header.php'; 
if(isset($_POST['addpet'])){
    $pet_name = $_POST['pet_name'];
    $pet_desc = $_POST['pet_desc'];
    $pet_price = $_POST['pet_price'];

    if(isset($_POST['edit_pet'])){
      $pet_id = $_POST['edit_pet'];
      $update_pet = "update products set product_name = '$pet_name', product_details = '$pet_desc', product_price = '$pet_price' where id = '$pet_id'";
      $result = $conn->query($update_pet);
      if($result === TRUE){
        ?>
        <script>
        window.location = "tables.php";
        </script>
        <?php
      }
      exit;
    }

    if($pet_name != NULL && $pet_desc != NULL && $pet_price != NULL) {
        $target_dir = "uploads/";
        $date=date_create();
        $target_file = $target_dir.date_timestamp_get($date).'_'.basename($_FILES["pet_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
        $check = getimagesize($_FILES["pet_image"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        // if ($_FILES["fileToUpload"]["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["pet_image"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["pet_image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }   
        $insert_pet = "insert into products (product_name, product_details, product_price, image) values('$pet_name', '$pet_desc', '$pet_price', '$target_file')";
        if($conn->query($insert_pet) === TRUE) {
            // echo "Inserted successfully !";
            ?>
            <script>
            window.location = 'add_pet.php'; 
            </script>
            <?php
        }else {
            echo "Error: " . $insert_pet . "<br>" . $conn->error;
        }
    }
    exit;
}

$pet_name = "";
$pet_desc = "";
$pet_price = "";
if(isset($_REQUEST['editid']) && $_REQUEST['editid'] != NULL) {
  $editid = $_REQUEST['editid'];
  $fetch_pet = "select * from products where id = $editid";
  $result = $conn->query($fetch_pet);
  while($row = $result->fetch_assoc()){
    $pet_image = $row['image'];
    $pet_name = $row['product_name'];
    $pet_desc = $row['product_details'];
    $pet_price = $row['product_price'];
  }
  // echo 'Hi';
  // exit;
}

if(isset($_REQUEST['deleteid']) && $_REQUEST['deleteid'] != NULL) {
  $delete_pet_id = $_REQUEST['deleteid'];
  $delete_pet_query = "DELETE FROM products WHERE id = $delete_pet_id";
  $fetch_image = "select image from products where id = $delete_pet_id";
  $result = $conn->query($fetch_image);
  while($row = $result->fetch_assoc()){
    $pet_image = $row['image'];
  }
  $result = $conn->query($delete_pet_query);
  if($result === TRUE){
    unlink($pet_image);
    ?>
    <script>
    window.location = 'tables.php';
    </script>
    <?php
  }
  exit;
}
?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <?php
            if(isset($_REQUEST['editid'])){
              ?>
              <h1 class="h3 mb-4 text-gray-800">Edit Your Pet</h1>
              <?php
            }else{
              ?>
              <h1 class="h3 mb-4 text-gray-800">Add Your Pet</h1>
              <?php
            }
            ?>
          <form method='post' enctype="multipart/form-data">
          <div class="form-group">
                <label for="name">Pet:</label>
                <input type="text" class="form-control" id="pet_name" name="pet_name" value="<?php echo $pet_name; ?>">
            </div>
            <div class="form-group">
                <label for="desc">Desc:</label>
                <input type="text" class="form-control" id="pet_desc" name="pet_desc" value="<?php echo $pet_desc; ?>">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="pet_price" name="pet_price" value="<?php echo $pet_price; ?>">
            </div>
            <?php
            if(!isset($_REQUEST['editid'])){
              
              ?>
              <div class="form-group">
                <label for="pet_image">Image:</label>
                <input type="file" class="form-control" id="pet_image" name="pet_image">
              </div>
              <input type="hidden" class="form-control" id="add_pet" name="add_pet">
              <?php
            }else{
              ?>
              <input type="hidden" class="form-control" id="edit_pet" name="edit_pet" value="<?php echo $_REQUEST['editid']; ?>">
              <?php
            }
            ?>
            <button type="submit" class="btn btn-primary" name='addpet'>Submit</button>
        </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
