<?php include('server.php') ?>
<section id="topNav">
    <?php if(isset($_SESSION['username'])) : ?>
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
<section id="searchBar">
    <div class="row">
        <div class="input-group my-2 mb-3 col-md-12">
            <form method="post" action="nav.php" id="searchForm">
                <input type="text" name="searchTerm" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit" name="searchSubmit">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>