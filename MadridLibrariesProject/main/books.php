<?php include('./partials/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>All Books</h1>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Title</th>
                <th>Authors First Name(s)</th>
                <th>Authors Last Name(s)</th>
                <th>Illustrators First Name(s)</th>
                <th>Illustrators Last Name(s)</th>
                <th>Themes</th>
            </tr>
            <?php

            //set up the query
            $sql = "SELECT  
                        Title,
                        authors.first_name AS author_first_name,
                        authors.last_name AS author_last_name,
                        illustrators.first_name AS illustrator_first_name,
                        illustrators.last_name AS illustrator_first_name,
                        Concat_WS(', ', Theme_1, Theme_2, Theme_3, Theme_4) AS Themes 
                        FROM books
                        INNER JOIN authors ON books.author_id=authors.author_id
                        INNER JOIN illustrators ON books.illustrator_id=illustrators.illustrator_id
                        ORDER BY book_id;";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $Title = ucwords($row['Title']);
                    $author_first_name = ucwords($row['author_first_name']);
                    $author_last_name = ucwords($row['author_last_name']);
                    $illustrator_first_name = ucwords($row['illustrator_first_name']);
                    $illustrator_first_name = ucwords($row['illustrator_first_name']);
                    $Themes = ucwords($row['Themes']);

            ?>
            <tr>
                <td><?php echo $Title ?></td>
                <td><?php echo $author_first_name ?></td>
                <td><?php echo $author_last_name ?></td>
                <td><?php echo $illustrator_first_name ?></td>
                <td><?php echo $illustrator_first_name ?></td>
                <td><?php echo $Themes ?></td>
                <td><a href="#" class="btn-secondary">More Info</a></td>
            </tr>
            <?php
                }
            } ?>

        </table>

    </div>
</div>
<!-- Main Section Starts -->

<?php include('./partials/footer.php'); ?>