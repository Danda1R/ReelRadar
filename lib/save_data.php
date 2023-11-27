<?php
function save_data($table, $data, $ignore = ["submit"], $checkDuplicate = false)
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

    $ignore = ['genre', 'list', 'type', 'submit'];
    foreach ($ignore as $key) {
        if (array_key_exists($key, $data)) {
            unset($data[$key]);
        }
    }

    $db = getDB();
    $query = "INSERT INTO $table ";
    $columns = array_filter(array_keys($data), function ($x) use ($ignore) {
        return !in_array($x, $ignore);
    });
    $placeholders = array_map(fn ($x) => ":$x", $columns);
    $query .= "(" . join(",", $columns) . ") VALUES (" . join(",", $placeholders) . ")";

    $params = [];
    foreach ($columns as $col) {
        $params[":$col"] = $data[$col];
    }

    //echo "<pre>" . var_export($ignore, true) . "</pre>";

    $stmt = $db->prepare($query);
    try {
        $stmt->execute($params);
        return $db->lastInsertId();
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true));
        flash("One of the fields is not in proper format", "danger");
        return -1;
    }
}
