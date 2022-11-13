<?php

namespace Config;

use App\Services\Feature\FeatureService;
use App\Services\Feature\IFeatureService;
use App\Services\Login\ILoginService;
use App\Services\Login\LoginService;
use App\Services\User\IUserService;
use App\Services\User\UserService;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
  public static function userService($getShared = true): IUserService
  {
    if ($getShared) {
      return static::getSharedInstance('userService');
    }

    return new UserService;
  }
  
  public static function loginService($getShared = true): ILoginService
  {
    if ($getShared) {
      return static::getSharedInstance('loginService');
    }

    return new LoginService;
  }

  public static function featureService($getShared = true): IFeatureService
  {
    if ($getShared) {
      return static::getSharedInstance('featureService');
    }

    return new FeatureService;
  }
}
