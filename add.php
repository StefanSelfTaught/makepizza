<?php
    include('config/db_connect.php');

    $title = $email = $ingredients = '';
    $errors = array('email' => '', 'title' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){
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

        if(array_filter($errors)){
            // echo 'error in the form'
        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
            
            if(mysqli_query($conn, $sql)){
                // succses
                header('Location: index.php');
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        };
    }
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php') ?>
    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">
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
            <input type="submit" value="submit" class="btn brand z-depth-0" name="submit">
        </div>
        </form>
    </section>
    <?php include('templates/footer.php') ?>
</html>