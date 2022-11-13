<?php

function dump_die($content)
{
  echo '<pre>';
  print_r($content);
  echo '</pre>';
  die;
}

function get_features($role_id)
{
  $service = \Config\Services::featureService();
  $features = $service->getFeatures($role_id);

  return $features;
}

