<?php  
class Datafile extends AppModel { 

    var $name = 'Datafile'; 

    function findByPath ($path, $name) { 
        return $this->find("name = '$name' and path = '$path'"); 
    } 

} 
?>