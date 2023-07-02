<?php fetch_post();?>
<form method="post">
    <h1 class="text-center">Lawyer Registration</h1>
    <div class="form-group">
        <label for="Fullname">Full Name</label>
        <input value="<?php echo $name;?>" name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    
        <label for="phone">Phone Number</label>
        <input value="<?php echo $number;?>" name="number"  type="text" class="form-control" id="phone" aria-describedby="emailHelp">
        <label for="Email">Email address</label>
        <input value="<?php echo $email;?>" name="email"  type="email" class="form-control" id="Email" aria-describedby="emailHelp">
        <label for="address">Residential Address</label>
        <input value="<?php echo $address;?>" name="address"  type="text" class="form-control" id="address" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="area">Practice Area</label>
        <input value="<?php echo $speciality; ?>" name="speciality"  type="text" class="form-control" id="area" aria-describedby="emailHelp">
        <label for="education">Education</label>
        <input value="<?php echo $education; ?>" name="education"  type="text" class="form-control" id="education" aria-describedby="emailHelp">
        <label for="exp">Experience</label>
        <input value="<?php echo $experience; ?>" name="experience"  type="text" class="form-control" id="exp" aria-describedby="emailHelp">
    </div>
    <div class="form-group mb-4">
        <label for="InputPassword1">Password</label>
        <input value="<?php echo $password; ?>" name="password"  type="password" class="form-control" id="password">
    </div>
    </form>
    <div class="form-group form-check">
    <input type="checkbox" onclick="toggle_password();" class="form-check-input" id="Check1">
    <label class="form-check-label" for="Check1">Show Password</label>
    </div>
  </div>
  <input name="submit" type="submit" class="btn btn-primary" value="Submit">
</form>
<script>
function toggle_password() {
    var passToggle = document.getElementById('password');
    passToggle.type = (passToggle.type === 'password') ? 'text' : 'password';
}
</script>
<?php
    if (isset($_POST['submit'])) {
        $name=$number=$email=$address=$speciality=$education=$experience=$password='';
    try {
        fetch_post();
        $errors=[]; 
        $err_msg=handle_err();
        if($err_msg){
            echo $err_msg;
        }
        else{
            bulk_sanitize();
            prepare_and_execute();
            echo 'records'
        }}
    catch (error $e) {
        echo $e->getMessage();
     }
    }
    
?>