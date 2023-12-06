<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>

<?php
$db = getDB();
// Generally try to avoid SELECT *, but this is about being dynamic so I'm using it this time
$query = "SELECT
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
    UMA.user_id = :user_id; -- Replace :user_id with your desired user ID
    LIMIT 10";

$stmt = $db->prepare($query);
$user_id = get_user_id();
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$results = [];
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<pre>" . var_export($e, true) . "</pre>";
}
?>
<h3>View Your Associations</h3>
<?php if (count($results) == 0) : ?>
    <p>No results to show</p>
<?php else : ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <?php foreach ($results as $index => $record) : ?>
                <?php if ($index == 0) : ?>
                    <thead class="thead-dark">
                        <tr>
                            <?php foreach ($record as $column => $value) : ?>
                                <th><?php echo htmlspecialchars($column); ?></th>
                            <?php endforeach; ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php endif; ?>
                    <tr>
                        <?php foreach ($record as $column => $value) : ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
        </table>
    </div>
<?php endif; ?>
