<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Single Entity View</title>
    <style>
        /* Add your CSS styles for the single view page here */
        /* This is just a placeholder */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .entity-details {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .entity-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php
    // Include necessary PHP files and perform authentication if required
    // ...

    // Get the ID from the query parameters
    $entity_id = isset($_GET['id']) ? $_GET['id'] : null;

    // Validate the ID (perform necessary checks based on your application logic)
    // Redirect back to list page with a message for an invalid ID
    if (!$entity_id || !isValidEntityId($entity_id)) {
        // Redirect back to the list page with an error message
        header("Location: list_media.php?message=Invalid ID");
        exit;
    }

    // Fetch entity details based on the ID (use your database query here)
    // Example: $entity = fetchEntityById($entity_id);
    // For demonstration purposes, using dummy data
    $entity = [
        'media_title' => 'Sample Media Title',
        'media_year' => '2023',
        'genre_name' => 'Sample Genre',
        'media_image_url' => 'path/to/image.jpg'
        // Add other relevant fields here
    ];
    ?>

    <div class="container">
        <div class="entity-details">
            <h2><?php echo htmlspecialchars($entity['media_title']); ?></h2>
            <p>Year: <?php echo htmlspecialchars($entity['media_year']); ?></p>
            <p>Genre: <?php echo htmlspecialchars($entity['genre_name']); ?></p>
            <img src="<?php echo htmlspecialchars($entity['media_image_url']); ?>" alt="Media Image">

            <!-- Links for edit and delete -->
            <p>
                <a href="edit.php?id=<?php echo $entity_id; ?>" class="btn">Edit</a>
                <a href="delete.php?id=<?php echo $entity_id; ?>" class="btn">Delete</a>
            </p>
        </div>

        <!-- Add more detailed information about the entity as needed -->
        <!-- Additional details can be displayed here based on your data structure -->
    </div>

</body>

</html>
