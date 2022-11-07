<?php
function search($array, $key, $value)
{
  $results = [];

  if (is_array($array)) {
    if (isset($array[$key]) && $array[$key] == $value) {
      $results[] = $array;
    }

    foreach ($array as $subarray) {
      $results = array_merge($results, search($subarray, $key, $value));
    }
  }

  return $results;
}
?>
<div class="card">
  <div class="card-header">
    <?= $status_name; ?>
  </div>
  <div id="panel_list" class="card-body collapse in">
    <div class="card-block card-dashboard">
      ---
    </div>
  </div>
  <div class="card-footer">
    ---
  </div>
</div>