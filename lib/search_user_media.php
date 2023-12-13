<?php

function search_users()
{
    $db = getDB();

    $query = "SELECT username FROM Users WHERE username LIKE CONCAT('%', :searchTerm, '%') LIMIT 25";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':searchTerm', $_GET['searchUser'], PDO::PARAM_STR);

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}

function search_medias()
{
    $db = getDB();

    $query = "SELECT original_title, year FROM Media_Details WHERE original_title LIKE CONCAT('%', :searchTerm, '%') LIMIT 25";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':searchTerm', $_GET['searchMedia'], PDO::PARAM_STR);

    $results = [];

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        flash("Failed to fetch data", "danger");
        error_log(var_export($e, true));
        return -1;
    }
    return $results;
}
