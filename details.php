<?php 
	include('config/db_connect.php');

	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo "query error: " . mysqli_error($conn);
		}
	}

	// check GET request id param
	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		$sql = "SELECT * FROM pizzas WHERE id = $id";

		// get query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$pizza = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}
 ?>
 <!DOCTYPE html>
 <html>
	<?php include('templates/header.php') ?>
	<div class="container center">
		<?php if($pizza): ?>
			<table class="centered responsive-table" >
        <thead>
          <tr>
              <th>Pizza Name</th>
              <th>Created By</th>
              <th>Created At</th>
              <th>Last Update</th>
              <th>Ingredients</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo htmlspecialchars($pizza['title']); ?></td>
            <td><?php echo htmlspecialchars($pizza['email']) ?></td>
            <td><?php echo date($pizza['created_at']); ?></td>
            <td><?php echo date($pizza['last_update']); ?></td>
            <td><?php echo htmlspecialchars($pizza['ingredients']); ?></td>
          </tr>
        </tbody>
      </table>
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-1">
			</form>
		<?php else: ?>
			<h5>No such pizza exists!</h5>
		<?php endif; ?>	
	</div>

	<?php include('templates/footer.php') ?>
 </html>