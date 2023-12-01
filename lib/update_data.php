<?php
function update_details_data($table, $data, $ignore, $checkDuplicate, $media_id)
{
    $table = se($table, null, null, false);
    if ($checkDuplicate) {
        $db = getDB();
        $title = $_POST["original_title"];
        $year = $_POST["year"];
        $query = "SELECT id from $table where original_title=\"$title\" AND year=$year";
        $stmt = $db->prepare($query);
        $results = [];
        try {
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            flash("One of the fields is not in proper format", "danger");
            error_log(var_export($e, true));
            return -1;
        }
        if (count($results) > 0) {
            flash("This description already exists!", "danger");
            return 0;
        }
    }

    //echo "<pre>" . var_export($data, true) . "</pre>";
    foreach ($ignore as $key) {
        if (array_key_exists($key, $data)) {
            unset($data[$key]);
        }
    }

    //echo "<pre>" . var_export($data, true) . "</pre>";

    $db = getDB();
    $query = "UPDATE $table SET ";

    $params = [];

    foreach ($data as $column => $data) {
        if ($column == "submit")
            continue;
        $query .= $column . " = :" . $column . ", ";
        $params[":" . $column] = $data;
    }
    //echo "<pre>" . var_export($params, true) . "</pre>";
    $final_query = substr($query, 0, -2) . " WHERE id = (SELECT details_id FROM Media WHERE id = " . $media_id . ")";
    //echo "<pre>" . var_export($final_query, true) . "</pre>";
    $stmt = $db->prepare($final_query);
    try {
        $stmt->execute($params);

        $db = getDB();
        $stmt = $db->prepare("SELECT details_id FROM Media WHERE id = " . $media_id);
        $r = $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        //echo "<pre>" . var_export($results, true) . "</pre>";

        return $results["details_id"];
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        flash("One of the fields is not in proper format", "danger");
        return -1;
    }
}

function update_media_data($table, $data, $ignore, $media_id)
{
    $table = se($table, null, null, false);

    foreach ($ignore as $key) {
        if (array_key_exists($key, $data)) {
            unset($data[$key]);
        }
    }

    $db = getDB();
    $query = "UPDATE $table SET ";

    $params = [];

    foreach ($data as $column => $data) {
        if ($column == "submit")
            continue;
        $query .= $column . " = :" . $column . ", ";
        $params[":" . $column] = $data;
    }
    //echo "<pre>" . var_export($params, true) . "</pre>";
    $final_query = substr($query, 0, -2) . " WHERE id = " . $media_id;
    //echo "<pre>" . var_export($final_query, true) . "</pre>";
    $stmt = $db->prepare($final_query);
    try {
        $results = $stmt->execute($params);
        return $media_id;
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        error_log("error");
        flash("One of the fields is not in proper format", "danger");
        return -1;
    }
}
