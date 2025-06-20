<?php include('config/constants.php'); ?>
<?php include('partial-front/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Upcoming & Played Matches</h1>
    <br>

    <?php
    $sql = "SELECT m.*, 
                c1.title AS home_team, c1.image_name AS home_logo,
                c2.title AS away_team, c2.image_name AS away_logo
            FROM tbl_match m
            INNER JOIN tbl_category c1 ON m.team1_id = c1.id
            INNER JOIN tbl_category c2 ON m.team2_id = c2.id
            ORDER BY m.id DESC";

    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <div class="match-card" style="border:1px solid #ccc; padding:20px; margin-bottom:20px; text-align:center;">
                <div style="display:flex; align-items:center; justify-content:space-around;">
                    <div>
                        <?php if ($row['home_logo']) { ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $row['home_logo']; ?>" width="80px"><br>
                        <?php } ?>
                        <strong><?php echo $row['home_team']; ?></strong>
                    </div>

                    <div style="font-size: 24px;">
                        <?php
                        if ($row['home_score'] !== null && $row['away_score'] !== null) {
                            echo "<strong>{$row['home_score']} - {$row['away_score']}</strong>";
                        } else {
                            echo "<span style='color: gray;'>VS</span>";
                        }
                        ?>
                    </div>

                    <div>
                        <?php if ($row['away_logo']) { ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $row['away_logo']; ?>" width="80px"><br>
                        <?php } ?>
                        <strong><?php echo $row['away_team']; ?></strong>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='error'>No matches found.</div>";
    }
    ?>
  </div>
</div>

<?php include('partial-front/footer.php'); ?>
