<?php
  class Database{
 	private $hostdb ="localhost";
 	private $userdb ="root";
 	private $passdb ="";
 	private $namedb ="softdev3";
 	public  $pdo;

 	public function __construct(){
       if (!isset($this->pdo)) {
       	  try {

       	  	  $link = new PDO("mysql:host=".$this->hostdb .";dbname=".$this->namedb,$this->userdb,$this->passdb);
              $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       	  	  $link->exec("SET CHARACTER SET utf8");
       	  	  $this->pdo = $link;

       	  } catch (PDOException $e) {

       	  	die("Failed to connect database".$e->getMessage());
       	  }
       }
 	  }


     //Select or Read Data.
    
      public function select($query){
          $result = $this->pdo->query($query) or die($this->pdo->error.__LINE__);
          if($result->rowCount() > 0){
            return $result;
          } else {
            return false;
          }
        }
      
      //Insert Data
      public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($insert_row){
           header("Location: index.php?msg=".urlencode('Data inserted successfully'));
           exit();
        }else{
          die("Error:(".$this->link-errno.")".$this->link-error);
        }
      }
      
      //Update data
      public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row){
           header("Location: index.php?msg=".urlencode('Data updated successfully'));
           exit();
        }else{
          die("Error:(".$this->link-errno.")".$this->link-error);
        }
      }

      //Delete data
      public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){
           header("Location: index.php?msg=".urlencode('Data deleted successfully'));
           exit();
        }else{
          die("Error:(".$this->link-errno.")".$this->link-error);
        }
      }

     }
?>