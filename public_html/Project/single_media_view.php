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

    $table = se($table, null, null, false);

    $media_id = isset($_GET['id']) ? $_GET['id'] : null;

    // Validate the ID (perform necessary checks based on your application logic)
    // Redirect back to list page with a message for an invalid ID
    if (!$media_id) {
        // Redirect back to the list page with an error message
        flash("Invalid media ID", "warning");
        die(header("Location: list_media.php"));
    }

    $db = getDB();

    $query = "SELECT
    MD.original_title AS title,
    MD.api_id,
    MD.isSeries,
    MD.isEpisode,
    MD.year,
    MD.release_date,
    MD.image_url,
    MD.image_caption,
    ML.name AS list_name,
    MG.name AS genre_name,
    MT.name AS type_name
FROM
    Media M
JOIN
    Media_Details MD ON M.details_id = MD.id
JOIN
    Media_List ML ON M.list_id = ML.id
JOIN
    Media_Type MT ON M.type_id = MT.id
JOIN
    Media_Genre MG ON M.genre_id = MG.id
WHERE
    M.id = :media_id;
";

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

    //echo "<pre>" . var_export(count($results), true) . "</pre>";

    if (count($results) == 0) {
        flash("This ID does not exist", "warning");
        die(header("Location: list_media.php"));
    }

    ?>
    <div class="button-container-left">
        <a href="admin/edit_media.php?id=<?php echo $media_id; ?>" class="button">Edit</a>
        <a href="admin/delete_media.php?id=<?php echo $media_id; ?>" class="button edit-button">Delete</a>
    </div>
    <div class="card">
        <div class="media-details">
            <h2><?php echo htmlspecialchars($results[0]['title']); ?></h2>
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
