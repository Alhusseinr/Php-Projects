<html>
    <head>
        <title>Book-O-Rama Book Entry Result</title>
    </head>
    <body>
        <h1>Book-O-Rama Book Entry Results</h1>
        <?php
            // short var name
            $isbn = $_POST['isbn'];
            $author = $_POST['author'];
            $title = $_POST['title'];
            $price = $_POST['price'];

            if(!$isbn || !$author || !$title || !$price){
                echo "You have not entered all the required details.<br />"."Please go back and try again.";
                exit;
            }

            if(!get_magic_quotes_gpc()){
                $isbn = addslashes($isbn);
                $author = addslashes($author);
                $title = addslashes($author);
                $price = addslashes($price);
            }

            @ $db = new mysqli('localhost', 'root','','database_systems' );

            if(mysqli_connect_errno()){
                echo "Error: Could not connect to database.  Please try again later.";
                exit;
            }

            $query = "insert into books values('".$isbn."', '".$author."', '".$title."', '".$price."')";

            $result = $db -> query($query);

            if($result){
                echo $db -> affected_rows." book inserted into database";
            }else{
                echo "An error has occurred.  The item was not added.";
                echo error_log();
            }

            $db -> close();

        ?>
    </body>
</html>