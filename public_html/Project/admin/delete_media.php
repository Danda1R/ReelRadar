<?php
require_once(__DIR__ . "/../../../partials/nav.php");
require(__DIR__ . "/../../../partials/flash.php");

if (!has_role("Admin")) {
    flash("You must be an Admin to delete media", "warning");
    die(header("Location: $BASE_PATH" . "/list_media.php"));
}

$table = "Media";

$media_id = isset($_GET['id']) ? $_GET['id'] : null;
$sortableColumns = ['title', 'year', 'genre_name'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Validate the ID (perform necessary checks based on your application logic)
// Redirect back to list page with a message for an invalid ID
if (!$media_id) {
    // Redirect back to the list page with an error message
    flash("Invalid media ID", "warning");
    die(header("Location: ../list_media.php"));
}

$results = list_single_media($table, $_GET);

//echo "<pre>" . var_export(count($results), true) . "</pre>";

if (count($results) == 0) {
    flash("This ID does not exist", "warning");
    die(header("Location: ../list_media.php"));
}

if (isset($_POST["submit"])) {
    //echo "<pre>" . var_export($_POST, true) . "</pre>";

    if (isset($_POST['agreeCheckbox']) && $_POST['yesNoRadio'] == 'yes') {
        $db = getDB();
        $query = "SELECT md.id AS media_details_id FROM Media m JOIN Media_Details md ON m.details_id = md.id WHERE m.id = :media_id;";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':media_id', $media_id, PDO::PARAM_INT);

        $results = [];

        try {
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            flash("Failed to fetch data", "danger");
            error_log(var_export($e, true));
            return -1;
        }

        $media_details_id = $results[0]["media_details_id"];

        $db = getDB();
        $query = "DELETE FROM Media WHERE id = :media_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':media_id', $media_id, PDO::PARAM_INT);
        $results = [];
        try {
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            flash("The media was not deleted", "danger");
            error_log(var_export($e, true));
            return -1;
        }

        $db = getDB();
        $query = "DELETE FROM Media_Details WHERE id = :media_details_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':media_details_id', $media_details_id, PDO::PARAM_INT);
        $results = [];
        try {
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            flash("The media was not deleted", "danger");
            error_log(var_export($e, true));
            return -1;
        }

        flash("Successfully deleted the media", "warning");
        die(header("Location: " . "../list_media.php?search=$search&limit=$limit&sort=$sort&order=$sortOrder"));
    }
}

?>
<div class="button-container-left">
    <a href="../list_media.php?search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button back-button">Back</a>
    <a href="../single_media_view.php?id=<?php echo $media_id; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button">View</a>
    <a href="edit_media.php?id=<?php echo $media_id; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class=" button edit-button">Edit</a>
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
<div>
    <form method="POST">
        <label for="yesNoCheckbox">Are you sure you want to delete this media?</label><br>
        <input type="checkbox" id="yesNoCheckbox" name="agreeCheckbox">
        <label for="yesNoCheckbox">Agree</label><br>

        <p>Select Yes To Confirm:</p>
        <input type="radio" id="yesRadio" name="yesNoRadio" value="yes">
        <label for="yesRadio">Yes</label><br>
        <input type="radio" id="noRadio" name="yesNoRadio" value="no">
        <label for="noRadio">No</label><br>

        <input class="btn btn-primary" type="submit" value="Delete" name="submit" />
    </form>
</div>


<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>
