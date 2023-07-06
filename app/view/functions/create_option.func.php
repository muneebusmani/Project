<?php
function create_options(mysqli $conn,string $options){
echo
"
<style>
  form{
    margin: 0px auto;
    width: 30rem;
    height: 20rem;
    --margin:10%;
    margin: var(--margin) auto;
    border: 2px solid black;
  }
</style>
<form class='text-center py-5' method='POST'>
  <h1>Add $options</h1>
  <label for='$options'>$options</label>
  <input type='text' id='$options' name='option' required>
  <input type='submit' value='Add'>
</form>
";
// Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        
        // Get the location value from the form
        $choice = $_POST['option'];

        // Insert the location into the options table
        $sql = "CREATE TABLE IF NOT EXISTS `$options` (`$options` varchar(255));
        INSERT INTO `$options` (`$options`) VALUES ('$choice');";
        
        if ($conn->multi_query($sql) === TRUE) {
            echo "$choice added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}