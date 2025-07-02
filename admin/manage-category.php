<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Teams</h1>
    <br><br>

    <?php
    // Display session messages
    $session_keys = ['add', 'remove', 'delete', 'no-category-found'];
    foreach ($session_keys as $key) {
        if (isset($_SESSION[$key])) {
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
    }
    ?>
    <br><br>

    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Team</a>
    <br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Team</th>
        <th>Image</th>
        <th>Action</th>
      </tr>

      <?php 
      // Get categories from database
      $sql = "SELECT * FROM tbl_category";
      $res = mysqli_query($conn, $sql);

      if ($res) {
          $count = mysqli_num_rows($res);
          $sn = 1;

          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>
                      <?php 
                      if ($image_name != "") {
                          ?>
                          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                          <?php
                      } else {
                          echo "<div class='error'>Image not added</div>";
                      }
                      ?>
                    </td>
                    <td>
                      <a href="<?php echo SITEURL; ?>admin/update-c.php?id=<?php echo $id; ?>" class="btn-secondary">Update Team</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Team</a>
                    </td>
                  </tr>
                  <?php
              }
          } else {
              // No categories found
              ?>
              <tr>
                <td colspan="4"><div class="error">No categories added.</div></td>
              </tr>
              <?php
          }
      } else {
          echo "<tr><td colspan='4'><div class='error'>Failed to fetch categories from database.</div></td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include('partials/footer.php'); ?>
