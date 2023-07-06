<?php
  if (isset($_POST['practice_area']) && isset($_POST['location'])) {
    // Get the selected filter values
    $practiceAreaFilter = $_POST['practice_area'];
    $locationFilter = $_POST['location'];
  
    // Construct the SQL query to fetch filtered lawyers
    $sql = "SELECT * FROM lawyers WHERE speciality = ? AND Location = ?";
    $stmt = $conn->prepare($sql);
  
    // Bind the filter values to the prepared statement
    $stmt->bind_param("ss", $practiceAreaFilter, $locationFilter);
  
    // Execute the prepared statement
    $stmt->execute();
  
    // Get the result set
    $result = $stmt->get_result();
  
    // Loop through the rows and display the filtered lawyers
    while ($row = $result->fetch_assoc()) {
      // Handle each row and display the lawyer details
      $lawyerName = $row['Name'];
      $lawyerPracticeArea = $row['PracticeArea'];
      $lawyerLocation = $row['Location'];
  
      echo "Lawyer Name: $lawyerName<br>";
      echo "Practice Area: $lawyerPracticeArea<br>";
      echo "Location: $lawyerLocation<br><br>";
    }  
    // Close the statement
    $stmt->close();
  }
  else {
    echo "No Lawyers Found!";
  }
