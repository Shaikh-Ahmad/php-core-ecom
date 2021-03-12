
<?php 

//DATABASE conectivity
/** @var $pdo \PDO  */
require_once "../../database.php";

require_once "../../functions.php"; 

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

//select query
$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($product);
// echo '</pre>';
// exit;


$errors = [];

$title = $product['title'];
$price = $product['price'];
$description = $product['description'];

// By default page request method is GET so this will give code error as we are using $_POST . so to handle this we have used an if statment when we use submit button the method of the page changes to POST and this code will get executed  
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once "../../validate_product.php";

    if(empty ($errors) ){

        
        //update query
        $statement = $pdo->prepare("UPDATE products SET title = :title, image = :image, description = :description, price = :price WHERE id = :id");

        $statement->bindValue(':title' , $title);
        $statement->bindValue(':image' , $imagePath);
        $statement->bindValue(':description' , $description);
        $statement->bindValue(':price' , $price);
        $statement->bindValue(':id' , $id);
        $statement->execute();

        // After form submition route to otherpage
        header('Location: index.php');
    }

}


//dump info from the GET 0r POST Method $_GET & $_POST is a super global
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

?>

<!-- HTML HEADER -->
    <?php include_once "../../views/partials/header.php"; ?>
    
    <p>
        <a href="index.php" class="btn btn-secondary"> <- Go Back to Products </a>
    </p>
    <h1>Update Product <b><?php echo $product['title'] ?></b></h1>

    <?php include_once "../../views/products/form.php"; ?>

  </body>
</html>