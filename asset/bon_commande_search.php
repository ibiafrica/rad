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
    if(isset($_REQUEST['number'])){
        // create prepared statement
        $sql = "SELECT * FROM autotec_ibi_vente WHERE vente_bc_number LIKE :number";

        $stmt = $pdo->prepare($sql);
        $number = $_REQUEST['number'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':number', $number);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<p>" . $row['vente_bc_number'] . "</p>";
            }
        } else{
            echo "<p>No results found</p>";
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