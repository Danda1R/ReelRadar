<?php
require_once(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true, "../login.php");
?>

<?php

$results = search_all_non_associations($_GET);


$sortableColumns = ['title', 'year', 'numOfStars'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';

$count_results = search_all_non_associations_count($limit, $_GET);
$count = $count_results[0]["row_count"];

$numOfPage = $count > $limit ? $limit : $count;

if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "Delete All Associations Searched") {
        error_log(var_export($_POST, true));
        delete_all_associations_onscreen($results);
        die(header("Location: list_all_associations.php"));
    } else if ($_POST["submit"] == "Delete") {
        $class_id = $_POST["class_id"];
        delete_an_association_onscreen($class_id);
        die(header("Location: list_all_associations.php?searchType=$searchType&search=$search&limit=$limit&sort=$sort&order=$sortOrder"));
    }
}

?>
<form action="" method="GET" id="searchAndSortForm">
    <select id="search" name="searchType">
        <option value="title" <?php echo $searchType === 'title' ? 'selected' : ''; ?>>Title</option>
        <option value="year" <?php echo $searchType === 'year' ? 'selected' : ''; ?>>Year</option>
    </select>
    <input type="text" name="search" class="search-bar" placeholder="Search by title or year" value="<?php echo htmlspecialchars($search); ?>">
    <label for="limit">Limit:</label>
    <input type="number" id="limit" name="limit" min="1" max="100" value="<?php echo htmlspecialchars($limit); ?>">
    <label for="sort">Sort by:</label>
    <select id="sort" name="sort">
        <option value="title" <?php echo $sort === 'title' ? 'selected' : ''; ?>>Title</option>
        <option value="year" <?php echo $sort === 'year' ? 'selected' : ''; ?>>Year</option>
        <option value="numOfStars" <?php echo $sort === 'numOfStars' ? 'selected' : ''; ?>>Ratings</option>
    </select>
    <select id="order" name="order">
        <option value="ASC" <?php echo $sortOrder === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
        <option value="DESC" <?php echo $sortOrder === 'DESC' ? 'selected' : ''; ?>>Descending</option>
    </select>
    <button type="submit">Apply</button>
</form>
<h3>View All Non-Associations</h3>
<h5>Total number of media without associations: <?php echo $count ?></h5>
<h5>Total number of media on this page: <?php echo $numOfPage ?></h5>

<?php if (count($results) == 0) : ?>
    <p>No results to show</p>
<?php else : ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <?php foreach ($results as $index => $record) : ?>
                <?php if ($index == 0) : ?>
                    <thead class="thead-dark">
                        <tr>
                            <?php foreach ($record as $column => $value) : ?>
                                <?php if ($column != "id" and $column != "user_id" and $column != "class_id") : ?>
                                    <th><?php echo htmlspecialchars($column); ?></th>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php endif; ?>
                    <tr>
                        <?php foreach ($record as $column => $value) : ?>
                            <?php if ($column == "api_id" && $value == NULL) : ?>
                                <td><?php echo htmlspecialchars("No ID. Manually Created"); ?></td>
                            <?php elseif ($column == "username") : ?>
                                <th>
                                    <a href="view_profile.php?user_id=<?php echo $record["user_id"]; ?>&username=<?php echo $record["username"]; ?>">
                                        <?php echo htmlspecialchars($value); ?>
                                    </a>
                                </th>
                            <?php elseif ($column != "id" and $column != "user_id" and $column != "class_id") : ?>
                                <th><?php echo htmlspecialchars($value); ?></th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="../single_association_view.php?id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
