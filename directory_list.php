<?php
  function dirToArray($dir) { 
     $ignore = array(".","..");
     $allow = array("mp3","mp4",);

     $result = array();
     $cdir = scandir($dir); 
     foreach ($cdir as $key => $value) 
     { 
        if (!in_array($value,$ignore)) 
        { 
           if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
           { 
              $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
           } 
           else 
           {
              if(in_array(substr(strrchr($value,'.'),1), $allow)){
                $result[] = $value;
              }
           } 
        } 
     } 
     return $result; 
  } 

  if(isset($_POST['dir'])){
    $files = dirToArray('assets/Music/'.$_POST['dir']);
    header('Content-Type: application/json');
    echo json_encode($files);
  }
  
?>