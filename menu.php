<?php

	session_start();
	
	if (!isset($_SESSION['logged_id']))
	{
		header('Location: index.php');
		exit();
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
  
	<nav class="navbar navbar-expand-md  navbar-light py-2 mb-4" >
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
	
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1 class="text-center">Witamy w aplikacji <strong style="letter-spacing: 3px;">FINANSE</strong></h1>
					<p class="lead text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate, ipsum sed imperdiet feugiat, metus magna imperdiet ex, id facilisis eros nibh eu massa. Maecenas elementum nunc nec tristique laoreet. Donec ornare, nisi et ultricies convallis, massa lacus consequat neque, sed iaculis nisi est pulvinar risus. Suspendisse sed laoreet felis. Pellentesque id fringilla augue. Etiam a vulputate justo. Quisque tempor congue dolor, non vehicula nunc lacinia in. Sed feugiat justo ullamcorper tellus porttitor mollis. Nullam pharetra sem metus, id fringilla nisi luctus vitae. Nunc consectetur lobortis purus. Sed maximus arcu sit amet pretium bibendum.</p>
				</div>
				<div class="col-md-5">
					<img src="img/menu.jpg" class="img-fluid align-middle mt-2">
				</div>
			</div>
		</div>
	</main>
  
	
  <script
  src="http://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
  </script>
</body>

</html>