<?php
require_once('config.php');
require_once('lib/Database.php');
require_once('models/Customer.php');

$customer = new \models\Customer();
$customers = $customer->getCustomers();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Customers</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <div class="btn-group" role="group">
        <a href="customers.php" class="btn btn-primary">Customers</a>
        <a href="transactions.php" class="btn btn-info">Transactions</a>
    </div>
    <hr>
    <h2>Customers</h2>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Customer ID #</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) {  ?>
                <tr>
                    <td><?php echo $customer->id; ?></td>
                    <td><?php echo $customer->first_name .' '. $customer->last_name; ?></td>
                    <td><?php echo $customer->email; ?></td>
                    <td><?php echo $customer->created_at; ?></td>

                </tr>
            <?php }?>
        </tbody>
    </table>
    <hr>
    <a href="index.php" class="btn btn-light">Pay Page</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
