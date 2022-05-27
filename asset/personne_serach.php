<?php
/*connection code. Change the folowing credentials with yours.*/
try{
    $pdo = new PDO("mysql:host=localhost;dbname=ibiafric_auto2", "ibiafric_auto2", "ibiafric_auto2");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
// Attempt search query execution
try{
    if(isset($_REQUEST['nom'])){
        // create prepared statement
        $sql = "select * from autotec_ibi_clients  WHERE nom LIKE :nom ";
        $stmt = $pdo->prepare($sql);
        $nom = $_REQUEST['nom'] . '%';
        $chassis_nom = '%'.$_REQUEST['nom'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':nom', $nom);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<option>" . $row['nom'].''.$row['prenom']. "</option>";
            }
        } else{
            echo "<option>No results found</option>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>