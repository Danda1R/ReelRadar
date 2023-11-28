<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "/home.php"));
}

$ignore = ["id", "modified", "created", "api_id", "api_image_id", "sumbit"];

if (isset($_POST["submit"])) {
    //echo "<pre>" . var_export($_POST, true) . "</pre>";

    //$detail_columns = remove_columns($_POST, $ignore);
    $id = save_data("Media_Details", $_POST, $ignore, true);
    if ($id > 0) {
        flash("Created Media Details with id $id", "success");

        $media_columns = [
            "title" => $_POST['original_title'], "details_id" => $id, "type_id" => $_POST['genre'],
            "list_id" => $_POST["list"], "genre_id" => $_POST["type"]
        ];

        //echo "<pre>" . var_export($media_columns, true) . "</pre>";

        $final_id = save_data("Media", $media_columns, ["submit"], false);
        if ($final_id > 0) {
            flash("Created Media with id $final_id", "success");
        }
    }
}
//get the table definition
$columns = get_columns("Media_Details");
$genres = get_rows("Media_Genre", "id, name");
$lists = get_rows("Media_List", "id, name");
$types = get_rows("Media_Type", "id, name");
//echo "<pre>" . var_export($genres, true) . "</pre>";

?>
<div class="container-fluid">
    <h1>Add Media</h1>
    <form method="POST">
        <?php foreach ($columns as $index => $column) : ?>
            <?php /* Lazily ignoring fields via hardcoded array*/ ?>
            <?php if (!in_array($column["Field"], $ignore)) : ?>
                <div class="mb-4">
                    <label class="form-label" for="<?php se($column, "Field"); ?>"><?php se($column, "Field"); ?></label>
                    <input class="form-control" id="<?php se($column, "Field"); ?>" type="<?php echo input_map(se($column, "Type", "", false)); ?>" name="<?php se($column, "Field"); ?>" />
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="mb-4">
            <label class="form-label" for="genre">Genre</label>
            <select class="form-select" id="genre" name="genre">
                <?php foreach ($genres as $index => $genre) : ?>
                    <option value="<?php se($genre['id']); ?>"><?php se($genre['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="list">List</label>
            <select class="form-select" id="list" name="list">
                <?php foreach ($lists as $index => $list) : ?>
                    <option value="<?php se($list['id']); ?>"><?php se($list['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="type">Type</label>
            <select class="form-select" id="type" name="type">
                <?php foreach ($types as $index => $type) : ?>
                    <option value="<?php se($type['id']); ?>"><?php se($type['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input class="btn btn-primary" type="submit" value="Create" name="submit" />
    </form>
</div>

<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>
