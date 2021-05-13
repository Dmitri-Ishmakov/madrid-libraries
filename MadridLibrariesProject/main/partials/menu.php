<!-- Menu Section Starts -->
<html lang="sp">

<head>
    <title>Madrid Libraries Project - Mitchel and James Smith</title>

    <link rel="stylesheet" href="../css/main.css">
    <?php mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli("localhost", "root", "t8G54prZ@Nfr", "madrid_libraries_project");
    ?>
</head>

<body>

    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./books.php">Books</a></li>
                <li><a href="./authors.php">Authors</a></li>
                <li><a href="./illustrators.php">Illustrators</a></li>
                <li><a href="./lists.php">Lists</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section ENDS -->