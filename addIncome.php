<?php

	session_start();
	
	if (!isset($_SESSION['logged_id']))
	{
		header('Location: index.php');
		exit();
	}
	
	if(isset($_POST['amount']))
	{
		$good=true;
		$amount = $_POST['amount'];
		$date = $_POST['date'];
		$category = $_POST['category'];
		$comment = $_POST['comment'];
		
		if ($amount <=0)
		{
			$good=false;
			$_SESSION['e_amount']="Wpisz pozytywną wartość";
		}
		$comment = htmlentities($comment, ENT_QUOTES, "UTF-8");
		
		require_once 'database.php';
		
		if($good == true)
		{
			$query = $db->prepare('INSERT INTO incomes VALUES (NULL, :userId, :amount, :date, :category, :comment)');
			$query->bindValue(':userId', $_SESSION['logged_id'], PDO::PARAM_INT);
			$query->bindValue(':amount', $amount, PDO::PARAM_STR);
			$query->bindValue(':date', $date, PDO::PARAM_STR);
			$query->bindValue(':category', $category, PDO::PARAM_STR);
			$query->bindValue(':comment', $comment, PDO::PARAM_STR);
			$query->execute();
		//	header('Location: index.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <script src="https://kit.fontawesome.com/40a173cedf.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  
  <meta name="author" content="Mateusz Paczwa"/>
  <meta name="description" content="Manage yours finances by looking at yours incomes and expenses" />
  <meta name="keywords" content="finances, incomes, expenses, saldo, money" />
  <title>Finanse logowanie</title>
  
</head>

<body>
	<div class="logo py-2">
		<h1><i class="fas fa-balance-scale"></i> Finanse</h1>
		<samll>Zadbaj o balans swoich przychodów i wydatków</small>
	</div>
  
	<nav class="navbar navbar-expand-md  navbar-light py-2" >
		<div class="container" >
		
			<button class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon "></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarCollapse">
				
				<ul class="navbar-nav mx-auto ">
					<li class="nac-item">
						<a href="menu.php" class="nav-link">Strona Główna</a>
					</li>
					<li class="nac-item">
						<a href="addIncome.php" class="nav-link">Dodaj Przychód</a>
					</li>
					<li class="nac-item">
						<a href="addExpense.php" class="nav-link">Dodaj Wydatek</a>
					</li>
					<li class="nac-item">
						<a href="balance.php" class="nav-link">Bilans</a>
					</li>
					<li class="nac-item">
						<a href="#" class="nav-link">Ustawienia</a>
					</li>
					<li class="nac-item">
						<a href="logout.php" class="nav-link">Wyloguj</a>
					</li>
				</ul>
				
			</div>
			
		</div>
	</nav>
  
  
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4  col-8 offset-2  text-center mt-5" id="logowanie">
				<header>
					<h2 class="p-3">Nowy przychód</h2>
				</header>
				
				<form id="form" method="post">
			
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-coins"></i></strong></span>
						</div>
						<input class="form-control" type="number" placeholder="Kwota" step="0.01" min="0" name="amount">
					</div>
					<?php
							if (isset($_SESSION['e_amount']))
							{
								echo '<div class="error">'.$_SESSION['e_amount'].'</div>';
								unset($_SESSION['e_amount']);
							}
					?>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="far fa-calendar-alt"></i></strong></span>
						</div>
						<input class="form-control" type="date" placeholder="Adres email" min="2000-01-01" name="date" id="date">
					</div>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-tag"></i></strong></span>
						</div>
						<select class="form-control" name="category">
							<option value="g" selected>Wynagrodzenie</option>
							<option value="kd" >Odsetki bankowe</option>
							<option value="kk">Sprzedaż na allegro</option>
							<option value="kk">Inne</option>
						</select>
					</div>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="far fa-comment"></i></strong></span>
						</div>
						<input class="form-control" type="text" placeholder="Komentarz" name="comment">
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"> 
								<button type="submit" value="Submit" class="btn btn-success btn-inline-block">
									<i class="fas fa-plus"></i> Dodaj 
								</button>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group"> 
								<button class="btn btn-danger btn-inline-block">
									<i class="fas fa-times"></i> Anuluj
								</button>
							</div>
						</div>
					</div>
				
				</form>
			</div>
			
		</div>
	</div>
	
  <script
  src="http://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
	
	$(document).ready( function() 
	{
		var d = new Date();
		var day = d.getDate();
		var month = d.getMonth() +1;
		var year = d.getFullYear();

		if(day <=9) day='0'+day;
		if(month <=9) month = '0' + month;

		//alert(day +"-"+month+"-"+year);
		$('#date').val(year+"-"+month+"-"+day);
		
	})
  </script>
</body>

</html>