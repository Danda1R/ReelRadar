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

    return $results;
}
