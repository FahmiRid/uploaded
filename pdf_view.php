<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Create a PDO connection to your database
  $dsn = 'mysql:host=localhost;dbname=testingdb;charset=utf8mb4';
  $username = 'root';
  $password = '';

  try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT name, content FROM pdf_files WHERE id = :id");

    // Bind the parameter
    $stmt->bindParam(':id', $id);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      $name = $result['name'];
      $content = $result['content'];

      // Set the appropriate headers for PDF
      header('Content-Type: application/pdf');
      header('Content-Disposition: inline; filename="' . $name . '"');

      // Output the PDF content
      echo $content;
    } else {
      echo 'PDF not found.';
    }
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}
?>
