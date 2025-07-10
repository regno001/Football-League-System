<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Scorecard</h1>
    <br><br>

    <?php
    // Check if match ID is passed
    if (!isset($_GET['id'])) {
        $_SESSION['error'] = "<div class='error'>No Match Selected.</div>";
        header('location:' . SITEURL . 'admin/manage-matches.php');
        exit;
    }

    $match_id = $_GET['id'];

    // Get match details
    $sql = "SELECT m.*, c1.title AS home_team, c2.title AS away_team 
            FROM tbl_match m
            JOIN tbl_category c1 ON m.team1_id = c1.id
            JOIN tbl_category c2 ON m.team2_id = c2.id
            WHERE m.id = $match_id";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $home_team = $row['home_team'];
        $away_team = $row['away_team'];
        $home_score = $row['home_score'];
        $away_score = $row['away_score'];
    } else {
        $_SESSION['error'] = "<div class='error'>Match Not Found.</div>";
        header('location:' . SITEURL . 'admin/manage-matches.php');
        exit;
    }
    ?>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td><strong><?php echo $home_team; ?> Score</strong></td>
          <td><input type="number" name="home_score" value="<?php echo $home_score ?? 0; ?>"></td>
        </tr>
        <tr>
          <td><strong><?php echo $away_team; ?> Score</strong></td>
          <td><input type="number" name="away_score" value="<?php echo $away_score ?? 0; ?>"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="match_id" value="<?php echo $match_id; ?>">
            <input type="submit" name="submit" value="Update Score" class="btn-primary">
          </td>
        </tr>
      </table>
    </form>

    <?php
    // Handle form submission
    if (isset($_POST['submit'])) {
        $match_id = $_POST['match_id'];
        $home_score = $_POST['home_score'];
        $away_score = $_POST['away_score'];

        $update_sql = "UPDATE tbl_match SET 
                       home_score = $home_score,
                       away_score = $away_score
                       WHERE id = $match_id";

        $update_res = mysqli_query($conn, $update_sql);

        if ($update_res) {
            $_SESSION['update'] = "<div class='success'>Score Updated Successfully.</div>";
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Score.</div>";
        }

        header('location:' . SITEURL . 'admin/manage-matches.php');
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
