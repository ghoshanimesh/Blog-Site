<!-- AVAILABLE CATEGORIES -->

<div class="col-xs-12">
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>Category Title</th>
            <th></th>
            <th></th>
        </tr>
        <tbody>
            <?php   
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);                
                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    echo "<tr>";
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td>$cat_id</td>";
                    echo "<td>$cat_title</td>";
                    echo "<td><a class='btn btn-danger' href='categories.php?delete=$cat_id'><span class='fa fa-times'> Delete</span></a></td>";
                    echo "<td><a class='btn btn-primary' href='categories.php?edit=$cat_id'><span class='fa fa-pencil'> Edit</span></a></td>";
                    echo "</tr>";
                }
                if(isset($_GET['delete'])){
                    $delete_id = $_GET['delete'];
                    $query = "DELETE FROM categories WHERE cat_id=$delete_id";
                    $delete_query = mysqli_query($connection, $query);
                    header("Location: categories.php");
                }
            ?>                                                               
        </tbody>
    </table>
</div>




