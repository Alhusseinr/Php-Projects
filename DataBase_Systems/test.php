<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Book-O-Rama Catalog Search</title>
    </head>
    <body>
    <div class="row" style="margin: 0px;">
        <div class="col-md-6">
            <h1> Book-O-Rama Catalog Search </h1>

            <form action="results.php" method="post">
                Choose Search Type:
                <br />
                <select name="searchtype" class="form-control">
                    <option value="author">Author</option>
                    <option value="title">Title</option>
                    <option value="isbn">ISBN</option>
                </select>
                <br />
                Enter Search Term:
                <br />
                <input name="searchterm"  type="text" size="40" autocomplete="off" class="form-control"/>
                <br />
                <input type="submit" name="submit" value="Search" class="btn btn-outline-success" />

            </form>
        </div>
        <div class="col-md-6">
            <h1>Book-O-Rama - New Book Entry</h1>
            <form action="insert_book.php" method="post">
                <table border="0">
                    <tr>
                        <td>ISBN</td>
                        <td>
                            <input type="text" name="isbn" maxlength="13" size="13" autocomplete="off" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>
                            <input type="text" name="author" maxlength="30" size="30" autocomplete="off" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" maxlength="60" size="30" autocomplete="off" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>Price $</td>
                        <td>
                            <input type="text" name="price" maxlength="7" size="7" autocomplete="off" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Register" class="btn btn-outline-success">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>










