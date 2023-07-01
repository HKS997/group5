<?php
include "db_connection.php";

if (isset($_POST["researchTitle"])) {
   $researchTitle = $_POST['researchTitle'];
   $researchDescription = $_POST['researchDescription'];
   $researchDate = $_POST['researchDate'];
   $researchArea = implode(", ", $_POST['researchArea']); // Convert array to string
   $researchType = $_POST['researchType'];

   // Convert researchDate to the appropriate format based on the dateType selected
   $dateType = $_POST['dateType'];
   if ($dateType === 'year') {
      $researchDate = $_POST['researchYear'];
   } elseif ($dateType === 'yearMonth') {
      $researchDate = $_POST['researchMonth'];
   } elseif ($dateType === 'fullDate') {
      $researchDate = $_POST['researchDate'];
   }

   $sql = "INSERT INTO research (ResearchTitle, ResearchDescription, ResearchDate, ResearchArea, ResearchType)
           VALUES (?, ?, ?, ?, ?)";

   $stmt = $conn->prepare($sql);
   $stmt->bind_param("sssss", $researchTitle, $researchDescription, $researchDate, $researchArea, $researchType);

   if ($stmt->execute()) {
      header("Location: manage_research.php?msg=New record created successfully");
      exit();
   } else {
      echo "Failed: " . $stmt->error;
   }

   $stmt->close();
   $conn->close();
}
?>
