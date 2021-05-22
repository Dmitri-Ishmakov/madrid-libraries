<?php include('./partials/menu.php'); ?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Illustrators</h1>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Illustrator_ID</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
            <?php

            //set up the query
            $sql = "SELECT * FROM illustrators";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //do things, not empty
                while ($row = mysqli_fetch_assoc($res)) {
                    $illustrator_id = ucwords($row['illustrator_id']);
                    $first_name = ucwords($row['first_name']);
                    $last_name = ucwords($row['last_name']);

            ?>
            <tr>
                <td><?php echo $illustrator_id ?></td>
                <td><?php echo $first_name ?></td>
                <td><?php echo $last_name ?></td>
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