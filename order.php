<?php include('partial-front/menu.php'); ?>
<?php include('config/constants.php'); ?>

<?php  
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL);
        exit;
    }
} else {
    header('location:' . SITEURL);
    exit;
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    if ($image_name == "") {
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">₹ <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your full name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder=" 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder=" hi@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
        if (isset($_POST['submit'])) {
            // Get data from form
            $food = $_POST['food'];
            $price = (float)$_POST['price'];
            $qty = (int)$_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d H:i:s");
            $status = "Ordered";

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Insert into database
            $sql2 = "INSERT INTO tbl_order SET 
                food = '$food',
                price = '$price',
                qty = '$qty',
                total = '$total',
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
            ";

            $res = mysqli_query($conn, $sql2);

            if ($res == true) {
                $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully!</div>";
                header('location:' . SITEURL);
                exit;
            } else {
                $_SESSION['order'] = "<div class='error text-center'>Failed to order food. Try again later.</div>";
                header('location:' . SITEURL);
                exit;
            }
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partial-front/footer.php'); ?>
