<?php
load_head();
?>
<style>
    tr,th,td{
        border: 2px solid black;
    }
    .btn-danger,.btn-success{
        border-radius: 25px;
    }

</style>
<table class="table text-center">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Photo</th>
      <th scope="col">FullName</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Residential Address</th>
      <th scope="col">PracticeArea</th>
      <th scope="col">Education</th>
      <th scope="col">Experience</th>
      <th scope="col">Password</th>
      <th scope="col">Manage</th>
    </tr>
<?php
    $sql='SELECT * FROM lawyers';
    $result=$conn->query($sql);

    while ($rows=$result->fetch_assoc()) {
        $ID=$rows['ID'];
        $Photo=$rows['Photo'];
        $name=$rows['name'];
        $number=$rows['number'];
        $email=$rows['email'];
        $address=$rows['address'];
        $speciality=$rows['speciality'];
        $education=$rows['education'];
        $experience=$rows['experience'];
        $password=$rows['password'];
        echo 
        "
        <tr>
        <td scope='col'>$ID</td>
        <td scope='col'>$Photo</td>
        <td scope='col'>$name</td>
        <td scope='col'>$number</td>
        <td scope='col'>$email</td>
        <td scope='col'>$address</td>
        <td scope='col'>$speciality</td>
        <td scope='col'>$education</td>
        <td scope='col'>$experience</td>
        <td scope='col'>$password</td>
        <td scope='col' style='width:20%;'>
        <span>
            <form class='d-inline' method='POST' action='admin_update'> 
            <input value='$ID' name='id' type='hidden'>
            <input value='$Photo' name='photo' type='hidden'>
            <input value='$name' name='Name' type='hidden'>    
            <input value='$number' name='Number'  type='hidden'>
            <input value='$email' name='Email'  type='hidden'>
            <input value='$address' name='Address'  type='hidden'>
            <input value='$speciality' name='Speciality'  type='hidden'>
            <input value='$education' name='Education'  type='hidden'>
            <input value='$experience' name='Experience'  type='hidden'>
            <input value='$password' name='Password'  type='hidden'>
            <button type='submit' name='update' class='btn btn-success' value='Update'>Update</button>
            </form>
            <form class='d-inline' method='POST' action='admin_delete'>
            <input value='$ID' name='id' type='hidden'>
            <input value='$Photo' name='photo' type='hidden'>
            <input value='$name' name='Name' type='hidden'>    
            <input value='$number' name='Number'  type='hidden'>
            <input value='$email' name='Email'  type='hidden'>
            <input value='$address' name='Address'  type='hidden'>
            <input value='$speciality' name='Speciality'  type='hidden'>
            <input value='$education' name='Education'  type='hidden'>
            <input value='$experience' name='Experience'  type='hidden'>
            <input value='$password' name='Password'  type='hidden'>
            <button type='submit' name='delete' class='btn btn-danger' value='Delete'>Delete</button>
            </form>
        </span>
        </td>
    </tr>
      </tr>
      ";
    }
    echo "</table>";
?>