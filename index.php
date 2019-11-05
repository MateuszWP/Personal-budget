<?php
	session_start();
	
	if (isset($_SESSION['logged_id']))
	{
		header('Location: menu.php');
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
  
  
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4  col-8 offset-2  text-center mt-5" id="logowanie">
				<h2 class="p-3">LOGOWANIE</h2>
				
				<form action="logging.php" method="post">
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-at"></i></strong></span>
						</div>
						<input class="form-control" type="text" placeholder="Adres email" name="email">
					</div>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-key"></i></strong></span>
						</div>
						<input class="form-control" type="password" placeholder="Hasło" name="password">
					</div>
					<?php
							if (isset($_SESSION['error']))
							{
								echo '<div class="error">'.$_SESSION['error'].'</div>';
								unset($_SESSION['error']);
							}
					?>
					
					<div class="form-group">
						<button type="submit" value="Submit" class="btn btn-success" >
							<i class="fas fa-sign-in-alt"></i> Zaloguj się 
						</button>
					</div>
					
					<div class="form-group">
						<small class="form-text text-muted">Nie masz jeszcze konta? </small>
						
						<a class="btn btn-info" href="rejestracja.php"><i class="fas fa-user-plus"></i> Zarejestruj się</a>
					
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
  </script>
</body>

</html>