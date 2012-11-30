<?php

function getTypos($str) {
  
  $filetxt = "typos.txt";

  $array = file($filetxt, FILE_IGNORE_NEW_LINES);

  $words = explode(" ", $str);
  $results = array();

  foreach ($words as $word) {

    $find = preg_grep("/\,$word$/", $array);

    foreach ($find as $value) {
      $split = explode(",", $value);
      $sent = str_replace($word, $split[0], $str);
      array_push($results, $sent);      
    }

  }

  return $results;

}


if(sizeof($_POST)){
	$typosArr = getTypos($_POST['name']);
}

?>
<form name="form" method="post" action="">
  <p>
    <input name="name" type="text" id="name" value="<?= $_POST['name']; ?>">
    <input type="submit" name="Submit" value="Search">
  </p>
  <p>
        <textarea name="typos" cols="50" rows="20"><?php
            if (sizeof($_POST)){
                foreach ($typosArr as $typo){
                    echo $typo . "\n";
                }
            }
        ?>
        </textarea>
    </p>
</form>