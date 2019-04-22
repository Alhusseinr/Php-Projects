<?php include('../server/Default.php') ?>

<!--<section id="topNav">
    <?php if(isset($_COOKIE['login'])) : ?>
    <div class="row" style="margin-top: 1em;">
        <div class="col-md-4">
            <h3>
                Welcome
                <strong>
                    <?php echo $_SESSION['username']; ?>
                </strong>
            </h3>
        </div>
        <div class="col-md-8" style="text-align: right !important;"></div>
    </div>
    <?php endif ?>
</section>
<section id="searchBar" style="margin-top:.75em;">
    <div class="row">
        <form method="post" action="index.php" id="searchForm" style="width: 100%;">
            <div class="col-md-12"></div>
            <div class="col-md-12">
                <?php include('errors.php')?>
            </div>
        </form>
    </div>
</section>-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
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
            <li class="nav-item">
                <a href="account.php" class="btn btn-outline-primary" style="margin-right: .5em;">
                    <!--<span style="font-size:12px;">
                        Welcome <?php echo $_SESSION['username'] ?>
                    </span>
                    <br />-->
                    <span>Account</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../login/Default.php?logout='1'" class="btn btn-outline-danger my-2 my-sm-0" style="margin-right:.5em;">Logout</a>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-outline-info my-2 my-sm-0">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
            </li>
        </ul>
    </div>
</nav>
