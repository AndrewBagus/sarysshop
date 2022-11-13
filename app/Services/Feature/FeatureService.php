<?php

namespace App\Services\Feature;

use App\Repositories\Feature\FeatureRepository;

class FeatureService implements IFeatureService
{
  private $featureRepo;

  public function __construct()
  {
    $this->featureRepo = new FeatureRepository();
  }

  public function getFeatures($role_id)
  {
    $features = $this->featureRepo->getFeatureParents($role_id);
    foreach ($features as $i => $feature) {
      $child = $this->featureRepo->getFeatureChilds($feature['id'], $role_id);
      $features[$i]['child'] = $child;
    }
    return $features;
  }
}
