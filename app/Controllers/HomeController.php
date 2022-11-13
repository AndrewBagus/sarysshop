<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Home',
      'menu' => '/',
      'parent' => '',
    ];

    return view('home/index', $data);
  }
}
