<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

function get_array($api_link, $table_name)
{
    $result = get($api_link, "MEDIA-X-RapidAPI-Key", [], true, "moviesdatabase.p.rapidapi.com");

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
    $data = $data["data"]['results'];

    foreach ($data as $index => $genre) {
        $ignore = ["modified", "created", "sumbit"];
        $id = save_data($table_name, array("id" => $index, "name" => $genre), $ignore, false);
    }
}

get_array("https://moviesdatabase.p.rapidapi.com/titles/utils/genres", "Media_Genre");
get_array("https://moviesdatabase.p.rapidapi.com/titles/utils/lists", "Media_List");
get_array("https://moviesdatabase.p.rapidapi.com/titles/utils/titleTypes", "Media_Type");

?>


<div class="container-fluid">
    <h1>Genre, List, and Type Databases Have Been Updated</h1>
</div>

<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>
