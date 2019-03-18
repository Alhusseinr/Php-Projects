<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Book-O-Rama Catalog Search</title>
        <style>
            .form-control:focus{
                box-shadow: none;
            }
            .btn:focus{
                box-shadow: none;
            }
            .btn-outline-primary:focus{
                box-shadow: none;
            }
            .btn-outline-success:focus{
                box-shadow: none;searchterm
            }
        </style>
    </head>
    <body class="container" style="margin-top: 12em;">
    <div class="row" style="margin: 0px;">
        <div class="col-md-12">
            <h1 style="text-align: center;"> Book-O-Rama Catalog Search </h1>
            <form action="results.php" method="post" id="results">
                <div class="row">
                    <div class="col-md-6">
                        <label>Choose Search Type:</label>
                        <select name="searchtype" class="form-control">
                            <option value="author">Author</option>
                            <option value="title">Title</option>
                            <option value="isbn">ISBN</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Enter Search Term:</label>
                        <input name="searchterm"  type="text" size="40" autocomplete="off" class="form-control"/>
                    </div>
                    <div class="col-md-12" style="margin-top:1em; text-align: right;">
                        <input type="submit" name="submit" value="Search" class="btn btn-outline-primary" />
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <h1 style="text-align: center;">Book-O-Rama - New Book Entry</h1>
            <form action="insert_book.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label>ISBN</label>
                        <input type="text" name="isbn" maxlength="13" size="13" autocomplete="off" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label>Author</label>
                        <input type="text" name="author" maxlength="30" size="30" autocomplete="off" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" maxlength="60" size="30" autocomplete="off" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label>Price $</label>
                        <input type="text" name="price" maxlength="7" size="7" autocomplete="off" class="form-control" />
                    </div>
                    <div class="col-md-12" style="margin-top:1em; text-align: right;">
                        <input type="submit" value="Register" class="btn btn-outline-success">
                    </div>
                </div>
            </form>
        </div>
    </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>










