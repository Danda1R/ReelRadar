<?php

function search_media($table)
{
    $table = se($table, null, null, false);
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $countQuery = "SELECT COUNT(*) AS total FROM Media
    JOIN Media_Details ON Media.details_id = Media_Details.id
    JOIN Media_Genre ON Media.genre_id = Media_Genre.id";

    // Adjust the count query based on your search criteria, if any
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $countQuery .= " WHERE Media.title LIKE :searchTerm OR Media_Details.year LIKE :searchTerm OR Media_Genre.name LIKE :searchTerm";
    }

    // Prepare and execute the count query
    $countStmt = $db->prepare($countQuery);
    if (!empty($search)) {
        $countStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }
    $countStmt->execute();
    $totalRows = $countStmt->fetchColumn();

    $query = "SELECT
    Media.id AS media_id,
    Media.title AS media_title,
    Media_Details.year AS media_year,
    Media_Details.api_id,
    Media_Details.image_url AS media_image_url,
    Media_Genre.name AS genre_name,
    COALESCE(Media_Classification.isFavorite, 0) AS isFavorite,
    COALESCE(Media_Classification.isWatched, 0) AS isWatched
    FROM Media
    JOIN Media_Details ON Media.details_id = Media_Details.id
    JOIN Media_List ON Media.list_id = Media_List.id
    JOIN Media_Type ON Media.type_id = Media_Type.id
    JOIN Media_Genre ON Media.genre_id = Media_Genre.id
    LEFT JOIN (
        SELECT MAX(uma.class_id) AS class_id, uma.media_id
        FROM User_Media_Association uma
        WHERE uma.user_id = :user_id
        GROUP BY uma.media_id
    ) AS UserMedia ON Media.id = UserMedia.media_id
    LEFT JOIN Media_Classification ON UserMedia.class_id = Media_Classification.id";

    // Searching
    if (!empty($search)) {
        $query .= " WHERE Media.title LIKE :searchTerm OR Media_Details.year LIKE :searchTerm OR Media_Genre.name LIKE :searchTerm";
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'genre_name'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $query .= " ORDER BY $sort $sortOrder";

    // Limiting records
    $query .= " LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

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

    return [
        'results' => $results,
        'totalRows' => $totalRows,
    ];
}

function search_top_media()
{
    $db = getDB();
    $watchedresults = [];
    $favoriteresults = [];

    $query = "SELECT m.id AS media_id,
    m.title AS media_title,
    md.year AS media_year,
    md.api_id,
    md.image_url AS media_image_url,
    mc.isFavorite AS isFavorite,
    mc.isWatched AS isWatched
    FROM Media m
    JOIN User_Media_Association uma ON m.id = uma.media_id
    JOIN Media_Classification mc ON uma.class_id = mc.id
    JOIN Media_Details md ON m.details_id = md.id
    WHERE mc.isWatched = 1
    ORDER BY mc.modified DESC
    LIMIT 4;";

    $stmt = $db->prepare($query);

    try {
        $stmt->execute();
        $watchedresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }

    $query = "SELECT m.id AS media_id,
    m.title AS media_title,
    md.year AS media_year,
    md.api_id,
    md.image_url AS media_image_url,
    mc.isFavorite AS isFavorite,
    mc.isWatched AS isWatched
    FROM Media m
    JOIN User_Media_Association uma ON m.id = uma.media_id
    JOIN Media_Classification mc ON uma.class_id = mc.id
    JOIN Media_Details md ON m.details_id = md.id
    WHERE mc.isFavorite = 1
    ORDER BY mc.modified DESC
    LIMIT 4;";

    $stmt = $db->prepare($query);

    try {
        $stmt->execute();
        $favoriteresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }

    return [
        "watchedresults" => $watchedresults,
        "favoriteresults" => $favoriteresults,
    ];
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
    //error_log(var_export($averageResults, true));

    return $averageResults[0]["averageStars"];
}
//Rishik Danda - 12/13/23
function search_associations()
{
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $query = "SELECT
    M.id,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
    FROM
    Media_Details MD
    JOIN
    Media M ON MD.id = M.details_id
    LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id
    LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
    WHERE
    UMA.user_id = :user_id";

    // Searching
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) ";
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'numOfStars'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $query .= " ORDER BY $sort $sortOrder";

    // Limiting records
    $query .= " LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $user_id = get_user_id();
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

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

function search_associations_count($limit)
{
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $countQuery = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
    FROM
    Media_Details MD
    JOIN
    Media M ON MD.id = M.details_id
    LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id
    LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
    WHERE
    UMA.user_id = :user_id";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $countQuery .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) ) AS subquery_alias";
    } else {
        $countQuery .= ") AS subquery_alias";
    }

    // Prepare and execute the count query
    $countStmt = $db->prepare($countQuery);

    $user_id = get_user_id();
    $countStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    if (!empty($search)) {
        $countStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $countStmt->execute();
    $totalRows = $countStmt->fetchColumn();

    $query = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
    FROM
    Media_Details MD
    JOIN
    Media M ON MD.id = M.details_id
    LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id
    LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
    WHERE
    UMA.user_id = :user_id";

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) LIMIT :limit OFFSET :offset) AS subquery_alias";
    } else {
        $query .= " LIMIT :limit OFFSET :offset) AS subquery_alias";
    }

    // Limiting records
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $user_id = get_user_id();
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    //error_log(var_export($stmt, true));

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return ["results" => $results, "totalRows" => $totalRows];
}

function delete_all_associations()
{
    $db = getDB();

    $query = "DELETE FROM User_Media_Association WHERE user_id = :user_id";

    $query = "DELETE FROM Media_Classification WHERE id IN (SELECT class_id FROM User_Media_Association
    WHERE user_id = :user_id)";

    $stmt = $db->prepare($query);
    $user_id = get_user_id();
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $results = [];

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function delete_all_associations_onscreen($results)
{
    $db = getDB();

    $class_ids = [];
    foreach ($results as $row) {
        // Change 'column_name' to the actual column name you want to retrieve
        $class_ids[] = $row['class_id'];
    }

    $placeholders = implode(',', array_fill(0, count($class_ids), '?'));

    $query = "DELETE FROM Media_Classification WHERE id IN ($placeholders)";
    $stmt = $db->prepare($query);

    foreach ($class_ids as $key => $class_id) {
        $stmt->bindValue(($key + 1), $class_id, PDO::PARAM_INT);
    }
    error_log(var_export($stmt, true));
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
}

function delete_an_association($media_id = "", $user_id = "")
{
    $db = getDB();

    error_log(var_export($_POST, true));
    $media_id = $_POST["id"];

    $query = "DELETE FROM Media_Classification WHERE id = (SELECT class_id FROM User_Media_Association WHERE
    user_id = :user_id AND media_id = :media_id)";

    $stmt = $db->prepare($query);
    if (empty($user_id))
        $user_id = get_user_id();
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $media_id, PDO::PARAM_STR);


    $results = [];

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function delete_an_association_onscreen($class_id)
{
    $db = getDB();

    error_log(var_export($_POST, true));

    $query = "DELETE FROM Media_Classification WHERE id = :class_id";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':class_id', $class_id, PDO::PARAM_STR);

    $results = [];

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function search_all_associations()
{
    //Rishik Danda - 12/13/23
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $query = "SELECT
    M.id,
    U.id AS user_id,
    U.username,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars,
    COALESCE(MC.id, 0) AS class_id,
    COALESCE(assoc_count.association_count, 0) AS NumOfAssociations
FROM
    User_Media_Association UMA
LEFT JOIN
    Users U ON U.id = UMA.user_id
LEFT JOIN
    Media M ON UMA.media_id = M.id
LEFT JOIN
    Media_Details MD ON M.details_id = MD.id
LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
LEFT JOIN
    (
        SELECT
            media_id,
            COUNT(id) AS association_count
        FROM
            User_Media_Association
        GROUP BY
            media_id
    ) AS assoc_count ON M.id = assoc_count.media_id";

    // Searching
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $searchArray = ['title' => 'M.title', 'year' => 'MD.year', 'username' => 'U.username'];
    if (isset($_GET['searchType'])) {
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $query .= " WHERE " . $searchArray[$_GET['searchType']] . " LIKE :searchTerm";
        }
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'numOfStars'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $query .= " ORDER BY $sort $sortOrder";

    // Limiting records
    $query .= " LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log(var_export($results, true));
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function search_all_non_associations()
{
    //Rishik Danda - 12/13/23
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $query = "SELECT
    M.id,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id
    FROM Media M
    LEFT JOIN Media_Details MD ON M.details_id = MD.id
    LEFT JOIN User_Media_Association UMA ON M.id = UMA.media_id
    WHERE UMA.id IS NULL";

    // Searching
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $searchArray = ['title' => 'M.title', 'year' => 'MD.year', 'username' => 'U.username'];
    if (isset($_GET['searchType'])) {
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $query .= " AND " . $searchArray[$_GET['searchType']] . " LIKE :searchTerm";
        }
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'numOfStars'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $query .= " ORDER BY $sort $sortOrder";

    // Limiting records
    $query .= " LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log(var_export($results, true));
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function search_all_associations_count($limit)
{
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $countQuery = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    M.id,
    U.username,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
FROM
    User_Media_Association UMA
LEFT JOIN
    Users U ON U.id = UMA.user_id
LEFT JOIN
    Media M ON UMA.media_id = M.id
LEFT JOIN
    Media_Details MD ON M.details_id = MD.id
LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $countQuery .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) ) AS subquery_alias";
    } else {
        $countQuery .= ") AS subquery_alias";
    }

    // Prepare and execute the count query
    $countStmt = $db->prepare($countQuery);

    if (!empty($search)) {
        $countStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $countStmt->execute();
    $totalRows = $countStmt->fetchColumn();

    $query = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    M.id,
    U.username,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
FROM
    User_Media_Association UMA
LEFT JOIN
    Users U ON U.id = UMA.user_id
LEFT JOIN
    Media M ON UMA.media_id = M.id
LEFT JOIN
    Media_Details MD ON M.details_id = MD.id
LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id";

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) LIMIT :limit OFFSET :offset) AS subquery_alias";
    } else {
        $query .= " LIMIT :limit OFFSET :offset) AS subquery_alias";
    }

    // Limiting records
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

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
    return ["results" => $results, "totalRows" => $totalRows];
}

function search_all_non_associations_count($limit)
{
    $db = getDB();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;
    $limit = min(max($limit, 1), 100);
    $offset = ($page - 1) * $limit;

    $countQuery = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    M.id,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id
    FROM Media M
    LEFT JOIN Media_Details MD ON M.details_id = MD.id
    LEFT JOIN User_Media_Association UMA ON M.id = UMA.media_id
    WHERE UMA.id IS NULL";

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $countQuery .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) ) AS subquery_alias";
    } else {
        $countQuery .= ") AS subquery_alias";
    }

    // Prepare and execute the count query
    $countStmt = $db->prepare($countQuery);

    if (!empty($search)) {
        $countStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $countStmt->execute();
    $totalRows = $countStmt->fetchColumn();

    $query = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    M.id,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id
    FROM Media M
    LEFT JOIN Media_Details MD ON M.details_id = MD.id
    LEFT JOIN User_Media_Association UMA ON M.id = UMA.media_id
    WHERE UMA.id IS NULL";

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) LIMIT :limit OFFSET :offset) AS subquery_alias";
    } else {
        $query .= " LIMIT :limit OFFSET :offset) AS subquery_alias";
    }

    // Limiting records
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

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
    return ["results" => $results, "totalRows" => $totalRows];
}

function search_associations_by_user($user_id)
{
    $db = getDB();

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;

    $limit = min(max($limit, 1), 100);

    $query = "SELECT
    M.id,
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    MD.image_url,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
    FROM
    Media_Details MD
    JOIN
    Media M ON MD.id = M.details_id
    LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id
    LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
    WHERE
    UMA.user_id = :user_id";

    // Searching
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) ";
    }

    // Sorting
    $sortableColumns = ['title', 'year', 'numOfStars'];
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

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

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

function search_associations_count_by_user($limit, $user_id)
{
    $db = getDB();

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;

    $limit = min(max($limit, 1), 100);

    $query = "SELECT COUNT(*) AS row_count FROM (
    SELECT
    MD.original_title AS media_title,
    MD.year AS release_year,
    MD.api_id,
    COALESCE(MC.isFavorite, 0) AS isFavorite,
    COALESCE(MC.isWatched, 0) AS isWatched,
    COALESCE(MC.numOfStars, 0) AS numOfStars
    FROM
    Media_Details MD
    JOIN
    Media M ON MD.id = M.details_id
    LEFT JOIN
    User_Media_Association UMA ON M.id = UMA.media_id
    LEFT JOIN
    Media_Classification MC ON UMA.class_id = MC.id
    WHERE
    UMA.user_id = :user_id";

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $searchTerm = "%$search%";
        $query .= " AND (M.title LIKE :searchTerm OR MD.year LIKE :searchTerm) LIMIT :limit) AS subquery_alias";
    } else {
        $query .= " LIMIT :limit) AS subquery_alias";
    }

    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    if (!empty($search)) {
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    }

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    //error_log(var_export($stmt, true));

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
