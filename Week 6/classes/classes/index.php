<?php       


include 'database.class.php';
       
$db = new Database();  
$db->connect();

  
$db->select('mysqlcrud');  
$res = $db->getResult();  
print_r($res);      

// $db->insert('mysqlcrud',array(1,"Name 1","this@wasinsert.ed"));  
// $db->insert('mysqlcrud',array(2,"Name 2","this@wasinsert.ed"));   
// $db->insert('mysqlcrud',array(3,"Name 3","this@wasinsert.ed"));  
// $res = $db->getResult();  
// print_r($res); 


// $db->update('mysqlcrud',array('name'=>'Changed!'),array('id=1'));  
// $res = $db->getResult();  
// print_r($res);   


// $db->delete('mysqlcrud',"id=1");  
// $res = $db->getResult();  
// print_r($res);            


    
  
?>