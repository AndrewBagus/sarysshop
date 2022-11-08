<?php

function dumpDie($content)
{
  echo '<pre>';
  print_r($content);
  echo '</pre>';
  die;
}
