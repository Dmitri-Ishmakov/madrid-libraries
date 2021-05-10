<?php include('./partials/menu.php');
$conn = new mysqli("localhost", "root", "t8G54prZ@Nfr", "madrid_libraries_project");?>

<!-- Main Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Authors</h1>
        <br /><br /><br />
        <!-- Button to add author-->
        <a href="#" class="btn-primary">Add Author</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>Author_ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
            <?php
            
            //set up the query
            $sql= "SELECT * FROM authors";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);

            if($count>0){
                //do things, not empty
                while($row=mysqli_fetch_assoc($res)){
                    $author_id = $row['author_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                
                ?>
            <tr>
                <td><?php echo $author_id?></td>
                <td><?php echo $first_name?></td>
                <td><?php echo $last_name?></td>
                <td><a href="#" class="btn-secondary">Update Author</a><a href="#" class="btn-tertiary">Delete
                        Author</a></td>
            </tr>
            <?php 
        } 
        } ?>

        </table>

    </div>
</div>
<!-- Main Section Starts -->

<?php include('./partials/footer.php'); ?>