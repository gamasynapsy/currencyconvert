<!DOCTYPE html>
<!--/* File : index.php
	 * Author : Gama Toko
	*/
/*******************************************************

    This program is free software; you can redistribute it and/or modify
    it as u need.
******************************************************/ 
-->
<html lang="en">
<head>
  <title>CURRENCY CONVERTER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Currency converter client side</h2>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="currency">Currency (check the currency to convert in EURO)</label>
      <select name="op" class="form-control">
		  <option value="convert">CONVERT</option>
		  <option value="reverse">REVERSE</option>
      </select>
      <select name="currency" class="form-control">
		  <option value="USD">USD</option>
		  <option value="JPY">JPY</option>
		  <option value="BGN">BGN</option>
      </select>
      <label for="amount">Amount</label>
      <input type="text" name="amount" class="form-control"  placeholder="Enter Amount to be converted" required/>
    </div>
    
    <button type="submit" name="submit" class="btn btn-default">Convert</button>
  </form>
  <p>&nbsp;</p>
  <h3>
  <?php
		if(isset($_POST['submit'])){
			$currency = $_POST['currency'];
			$amount = $_POST['amount'];
			$op = $_POST['op'];
			$url = 'http://localhost/Rest/rest.php?op='.$op.'&currency='.$currency.'&amount='.$amount;
			
			$client = curl_init($url);
			curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
			$response = curl_exec($client);
			
			$result = json_decode($response);
			if($op == 'convert')
				echo $amount.' '.$currency.' --> '.$result->data.' Euros'; 
			else
				echo $amount.' Euros --> '.$result->data.' '.$currency; 	
		}
   ?>
  </h3>
</div>
</body>
</html>
