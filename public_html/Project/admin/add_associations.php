<?php
require(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true, "../login.php");
?>

<?php
$searchUser = isset($_GET['searchUser']) ? $_GET['searchUser'] : '';
$searchMedia = isset($_GET['searchMedia']) ? $_GET['searchMedia'] : '';

$userResults = search_users($_GET);
$mediaResults = search_medias($_GET);
?>

<form action="" method="GET" id="searchAndSortForm">
    <input type="text" name="searchUser" class="search-bar" placeholder="Search by username" value="<?php echo htmlspecialchars($searchUser); ?>">
    <input type="text" name="searchMedia" class="search-bar" placeholder="Search by media title" value="<?php echo htmlspecialchars($searchMedia); ?>">
    <button type="submit">Search</button>
</form>
<h3>Add Associations</h3>
<form action="add_classifications.php" method="POST">
    <div class="form-container">
        <div class="form-group">
            <label for="checkbox1">
                <input type="checkbox" id="watched" name="watched"> Watched
            </label>
            <label for="checkbox2">
                <input type="checkbox" id="favorite" name="favorite"> Favorite
            </label>
        </div>
        <div class="form-group">
            <label for="numberInput">Ratings:</label>
            <input type="number" id="ratings" name="ratings" min="1" max="5">
        </div>
    </div>
    <div class="form-submit">
        <input type="submit" value="Apply">
    </div>
    <div class="results-container">
        <?php if (count($userResults) == 0) : ?>
            <p>No user results to show. </p>
        <?php else : ?>
            <table>
                <?php foreach ($userResults as $index => $record) : ?>
                    <?php if ($index == 0) : ?>
                        <thead>
                            <tr>
                                <th class="checkbox-column">Select</th>
                                <?php foreach ($record as $column => $value) : ?>
                                    <th><?php echo htmlspecialchars($column); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                    <?php endif; ?>
                    <tr>
                        <td class="checkbox-column">
                            <input type="checkbox" name="userCheckbox[]" value="<?php echo $record["username"] ?>">
                        </td>
                        <?php foreach ($record as $column => $value) : ?>
                            <td><?php echo htmlspecialchars($value !== null ? $value : "N/A"); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php if (count($mediaResults) == 0) : ?>
            <p>No media results to show. </p>
        <?php else : ?>
            <table>
                <?php foreach ($mediaResults as $index => $record) : ?>
                    <?php if ($index == 0) : ?>
                        <thead>
                            <tr>
                                <th class="checkbox-column">Select</th>
                                <?php foreach ($record as $column => $value) : ?>
                                    <th><?php echo htmlspecialchars($column); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                    <?php endif; ?>
                    <tr>
                        <td class="checkbox-column">
                            <input type="checkbox" name="mediaCheckbox[]" value="<?php echo $record["original_title"] ?>">
                        </td>
                        <?php foreach ($record as $column => $value) : ?>
                            <td><?php echo htmlspecialchars($value !== null ? $value : "N/A"); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</form>

<?php
require(__DIR__ . "/../../../partials/flash.php");
require_once(__DIR__ . "/../../../partials/footer.php");
?>
