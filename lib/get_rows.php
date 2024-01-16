<?php

function get_rows($table, $name)
{
    $table = se($table, null, null, false);
    $db = getDB();
    $query = "SELECT $name from $table"; //be sure you trust $table
    $stmt = $db->prepare($query);
    $results = [];
    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("An unexpect error occurred getting table info", "danger");
        error_log(var_export($e, true));
    }
    return $results;
}
