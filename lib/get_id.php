<?php

function get_genretypelist_id($table, $name)
{
    $table = se($table, null, null, false);
    $db = getDB();
    $query = "SELECT id from $table where name = :name"; //be sure you trust $table
    $name_array = ['name' => $name];
    $stmt = $db->prepare($query);
    $results = [];
    try {
        $stmt->execute($name_array);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("An unexpect error occurred getting table info", "danger");
        error_log(var_export($e, true));
    }
    return $results;
}
