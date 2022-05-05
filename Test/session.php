<?php
$count = 2;
$filter = array(1, 2);
if ($count ==1) {
  echo "1";
} elseif (($count==1) and (!isset($filter))) {
  echo "2";
} else {
  echo "3";
}

 ?>
