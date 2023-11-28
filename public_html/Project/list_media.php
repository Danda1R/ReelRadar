<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Media Gallery</title>
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
    $db = getDB();

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $limit = ($limit < 1 || $limit > 100) ? 10 : $limit;

    $limit = min(max($limit, 1), 100);

    $query = "SELECT
    Media.id AS media_id,
    Media.title AS media_title,
    Media_Details.year AS media_year,
    Media_Details.image_url AS media_image_url,
    Media_Genre.name AS genre_name
FROM
    Media
JOIN
    Media_Details ON Media.details_id = Media_Details.id
JOIN
    Media_List ON Media.list_id = Media_List.id
JOIN
    Media_Type ON Media.type_id = Media_Type.id
JOIN
    Media_Genre ON Media.genre_id = Media_Genre.id";

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

    //echo "<pre>" . var_export($query, true) . "</pre>";

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

    //echo "<pre>" . var_export(count($results), true) . "</pre>";

    if (count($results) == 0) {
        flash("There are no current media available. Please add some.", "warning");
        die(header("Location: home.php"));
    }
    ?>

    <div class="card-gallery">
        <?php if (count($results) > 0) : ?>
            <?php foreach ($results as $row) : ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($row['media_title']); ?></h3>
                    <p>Year: <?php echo htmlspecialchars($row['media_year']); ?></p>
                    <p>Genre: <?php echo htmlspecialchars($row['genre_name']); ?></p>
                    <img src="<?php echo htmlspecialchars($row['media_image_url']); ?>" alt="Media Image">

                    <a href="single_media_view.php?id=<?php echo $row['media_id']; ?>">View</a>
                    <a href="admin/delete_media.php?id=<?php echo $row['media_id']; ?>">Delete</a>
                    <a href="admin/edit_media.php?id=<?php echo $row['media_id']; ?>">Edit</a>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <form action="" method="GET" id="searchAndSortForm">
        <input type="text" name="search" placeholder="Search by title, year, or genre" value="<?php echo htmlspecialchars($search); ?>">
        <label for="limit">Limit:</label>
        <input type="number" id="limit" name="limit" min="1" max="100" value="<?php echo htmlspecialchars($limit); ?>">
        <label for="sort">Sort by:</label>
        <select id="sort" name="sort">
            <option value="title" <?php echo $sort === 'title' ? 'selected' : ''; ?>>Title</option>
            <option value="year" <?php echo $sort === 'year' ? 'selected' : ''; ?>>Year</option>
            <option value="genre_name" <?php echo $sort === 'genre_name' ? 'selected' : ''; ?>>Genre</option>
        </select>
        <select id="order" name="order">
            <option value="ASC" <?php echo $sortOrder === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
            <option value="DESC" <?php echo $sortOrder === 'DESC' ? 'selected' : ''; ?>>Descending</option>
        </select>
        <button type="submit">Apply</button>
    </form>
</body>
