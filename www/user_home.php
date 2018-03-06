<?php
  
  include 'includes/db.php';
  include 'includes/user_header.php';
  include 'includes/functions.php';
 // include 'includes/user_login.php';

?>

  <body id="home">
  <!-- main content starts here -->
     <div class="main">
        <div class="book-display">
           <?php
              $fetch = showTopSeller($conn);

              echo $fetch;

           ?>

   		    <form>
                <label for="book-amount">Amount</label>
                <input type="number" class="book-amount text-field">
                <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
            </form>
      </div>
      </div>
         <div class="trending-books horizontal-book-list">
         <h3 class="header">Trending</h3>
         <ul class="book-list">
         <?php

             $trendData = viewTrendingBooks($conn);

             echo $trendData;


        ?>
      </ul>
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
  <!-- footer starts here-->
  <?php

    include 'includes/user_footer.php';


  ?>
