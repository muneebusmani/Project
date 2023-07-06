<style>
  .search-wrapper {
    height: 100vh;
  }
  
  /* Styles for search bar */
  .search-container {
    max-width: 40rem;
    margin: 0px auto;
  }
  
  .search-input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
  }
  /* Styles for filters */
  .filter-container {
    max-width: 40rem;
    margin: 0px auto;
  }
  
  .filter-select {
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  .w-40 {
    width: 50%;
    padding: 2rem;
    display: inline;
  }
  option {
    text-align: center;
  }
  hr {
    width: 100%;
    background-color: darkgray;
  }
</style>

<form method="post" class="search-wrapper" action="lawyers">
  <div class="search-container">
    <div class="filter-container d-flex py-3">
      <select id="practice-area-filter" name="practice_area" class="filter-select w-40 text-center">
        <option disabled selected>Practice Area</option>
        <?php
        $column = 'PracticeArea';
        $table = 'PracticeAreas';

        // Construct the SQL query
        $sql = "SELECT $column FROM $table";
        $stmt = $conn->prepare($sql);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Loop through the rows
        while ($row = $result->fetch_assoc()) {
          // Handle each row
          $practiceArea = $row['PracticeArea'];
          echo "<option value='$practiceArea'>$practiceArea</option>";
        }
        // Close the statement
        $stmt->close();
        ?>
      </select>
      <select id="location-filter" name="location" class="filter-select w-40 text-center">
        <option disabled selected>Location</option>
        <?php
        $column = 'areas';
        $table = 'area';

        // Construct the SQL query
        $sql = "SELECT $column FROM $table";
        $stmt = $conn->prepare($sql);
        // Execute the prepared statement
        $stmt->execute();
        // Get the result set
        $result = $stmt->get_result();
        // Loop through the rows
        while ($row = $result->fetch_assoc()) {
          // Handle each row
          $area = $row['areas'];
          echo "<option value='$area'>$area</option>";
        }
        // Close the statement
        $stmt->close();
        ?>
      </select>
    </div>
    <input type="submit" class="btn btn-primary p-3 w-100" value="Find Lawyers">
  </div>
  <hr>
</form>
