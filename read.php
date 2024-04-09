<!-- Header -->
<?php  include 'header.php'?>
 <!-- body -->
<h1 class="text-center">Информация о контакте</h1>
  <div class="container">
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th  scope="col" >ID</th>
          <th  scope="col">Имя</th>
          <th  scope="col">Телефон</th>
          <th  scope="col">Отдел</th>
        </tr>  
      </thead>
        <tbody>
          <tr>
                
            <?php
              //  first we check using 'isset() function if the variable is set or not'
              //Processing form data when form is submitted
              if (isset($_GET['user_id'])) {
                  $userid = $_GET['user_id']; 
 
                  // SQL query to fetch the data where id=$userid & storing data in view_user 
                  $query="SELECT * FROM contacts WHERE id = {$userid} ";  
                  $view_users= mysqli_query($conn,$query);            
 
                  while($row = mysqli_fetch_assoc($view_users))
                  {
                      $id = $row['id'];
                      $user = $row['username'];
                      $phone = $row['phone'];
                      $department = $row['department'];
 
                        echo "<tr >";
                        echo " <td >{$id}</td>";
                        echo " <td > {$user}</td>";
                        echo " <td > {$phone}</td>";
                        echo " <td >{$department} </td>"; 
                        echo " </tr> ";
                  }
                }
            ?>
          </tr>  
        </tbody>
    </table>
  </div>
 
   <!-- a BACK Button to go to pervious page -->
  <div class="container text-center mt-5">
    <a href="home.php" class="btn btn-warning mt-5"> Назад </a>
  <div>
 
<!-- Footer -->
<?php include "footer.php" ?>