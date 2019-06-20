<?php 
	include('config/db_connect.php');
	// write query for all pizzas
	$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

	// make query and get result
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free result from memory
	mysqli_free_result($result);

	// close the connection
	mysqli_close($conn);
	explode(',', $pizzas[0]['ingredients']);
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php') ?>
	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php 
				 foreach ($pizzas as $pizza) { ?>
				 	<div class="col xl4 l5 m6 s12">
				 		<div class="card z-depth-3">
				 			<div class="card-image waves-effect waves-block waves-light">
      					<img style="max-height: 335px" class="activator" src="https://source.unsplash.com/random/300×300/?pizza">
    					</div>
				 			<div class="card-content center">
				 				<span class="card-title activator grey-text text-darken-4">
				 					<?php echo strtoupper(htmlspecialchars($pizza['title'])); ?>
				 					<i class="material-icons right">more_vert</i>
				 				</span>
				 			</div>
				 			<div class="card-reveal">
      					<span class="card-title grey-text text-darken-4">
      						<?php echo strtoupper(htmlspecialchars($pizza['title'])); ?>
      						<i class="material-icons right">close</i>
      					</span>
	      				<ul class="center collection">
					 					<?php foreach (explode(',', $pizza['ingredients']) as $ing) { ?>
					 						<li class="collection-item center"> <?php echo htmlspecialchars($ing); ?></li>
					 					<?php } ?>
					 			</ul>
					 			<img src="img/pizza.svg" class="center pizza">
   					 	</div>
				 			<div class="card-action">
				 				<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
				 				<a class="brand-text right" href="update.php?id=<?php echo $pizza['id']?>">change info</a>
				 			</div>
				 		</div>
				 	</div>
			<?php } ?>
		</div>
	</div>
	<?php include('templates/footer.php') ?>
</html>