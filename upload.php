<?php
$uploadDir = 'uploads/';

// Ensure the uploads directory exists
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_FILES['image']) {
    $targetFile = $uploadDir . basename($_FILES['image']['name']);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        // Construct the image link based on your server's URL and the uploaded file path
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $serverUrl = $protocol . "://" . $_SERVER['HTTP_HOST'];
        $imageLink = $serverUrl . '/' . $targetFile;

        // Display the image link on the page
        echo '<div class="container">';
        echo '<h2>Image Link:</h2>';
        echo '<p><a href="' . $imageLink . '" target="_blank">' . $imageLink . '</a></p>';
        echo '</div>';
    } else {
        echo 'Error uploading the file.';
    }
}
?>
