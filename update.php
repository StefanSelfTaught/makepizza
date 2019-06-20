<?php 
 include('config/db_connect.php');
 $datamysql = date("Y-m-d H:i:s");
 $title = $email = $ingredients = '';
 $errors = array('email' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['update'])){
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br />';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'email must be a valid email address';
            }
        }

        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required <br />';
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Title must be letters and spaces only';
            }
        }

        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'At least one ingredient is required <br />';
        } else {
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'Ingredients must be a comma separated list';
            }
        }  
    }

    if(isset($_POST['update'])){
				$id_to_update = mysqli_escape_string($conn, $_POST['id_to_update']);

				$sql = "UPDATE pizzas 
								SET
								title = '$title', 
								email = '$email', 
								ingredients = '$ingredients',
								last_update = '$datamysql'
								WHERE id = $id_to_update";

				if(mysqli_query($conn, $sql)){
					header('Location: index.php');
				} else {
					echo "query error: " . mysqli_error($conn);
				}
		}

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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Pizza Info</title>
</head>
<body>
	<?php include 'templates/header.php'; ?>
	<div class="container center">
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
	</div>
	<section class="container grey-text">
        <h4 class="center">Update Info</h4>
        <form class="white" action="update.php" method="POST">
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="text" name="email" class="validate" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label for="email">Your Email</label>
          </div>
       </div>
       <div class="row">
        <div class="input-field col s12">
          <input id="text" type="text" class="validate" name="title" value="<?php echo htmlspecialchars($title) ?>">
          <div class="red-text"><?php echo $errors['title']; ?></div>
          <label for="text">Pizza Title</label>
        </div>
       </div>
       <div class="row">
        <div class="input-field col s12">
          <input id="text2" type="text" class="validate" name="ingredients" 
          value="<?php echo htmlspecialchars($ingredients) ?>">
          <div class="red-text"><?php echo $errors['ingredients']; ?></div>
          <label for="text2">Ingredients (comma separated)</label>
        </div>
       </div>
        <div class="center">
            <input type="hidden" name="id_to_update" value="<?php echo $pizza['id']; ?>">
            <input type="submit" value="update" class="btn brand z-depth-0" name="update">
        </div>
        </form>
    </section>
	<?php include 'templates/footer.php'; ?>
</html>