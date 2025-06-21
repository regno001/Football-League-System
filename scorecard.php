<?php include('partial-front/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Scorecard</h1>
      <link rel="stylesheet" href="style.css"> <!-- If using external file -->
  <style>
   /* Wrapper styles */
.wrapper {
  width: 90%;
  margin: 0 auto;
  padding: 20px;
}

/* Main content area */
.main-content {
  background-color: #f4f4f4;
  padding: 40px 0;
  min-height: 100vh;
}

/* Heading */
h1 {
  text-align: center;
  font-size: 36px;
  margin-bottom: 20px;
  color: #333;
}

/* Table styling */
.tbl-full {
  width: 100%;
  border-collapse: collapse;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.tbl-full th,
.tbl-full td {
  padding: 15px;
  text-align: center;
  border: 1px solid #ddd;
}

.tbl-full th {
  background-color: #007bff;
  color: white;
  font-weight: 600;
  text-transform: uppercase;
}

.tbl-full tr:nth-child(even) {
  background-color: #f9f9f9;
}

.tbl-full tr:hover {
  background-color: #f1f1f1;
}

/* Error message */
.error {
  text-align: center;
  padding: 20px;
  font-size: 18px;
  color: red;
  font-weight: bold;
}

  </style>
</head>
    <br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Team Name</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Points</th>
      </tr>

      <?php
      // Fetch team scorecard data
      $sql = "SELECT * FROM tbl_category ORDER BY points DESC, wins DESC";
      $res = mysqli_query($conn, $sql);
      $sn = 1;

      if ($res && mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
              ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['wins']; ?></td>
                <td><?php echo $row['losses']; ?></td>
                <td><?php echo $row['points']; ?></td>
              </tr>
              <?php
          }
      } else {
          echo "<tr><td colspan='5' class='error'>No Scorecard Data Available</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include('partial-front/footer.php'); ?>
