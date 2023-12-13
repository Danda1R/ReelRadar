<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
require(__DIR__ . "/../../partials/flash.php");

$table = "Media";

$results = search_media($table, $_GET);

$sortableColumns = ['title', 'year', 'genre_name'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$totalPages = ceil($results["totalRows"] / $limit);

//echo "<pre>" . var_export($totalPages, true) . "</pre>";

if (count($results["results"]) == 0) {
    flash("There are no current media matching this description available.", "warning");
    die(header("Location: list_media.php"));
}
?>

<form action="" method="GET" id="searchAndSortForm">
    <input type="text" name="search" class="search-bar" placeholder="Search by title, year, or genre" value="<?php echo htmlspecialchars($search); ?>">
    <label for="limit">Limit:</label>
    <input type="number" id="limit" name="limit" min="1" max="100" value="<?php echo htmlspecialchars($limit); ?>">
    <label for="sort">Sort by:</label>
    <select id="sort" name="sort">
        <option value="title" <?php echo $sort === 'title' ? 'selected' : ''; ?>>Title</option>
        <option value="year" <?php echo $sort === 'year' ? 'selected' : ''; ?>>Year</option>
        <option value="genre_name" <?php echo $sort === 'genre_name' ? 'selected' : ''; ?>>Genre</option>
    </select>
    <select id="order" name="order">
        <option value="ASC" <?php echo $sortOrder === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
        <option value="DESC" <?php echo $sortOrder === 'DESC' ? 'selected' : ''; ?>>Descending</option>
    </select>
    <div class="page-navigation">
        <label for="page">Page:</label>
        <div class="page-arrows">
            <input type="number" id="page" name="page" min="1" max=<?php echo $totalPages ?> value="<?php echo htmlspecialchars($page); ?>" style="width: 50px;">
        </div>
    </div>
    <button type="submit">Apply</button>
</form>

<div class="card-gallery">
    <?php if (count($results) > 0) : ?>
        <?php foreach ($results['results'] as $row) : ?>
            <div class="card">
                <div class="card-mini-details">
                    <div class="card-mini-column">
                        <h3><?php echo htmlspecialchars($row['media_title']); ?></h3>
                        <?php echo ($row['api_id'] !== null) ? "<p>Created by API. API ID: " . htmlspecialchars($row['api_id']) . "</p>" : "<p>Created manually</p>"; ?>
                        <p>Year: <?php echo htmlspecialchars($row['media_year']); ?></p>
                        <p>Genre: <?php echo htmlspecialchars($row['genre_name']); ?></p>
                    </div>
                    <div class="card-mini-column">
                        <img src="<?php echo htmlspecialchars($row['media_image_url']); ?>" alt="Media Image">
                    </div>
                </div>

                <!--<img src="<?php echo htmlspecialchars($row['media_image_url']); ?>" alt="Media Image">-->

                <div class="button-container">
                    <a href="single_media_view.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button">View</a>
                    <a href="admin/delete_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button delete-button">Delete</a>
                    <a href="admin/edit_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button edit-button">Edit</a>
                </div>
                <div class="button-container">
                    <button class="button star-button <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="star">
                        <i class="fas fa-star <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>"></i>
                    </button>
                    <button class="button eye-button <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="eye">
                        <i class="fas fa-eye <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>"></i>
                    </button>
                </div>
                <div class="button-container">
                    Average Ratings:
                    <div class="rating">
                        <?php
                        $initialRating = get_average_rating($row['media_id']);
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $initialRating) {
                                echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['media_id'] . '" data-value="' . $i . '" style="color: gold;">&#9733;</span>';
                            } else {
                                echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['media_id'] . '" data-value="' . $i . '">&#9733;</span>';
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

<?php
require(__DIR__ . "/../../partials/footer.php");
?>
