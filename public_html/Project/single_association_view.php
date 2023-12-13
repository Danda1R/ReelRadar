<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
require(__DIR__ . "/../../partials/flash.php");

$previousPage = $_SERVER['HTTP_REFERER'];

$table = "Media";
$media_id = isset($_GET['id']) ? $_GET['id'] : null;
$sortableColumns = ['title', 'year', 'genre_name'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$results = list_single_media($table, $_GET);
error_log("Session data: " . var_export($results, true));

if (count($results) == 0) {
    flash("This ID does not exist", "warning");
    die(header("Location: list_media.php"));
}

?>
<div class="button-container-left">
    <a href="<?php echo $previousPage; ?>" class="button back-button">Back</a>
    <a href="admin/delete_media.php?id=<?php echo $media_id; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button delete-button">Delete</a>
</div>
<div class="card-details">
    <div class="media-details media-title">
        <h2><?php echo htmlspecialchars($results[0]['original_title']); ?>
            <span class="year"><?php echo htmlspecialchars($results[0]['year']); ?></span>
        </h2>
        <img src="<?php echo htmlspecialchars($results[0]['image_url']); ?>" alt="Media Image">
        <p class="caption"><?php echo htmlspecialchars($results[0]['image_caption']); ?></p>
    </div>
    <div class="media-details media-type-details">
        <button class="button star-button <?php echo $results[0]['isFavorite'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $results[0]['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="star">
            <i class="fas fa-star <?php echo $results[0]['isFavorite'] == 1 ? 'filled' : ''; ?>"></i>
            Add to your Favorites
        </button>
        <button class="button eye-button <?php echo $results[0]['isWatched'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $results[0]['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="eye">
            <i class="fas fa-eye <?php echo $results[0]['isWatched'] == 1 ? 'filled' : ''; ?>"></i>
            Add to your Watched
        </button>
        <div class="button-container-left">
            Your Ratings:
            <div class="rating">
                <?php
                $initialRating = get_rating($media_id);
                error_log("Session data: " . var_export($initialRating, true));
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $initialRating) {
                        echo '<span class="star" data-user-id="' . get_user_id() . '" data-media-id="' . $results[0]['media_id'] . '" data-value="' . $i . '" style="color: gold;">&#9733;</span>';
                    } else {
                        echo '<span class="star" data-user-id="' . get_user_id() . '" data-media-id="' . $results[0]['media_id'] . '" data-value="' . $i . '">&#9733;</span>';
                    }
                }
                ?>
            </div>
            <div class="selected-rating"></div>

        </div>
    </div>
    <div class="media-details media-type-details">
        <h2>Genre:</h2>
        <p><?php echo htmlspecialchars($results[0]['genre_name']); ?></p>
        <h2>List:</h2>
        <p><?php echo htmlspecialchars($results[0]['list_name']); ?></p>
        <h2>Type of Media:</h2>
        <p><?php echo htmlspecialchars($results[0]['type_name']); ?></p>
    </div>
    <div class="media-details media-api-details">
        <p>Released on <?php echo date("m/d/Y", strtotime($results[0]['release_date'])); ?></p>
        <p><?php echo htmlspecialchars($output = ($results[0]['isSeries'] == 1) ? "This media is a series" : "This media is not a series"); ?></p>
        <p><?php echo htmlspecialchars($output = ($results[0]['isEpisode'] == 1) ? "This media is an episode" : "This media is not a episode"); ?></p>
        <br>
        <?php echo ($results[0]['api_id'] !== null) ? "<p>This media was created by the API. The API ID is " . htmlspecialchars($results[0]['api_id']) .
            "</p><br><p>It was created on " . htmlspecialchars($results[0]['created']) . " and last modified on " . htmlspecialchars($results[0]['modified']) .
            " </p>" : "<p>Created manually</p>";
        ?>
    </div>
</div>

<?php
require(__DIR__ . "/../../partials/footer.php");
?>
