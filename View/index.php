<html>
<head>
    <title>Apple</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <form action='index.php' method="get" >
        <div class="container text-center mt-2 ">
            <div class="row justify-content-md-center mb-3">
                <div class="col col-lg">
                    <input type="text" class="form-control" id="SearchProd" name="SearchProd" placeholder="Write name product" >
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-success ">Find</button>
                    <a href="AdminPanel.php" class="btn btn-secondary" >AdminPanel</a>

                </div>
            </div>
    </form>
    <?php
    include "../models/Product.php";
    include "../Controller/ProductController.php";

    $conn = new mysqli("localhost", "root", "", "tets_bd");
    if($conn->connect_error){
        echo 'ERROR';
    }
    else {
//        echo 'Access';


        $NameProd = "";
        if (isset($_GET['SearchProd'])){
            $NameProd = $_GET['SearchProd'];
        }




        $sql_code = "SELECT * FROM `prod_img`;";
        if($results = $conn->query($sql_code)) {

            echo "<table class='table' id='ProdTable' >";
            echo "<thead class='thead-light table-dark'>";


            echo "<tr>";
            echo  "<th scope='col' >Id</th>";
            echo  "<th scope='col' >Images</th>";
            echo  "<th scope='col' >Title</th>";
            echo  "<th scope='col'>Price</th>";
            echo  "<th scope='col' >Description</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($results as $res){
//                $col = 'bg-info';
                $ProdControllers = new ProductController();
                $ProdControllers->setProduct($res["id"],$res["title"],$res["price"],$res["description"],$res['images']);
                $ProdControllers->FillMainTable($NameProd);


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
