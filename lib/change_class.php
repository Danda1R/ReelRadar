<?php
//Rishik Danda - 12/13/23
function add_to_star($mediaId, $userId)
{
    $db = getDB();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log(var_export($row, true));

    if ($row['count'] > 0) {
        // If the record exists, perform an UPDATE query
        $updateStmt = $db->prepare("UPDATE Media_Classification SET isFavorite = 1 WHERE id = (SELECT class_id FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id)");
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $updateStmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
        $updateStmt->execute();
        $updateRow = $updateStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $class_columns = [
            "isFavorite" => 1, "isWatched" => 0, "numOfStars" => 0,
            "isReviewed" => 0, "review" => ""
        ];
        $id = save_data("Media_Classification", $class_columns);
        $association_columns = [
            "user_id" => $userId, "media_id" => $mediaId, "class_id" => $id
        ];
        $id = save_data("User_Media_Association", $association_columns);
    }
}

function remove_from_star($mediaId, $userId)
{
    $db = getDB();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log(var_export($row, true));

    if ($row['count'] > 0) {
        // If the record exists, perform an UPDATE query
        $updateStmt = $db->prepare("UPDATE Media_Classification SET isFavorite = 0 WHERE id = (SELECT class_id FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id)");
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $updateStmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
        $updateStmt->execute();
        $updateRow = $updateStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $class_columns = [
            "isFavorite" => 0, "isWatched" => 0, "numOfStars" => 0,
            "isReviewed" => 0, "review" => ""
        ];
        $id = save_data("Media_Classification", $class_columns);
        $association_columns = [
            "user_id" => $userId, "media_id" => $mediaId, "class_id" => $id
        ];
        $id = save_data("User_Media_Association", $association_columns);
    }
}

function add_to_eye($mediaId, $userId)
{
    $db = getDB();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log(var_export($row, true));

    if ($row['count'] > 0) {
        // If the record exists, perform an UPDATE query
        $updateStmt = $db->prepare("UPDATE Media_Classification SET isWatched = 1 WHERE id = (SELECT class_id FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id)");
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $updateStmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
        $updateStmt->execute();
        $updateRow = $updateStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $class_columns = [
            "isFavorite" => 0, "isWatched" => 1, "numOfStars" => 0,
            "isReviewed" => 0, "review" => ""
        ];
        $id = save_data("Media_Classification", $class_columns);
        $association_columns = [
            "user_id" => $userId, "media_id" => $mediaId, "class_id" => $id
        ];
        $id = save_data("User_Media_Association", $association_columns);
    }
}

function remove_from_eye($mediaId, $userId)
{
    $db = getDB();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log(var_export($row, true));

    if ($row['count'] > 0) {
        // If the record exists, perform an UPDATE query
        $updateStmt = $db->prepare("UPDATE Media_Classification SET isWatched = 0 WHERE id = (SELECT class_id FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id)");
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $updateStmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
        $updateStmt->execute();
        $updateRow = $updateStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $class_columns = [
            "isFavorite" => 0, "isWatched" => 0, "numOfStars" => 0,
            "isReviewed" => 0, "review" => ""
        ];
        $id = save_data("Media_Classification", $class_columns);
        $association_columns = [
            "user_id" => $userId, "media_id" => $mediaId, "class_id" => $id
        ];
        $id = save_data("User_Media_Association", $association_columns);
    }
}

function change_rating($starValue, $mediaId, $userId)
{
    $db = getDB();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log(var_export($row, true));

    if ($row['count'] > 0) {
        // If the record exists, perform an UPDATE query
        $updateStmt = $db->prepare("UPDATE Media_Classification SET numOfStars = :numOfStars WHERE id = (SELECT class_id FROM User_Media_Association WHERE user_id = :user_id AND media_id = :media_id)");
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $updateStmt->bindParam(':media_id', $mediaId, PDO::PARAM_STR);
        $updateStmt->bindParam(':numOfStars', $starValue, PDO::PARAM_STR);
        $updateStmt->execute();
        $updateRow = $updateStmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $class_columns = [
            "isFavorite" => 0, "isWatched" => 0, "numOfStars" => $starValue,
            "isReviewed" => 0, "review" => ""
        ];
        $id = save_data("Media_Classification", $class_columns);
        $association_columns = [
            "user_id" => $userId, "media_id" => $mediaId, "class_id" => $id
        ];
        $id = save_data("User_Media_Association", $association_columns);
    }
}
