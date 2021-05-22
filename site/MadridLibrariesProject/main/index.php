<?php include('./partials/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <div class="image-center">
            <img src="../images/MadridVintage.png" title="Madrid Vintage" alt="Madrid Vintage" />
        </div>
        <br><br><br>
        <div class="image-center">
            <form action="search.php" method="post">
                Search Term: <select name="themeToSearch">
                    <name="theme" <?php

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
                                            echo "<option value='" . ucwords($row['themes']) . "'>" . ucwords($row['themes']) . "</option>";
                                        }
                                        echo "</select>";
                                    }

                                    ?>>
                </select><br>
                <input type="submit">
            </form>
        </div>

    </div>
</div>
<!-- Main Section ENDS -->

<?php include('./partials/footer.php'); ?>