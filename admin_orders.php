<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'Order Payment status has been updated';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id='$delete_id'") or die('query failed');
    $message[] = '1 order has been deleted';
}

// Cancel Order Logic
if (isset($_GET['cancel_order'])) {
    $order_id = $_GET['cancel_order'];
    mysqli_query($conn, "UPDATE `orders` SET `payment_status`='cancelled' WHERE `id`='$order_id'") or die('query failed');
    $message[] = 'Order has been cancelled';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
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
include 'admin_header.php';
?>

<section class="admin_orders">
    <h1 class="title">Placed Orders</h1>

    <div class="admin_box_container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
        if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
        ?>
        <div class="admin_box">
            <p>User Id : <span><?php echo $fetch_orders['user_id'] ?></span></p>
            <p>Placed On : <span><?php echo $fetch_orders['placed_on'] ?></span></p>
            <p>Name : <span><?php echo $fetch_orders['name'] ?></span></p>
            <p>Number : <span><?php echo $fetch_orders['number'] ?></span></p>
            <p>Email : <span><?php echo $fetch_orders['email'] ?></span></p>
            <p>Address : <span><?php echo $fetch_orders['address'] ?></span></p>
            <p>Total Products : <span><?php echo $fetch_orders['total_products'] ?></span></p>
            <p>Total Price : <span><?php echo $fetch_orders['total_price'] ?></span></p>
            <p>Payment Method : <span><?php echo $fetch_orders['method'] ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                <select name="update_payment">
                    <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
                <input type="submit" value="update" name="update_order" class="option-btn">
                <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');" class="delete-btn">delete</a>
                <a href="admin_orders.php?cancel_order=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Are you sure you want to cancel this order?');" class="btn btn-danger">Cancel Order</a>
            </form>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No orders placed yet!</p>';
        }
        ?>
    </div>
</section>

<script src="admin_js.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>