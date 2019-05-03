<?php
include('../UserControls/NavBar.php');

//$db = mysqli_connect('localhost', 'root', '', 'database_systems');


if(isset($_GET['searchSubmit'])){
    $term = mysqli_real_escape_string($DB, $_POST['searchTerm']);
    $search_query = "select * from products where name like '%".$term."%' OR description like '%".$term."%' ";
    $run = mysqli_query($DB, $search_query);
}

$results = mysqli_fetch_assoc($run);
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?php

            if($run):
                if(mysqli_num_rows($run) > 0):
                    while($product = mysqli_fetch_assoc($run)):
                        ?>
                        <div class="col-sm-4 col-md-3" style="text-align: center;">
                            <form method="post" action="index.php?action=add&id=id=<?php $product['product_id']; ?>">
                                <div class="col-md-12">
                                    <img src="<?php echo $product['img']; ?>" class="img-fluid" />
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        <?php echo $product['name']; ?>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Left in stock:  <?php
                                        if($product['quantity'] > 10){
                                            echo '<strong>10+</strong>';
                                        }else{
                                            echo '<strong>'.$product['quantity'].'</strong>';
                                        }

                                        ?>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        <?php echo $product['price']; ?>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-success">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    <?php
                    endwhile;
                endif;
            endif;
            ?>
        </div>
    </div>
</div>

