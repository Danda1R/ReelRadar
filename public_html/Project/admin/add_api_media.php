<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You must be an Admin to add API media", "warning");
    die(header("Location: " . get_url("home.php")));
}

if (isset($_POST['submit_title_year'])) {

    //echo "<pre>" . var_export($_POST, true) . "</pre>";
    $exactMatch = $_POST['exact_match'] == 'on' ? true : false;
    $result = get(
        "https://moviesdatabase.p.rapidapi.com/titles/search/title/" . rawurlencode($_POST['title']),
        "MEDIA-X-RapidAPI-Key",
        ["exact" => $exactMatch, "year" => $_POST['year']],
        true,
        "moviesdatabase.p.rapidapi.com"
    );

    $status = se($result, "status", 400, false);
    if ($status != 200) {
        return;
    }

    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        return;
    }
    $data = $data["data"];
    $output = [];

    $num = 0;

    foreach ($data["results"] as $index => $details) {
        $output = array("api_id" => $details["id"]);
        $output = $output + array("original_title" => $details["titleText"]["text"]);
        $output = $output + array("isSeries" => (int)$details["titleType"]["isSeries"]);
        $output = $output + array("isEpisode" => (int)$details["titleType"]["isEpisode"]);
        $output = $output + array("year" => $details["releaseYear"]["year"]);
        $output = $output + array("release_date" => $details["releaseDate"]["year"] . "-" . $details["releaseDate"]["month"] . "-" . $details["releaseDate"]["day"]);
        $output = $output + array("api_image_id" => $details["primaryImage"]["id"]);
        $output = $output + array("image_url" => $details["primaryImage"]["url"]);
        $output = $output + array("image_caption" => $details["primaryImage"]["caption"]["plainText"]);

        $ignore = ["id", "modified", "created", "sumbit"];
        $id = save_data("Media_Details", $output, $ignore, false);

        $media_columns = [
            "title" => $output['original_title'], "details_id" => $id, "type_id" => 1,
            "list_id" => 1, "genre_id" => 1
        ];

        //echo "<pre>" . var_export($media_columns, true) . "</pre>";

        $final_id = save_data("Media", $media_columns, ["submit"], false);

        if ($final_id > 0)
            $num++;
    }
    flash("You have added " . $num . " medias to the website", "success");
}

// Check if the "Add Random by Genre, List & Type" form is submitted
if (isset($_POST['submit_genre_list_type'])) {
    //echo "<pre>" . var_export($_POST, true) . "</pre>";
    $result = get(
        "https://moviesdatabase.p.rapidapi.com/titles/random",
        "MEDIA-X-RapidAPI-Key",
        ["genre" => $_POST['genre'], "titleType" => $_POST['type'], "list" => $_POST['list']],
        true,
        "moviesdatabase.p.rapidapi.com"
    );

    $status = se($result, "status", 400, false);
    if ($status != 200) {
        return;
    }

    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        return;
    }
    $data = $data["data"];
    $output = [];

    //echo "<pre>" . var_export($data, true) . "</pre>";

    $num = 0;

    foreach ($data["results"] as $index => $details) {
        $output = array("api_id" => $details["id"]);
        $output = $output + array("original_title" => $details["titleText"]["text"]);
        $output = $output + array("isSeries" => (int)$details["titleType"]["isSeries"]);
        $output = $output + array("isEpisode" => (int)$details["titleType"]["isEpisode"]);
        $output = $output + array("year" => $details["releaseYear"]["year"]);
        $output = $output + array("release_date" => $details["releaseDate"]["year"] . "-" . $details["releaseDate"]["month"] . "-" . $details["releaseDate"]["day"]);
        $output = $output + array("api_image_id" => $details["primaryImage"]["id"]);
        $output = $output + array("image_url" => $details["primaryImage"]["url"]);
        $output = $output + array("image_caption" => $details["primaryImage"]["caption"]["plainText"]);

        $ignore = ["id", "modified", "created", "sumbit"];
        $id = save_data("Media_Details", $output, $ignore, false);

        $genre_id = get_genretypelist_id("Media_Genre", $_POST['genre']);
        $list_id = get_genretypelist_id("Media_List", $_POST['list']);
        $type_id = get_genretypelist_id("Media_Type", $_POST['type']);

        $media_columns = [
            "title" => $output['original_title'], "details_id" => $id, "type_id" => $type_id[0]["id"],
            "list_id" => $list_id[0]["id"], "genre_id" => $genre_id[0]["id"]
        ];

        //echo "<pre>" . var_export($media_columns, true) . "</pre>";

        $final_id = save_data("Media", $media_columns, ["submit"], false);
        if ($final_id > 0)
            $num++;
    } // Important to stop further execution after redirecting
    flash("You have added " . $num . " medias to the website", "success");
}

$genres = get_rows("Media_Genre", "id, name");
$lists = get_rows("Media_List", "id, name");
$types = get_rows("Media_Type", "id, name");

?>

<div class="container-fluid">
    <h1>Import API Data</h1>
    <div class="row">
        <h2>Add by Title & Year</h2>
        <div class="col">
            <form method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title"><br><br>

                <label for="year">Year:</label>
                <input type="text" id="year" name="year"><br><br>

                <input type="checkbox" id="exact_match" name="exact_match">
                <label for="exact_match">Exact Match</label><br><br>

                <input class="btn btn-primary" type="submit" value="Add" name="submit_title_year" />
            </form>
        </div>
        <h2>Add Random by Genre, List & Type</h2>
        <div class="col">
            <form method="POST">
                <div class="mb-4">
                    <label class="form-label" for="genre">Genre</label>
                    <select class="form-select" id="genre" name="genre">
                        <?php foreach ($genres as $index => $genre) : ?>
                            <?php if ($genre['name'] !== null) : ?>
                                <option value="<?php se($genre['name']); ?>"><?php se($genre['name']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="list">List</label>
                    <select class="form-select" id="list" name="list">
                        <?php foreach ($lists as $index => $list) : ?>
                            <?php if ($list['name'] !== null) : ?>
                                <option value="<?php se($list['name']); ?>"><?php se($list['name']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="type">Type</label>
                    <select class="form-select" id="type" name="type">
                        <?php foreach ($types as $index => $type) : ?>
                            <?php if ($type['name'] !== null) : ?>
                                <option value="<?php se($type['name']); ?>"><?php se($type['name']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input class="btn btn-primary" type="submit" value="Add" name="submit_genre_list_type" />
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>
