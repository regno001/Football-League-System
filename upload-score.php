<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Upload Score</h1>
    <br>

    <?php
    if (!isset($_GET['id'])) {
        header('location:' . SITEURL . 'admin/manage-matches.php');
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_match WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $match = mysqli_fetch_assoc($res);
    ?>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Home Score:</td>
          <td><input type="number" name="home_score" value="<?php echo $match['home_score']; ?>"></td>
        </tr>
        <tr>
          <td>Away Score:</td>
          <td><input type="number" name="away_score" value="<?php echo $match['away_score']; ?>"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Score" class="btn-primary">
          </td>
        </tr>
      </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $home_score = $_POST['home_score'];
        $away_score = $_POST['away_score'];

        $update = "UPDATE tbl_match SET home_score=$home_score, away_score=$away_score WHERE id=$id";
        $res2 = mysqli_query($conn, $update);

        if ($res2) {
            $_SESSION['update'] = "<div class='success'>Score Updated Successfully</div>";
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Score</div>";
        }

        header('location:' . SITEURL . 'admin/manage-food.php');
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
