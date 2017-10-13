<?php  
class Datafile extends AppModel { 

    var $name = 'Datafile'; 
    var $useTable = 'files';

    function findByPath ($path, $name) { 
        return $this->find("name = '$name' and path = '$path'"); 
    } 

} 
?>