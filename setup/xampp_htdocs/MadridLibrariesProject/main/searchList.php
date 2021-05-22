<?php include('./partials/menu.php'); ?>
<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <?php $searchValue = "";
        foreach ($_POST as $value) {
            $searchValue = $searchValue . $value . ", ";
        }
        $searchValue = rtrim($searchValue, ", ");
        ?>
        <h1>Searching for Lists From <?php echo $searchValue ?></h1>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Year</th>
                <th>Ages</th>
                <th>num_books</th>
            </tr>
            <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $conn = new mysqli("localhost", "root", "t8G54prZ@Nfr", "madrid_libraries_project");
            $searchTerm = "SELECT `year`, ages, COUNT(*) AS num_books FROM lists INNER JOIN books ON books.list_id = lists.list_id WHERE `year` IN ({$searchValue}) GROUP BY `year`, ages";
            //set up the query
            $sql2 = $searchTerm;
            //execute the query
            $res = mysqli_query($conn, $sql2);
            //count the rows
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $year = ucwords($row['year']);
                    $ages = ucwords($row['ages']);
                    $num_books = ucwords($row['num_books']);

            ?>
            <tr>
                <td><?php echo $year ?></td>
                <td><?php echo $ages ?></td>
                <td><?php echo $num_books ?></td>
            </tr>

            <?php
                }
            } ?>
        </table>
        <br /><br />
        <a href="./lists.php" class="btn-Primary right">Back To Lists</a>
    </div>
</div>
<?php include('./partials/footer.php'); ?>