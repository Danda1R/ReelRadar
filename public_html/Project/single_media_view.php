<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Single media View</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 400px;
            height: 400px;
            display: inline-block;
            float: left;
        }

        .card img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <?php
    require_once(__DIR__ . "/../../partials/nav.php");
    is_logged_in(true);
    require(__DIR__ . "/../../partials/flash.php");

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
        <a href="list_media.php?search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button back-button">Back</a>
        <a href="admin/edit_media.php?id=<?php echo $media_id; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button edit-button">Edit</a>
        <a href="admin/delete_media.php?id=<?php echo $media_id; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button delete-button">Delete</a>
    </div>
    <div class="button-container-left">
        <button class="button star-button <?php echo $results[0]['isFavorite'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $results[0]['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="star">
            <i class="fas fa-star <?php echo $results[0]['isFavorite'] == 1 ? 'filled' : ''; ?>"></i>
        </button>
        <button class="button eye-button <?php echo $results[0]['isWatched'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $results[0]['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="eye">
            <i class="fas fa-eye <?php echo $results[0]['isWatched'] == 1 ? 'filled' : ''; ?>"></i>
        </button>
    </div>
    <div class="button-container-left">
        Your Ratings:
        <div class="rating">
            <?php
            $initialRating = get_rating($media_id); // Assuming $results is an array and contains the desired value
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
    <div class="card">
        <div class="media-details">
            <h2><?php echo htmlspecialchars($results[0]['original_title']); ?></h2>
            <?php if ($results[0]['api_id'] !== null) : ?>
                <p>API ID: <?php echo htmlspecialchars($results[0]['api_id']); ?></p>
            <?php endif; ?>
            <?php if ($results[0]['api_id'] == null) : ?>
                <p>API ID: <?php echo "Not From The API" ?></p>
            <?php endif; ?>
            <p>Year: <?php echo htmlspecialchars($results[0]['year']); ?></p>
            <p>Release Date: <?php echo htmlspecialchars($results[0]['release_date']); ?></p>
            <p>Genre: <?php echo htmlspecialchars($results[0]['genre_name']); ?></p>
            <p>List: <?php echo htmlspecialchars($results[0]['list_name']); ?></p>
            <p>Type: <?php echo htmlspecialchars($results[0]['type_name']); ?></p>
            <p>Is A Series: <?php echo htmlspecialchars($results[0]['isSeries']); ?></p>
            <p>Is An Episode: <?php echo htmlspecialchars($results[0]['isEpisode']); ?></p>
            <img src="<?php echo htmlspecialchars($results[0]['image_url']); ?>" alt="Media Image">
            <p><?php echo htmlspecialchars($results[0]['image_caption']); ?></p>
        </div>

        <!-- Add more detailed information about the media as needed -->
        <!-- Additional details can be displayed here based on your data structure -->
    </div>

</body>

</html>

<?php
require(__DIR__ . "/../../partials/footer.php");
?>
