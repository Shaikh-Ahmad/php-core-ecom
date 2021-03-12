
<?php 

//DATABASE conectivity
/** @var $pdo \PDO  */
require_once "../../database.php"; 

$search = $_GET['search'] ?? '';
if($search){
  $statment = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC');
  $statment->bindValue(':title',"%$search%");
} else{
  $statment = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}

$statment->execute();
$products = $statment->fetchAll(PDO::FETCH_ASSOC);

// use this code to dump data on view page and check if the data in database table is being shown
// echo '<pre>';
// var_dump($products);
// echo '</pre>';

?>


<!-- HTML HEADER -->
<?php include_once "../../views/partials/header.php"; ?>

    <h1>Product Crud</h1>
    <p>
        <a href="create.php" class="btn btn-success">Create Product</a>
    </p>

    <form action="" method="">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="search product" name="search" value="<?php echo $search ?>">
        <button class="btn btn-outline-secondary" type="submit" >Search</button>
      </div>
    </form>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $i => $product): ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td>
                        <img src="../<?php echo $product['image'] ?>" class="thumb-image" alt="product img">
                    </td>
                    <td><?php echo $product['title'] ?></td>
                    <td><?php echo number_format($product['price'], 2, '.', ',');  ?></td>
                    <td><?php echo date("d-m-Y", strtotime($product['create_date']))  ?></td>
                    <td>
                        <a href="update.php?id=<?php  echo $product['id'] ?>" class="btn btn-sm btn-outline-primary" >Edit</a>
                        <form method="post" action="delete.php"  style="display:inline-block">
                            <input type="hidden" name="id" value="<?php  echo $product['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
            
        </tbody>
      </table>

  </body>
</html>