<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Matches</h1>
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
        <th>Home Team</th>
        <th>Away Team</th>
        <th>Score</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT m.*, 
              c1.title AS home_team, 
              c2.title AS away_team 
              FROM tbl_match m
              INNER JOIN tbl_category c1 ON m.team1_id = c1.id
              INNER JOIN tbl_category c2 ON m.team2_id = c2.id";

      $res = mysqli_query($conn, $sql);
      $sn = 1;

      if (mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
              ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $row['home_team']; ?></td>
                <td><?php echo $row['away_team']; ?></td>
                <td>
                  <?php
                  if ($row['home_score'] !== null && $row['away_score'] !== null) {
                      echo $row['home_score'] . " - " . $row['away_score'];
                  } else {
                      echo "<span class='error'>Not Updated</span>";
                  }
                  ?>
                </td>
                <td>
                  <a href="upload-score.php?id=<?php echo $row['id']; ?>" class="btn-secondary">Upload Score</a>
                </td>
              </tr>
              <?php
          }
      } else {
          echo "<tr><td colspan='5' class='error'>No Matches Found</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include('partials/footer.php'); ?>
