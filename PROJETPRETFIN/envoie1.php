<?php
$id = $_GET["id"];
$servername = "localhost";
$username = "root";
$password = "";
$database = "projet";

//create connection
$con = new mysqli($servername, $username, $password, $database);


// $get_customer = "select * from support where where id='$id'";


//read the row of the selected element from database table


?>


            


    <h5>ENVOYER LE SYLLABUS A CE COURS</h5>
    <form action="#" method="POST" enctype="multipart/form-data">
       <div>
       <input type="hidden" name="idSup" value="<?php echo $idSup; ?>">
       </div>
       
        <div class="col-6">
        <input type="file" name="fichier" class="form-control" required ><br>
        </div>
        <button name="update" class="btn btn-primary" >

        <i class="fa fa-user-md" ></i> Update Now

        </button>
    </form>
<?php

if(isset($_POST['update'])){
    $update_id = $id;
    
    $fichier = $_FILES['fichier']['name'];

    $fichier_tmp = $_FILES['fichier']['tmp_name'];

    move_uploaded_file($fichier_tmp,'fichiers/supportFiles/'.$fichier);
    
    $con = new mysqli($servername, $username, $password, $database);

   $update_customer = " UPDATE support SET Fichier ='$fichier' WHERE idSup=$id";

   $run_customer = mysqli_query($con,$update_customer);

    if($run_customer){

    echo "<script>alert('Your account has been updated please login again')</script>";
    header("location:./supports.php");

}

}


?>