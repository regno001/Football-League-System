<?php 
ob_start(); // Start output buffering
include('partials/menu.php'); 
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Scorecard</h1>
    <br>

    <?php 
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    ?>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Team Name</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Points</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT * FROM tbl_category ORDER BY title ASC";
      $res = mysqli_query($conn, $sql);
      $sn = 1;

      if ($res && mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
              $id = $row['id'];
              $title = $row['title'];
              $wins = $row['wins'];
              $losses = $row['losses'];
              $points = $row['points'];
              ?>
              <tr>
                <form action="" method="POST">
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo $title; ?></td>
                  <td><input type="number" name="wins" value="<?php echo $wins; ?>" required></td>
                  <td><input type="number" name="losses" value="<?php echo $losses; ?>" required></td>
                  <td><input type="number" name="points" value="<?php echo $points; ?>" required></td>
                  <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="update_score" value="Update" class="btn-secondary">
                  </td>
                </form>
              </tr>
              <?php
          }
      } else {
          echo "<tr><td colspan='6' class='error'>No Teams Found</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php
if (isset($_POST['update_score'])) {
    $id = $_POST['id'];
    $wins = $_POST['wins'];
    $losses = $_POST['losses'];
    $points = $_POST['points'];

    $update_sql = "UPDATE tbl_category SET 
                    wins = '$wins',
                    losses = '$losses',
                    points = '$points'
                  WHERE id = '$id'";

    $update_res = mysqli_query($conn, $update_sql);

    if ($update_res) {
        $_SESSION['update'] = "<div class='success'>Scorecard updated successfully.</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to update scorecard.</div>";
    }

    header("Location: " . SITEURL . "admin/manage-scorecard.php");
    exit();
}
?>

<?php 
include('partials/footer.php'); 
ob_end_flush(); // Send buffered output
?>
