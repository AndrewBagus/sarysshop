<?php

namespace App\Repositories\Feature;

interface IFeatureRepository
{
  public function getFeatureParents($role_id);
  public function getFeatureChilds($parent_id, $role_id);
}
