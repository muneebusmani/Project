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

<form method="post" class="search-wrapper" action="search_output">
  <div class="search-container">
    <div class="filter-container d-flex py-3">
      <select id="practice-area-filter" name="practice_area" class="filter-select w-40 text-center">
        <option disabled selected>Practice Area</option>
        <?php
        user::fetch_options($conn,'practice_area','practice_area');
        ?>
      </select>
      <select id="practice-area-filter" name="location" class="filter-select w-40 text-center">
        <option disabled selected>Location</option>
        <?php
        user::fetch_options($conn,'location','location');
        ?>
      </select>
    </div>
    <input type="submit" class="btn btn-primary p-3 w-100" value="Find Lawyers">
  </div>
  <hr>
</form>
<?php
if (isset($_GET['lawyers'])) {
  echo "
  <script>
      alert('No Lawyers Found Based on Current Criteria');
      window.history.replaceState({}, document.title, window.location.pathname);
  </script>
  ";
  unset($_GET['lawyers']);
}

