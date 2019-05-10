<?php
$page_title = 'Cart';
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        Rami's Shop | <?php echo $page_title ?>
    </title>

    <?php include('../UserControls/topScripts.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#qtyRemove').change(function () {
                // SELECTED VALUE
                var productQty = $(this).val();
                var proId = $('#proId').val();
                alert("Value in js: " + productQty + " and product Id: " + proId);

                // Ajax to call the PHP function
                $.post('Default.php', { ProductQty: productQty, ProductId: proId }, function (data) {
                    alert('ajax completed. Response: ' + data);
                })
            })
        })

    </script>
</head>
<body>
    <?php

    include('../UserControls/NavBar.php');
    global $DB;

    $userId = checkLoggedIn();

    $getCart = "SELECT * FROM cart INNER JOIN cart_product INNER JOIN products ON cart.users_id = cart_product.userId AND cart_product.product_id = products.product_id ";

    $run = mysqli_query($DB, $getCart);
    ?>
    <div class="row" style="margin-top:4em;">
        <div class="col-md-8">
            <table style="width:100%;">
                <thead>
                    <tr class="row" style="margin-bottom: 1em;">
                        <th scope="col" style="text-align: center;" class="col-md-3 align-self-center">Product</th>
                        <th scope="col" style="text-align: center;" class="col-md-3 align-self-center">Price</th>
                        <th scope="col" style="text-align: center;" class="col-md-3 align-self-center">Quantity</th>
                        <th class="col-md-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row" style="margin-bottom: 1em;">
                        <?php
                        if($run):
                            if(mysqli_num_rows($run) > 0):
                                while($data = mysqli_fetch_assoc($run)):
                        ?>
                       
                        <td class="col-md-3 align-self-center" style="text-align: center;"><img src="<?php echo $data['img'] ?>" /> <input type="hidden" id="proId" value="<?php echo $data['product_id'] ?>" /></td>
                        <td class="col-md-3 align-self-center" style="text-align: center;"><?php echo $data['cart_price'] ?> $</td>
                        <td class="col-md-3 align-self-center" style="text-align: center;">
                            <select id="qtyRemove" class="form-control">
                                <?php
                                    for($i = $data['cart_qty']; $i >= 1; $i--):
                                ?>

                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                <?php 
                                    endfor; 
                                ?>

                                <option value="0">Remove</option>
                            </select>

                        </td>
                        <td class="col-md-3 align-self-center" style="text-align: center;">
                            <button name="remove_from_cart" class="btn btn-outline-danger">Remove from cart</button>
                        </td>



                        <?php
                                endwhile;
                            endif;
                        endif;
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4" style="margin-top: .5em;">
            <div class="boxTop" style="border: 1px solid lightgrey; margin-bottom:1em;">
                Total and checkout
            </div>

            <div class="boxBottom" style="border: 1px solid lightgrey;">
                Random items
            </div>

        </div>
    </div>
    <?php include('./UserControls/bottomScripts.php'); ?>
    <?php include('./UserControls/Footer.php'); ?>
</body>
</html>











