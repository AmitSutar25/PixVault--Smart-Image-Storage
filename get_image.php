<?php

$servername = "mydatabase.crc8o6222fmv.sa-east-1.rds.amazonaws.com";
$username = "admin";
$password = "Amit24680";
$dbname = "myappdb";

$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname
);

if (!$conn) {
    die("Database connection failed.");
}

$name = trim($_GET["name"] ?? "");

$images = [];
$error = "";

if ($name === "") {
    $error = "Please enter a name.";
} else {

    $sql = "SELECT name, url FROM posts WHERE name = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row;
        }

        mysqli_stmt_close($stmt);

        if (empty($images)) {
            $error = "No image found for this name.";
        }

    } else {
        $error = "Unable to search for the image.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Get Your Image</title>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    min-height: 100vh;
    padding: 25px 15px;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2, #3b82f6);
    display: flex;
    align-items: center;
    justify-content: center;
}

.result-box {
    width: 100%;
    max-width: 600px;
    padding: 35px;
    border-radius: 22px;
    background: white;
    box-shadow: 0 20px 55px rgba(0,0,0,0.25);
    text-align: center;
}

.icon {
    font-size: 45px;
    margin-bottom: 15px;
}

h1 {
    color: #202944;
    font-size: 27px;
    margin-bottom: 12px;
}

.message {
    color: #6b7280;
    line-height: 1.7;
    margin-bottom: 24px;
}

.image-card {
    padding: 18px;
    margin: 18px 0;
    background: #f8f9ff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
}

.image-card img {
    display: block;
    width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 10px;
    margin-bottom: 12px;
}

.image-card p {
    color: #374151;
    overflow-wrap: anywhere;
    margin-bottom: 12px;
}

.image-card a {
    color: #4f46e5;
    font-weight: bold;
}

.error {
    padding: 15px;
    border-radius: 10px;
    background: #fee2e2;
    color: #b91c1c;
    line-height: 1.6;
    margin: 20px 0;
}

.back-button {
    display: inline-block;
    width: 100%;
    padding: 14px;
    margin-top: 12px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.back-button:hover {
    opacity: 0.9;
}

@media (max-width: 480px) {
    .result-box {
        padding: 25px 18px;
    }
}
</style>
</head>

<body>

<div class="result-box">

    <div class="icon">🖼️</div>

    <h1>Image Search Results</h1>

    <p class="message">
        Search results for:
        <strong><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></strong>
    </p>

    <?php if ($error !== ""): ?>

        <div class="error">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>

    <?php else: ?>

        <p class="message">
            Found <?= count($images) ?> image(s).
        </p>

        <?php foreach ($images as $image): ?>

            <div class="image-card">

                <p>
                    Uploaded by:
                    <strong>
                        <?= htmlspecialchars(
                            $image["name"],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </strong>
                </p>

                <img
                    src="<?= htmlspecialchars(
                        $image["url"],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    alt="Uploaded image"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                >

                <p style="display:none; color:#b91c1c;">
                    The image could not be loaded. Check the S3 object
                    URL and its access permissions.
                </p>

                <a
                    href="<?= htmlspecialchars(
                        $image["url"],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Open Full Image
                </a>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <a href="index.html" class="back-button">
        ← Back to Home
    </a>

</div>

</body>
</html>
