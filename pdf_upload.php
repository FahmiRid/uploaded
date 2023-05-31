<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if a file was uploaded
  if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {

    
    $tempFile = $_FILES['pdfFile']['tmp_name'];

    // Get the file content
    $content = file_get_contents($tempFile);

    // Create a PDO connection to your database
    $dsn = 'mysql:host=localhost;dbname=testingdb;charset=utf8mb4';
    $username = 'root';
    $password = '';

    try {
      $pdo = new PDO($dsn, $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare the SQL statement
      $stmt = $pdo->prepare("INSERT INTO pdf_files (name, content) VALUES (:name, :content)");

      // Bind the parameters
      $stmt->bindParam(':name', $_FILES['pdfFile']['name']);
      $stmt->bindParam(':content', $content, PDO::PARAM_LOB);

      // Execute the statement
      $stmt->execute();

      // Generate the response page with the PDF content
      $lastInsertedId = $pdo->lastInsertId();
      echo '<!DOCTYPE html>
            <html>
            <head>
              <title>PDF Viewer</title>
              <style>
                body { margin: 0; padding: 0; }
                iframe { width: 100%; height: 100vh; border: 0; }
              </style>
            </head>
            <body>
              <iframe src="pdf_view.php?id=' . $lastInsertedId . '"></iframe>
            </body>
            </html>';
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  } else {
    echo 'Error uploading file.';
  }
}
?>
