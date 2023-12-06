<?php

function search_media($table)
{
    $table = se($table, null, null, false);
    $db = getDB();

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;

    $limit = min(max($limit, 1), 100);

    $query = "SELECT
    Media.id AS media_id,
    Media.title AS media_title,
    Media_Details.year AS media_year,
    Media_Details.api_id,
    Media_Details.image_url AS media_image_url,
    Media_Genre.name AS genre_name,
    COALESCE(Media_Classification.isFavorite, 0) AS isFavorite,
    COALESCE(Media_Classification.isWatched, 0) AS isWatched
FROM
    Media
JOIN
    Media_Details ON Media.details_id = Media_Details.id
JOIN
    Media_List ON Media.list_id = Media_List.id
JOIN
    Media_Type ON Media.type_id = Media_Type.id
JOIN
    Media_Genre ON Media.genre_id = Media_Genre.id
LEFT JOIN (
    SELECT
        MAX(uma.class_id) AS class_id,
        uma.media_id
    FROM
        User_Media_Association uma
    WHERE
        uma.user_id = :user_id
    GROUP BY
        uma.media_id
) AS UserMedia ON Media.id = UserMedia.media_id
LEFT JOIN
    Media_Classification ON UserMedia.class_id = Media_Classification.id";

    // Searching
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " WHERE Media.title LIKE :searchTerm OR Media_Details.year LIKE :searchTerm OR Media_Genre.name LIKE :searchTerm";
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'genre_name'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $query .= " ORDER BY $sort $sortOrder";

    // Limiting records
    $query .= " LIMIT :limit";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $user_id = get_user_id();
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

function get_average_rating($media_id)
{

    $db = getDB();

    $results = [];

    $stmt = $db->prepare("SELECT AVG(mc.numOfStars) AS averageStars FROM Media_Classification mc
    JOIN User_Media_Association uma ON mc.id = uma.class_id WHERE mc.numOfStars > 0 AND uma.media_id = :media_id");
    $stmt->bindParam(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->execute();
    $averageResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log(var_export($averageResults, true));

    return $averageResults[0]["averageStars"];
}
