<?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "my_shop";
      
  
      try {
          $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
          // set the PDO error mode to exception
          $sql = "SELECT id, name, parent_id FROM categories";
  
          $q = $conn->query($sql);
          $q->setFetchMode(PDO::FETCH_ASSOC);
            
          } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage() . "\n";
          }  
        
if(isset($_POST['oldname']) && isset($_POST['newname'])){
    $oldname = $_POST['oldname'];
    $newname = $_POST['newname'];
        $query = "SELECT name FROM categories where name=:oldname";
        $statement = $conn ->prepare($query);
       
        $statement->bindValue(':oldname', $oldname);
       
        $statement ->execute();

        
        
    

    $sql = "UPDATE categories SET name='$newname' where name='$oldname'";
  

   

  $insertion = $conn->prepare($sql);
 
    $verification=$insertion->execute();
   
    if($verification){
    echo $oldname. " modified into " . $newname;
    }
}
?>