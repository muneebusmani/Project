<style>
    .parent{
        width: 20rem;
    }
  .child {
    display: none;
  }
  .btn{
    padding: 1rem 2rem;
  }
</style>
<h1 class="text-center py-5">
    JusticiaLaw Admin
</h1>
  <div class="parent" onmouseover="showChild(this)" onmouseout="hideChild(this)" onclick="toggleChild(this)">
    <input type="button" class="btn btn-secondary" style="width: 100%" value="Locations">
    <div class="child">
      <?php admin::fetch_options($conn, 'location') ?>
    </div>
  </div>

  <script>
    function showChild(parent) {
      var child = parent.querySelector('.child');
      child.style.display = 'block';
    }

    function hideChild(parent) {
      var child = parent.querySelector('.child');
      if (!parent.dataset.clicked) {
        child.style.display = 'none';
      }
    }

    function toggleChild(parent) {
      var child = parent.querySelector('.child');
      if (child.style.display === 'none') {
        child.style.display = 'block';
        parent.dataset.clicked = true;
      } else {
        child.style.display = 'none';
        parent.dataset.clicked = false;
      }
    }
  </script>
