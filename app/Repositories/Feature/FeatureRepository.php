<?php

namespace App\Repositories\Feature;

use App\Models\FeatureModel;

class FeatureRepository implements IFeatureRepository
{
  private $model;
  public function __construct()
  {
    $this->model = new FeatureModel();
  }

  public function getFeatureParents($role_id)
  {
    $subquery = '(select count(ta.id) from t_akses ta
          join m_feature mf on ta.feature_id = mf.id
          where ta.role_id = ' . $role_id . '
          and parent = m_feature.id) > 0';
    $features = $this->model
      ->join('t_akses a', 'm_feature.id = a.feature_id', 'left')
      ->where([
        'm_feature.is_active' => true,
        'm_feature.parent' => 'root',
      ])
      ->groupStart()
      ->where([
        $subquery =>  null
      ])
      ->orWhere([
        'a.role_id' =>  $role_id
      ])
      ->groupEnd()
      ->select('m_feature.id, m_feature.nama, m_feature.link, m_feature.icon')
      ->orderBy('m_feature.order')
      ->get()
      ->getResultArray();

    return $features;
  }

  public function getFeatureChilds($parent_id, $role_id)
  {
    return $this->model
      ->join('t_akses', 'm_feature.id = t_akses.feature_id')
      ->where(['m_feature.is_active' => true, 'm_feature.parent' => $parent_id, 't_akses.role_id' => $role_id])
      ->select('m_feature.id, m_feature.nama, m_feature.link, m_feature.icon, (select nama from m_feature where id=' . $parent_id . ') as parent')
      ->orderBy('m_feature.order')
      ->get()
      ->getResultArray();
  }
}
