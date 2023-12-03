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
            width: auto;
            height: 300px;
        }
    </style>
</head>

<body>

    <?php
    require_once(__DIR__ . "/../../partials/nav.php");
    is_logged_in(true);
    require(__DIR__ . "/../../partials/flash.php");

    $table = "Media";

    $results = search_media($table, $_GET);

    $sortableColumns = ['title', 'year', 'genre_name'];
    $sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortableColumns) ? $_GET['sort'] : 'media_title'; // Default sorting by title
    $sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; // Default order ASC
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    //echo "<pre>" . var_export(count($results), true) . "</pre>";

    if (count($results) == 0) {
        flash("There are no current media matching this description available.", "warning");
        die(header("Location: list_media.php"));
    }
    ?>

    <form action="" method="GET" id="searchAndSortForm">
        <input type="text" name="search" class="search-bar" placeholder="Search by title, year, or genre" value="<?php echo htmlspecialchars($search); ?>">
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

    <div class="card-gallery">
        <?php if (count($results) > 0) : ?>
            <?php foreach ($results as $row) : ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($row['media_title']); ?></h3>
                    <?php if ($row['api_id'] !== null) : ?>
                        <p>Created by API. API ID: <?php echo htmlspecialchars($row['api_id']); ?></p>
                    <?php endif; ?>
                    <?php if ($row['api_id'] == null) : ?>
                        <p>Created manually</p>
                    <?php endif; ?>
                    <p>Year: <?php echo htmlspecialchars($row['media_year']); ?></p>
                    <p>Genre: <?php echo htmlspecialchars($row['genre_name']); ?></p>
                    <img src="<?php echo htmlspecialchars($row['media_image_url']); ?>" alt="Media Image">

                    <div class="button-container">
                        <a href="single_media_view.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button">View</a>
                        <a href="admin/delete_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button delete-button">Delete</a>
                        <a href="admin/edit_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>" class="button edit-button">Edit</a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

<?php
require(__DIR__ . "/../../partials/footer.php");
?>
