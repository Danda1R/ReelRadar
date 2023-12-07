<?php

function list_single_media($table)
{
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
    M.id AS media_id,
    MD.id,
    MD.original_title,
    MD.api_id,
    MD.isSeries,
    MD.isEpisode,
    MD.year,
    MD.release_date,
    MD.image_url,
    MD.image_caption,
    ML.name AS list_name,
    MG.name AS genre_name,
    MT.name AS type_name,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched
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
LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id AND UMA.user_id = :user_id
LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
WHERE
    M.id = :media_id";

    $stmt = $db->prepare($query);
    $user_id = get_user_id();
    $stmt->bindParam(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }

    return $results;
}

function get_rating($media_id)
{

    $db = getDB();

    $results = [];

    $stmt = $db->prepare("SELECT mc.numOfStars AS rating FROM Media_Classification mc
    JOIN User_Media_Association uma ON mc.id = uma.class_id AND uma.media_id = :media_id
    AND uma.user_id = :user_id;");

    $user_id = get_user_id();

    $stmt->bindParam(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $averageResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log(var_export($stmt, true));
    error_log(var_export($averageResults, true));

    if (empty($averageResults)) {
        return 0;
    } else {
        return $averageResults[0]["rating"];
    }
}
