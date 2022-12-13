<?php


// Define the function
function generateString($stringLength = 60) 
{

  // Generate the string
  $string = substr(
    str_shuffle(str_repeat(
        $x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 
        ceil($stringLength/strlen($x)) )),
        1,
        $stringLength
    );

  // Return the string
  return $string;
}
