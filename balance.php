<?php
	session_start();

	if (!isset($_SESSION['logged_id']))
	{
		header('Location: index.php');
		exit();
	}
	$logged_id = $_SESSION['logged_id'];
	require_once 'database.php';
	
	
	if(isset($_POST["periodOfTime"]) && $_POST["periodOfTime"] == 2)
	{
		$month = date('m');
		$year = date('Y');
		
		$incomeQuery = $db->query("SELECT userId, amount, date, category FROM incomes WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' ");
		$incomes = $incomeQuery->fetchAll();

		$incomeCategoryQuery = $db->query("SELECT SUM(amount), category FROM incomes WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' GROUP BY category");
		$incomesCategory = $incomeCategoryQuery->fetchAll();
		
		$expenseQuery = $db->query("SELECT userId, amount, date, category FROM expenses WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' ");
		$expenses = $expenseQuery->fetchAll();

		$expenseCategoryQuery = $db->query("SELECT SUM(amount), category FROM expenses WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' GROUP BY category");
		$expensesCategory = $expenseCategoryQuery->fetchAll();
	}
	else if(isset($_POST["periodOfTime"]) && $_POST["periodOfTime"] == 3)
	{
		$month = date('m');
		$year = date('Y');
		
		if(--$month <=0)
		{
			$year--;
			$month=12;
		}
		
		$incomeQuery = $db->query("SELECT userId, amount, date, category FROM incomes WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' ");
		$incomes = $incomeQuery->fetchAll();

		$incomeCategoryQuery = $db->query("SELECT SUM(amount), category FROM incomes WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' GROUP BY category");
		$incomesCategory = $incomeCategoryQuery->fetchAll();
		
		$expenseQuery = $db->query("SELECT userId, amount, date, category FROM expenses WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' ");
		$expenses = $expenseQuery->fetchAll();

		$expenseCategoryQuery = $db->query("SELECT SUM(amount), category FROM expenses WHERE userId='$logged_id' && month(date)='$month' && year(date) = '$year' GROUP BY category");
		$expensesCategory = $expenseCategoryQuery->fetchAll();
	}
	else if(isset($_POST["periodOfTime"]) && $_POST["periodOfTime"] == 4)
	{
		$month = date('m');
		$year = date('Y');
		
		$incomeQuery = $db->query("SELECT userId, amount, date, category FROM incomes WHERE userId='$logged_id' && year(date) = '$year' ");
		$incomes = $incomeQuery->fetchAll();

		$incomeCategoryQuery = $db->query("SELECT SUM(amount), category FROM incomes WHERE userId='$logged_id' && year(date) = '$year' GROUP BY category");
		$incomesCategory = $incomeCategoryQuery->fetchAll();
		
		$expenseQuery = $db->query("SELECT userId, amount, date, category FROM expenses WHERE userId='$logged_id' && year(date) = '$year' ");
		$expenses = $expenseQuery->fetchAll();

		$expenseCategoryQuery = $db->query("SELECT SUM(amount), category FROM expenses WHERE userId='$logged_id' && year(date) = '$year' GROUP BY category");
		$expensesCategory = $expenseCategoryQuery->fetchAll();
	}
	
	if(isset($_POST['date1']))
	{
		
	//	$date1 = $_POST['date1'];
	//	$date2 = $_POST['date2'];
		
		$date1 = date('Y-m-d', strtotime($_POST['date1']));
		$date2 = date('Y-m-d', strtotime($_POST['date2']));
		
		
		if($date1 <= $date2)
		{
			$incomeQuery = $db->query("SELECT userId, amount, date, category FROM incomes WHERE userId='$logged_id' && date>='$date1' && date<='$date2' ");
			$incomes = $incomeQuery->fetchAll();

			$incomeCategoryQuery = $db->query("SELECT SUM(amount), category FROM incomes WHERE userId='$logged_id' && date>='$date1' && date<='$date2' GROUP BY category");
			$incomesCategory = $incomeCategoryQuery->fetchAll();
			
			$expenseQuery = $db->query("SELECT userId, amount, date, category FROM expenses WHERE userId='$logged_id' && date>='$date1' && date<='$date2' ");
			$expenses = $expenseQuery->fetchAll();

			$expenseCategoryQuery = $db->query("SELECT SUM(amount), category FROM expenses WHERE userId='$logged_id' && date>='$date1' && date<='$date2'  GROUP BY category");
			$expensesCategory = $expenseCategoryQuery->fetchAll();
			
		}
		else{
			$_SESSION['e_date']='<span style="color: red;">Pierwsza data nie powinna być późniejsza od drugiej daty</span>';
		}
	
	}
		

?>

<?php
 
	if(isset($_POST["periodOfTime"]))
	{
		$option = $_POST["periodOfTime"];
	}
	else if (isset($_SESSION['e_date']))
	{
		$option=5;
	}
	else{
		$option=1;
	}
//	(isset($_POST["periodOfTime"])) ? $option = $_POST["periodOfTime"] : $option=1;
 
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
  
  
	<div class="container mt-3">
		
		<div class="row">
			<div class="col-lg-3 offset-lg-7 col-md-4 offset-md-6 col-8 offset-2">
				<div class="input-group form-group">
					<div>
						<span class="input-group-text"><strong><i class="far fa-calendar-alt"></i></strong></span>
					</div>
					<form method="post">
						<select class="form-control" name="periodOfTime" id="selectDate" onchange="this.form.submit()">
							<option <?php if ($option == 1 ) echo 'selected' ; ?> value="1" disabled selected hidden>Okres czasu</option>
							<option <?php if ($option == 2 ) echo 'selected' ; ?> value="2">Bieżacy miesiac</option>
							<option <?php if ($option == 3 ) echo 'selected' ; ?> value="3">Poprzedni miesiąc</option>
							<option <?php if ($option == 4 ) echo 'selected' ; ?> value="4">Bieżacy rok</option>
							<option <?php if ($option == 5 ) echo 'selected' ; ?> value="5">Niestandardowy</option>
						</select>
					</form>
				</div>
			</div>
		</div>
		<?php
			//echo $_SESSION['e_date'];
		?>
		<!--MODAL -->
		<div class="modal" id="customDate">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<h5 class="modal-title">Wybierz zakres czasu</h5>
				<button class="close" data-dismiss="modal">&times;</button>
			  </div>
			  
			  <div class="modal-body">
				<form id="formModal" method="post">
				
				  <div class="form-group">
					<label for="date">Od</label>
					<input class="form-control" type="date" min="2000-01-01" name="date1" id="date">
				  </div>
				  <?php
							if (isset($_SESSION['e_date']))
							{
								echo '<div class="error">'.$_SESSION['e_date'].'</div>';
								unset($_SESSION['e_date']);
							}
					?>
				  <div class="form-group">
					<label for="date">Do</label>
					<input class="form-control" type="date" min="2000-01-01" name="date2" id="date2">
				  </div>
				  
				</form>
			  </div>
			  
			  <div class="modal-footer">
				<button type="submit" class="btn btn-primary" data-dismiss="modal" form="form" id="submitModal">Akceptuj</button>
			  </div>
			  
			</div>
		  </div>
		</div>
				
		<!-- BILANS-->
		<header class="text-center">
			<h1 class="display-4"><strong>BILANS</strong></h1>
		<header>
		
		<div class="row">
		<!-- Przychody i wydatki lda poszzegolnych kategorii -->
			<div id="incomes" class="col-lg-6">
				<h2 class="text-center py-2">Przychody <i class="fas fa-plus"></i></h2>
				<table class="table table-success table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Kwota</th>
							<th>Kategoria</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($option == 2 || $option == 3 || $option == 4 ||($option == 1 && isset($date1))){
								$number =1;
								foreach ($incomesCategory as $income) {
									echo
									"<tr>
										<th scope="."row".">{$number}</th>
										<td>{$income['SUM(amount)']}</td>
										<td>{$income['category']}</td>
									</tr>";
									$number++;
								}
							}
						?>
					</tbody>
				</table>
			</div>

			<div id="expenses" class="col-lg-6">
				<h2 class="text-center py-2">Wydatki <i class="fas fa-minus"></i></h2>
				<table class="table table-warning table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Kwota</th>
							<th>Kategoria</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($option == 2 || $option == 3 || $option == 4 ||($option == 1 && isset($date1)))
							{
								$number =1;
								foreach ($expensesCategory as $expense) {
									echo
									"<tr>
										<th scope="."row".">{$number}</th>
										<td>{$expense['SUM(amount)']}</td>
										<td>{$expense['category']}</td>
									</tr>";
									$number++;
								}
							}
						?>
					</tbody>
				</table>
			</div>

			<!-- Przychody i wydatki all info -->
			<div id="incomes" class="col-lg-6">
				<h2 class="text-center py-2">Przychody <i class="fas fa-plus"></i></h2>
				<table class="table table-success table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Data</th>
							<th>Kwota</th>
							<th>Kategoria</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($option == 2 || $option == 3 || $option == 4 ||($option == 1 && isset($date1)))
							{
								$number =1;
								foreach ($incomes as $income) {
									echo
									"<tr>
										<th scope="."row".">{$number}</th>
										<td>{$income['amount']}</td>
										<td>{$income['date']}</td>
										<td>{$income['category']}</td>
									</tr>";
									$number++;
								}
							}
						?>
					</tbody>
				</table>
			</div>

			<div id="expenses" class="col-lg-6">
				<h2 class="text-center py-2">Wydatki <i class="fas fa-minus"></i></h2>
				<table class="table table-warning table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Data</th>
							<th>Kwota</th>
							<th>Kategoria</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($option == 2 || $option == 3 || $option == 4 ||($option == 1 && isset($date1)))
							{
								$number =1;
								foreach ($expenses as $expense) {
									echo
									"<tr>
										<th scope="."row".">{$number}</th>
										<td>{$expense['amount']}</td>
										<td>{$expense['date']}</td>
										<td>{$expense['category']}</td>
									</tr>";
									$number++;
								}
							}
							
						?>
					</tbody>
				</table>
			</div>

		</div>
		
		<div class="mt-4">
			<h3>Bilans za wybrany okres: </h3>
			<p class="lead">Dobrze ci idzie z finansami - trzymaj tak dalej!</p>
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
	
	$(document).ready(function() {
		var selectedOption = $("#selectDate").children("option:selected").val();
		if(selectedOption == 5)
		{
			$modal = $('#customDate');
			$modal.modal('show');
		}
		if(selectedOption == "fail")
		{
			$modal = $('#customDate');
			$modal.modal('show');
		}
	});
	
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
		$('#date2').val(year+"-"+month+"-"+day);
		
	})
	
	$(document).ready(function() {
			$("#submitModal").click(function() {
				$("#formModal").submit();
			});
    });
	
  </script>
</body>

</html>