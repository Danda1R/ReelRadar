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
    LEFT JOIN
    User_Media_Association ON Media.id = User_Media_Association.media_id
    LEFT JOIN
    Media_Classification ON User_Media_Association.class_id = Media_Classification.id";

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
