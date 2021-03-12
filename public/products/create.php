
<?php 

//DATABASE conectivity
/** @var $pdo \PDO  */
require_once "../../database.php"; 

require_once "../../functions.php"; 

// // for cecking file properties
// echo '<pre>';
// var_dump($_FILES);
// echo '</pre>';

$errors = [];

$title = '';
$price = '';
$description = '';
$product = [
    'image' => ''
];

// By default page request method is GET so this will give code error as we are using $_POST . so to handle this we have used an if statment when we use submit button the method of the page changes to POST and this code will get executed  
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //this if statment will check if the error array is empty then execute and will store the values entered in Database
    //in simple validation
    require_once "../../validate_product.php";
    
    if(empty ($errors) ){

        

        $statment = $pdo->prepare("INSERT INTO products (title,image,description,price,create_date) 
                        VAlUE(:title,:image,:description,:price,:date)
                    ");

        $statment->bindValue(':title' , $title);
        $statment->bindValue(':image' , $imagePath);
        $statment->bindValue(':description' , $description);
        $statment->bindValue(':price' , $price);
        $statment->bindValue(':date' , date('Y-m-d H:i:s'));
        $statment->execute();

        // After form submition route to otherpage
        header('Location: index.php');
    }

}

//dump info from the GET 0r POST Method $_GET & $_POST is a super global
echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>

    <!-- HTML HEADER -->
    <?php include_once "../../views/partials/header.php"; ?>

    <p>
        <a href="index.php" class="btn btn-secondary"> <- Go Back to Products </a>
    </p>
    <h1>Create New Product</h1>

    <?php include_once "../../views/products/form.php"; ?>

  </body>
</html>