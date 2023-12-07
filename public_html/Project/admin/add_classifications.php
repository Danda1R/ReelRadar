<?php
require(__DIR__ . "/../../../partials/nav.php");
is_logged_in(true, "../login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log(var_export($_POST, true));
    if (isset($_POST['userCheckbox']) && isset($_POST['mediaCheckbox'])) {

        $db = getDB();

        $userCheckboxes = $_POST['userCheckbox'];
        $mediaCheckboxes = $_POST['mediaCheckbox'];
        $watched = isset($_POST['watched']) ? $_POST['watched'] : 'off';
        $favorite = isset($_POST['favorite']) ? $_POST['favorite'] : 'off';
        $ratings = isset($_POST['ratings']) ? $_POST['ratings'] : 0;

        foreach ($userCheckboxes as $userCheckbox) {
            foreach ($mediaCheckboxes as $mediaCheckbox) {
                $userStmt = $db->prepare("SELECT id AS userID FROM Users WHERE username = :username");
                $userStmt->bindParam(':username', $userCheckbox, PDO::PARAM_STR);
                $userStmt->execute();
                $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);

                $mediaStmt = $db->prepare("SELECT id AS mediaID FROM Media WHERE title = :title");
                $mediaStmt->bindParam(':title', $mediaCheckbox, PDO::PARAM_STR);
                $mediaStmt->execute();
                $mediaRow = $mediaStmt->fetch(PDO::FETCH_ASSOC);

                error_log(var_export($mediaRow["mediaID"] . " " . $userRow["userID"], true));

                if ($watched == "on") {
                    add_to_eye($mediaRow["mediaID"], $userRow["userID"]);
                } else {
                    remove_from_eye($mediaRow["mediaID"], $userRow["userID"]);
                }

                if ($favorite == "on") {
                    add_to_star($mediaRow["mediaID"], $userRow["userID"]);
                } else {
                    remove_from_star($mediaRow["mediaID"], $userRow["userID"]);
                }

                if ($ratings > 0) {
                    change_rating($ratings, $mediaRow["mediaID"], $userRow["userID"]);
                }
            }
        }
        flash("Associations successfully made!", "success");
        die(header("Location: add_associations.php"));
    } else {
        flash("Please select at least one user and one media to add associations!", "warning");
        die(header("Location: add_associations.php"));
    }
}

require(__DIR__ . "/../../../partials/flash.php");
require_once(__DIR__ . "/../../../partials/footer.php");
