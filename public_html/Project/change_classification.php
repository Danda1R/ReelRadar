<?php

require_once(__DIR__ . "/../../partials/nav.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_to_star') {
        if (isset($_POST['media_id']) && isset($_POST['user_id'])) {
            $mediaId = $_POST['media_id'];
            $userId = $_POST['user_id'];
            add_to_star($mediaId, $userId);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == 'remove_from_star') {
        if (isset($_POST['media_id']) && isset($_POST['user_id'])) {
            $mediaId = $_POST['media_id'];
            $userId = $_POST['user_id'];
            remove_from_star($mediaId, $userId);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == 'add_to_eye') {
        if (isset($_POST['media_id']) && isset($_POST['user_id'])) {
            $mediaId = $_POST['media_id'];
            $userId = $_POST['user_id'];
            add_to_eye($mediaId, $userId);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == 'remove_from_eye') {
        if (isset($_POST['media_id']) && isset($_POST['user_id'])) {
            $mediaId = $_POST['media_id'];
            $userId = $_POST['user_id'];
            remove_from_eye($mediaId, $userId);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] == 'change_rating') {
        if (isset($_POST['media_id']) && isset($_POST['user_id'])) {
            $starValue = $_POST['star_value'];
            $mediaId = $_POST['media_id'];
            $userId = $_POST['user_id'];
            change_rating($starValue, $mediaId, $userId);
        }
    }
}
