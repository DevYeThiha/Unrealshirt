<?php require('header.php'); ?>
<?php check_admin(); ?>

<main class="container">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <h3>Admin Page</h3>
        </div>
        <?php 
        
          $connection = new mysqli('localhost','root','','unrealshirt',3306);
          $statement = $connection->prepare('SELECT product.id,product.name,product.photo,product.purchasePrice,product.price,category.category,`type`.type,color.color,product.isDeleted FROM product, category, `type`, color WHERE product.category = category.id AND product.type = `type`.id AND product.color = color.id');
          $statement->execute();
          $statement->bind_result($id,$name,$photo,$purchasePrice,$price,$category,$type,$color,$isDeleted);
          while($statement->fetch()){
            if ($isDeleted == "Deleted") {
        ?>
          <div class="col-lg-3">
            <div class="card shadow bg-danger text-white mb-3">
              <img class="card-img-top" src="img/product/<?php echo $photo;?>" alt="Card image cap">
              <div class="card-body">
                <p style="font-size:1.3em;">Price: <?php echo $price;?>KYATS</p>
                <div class="float-right">
                  <a href="product_edit.php?id=<?php echo $id;?>" class="btn btn-dark">Edit</a>
                  <a href="product_delete.php?id=<?php echo $id;?>" class="btn btn-dark">Delete</a>
                </div>
              </div>
            </div>
          </div>
        <?php }else{?>
          <div class="col-lg-3">
            <div class="card shadow mb-3">
              <img class="card-img-top" src="img/product/<?php echo $photo;?>" alt="Card image cap">
              <div class="card-body">
                <p style="font-size:1.3em;">Price: <?php echo $price;?>KYATS</p>
                <div class="float-right">
                  <a href="product_edit.php?id=<?php echo $id;?>" class="btn btn-dark">Edit</a>
                  <a href="product_delete.php?id=<?php echo $id;?>" class="btn btn-dark">Delete</a>
                </div>
              </div>
            </div>
          </div>
        <?php }
          }
            $statement->close();
            $connection->close();
        ?> 

    </div>
</main>






<?php        
        $connection = new mysqli('localhost','root','','unrealshirt',3306);
        $statement = $connection->prepare('SELECT COUNT(id) FROM product');
        $statement->execute();
        $statement->bind_result($count);
        $statement->fetch();
        if($count<5){
          require('footer_fixbottom.php'); 
        }else{
          require('footer.php'); 
        }
?>