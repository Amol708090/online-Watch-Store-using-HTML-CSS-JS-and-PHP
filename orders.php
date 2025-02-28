<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

// Cancel Order Logic
if (isset($_GET['cancel_order'])) {
    $order_id = $_GET['cancel_order'];
    $update_query = mysqli_query($conn, "UPDATE `orders` SET `payment_status`='cancelled' WHERE `id`='$order_id' AND `user_id`='$user_id'") or die('query failed');
    if ($update_query) {
        header('location:orders.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">
    <style>
        .btn-danger {
            background-color: red;
            color: white;
            padding: 5px 10px; /* Smaller padding */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px; /* Smaller font size */
        }
        .btn-danger:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<?php
include 'user_header.php';
?>

<section class="orders">
    <h2>Placed Orders</h2>
    <div class="orders_cont">
        <?php
        $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');
        if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
        ?>
        <div class="orders_box">
            <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
            <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
            <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
            <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
            <p> payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') { echo 'red'; } else { echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
            <a href="orders.php?cancel_order=<?php echo $fetch_orders['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</a>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">no orders placed yet!</p>';
        }
        ?>
    </div>
</section>

<?php
include 'footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="script.js"></script>

</body>
</html>