<style>
    .myform{
        height:75vh;
        width: 75vw;
        padding: 5vh 7.5vw 0 7.5vw;
    }
</style>
<div class="d-flex justify-content-center">
<form class="myform">
    <h1 class="text-center">Lawyer Registration</h1>

        <label for="">Upload Photo(Optional)</label>
        <input name="pic" type="file">

    <div class="form-group">
        <label for="Fullname">Full Name(Required)</label>
        <input name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    

        <label for="Email">Email address(Required)</label>
        <input name="email"  type="email" class="form-control" id="Email" aria-describedby="emailHelp">

        <label for="phone">Phone Number(optional)</label>
        <input name="phone"  type="text" class="form-control" id="phone" aria-describedby="emailHelp">

        <label for="address">Residential Address(optional)</label>
        <input name="address"  type="text" class="form-control" id="address" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="area">Practice Area(Required)</label>
        <input name="speciality"  type="text" class="form-control" id="area" aria-describedby="emailHelp">

        <label for="education">Education(Required)</label>
        <input name="education"  type="text" class="form-control" id="education" aria-describedby="emailHelp">

        <label for="exp">Experience(Required)</label>
        <input name="experience"  type="text" class="form-control" id="exp" aria-describedby="emailHelp">
    </div>
    <div class="form-group mb-4">
        <label for="InputPassword1">Password</label>
        <input name="password"  type="password" class="form-control" id="InputPassword1">
    </div>

  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="Check1">
    <label class="form-check-label" for="Check1">Show Password</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
