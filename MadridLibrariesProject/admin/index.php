<?php include('./partials/menu.php'); ?>

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