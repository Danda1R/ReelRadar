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
    require_once(__DIR__ . "/../../../partials/nav.php");
    require(__DIR__ . "/../../../partials/flash.php");

    if (!has_role("Admin")) {
        flash("You don't have permission to view this page", "warning");
        die(header("Location: $BASE_PATH" . "/home.php"));
    }

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
    MD.id AS media_details_id,
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
            die(header("Location: " . get_url("list_media.php")));
        }
    }

    ?>
    <div class="button-container-left">
        <a href="../single_media_view.php?id=<?php echo $media_id; ?>" class="button">View</a>
        <a href="edit_media.php?id=<?php echo $media_id; ?>" class=" button edit-button">Edit</a>
    </div>
    <div class="card">
        <div class="media-details">
            <h2><?php echo htmlspecialchars($results[0]['title']); ?></h2>
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
</body>

</html>

<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>
