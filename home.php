<!-- Header -->
<?php include "header.php"?>
<!-- body -->
  <div class="container">
    <h1 class="text-center" >Телефонный справочник</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Создайте новый контакт</a>
 
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th  scope="col">ID</th>
              <th  scope="col">Имя</th>
              <th  scope="col">Телефон</th>
              <th  scope="col">Отдел</th>
              <th  scope="col" colspan="3" class="text-center">CRUD-операции</th>
            </tr>  
          </thead>
            <tbody>
              <tr>
  
          <?php
            $query="SELECT * FROM contacts";               // SQL query to fetch all table data
            $view_users= mysqli_query($conn,$query);    // sending the query to the database
 
            //  displaying all the data retrieved from the database using while loop
            while($row= mysqli_fetch_assoc($view_users)){
              $id = $row['id'];                
              $user = $row['username'];        
              $phone = $row['phone'];         
              $department = $row['department'];        
 
              echo "<tr >";
              echo " <th scope='row' >{$id}</th>";
              echo " <td > {$user}</td>";
              echo " <td > {$phone}</td>";
              echo " <td >{$department} </td>";
 
              echo " <td class='text-center'> <a href='read.php?user_id={$id}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
 
              echo " <td class='text-center' > <a href='update.php?edit&user_id={$id}' class='btn btn-secondary'><i class='bi bi-pencil'></i> EDIT</a> </td>";
 
              echo " <td  class='text-center'>  <a href='delete.php?delete={$id}' class='btn btn-danger'> <i class='bi bi-trash'></i> DELETE</a> </td>";
              echo " </tr> ";
                  }  
                ?>
              </tr>  
            </tbody>
        </table>
  </div>
 
<!-- a BACK button to go to the index page -->
<div class="container text-center mt-5">
      <a href="index.php" class="btn btn-warning mt-5"> Назад </a>
    <div>
 
<!-- Footer -->
<?php include "footer.php" ?>