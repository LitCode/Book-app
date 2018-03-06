<?php

    session_start();
 	
    include 'includes/db.php';
    include 'includes/user_header.php';
    include 'includes/functions.php';

 ?>
 <body id="catalogue">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->
  <!-- side bar starts here -->
  <div class="side-bar">
    <div class="categories">
      <h3 class="header">Categories</h3>
        <ul class="category-list">
          <?php

            $data = viewBookCategory($conn);

            echo $data;

          ?>
        </ul>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="main-book-list horizontal-book-list">
      <ul class="book-list">
        <?php

          $bookData = viewAllBooks($conn);

          echo $bookData;

        ?>
      </ul>
      <div class="actions">
        <button class="def-button previous">Previous</button>
        <button class="def-button next">Next</button>
      </div>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
        <ul class="book-list">
          <?php

            $recentData = viewRecentBooks($conn);

            echo $recentData;

          ?>
        </ul>
    </div>
    
  </div>

   <?php

    include 'includes/user_footer.php';


  ?>