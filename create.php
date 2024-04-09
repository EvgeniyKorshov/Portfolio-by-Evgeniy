<!-- Header -->
<?php  include "header.php" ?>
 <!-- body -->
<?php 
  if(isset($_POST['create'])) 
    {
        $user = $_POST['user'];
        $phone = $_POST['phone'];
        $department = $_POST['department'];
       
        // SQL query to insert user data into the users table
        $query= "INSERT INTO contacts(username, phone, department) VALUES('{$user}','{$phone}','{$department}')";
        $add_user = mysqli_query($conn,$query);
     
        // displaying proper message for the user to see whether the query executed perfectly or not 
          if (!$add_user) {
              echo "something went wrong ". mysqli_error($conn);
          }
 
          else { echo "<script type='text/javascript'>alert('Контакт успешно добавлен!')</script>";
              }         
    }
?>
 
<h1 class="text-center">Добавить новый контакт </h1>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label for="user" class="form-label">Имя</label>
        <input type="text" name="user"  class="form-control">
      </div>
 
      <div class="form-group">
        <label for="phone" class="form-label">Телефон</label>
        <input type="text" name="phone"  class="form-control">
      </div>
     
      <div class="form-group">
        <label for="department" class="form-label">Отдел</label>
        <input type="text" name="department"  class="form-control">
      </div>    
 
      <div class="form-group">
        <input type="submit"  name="create" class="btn btn-primary mt-2" value="Добавить">
      </div>
    </form> 
  </div>
 
   <!-- a BACK button to go to the home page -->
  <div class="container text-center mt-5">
    <a href="home.php" class="btn btn-warning mt-5"> Назад </a>
  <div>
 
<!-- Footer -->
<?php include "footer.php" ?>