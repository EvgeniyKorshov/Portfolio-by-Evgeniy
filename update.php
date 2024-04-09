<!-- Header -->
<?php include "header.php"?>
 <!-- body -->
<?php
   // checking if the variable is set or not and if set adding the set data value to variable userid
   if(isset($_GET['user_id']))
    {
      $userid = $_GET['user_id']; 
    }
      // SQL query to select all the data from the table where id = $userid
      $query="SELECT * FROM contacts WHERE id = $userid ";
      $view_users= mysqli_query($conn,$query);
 
      while($row = mysqli_fetch_assoc($view_users))
        {
          $id = $row['id'];
          $user = $row['username'];
          $phone = $row['phone'];
          $department = $row['department'];
        }
  
    //Processing form data when form is submitted
    if(isset($_POST['update'])) 
    {
      $user = $_POST['user'];
      $phone = $_POST['phone'];
      $department = $_POST['department'];
       
      // SQL query to update the data in user table where the id = $userid 
      $query = "UPDATE contacts SET username = '{$user}' , phone = '{$phone}' , department = '{$department}' WHERE id = $userid";
      $update_user = mysqli_query($conn, $query);
      echo "<script type='text/javascript'>alert('Контактные данные успешно обновлены!')</script>";
    }             
?>
 
<h1 class="text-center">Обновить сведения о контакте</h1>
  <div class="container ">
    <form action="" method="post">
      <div class="form-group">
        <label for="user" >Имя</label>
        <input type="text" name="user" class="form-control" value="<?php echo $user  ?>">
      </div>
 
      <div class="form-group">
        <label for="phone" >Телефон</label>
        <input type="text" name="phone"  class="form-control" value="<?php echo $phone  ?>">
      </div>
        
      <div class="form-group">
        <label for="department" >Отдел</label>
        <input type="text" name="department"  class="form-control" value="<?php echo $department  ?>">
      </div>    
 
      <div class="form-group">
         <input type="submit"  name="update" class="btn btn-primary mt-2" value="Обновить">
      </div>
    </form>    
  </div>
 
    <!-- a BACK button to go to the home page -->
    <div class="container text-center mt-5">
      <a href="home.php" class="btn btn-warning mt-5"> Назад </a>
    <div>
 
<!-- Footer -->
<?php include "footer.php" ?>