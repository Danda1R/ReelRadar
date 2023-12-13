<?php
require_once(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true);
?>

<?php

$user_id = $_GET['user_id'];
$username = $_GET['username'];

$results = search_associations_by_user($user_id, $_GET);


$sortableColumns = ['title', 'year', 'numOfStars'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$count_results = search_associations_count_by_user($limit, $user_id, $_GET);
$count = $count_results[0]["row_count"];

$numOfPage = $count > $limit ? $limit : $count;

if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "Delete All Associations") {
        delete_all_associations();
        die(header("Location: list_associations.php?search=$search&limit=$limit&sort=$sort&order=$sortOrder"));
    } else if ($_POST["submit"] == "Delete") {
        delete_an_association($_POST["id"]);
        //error_log(var_export($_POST, true));
        die(header("Location: list_associations.php?search=$search&limit=$limit&sort=$sort&order=$sortOrder"));
    }
}

?>
<form action="" method="GET" id="searchAndSortForm">
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
<a href="list_all_associations.php?search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button back-button">Back</a>
<h3>View <?php echo $username ?>'s Associations</h3>
<h5>Total number of associations with this account: <?php echo $count ?></h5>
<h5>Total number of associations on this page: <?php echo $numOfPage ?></h5>

<button id="toggleViewBtn">Toggle View</button>

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
                                <?php if ($column != "id" && $column != "image_url") : ?>
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
                            <?php elseif ($column != "id" && $column != "image_url") : ?>
                                <th><?php echo htmlspecialchars($value); ?></th>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="../single_association_view.php?id=<?php echo $record['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                </div>
                                <?php if (has_role("Admin")) : ?>
                                    <div class="col-md-6">
                                        <form method="POST">
                                            <input type="hidden" name="id" value=<?php echo $record['id']; ?> />
                                            <input class="btn btn-primary btn-sm" type="submit" value="Delete" name="submit" />
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
        </table>
    </div>
    <div class="card-gallery">
        <?php if (count($results) > 0) : ?>
            <?php foreach ($results as $row) : ?>
                <div class="card">
                    <div class="card-mini-details">
                        <div class="card-mini-column">
                            <h3><?php echo htmlspecialchars($row['media_title']); ?></h3>
                            <?php echo ($row['api_id'] !== null) ? "<p>Created by API. API ID: " . htmlspecialchars($row['api_id']) . "</p>" : "<p>Created manually</p>"; ?>
                            <p>Year: <?php echo htmlspecialchars($row['release_year']); ?></p>
                        </div>
                        <div class="card-mini-column">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Media Image">
                        </div>
                    </div>

                    <div class="button-container">
                        <a href="single_media_view.php?id=<?php echo $row['id']; ?>" class="button">View</a>
                        <a href="admin/delete_media.php?id=<?php echo $row['id']; ?>" class="button delete-button">Delete</a>
                        <a href="admin/edit_media.php?id=<?php echo $row['id']; ?>" class="button edit-button">Edit</a>
                    </div>
                    <div class="button-container">
                        <button class="button star-button <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="star">
                            <i class="fas fa-star <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>"></i>
                        </button>
                        <button class="button eye-button <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="eye">
                            <i class="fas fa-eye <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>"></i>
                        </button>
                    </div>
                    <div class="button-container">
                        Average Ratings:
                        <div class="rating">
                            <?php
                            $initialRating = get_average_rating($row['id']);
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $initialRating) {
                                    echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['id'] . '" data-value="' . $i . '" style="color: gold;">&#9733;</span>';
                                } else {
                                    echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['id'] . '" data-value="' . $i . '">&#9733;</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php endif; ?>

<script src=" https://code.jquery.com/jquery-3.6.0.min.js">
</script>
<script>
    $(document).ready(function() {
        $('.card-gallery').hide();
        $('#toggleViewBtn').on('click', function() {
            $('.table-responsive').toggle();
            $('.card-gallery').toggle();
        });
    });
</script>
