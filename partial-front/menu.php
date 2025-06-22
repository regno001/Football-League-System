<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Website</title>

    <!-- Link our CSS file -->
  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="">Football
                    
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Teams</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>matches.php">Matches</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>scorecard.php">Scorecard</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
