<?php
   echo '<div class="categories"><p>Categories:</p><ul> ' ;
    $query = "SELECT * FROM categories;";
    $result = $conn->query($query);
    if ($result->num_rows) 
      {
     while($row = $result->fetch_assoc() ) {
       $category1 = $row["category"] ;
       echo '<li> <a href="postsByCateg.php?category='.$category1.'">'.$category1.'</a></li>' ;
     }}
     echo '</ul></div>' ;
     ?>
    