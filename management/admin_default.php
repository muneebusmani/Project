<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Custom styles for this template -->
    <link href="../../assets/css/bootstrap-4.5.3.css" rel="stylesheet">
    <link href="../../assets/css/darkreader.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <style>
nav{
position:fixed;
}
  /* Remove default bullets */
ul, #myUL {
  list-style-type: none;
}

/* Remove margins and padding from the parent ul */
#myUL {
  margin: 0;
  padding: 0;
}

/* Style the caret/arrow */
.caret {
  cursor: pointer;
  user-select: none; /* Prevent text selection */
}

/* Create the caret/arrow with a unicode, and style it */
.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

/* Rotate the caret/arrow icon when clicked on (using JavaScript) */
.caret-down::before {
  transform: rotate(90deg);
}

/* Hide the nested list */
.nested {
  display: none;
}

/* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
.active {
  display: block;
}
</style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <nav id="myUL" class="col-md-3 col-lg-2 d-md-block bg-dark">
  <a class="col-md-3 col-lg-2 mr-0 px-3" href="#"><h1 class="py-3">JusticiaLaw</h1></a>
  <li><span class="caret">Beverages</span>
    <ul class="nested">
      <li>Water</li>
      <li><span class="caret">Tea</span>
        <ul class="nested">
          <li>Black Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</nav>

  </div>
</div>
<script src="../../assets/lib/jquery/jquery.min.js"></script>
<script src="../../assets/lib/bootstrapbundlejs/bootstrap.bundle.min.js"></script>
<script src="dashboard.js"></script>
<script src="../../assets/js/main.js"></script>

<!-- Dark mode Api -->
<script src="../../assets/lib/darkreader/darkreader.min.js"></script>
<script src="../../assets/lib/darkreader/darkreader.config.js"></script>

</body>
</html>
<script>
  var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>