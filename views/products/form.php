
<!-- this if statment will check if the error array is not empty then execute and then will display errors -->
<?php if(!empty ($errors) ): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <div>
                    <?php echo $error ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <?php if ($product['image']): ?>
            <img src="../<?php echo $product['image'] ?>" class="update-image">
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <br>
            <input name="image" type="file">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Title</label>
            <input type="text" name="title" value="<?php echo $title ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <textarea name="description" class="form-control"><?php echo $description ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number"  name="price" value="<?php echo $price ?>" step=".01" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>