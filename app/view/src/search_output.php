    <style>
      .location {
        margin-left: var(--margin);
        margin-right: var(--margin);
        text-align: center !important;
      }

      .w-33 {
        width: 33%;
        text-align: center;
        margin: 0;
      }
    </style>
    <h2 class="m-5 text-center">Search Lawyers By Type And Location</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $practiceAreaFilter = $_POST['practice_area'];
      $locationFilter     = $_POST['location'];
      user::fetch_lawyers($conn,$practiceAreaFilter,$locationFilter);
    }
    ?>