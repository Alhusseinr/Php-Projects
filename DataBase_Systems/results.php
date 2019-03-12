<html>

    <head>
        <title>Book-O-Rama Search Results</title>
    </head>
    <body>
        <h1>Book-O-Rama Search Results</h1>
    </body>
    <?php
        // create short var names
        $searchType = $_POST['searchtype'];
        $searchTerm = trim($_POST['searchterm']);
        echo $searchType." ".$searchType;

        if(!$searchType || !$searchTerm){
            echo "You have not entered search details.  Please go back and try again.";
            exit;
        }

        if(!get_magic_quotes_gpc()){
            $searchType = addslashes($searchType);
            $searchTerm = addslashes($searchTerm);
        }

        @ $db = new mysqli('localhost', 'root','','database_systems' );

        echo mysqli_connect_errno();

        if(mysqli_connect_errno()){
            echo 'Error: Could not connect to database.  Please try again later.';
            exit;
        }

        // $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
        $query = "select * from books";
        $result = $db -> query($query);

        $num_results = $result -> num_rows;

        echo "<p>Number of books found: ".$num_results."</p>";

        for($i = 0; $i < $num_results; $i++){
            $row = $result -> fetch_assoc();
            echo "<p><strong>".($i + 1).".Title: ";
            echo htmlspecialchars(stripslashes($row['title']));
            echo "</strong><br />Author: ";
            echo stripslashes($row['author']);
            echo "<br />ISBN: ";
            echo stripslashes($row['isbn']);
            echo "<br />Price: ";
            echo stripslashes($row['price']);
            echo "</p>";
        }

        $result -> free();
        $db -> close();

    ?>
</html>