<style>
  .location{
    margin-left: var(--margin);
    margin-right: var(--margin);
    text-align: center !important;

  }
  .w-33{
    width: 33%;
    text-align: center;
    margin: 0;
  }
</style>
<h2 class="m-5 text-center">Search Lawyers By Type And Location</h2>
<?php
if (isset($_POST['practice_area']) && isset($_POST['location'])) {
try {
      $practiceAreaFilter = $_POST['practice_area'];
      $locationFilter = $_POST['location'];
      $sql = "SELECT * FROM lawyers WHERE speciality = ? AND location = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $practiceAreaFilter, $locationFilter);
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        $Pic = $row['Photo'];
        $lawyerName = $row['name'];
        $lawyerLocation = $row['location'];
        $lawyerPracticeArea = $row['speciality'];
        echo 
        "
    <div class='wrapper' style=''>
      <div class='accordion' style='width:75%;margin:0px auto;'>
        <div class='card'>
        <div class='card-header' id='headingOne'>
          <h2 class='mb-0'>
            <button class='btn btn-link btn-block text-left' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
            <a href'lawyer_create'>
            <span class='d-flex justify-content-center'>
              <p class'lawyer-photo' style='
                width:2.5rem;
                height:2.5rem;
                background-size: cover;
                background-image: url($Pic);'>
              </p>
              <p class='w-33 align-middle'>$lawyerName</p>
              <p class='w-33 align-middle'>$lawyerLocation</p>
              <p class='w-33 align-middle'>$lawyerPracticeArea</p>
              </span>
            </a>


            </button>
          </h2>
        </div>
      </div>
  </div>    
        ";
      }  
      $stmt->close();
} catch (Exception $e) {
  echo $e->getMessage();
}
  }
  else {
    echo "No Lawyers Found!";
  }
?>
