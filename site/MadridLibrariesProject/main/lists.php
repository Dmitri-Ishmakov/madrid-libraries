<?php include('./partials/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Lists</h1>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Year</th>
                <th>num_books</th>
            </tr>

            <?php

            //set up the query
            $sql = "SELECT `year`, COUNT(*) AS num_books FROM lists INNER JOIN books ON books.list_id = lists.list_id  GROUP BY `year`";

            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $year = ucwords($row['year']);
                    $num_books = ucwords($row['num_books']);

            ?>
            <tr>
                <form action="searchList.php" method="post">
                    <td>
                        <input type="checkbox" id=<?php echo "$year" ?> name=<?php echo "$year" ?>
                            value=<?php echo "$year" ?>>
                        <label for=<?php echo "$year" ?>> <?php echo "$year" ?> </label><br>
                    </td>
                    <td><?php echo $num_books ?></td>


            </tr>
            <?php
                }
            } ?>
        </table>
        <input type="submit" value="Submit">
        <input type="reset">
        </form>
    </div>
</div>
<!-- Main Section Starts -->

<?php include('./partials/footer.php'); ?>