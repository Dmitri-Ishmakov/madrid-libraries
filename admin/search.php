<?php include('./partials/menu.php'); ?>
<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Searching for books containing <?php echo ucwords($_POST["themeToSearch"]) ?></h1>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Title</th>
                <th>Author First Names</th>
                <th>Author Last Names</th>
                <th>Illustrator First Names</th>
                <th>Illustrator Last Names</th>
                <th>Themes</th>
            </tr>
            <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $conn = new mysqli("localhost", "root", "t8G54prZ@Nfr", "madrid_libraries_project");
            //set up the query
            $sql2 = "SELECT Title,
            authors.first_name as aFirstName,
            authors.last_name as aLastName,
            illustrators.first_name as iFirstName,
            illustrators.last_name as iLastName,
            Concat_WS(',', Theme_1, Theme_2, Theme_3, Theme_4) AS Themes 
            FROM books
            INNER JOIN authors ON books.author_id=authors.author_id
            INNER JOIN illustrators ON books.illustrator_id=illustrators.illustrator_id
            WHERE Theme_1 = '{$_POST["themeToSearch"]}' 
            OR Theme_2 = '{$_POST["themeToSearch"]}' 
            OR Theme_3 = '{$_POST["themeToSearch"]} '
            OR Theme_4 = '{$_POST["themeToSearch"]}' ";
            //execute the query
            $res = mysqli_query($conn, $sql2);
            //count the rows
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $title = ucwords($row['Title']);
                    $authors_first_names = ucwords($row['aFirstName']);
                    $authors_last_names = ucwords($row['aLastName']);
                    $illustrator_first_names = ucwords($row['iFirstName']);
                    $illustrator_last_names = ucwords($row['iLastName']);
                    $themes = ucwords($row['Themes']);
            ?>
            <tr>
                <td><?php echo $title ?></td>
                <td><?php echo $authors_first_names ?></td>
                <td><?php echo $authors_last_names ?></td>
                <td><?php echo $illustrator_first_names ?></td>
                <td><?php echo $illustrator_last_names ?></td>
                <td><?php echo $themes ?></td>
            </tr>

            <?php
                }
            } ?>
        </table>
        <br /><br />
        <a href="./index.php" class="btn-Primary right">New Search</a>
    </div>
</div>
<?php include('./partials/footer.php'); ?>