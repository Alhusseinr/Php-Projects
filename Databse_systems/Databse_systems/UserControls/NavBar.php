<?php

require(dirname(__FILE__)."/DBconfig.php");

$username = $_SESSION['username'];


$query = "CALL GetRole('$username')";
$result = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($result);

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Collectables Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav pull-sm-left">
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-logo mx-auto">
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" action="Default.php">
                    <div class="input-group">
                        <input name="searchTerm" type="text" class="form-control" placeholder="Search" autocomplete="off" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" name="searchSubmit" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav pull-sm-right">
            <?php if($data['role'] == 'admin'): ?>
            <li class="nav-item">
                <a href="./manage_site/Default.php" class="btn btn-outline-secondary" style="margin-right: .5em;">Manage Site</a>
            </li>
            <?php endif;  ?>
            <li class="nav-item">
                <a href="account.php" class="btn btn-outline-primary" style="margin-right: .5em;">
                    <span>Account <?php echo $_SESSION['username'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-outline-info my-2 my-sm-0" style="margin-right:.5em;">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
            </li>
            <li class="nav-item">
                <a href="../login/Default.php?logout='1'" class="btn btn-outline-danger my-2 my-sm-0" style="margin-right:.5em;">Logout</a>
            </li>
        </ul>
    </div>
</nav>
