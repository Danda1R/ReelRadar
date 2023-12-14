<?php
require(__DIR__ . "/../../partials/nav.php");
$results = search_top_media();
//echo "<pre>" . var_export($results, true) . "</pre>";
?>

<h1 class="header">Home</h1>

<section>
  <h2>Welcome to my website!</h2>
  <p>You can view different types of media (Movies, TV Shows, Shorts & Video Games)</p>
  <p>If you are an admin or editor, you can also add media, edit media, or delete media</p>
</section>
<div class="card-gallery">
  <h2>Most recently watched:</h2>
  <?php if (count($results) > 0) : ?>
    <?php foreach ($results["watchedresults"] as $row) : ?>
      <div class="card">
        <div class="card-mini-details">
          <div class="card-mini-column">
            <h3><?php echo htmlspecialchars($row['media_title']); ?></h3>
            <?php echo ($row['api_id'] !== null) ? "<p>Created by API. API ID: " . htmlspecialchars($row['api_id']) . "</p>" : "<p>Created manually</p>"; ?>
            <p>Year: <?php echo htmlspecialchars($row['media_year']); ?></p>
          </div>
          <div class="card-mini-column">
            <img src="<?php echo htmlspecialchars($row['media_image_url']); ?>" alt="Media Image">
          </div>
        </div>

        <div class="button-container">
          <a href="single_media_view.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button">View</a>
          <a href="admin/delete_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button delete-button">Delete</a>
          <a href="admin/edit_media.php?id=<?php echo $row['media_id']; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>&sort=<?php echo $sort; ?>&order=<?php echo $sortOrder; ?>&page=<?php echo $page; ?>" class="button edit-button">Edit</a>
        </div>
        <div class="button-container">
          <button class="button star-button <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="star">
            <i class="fas fa-star <?php echo $row['isFavorite'] == 1 ? 'filled' : ''; ?>"></i>
          </button>
          <button class="button eye-button <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>" data-media-id="<?php echo $row['media_id']; ?>" data-user-id="<?php echo get_user_id(); ?>" data-action="eye">
            <i class="fas fa-eye <?php echo $row['isWatched'] == 1 ? 'filled' : ''; ?>"></i>
          </button>
        </div>
        <div class="button-container">
          Average Ratings:
          <div class="rating">
            <?php
            $initialRating = get_average_rating($row['media_id']);
            for ($i = 1; $i <= 5; $i++) {
              if ($i <= $initialRating) {
                echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['media_id'] . '" data-value="' . $i . '" style="color: gold;">&#9733;</span>';
              } else {
                echo '<span data-user-id="' . get_user_id() . '" data-media-id="' . $row['media_id'] . '" data-value="' . $i . '">&#9733;</span>';
              }
            }
            ?>
          </div>
        </div>
      </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<?php

if (is_logged_in(true)) {
  //comment this out if you don't want to see the session variables
  error_log("Session data: " . var_export($_SESSION, true));
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>
