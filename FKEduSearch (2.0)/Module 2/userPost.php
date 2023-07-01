<?php
$page = 'your post';
include 'includes/menu.php';
include 'search.php';
include 'chart_library.php';
?>

<!-- select maksudnya ambik data dari db -->

<?php
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error());

$query = "SELECT * FROM post" or die(mysqli_connect_error());
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    $numberIncrement = 1;
    ?>

    <table border="2" style="width: 100%;">
        <tr>
            <th class="thlist">No.</th>
            <th class="thlist">Category</th>
            <th class="thlist">Post Title</th>
            <th class="thlist">Post Question</th>
            <th class="thlist">Post Date Created</th>
            <th class="thlist">Post Status</th> <!-- New column for post status -->
            <th class="thlist">Rate the Expert</th>
            <th class="thlist">Post Likes</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="trlist">
                <td><?php echo $numberIncrement; ?></td>
                <td><?php echo $row['post_categories']; ?></td>
                <td><?php echo $row['post_title']; ?></td>
                <td><?php echo $row['post_content']; ?></td>
                <td><?php echo $row['post_createdDate']; ?></td>
                <td><?php echo $row['post_status']; ?></td> <!-- Display post status -->
                <td>
                    <form method="POST" action="rating.php">
                        <input type="hidden" name="expert_id" value="<?php echo $row['expert_ID']; ?>">
                        <select name="rating_value">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input type="submit" value="Rate">
                    </form>
                </td>
                <td><?php echo $row['post_likes']; ?></td>
            </tr>
            <?php
            $numberIncrement++; // Increment the numberIncrement variable
        }
        ?>

    </table>

    <div id="posts">
        <div class="add-post">
            <a href="addPost.php"><i class="fas fa-plus"></i> Add Post</a>
        </div>
    </div>

    <?php
} else {
    echo "No Data in Database -----";
}
?>
<?php
include 'includes/footer.php';
?>
