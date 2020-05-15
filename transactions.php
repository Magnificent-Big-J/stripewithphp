<?php
require_once('config.php');
require_once('lib/Database.php');
require_once('models/Transaction.php');

$transaction = new \models\Transaction();
$transactions = $transaction->getTransactions();

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
            <th>Transaction ID #</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactions as $transaction) {  ?>
            <tr>
                <td><?php echo $transaction->id; ?></td>
                <td><?php echo $transaction->customer_id; ?></td>
                <td><?php echo $transaction->product; ?></td>
                <td><?php echo sprintf('%.2f', $transaction->amount / 100); ?> <?php echo strtoupper($transaction->currency); ?></td>
                <td><?php echo $transaction->created_at; ?></td>
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
