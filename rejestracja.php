<?php
	session_start();
	
	if (isset($_POST['email']))
	{
		$good=true;
		
		//Sprawdź poprawność imienia
		$name = $_POST['name'];
		if (ctype_alpha($name)==false)
		{
			$good=false;
			$_SESSION['e_name']="Imię może składać się tylko z liter (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$good=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		
		if ((strlen($password)<6) || (strlen($password)>15))
		{
			$good=false;
			$_SESSION['e_password']="Hasło musi posiadać od 6 do 15 znaków!";
		}
		
		if ($password!=$password2)
		{
			$good=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne!";
		}	

		$passwordo_hash = password_hash($password, PASSWORD_DEFAULT);		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $name;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $password;
		$_SESSION['fr_haslo2'] = $password2;
		
		
		
		require_once 'database.php';
		
		$emailQuery = $db->prepare('SELECT id, password FROM users WHERE email = :email');
		$emailQuery->bindValue(':email', $email, PDO::PARAM_STR);
		$emailQuery->execute();
		
	//	echo $emailQuery->rowCount();
		if($emailQuery->rowCount()>0)
		{
			$good = false;
			$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
		}
		
		if($good == true)
		{		
			$query = $db->prepare('INSERT INTO users VALUES (NULL, :name, :email, :password)');
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->bindValue(':name', $name, PDO::PARAM_STR);
			$query->bindValue(':password', $passwordo_hash , PDO::PARAM_STR);
			$query->execute();
			header('Location: index.php');
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
	<div class="logo py-2  text-center ">
		<h1><i class="fas fa-balance-scale"></i> Finanse</h1>
		<samll>Zadbaj o balans swoich przychodów i wydatków</small>
	</div>
  
  
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4  col-8 offset-2  text-center mt-5" id="logowanie">
				<h2 class="p-3">REJESTRACJA</h2>
				<form method="post">
			
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-user"></i></strong></span>
						</div>
						<input class="form-control" type="text" placeholder="Imię" name="name">
					</div>
					<?php
							if (isset($_SESSION['e_name']))
							{
								echo '<div class="error">'.$_SESSION['e_name'].'</div>';
								unset($_SESSION['e_name']);
							}
					?>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-at"></i></strong></span>
						</div>
						<input class="form-control" type="email" placeholder="Adres email" name="email">
					</div>
					<?php
							if (isset($_SESSION['e_email']))
							{
								echo '<div class="error">'.$_SESSION['e_email'].'</div>';
								unset($_SESSION['e_email']);
							}
					?>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-key"></i></strong></span>
						</div>
						<input class="form-control" type="password" placeholder="Hasło" name="password">
					</div>
					<?php
							if (isset($_SESSION['e_password']))
							{
								echo '<div class="error">'.$_SESSION['e_password'].'</div>';
								unset($_SESSION['e_password']);
							}
					?>
					
					<div class="input-group form-group">
						<div>
							<span class="input-group-text"><strong><i class="fas fa-key"></i></strong></span>
						</div>
						<input class="form-control" type="password" placeholder="Powtórz hasło" name="password2">
					</div>
				
					<div class="form-group">

						<button type="submit" value="Submit" class="btn btn-info">
							<i class="fas fa-user-plus"></i> Zarejestruj się 
						</button>
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