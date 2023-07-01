  <style>
    .search-wrapper{
        height:100vh;
        width: 100vw;
    }
    /* Styles for search bar */
    .search-container {
      display: flex;
      align-items: center;
      max-width: 400px;
      margin: 20px auto;
    }
    
    .search-input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px 0 0 5px;
    }
    
    .search-button {
      padding: 10px 15px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
    }
    
    /* Styles for filters */
    .filter-container {
      display: flex;
      align-items: center;
      max-width: 400px;
      margin: 10px auto;
    }
    
    .filter-label {
      margin-right: 10px;
    }
    
    .filter-select {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
<form method="GET" class="search-wrapper">
      <div class="search-container">
          <input type="text" class="search-input" placeholder="Search...">
    <button type="submit" class="search-button">Search</button>
  </div>
  
    <div class="filter-container">
        <label for="category-filter" class="filter-label">Practice Area</label>
        <select id="category-filter" class="filter-select">
        <option value="">All</option>
        </select>
    </div>

    <div class="filter-container">
        <label for="price-filter" class="filter-label">Price:</label>
        <select id="price-filter" class="filter-select">
            <option value="">All</option>
        </select>
    </div>
</form>
<?php
// Get the search query and filters from the request
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$priceFilter = isset($_GET['price']) ? $_GET['price'] : '';

// Perform the search and filtering logic
// Replace this with your own search and filtering implementation

// Sample search results for demonstration purposes
$products = [
    ['name' => 'Product 1', 'category' => 'electronics', 'price' => 99.99],
    ['name' => 'Product 2', 'category' => 'clothing', 'price' => 49.99],
    ['name' => 'Product 3', 'category' => 'books', 'price' => 19.99],
    ['name' => 'Product 4', 'category' => 'electronics', 'price' => 149.99],
    ['name' => 'Product 5', 'category' => 'books', 'price' => 29.99]
];

// Apply filters if they are provided
if (!empty($categoryFilter)) {
    $products = array_filter($products, function($product) use ($categoryFilter) {
        return $product['category'] === $categoryFilter;
    });
}

if (!empty($priceFilter)) {
    $priceRange = explode('-', $priceFilter);
    $minPrice = floatval($priceRange[0]);
    $maxPrice = floatval($priceRange[1]);

    $products = array_filter($products, function($product) use ($minPrice, $maxPrice) {
        return $product['price'] >= $minPrice && $product['price'] <= $maxPrice;
    });
}

// Output the search results
foreach ($products as $product) {
    echo '<p>' . $product['name'] . ' - Category: ' . $product['category'] . ', Price: $' . $product['price'] . '</p>';
}
?>
