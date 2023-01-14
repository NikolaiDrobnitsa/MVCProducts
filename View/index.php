<html lang="en">
<head>
    <title>Apple</title>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <form class="input_container " method='post' enctype="multipart/form-data" action="index.php">
        <div class="container text-center ">
            <div class="text-start justify-content-md-center mb-3">
                <div class="col col-lg ">
                    <h2>Admin panels</h2>
                </div>
                <div class="col col-lg ">
                    <h5 >Add Product </h5>
                </div>

            </div>
            <div class="row justify-content-md-center mb-3">

                <div class="col col-lg">
                    <label for="addProdName" >Name</label>
                    <input type="text" class="form-control" id="addProdName" name="add_name" placeholder="Title" value="">
                </div>
                <div class="col col-lg">
                    <label for="addProdPrice">Price</label>
                    <input type="text" class="form-control" id="addProdPrice" name="add_price" placeholder="Price" value="" >
                </div>
                <div class="col col-lg">
                    <label for="SearchProd" >Description</label>
                    <input type="text" class="form-control" id="SearchProd" name="add_amount" placeholder="Description" value="">
                </div>
                <div class="col col-lg">
                    <label for="SearchProd" >IMG</label>
                    <input type="file" class="form-control" id="SearchProd" name="img_upload" placeholder="Img" >
                </div>
                <div class="col-md-auto  p-4">
                    <button type="submit" class="btn btn-success " id="Add_btn" name="upload">Adds </button>
                    <a href="index.php" class="btn btn-info" id="Exit_btn" >Exit </a>
                </div>

            </div>
    </form>

    <div class="div__update_prod pb-4">
        <form class="input_container" method='post' enctype="multipart/form-data" action="index.php">
            <div class="container text-center ">
                <div class="text-start">


                    <h5  >Update Product</h5 class="" >


                </div>
                <div class="row justify-content-md-center mb-3">
                    <div class="col col-lg">
                        <label for="SearchProd" >ID</label>
                        <input type="text" class="form-control" id="SearchProd" name="upload_id" placeholder="ID" >
                    </div>

                    <div class="col col-lg">
                        <label for="addProdName" >Title</label>
                        <input type="text" class="form-control" id="addProdName" name="update_name" placeholder="Name" value="">
                    </div>
                    <div class="col col-lg">
                        <label for="addProdPrice">Price</label>
                        <input type="text" class="form-control" id="addProdPrice" name="update_price" placeholder="Price" value="" >
                    </div>
                    <div class="col col-lg">
                        <label for="SearchProd" >Description</label>
                        <input type="text" class="form-control" id="SearchProd" name="update_amount" placeholder="Amount" value="">
                    </div>
                    <div class="col col-lg">
                        <label for="SearchProd" >IMG</label>
                        <input type="file" class="form-control" id="SearchProd" name="img_update" placeholder="zzz" >
                    </div>

                    <div class="col-md-auto p-3 ">
                        <button type="submit" class="btn btn-success " id="Add_btn" name="Update">Update </button>
                    </div>

                </div>
        </form>
    </div>
    <?php
    include "../models/Product.php";
    include "../Controller/ProductController.php";

    $conn = new mysqli("localhost", "root", "", "tets_bd");
    if($conn->connect_error){
        echo 'ERROR';
    }
    else {
//        echo 'Access';


        if (isset($_POST['delete_btn'])){
            echo "<script>alert('del'); </script>";
            $delete = 'DELETE FROM prod_img WHERE id='.(int)$_POST['delete_btn'];
            $result = $conn->query($delete);
            if (!$result){
                echo 'ERROR';
            }
        }


        if(isset($_POST['upload'])){
            $img_type = substr($_FILES['img_upload']['type'], 0, 5);
            if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image'){
                $images = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
                $title = $_POST['add_name'];
                $price = $_POST['add_price'];
                $description = $_POST['add_amount'];
                $conn->query("INSERT INTO prod_img (title, price, description , images) VALUES ('$title','$price','$description','$images')");
            }
        }


        if(isset($_POST['Update'])){
            $img_type = substr($_FILES['img_update']['type'], 0, 5);
            if(!empty($_FILES['img_update']['tmp_name']) and $img_type === 'image'){
                $id = $_POST['upload_id'];
                $img = addslashes(file_get_contents($_FILES['img_update']['tmp_name']));
                $title = $_POST['update_name'];
                $price = $_POST['update_price'];
                $description = $_POST['update_amount'];
                $conn->query("UPDATE prod_img SET title='$title',price='$price',description='$description',images='$img' WHERE id='$id'");
            }
        }

        $sql_code = "SELECT * FROM `prod_img`;";
        if($results = $conn->query($sql_code)) {

            echo "<table class='table' id='ProdTable' >";
            echo "<thead class='thead-light table-dark'>";


            echo "<tr>";
            echo  "<th scope='col' >Id</th>";
            echo  "<th scope='col' >IMG</th>";
            echo  "<th scope='col' >Title</th>";
            echo  "<th scope='col'>Price</th>";
            echo  "<th scope='col' >Description</th>";
            echo  "<th scope='col' >Delete</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($results as $res){
                $ProdControllers = new ProductController();
                $ProdControllers->setProduct($res["id"],$res["title"],$res["price"],$res["description"],$res['images']);
                $ProdControllers->FillTable();


            }
            echo "</tbody>";
            echo "</table>";

            $results->free();

        }
        else {
            echo '<p>Data NOT selected!!!</p>';
        }

        $conn->close();
    }

    ?>
</div>
</body>
</html>
