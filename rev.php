<?php
  function test_rec($number)
  {
    echo $number.' , ';
    $number++;
    if($number <= 100)
    {
      test_rec($number);
    }
  }

  test_rec(1);
?>