<?php
function fetch_lawyers($conn,$practiceAreaFilter,$locationFilter):void
{
    $sql = "SELECT * FROM lawyers WHERE speciality = ? AND location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $practiceAreaFilter, $locationFilter);
    $stmt->execute();
    $result=$stmt->get_result();
    $foundLawyers = false;
      while ($row = $result->fetch_assoc()) {
        $lawyers = lawyers($row);
        if ($lawyers === null) {
          header('location:search?lawyers=null');
        } else {
          $foundLawyers = true;
          echo $lawyers;
        }
      }

      if (!$foundLawyers) {
        header('location:search?lawyers=null');
      }
   $stmt->close();
  }