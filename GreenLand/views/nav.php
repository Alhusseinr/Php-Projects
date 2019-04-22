<?php include('server.php') ?>
<section id="topNav">
    <?php if(isset($_COOKIE['login'])) : ?>
    <div class="row" style="margin-top: 1em;">
        <div class="col-md-4">
            <h3>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h3>
        </div>
        <div class="col-md-8" style="text-align: right !important;">
            <a href="account.php" class="btn btn-outline-primary" style="margin-right: .5em;">Account</a>
            <a href="login.php?logout='1'" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
        </div>
    </div>
    <?php endif ?>
</section>
<section id="searchBar" style="margin-top:.75em;">
    <div class="row">
        <form method="post" action="index.php" id="searchForm" style="width: 100%;">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input name="searchTerm" type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" name="searchSubmit" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php include('errors.php')?>
            </div>
        </form>
    </div>
</section>