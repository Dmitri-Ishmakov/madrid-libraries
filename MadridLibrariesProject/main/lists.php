<?php include('./partials/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Lists</h1>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>List ID</th>
                <th>Ages</th>
                <th>Year</th>
            </tr>
            <?php

            //set up the query
            $sql = "SELECT * FROM lists";

            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            
            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $list_id = ucwords($row['list_id']);
                    $ages = ucwords($row['ages']);
                    $year = ucwords($row['year']);

            ?>
            <tr>
                <td><?php echo $list_id ?></td>
                <td><?php echo $ages ?></td>
                <td><?php echo $year ?></td>
                <td><a href="#" class="btn-secondary">More Info</a>
            </tr>
            <?php
                }
            } ?>
        </table>

    </div>
</div>
<!-- Main Section Starts -->

<?php include('./partials/footer.php'); ?>