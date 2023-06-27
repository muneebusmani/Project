<!DOCTYPE html>
<html>
<head>
  <title>Search Bar with Filters</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Search Bar with Filters</h1>
  
  <form id="searchForm">
    <input type="text" id="searchInput" placeholder="Search...">
    <br>
    <label>
      <input type="checkbox" class="filterCheckbox" value="filter1"> Filter 1
    </label>
    <label>
      <input type="checkbox" class="filterCheckbox" value="filter2"> Filter 2
    </label>
    <label>
      <input type="checkbox" class="filterCheckbox" value="filter3"> Filter 3
    </label>
    <br>
    <button type="submit">Search</button>
  </form>
  
  <div id="searchResults"></div>
  
  <script>
    $(document).ready(function() {
      $('#searchForm').submit(function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Get search query
        var searchQuery = $('#searchInput').val();
        
        // Get selected filters
        var selectedFilters = [];
        $('.filterCheckbox:checked').each(function() {
          selectedFilters.push($(this).val());
        });
        
        // Perform search with filters
        performSearch(searchQuery, selectedFilters);
      });
    });
    
    function performSearch(query, filters) {
      // Your search logic here
      // You can make an AJAX request to a server endpoint to fetch search results based on the query and filters
      // Update the #searchResults element with the retrieved search results
      // For demonstration, let's simply display the query and selected filters
      
      var resultHtml = '<p>Search Query: ' + query + '</p>';
      resultHtml += '<p>Selected Filters: ' + filters.join(', ') + '</p>';
      
      $('#searchResults').html(resultHtml);
    }
  </script>
</body>
</html>
