<!-- Menu Section Starts -->
<html lang="sp">

<head>
    <title>Madrid Libraries Project - Mitchel and James Smith</title>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="./admin/index.php">Home</a></li>
                <li><a href="./admin/lists.php">Lists</a></li>
                <li><a href="./admin/books.php">Books</a></li>
                <li><a href="./admin/authors.php">Authors</a></li>
                <li><a href="./admin/illustrators.php">Illustrators</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section ENDS -->

    <!-- Main Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <form action="search.php" method="post">
                Search Term: <select name="themeToSearch">

                    <name="theme" <?php
                                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                                    $conn = new mysqli("localhost", "root", "t8G54prZ@Nfr", "madrid_libraries_project");

                                    //set up the query
                                    $sql = "SELECT DISTINCT Theme_1 as themes FROM books 
                UNION
                SELECT DISTINCT Theme_2 as themes FROM books
                UNION
                SELECT DISTINCT Theme_3 as themes FROM books
                UNION
                SELECT DISTINCT Theme_4 as themes FROM books;";
                                    //execute the query
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);

                                    echo "<select name='theme'>";
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option value='" . $row['themes'] . "'>" . $row['themes'] . "</option>";
                                        }
                                        echo "</select>";
                                    }

                                    ?>>
                </select><br>
                <input type="submit">
            </form>


        </div>
    </div>
    <!-- Main Section ENDS -->

    <?php include('./partials/footer.php'); ?>