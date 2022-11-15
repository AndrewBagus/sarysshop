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

function datatableQuery($query, $search, $column_search, $column_order, $order, $order_by)
{
  foreach ($column_search as $i => $item) // looping awal
  {
    if ($search['value']) // jika datatable mengirimkan pencarian dengan metode POST
    {

      if ($i === 0) // looping awal
      {
        $query = $query->groupStart();
        $query = $query->like($item, $search['value']);
      } else {
        $query = $query->orLike($item, $search['value']);
      }

      if (count($column_search) - 1 == $i) {
        $query = $query->groupEnd();
      }
    }
    $i++;
  }

  if (isset($order)) {
    $query = $query->orderBy($column_order[$order['0']['column']], $order['0']['dir']);
  } else if (isset($order_by)) {
    $query->order = $order_by;
    $query = $query->orderBy(key($order), $order[key($order)]);
  }

  return $query;
}
