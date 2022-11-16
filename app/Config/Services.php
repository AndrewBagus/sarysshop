<?php

namespace Config;

use App\Services\Bank\BankService;
use App\Services\Bank\IBankService;
use App\Services\Feature\FeatureService;
use App\Services\Feature\IFeatureService;
use App\Services\JenisBank\IJenisBankService;
use App\Services\JenisBank\JenisBankService;
use App\Services\KategoriPelanggan\IKategoriPelangganService;
use App\Services\KategoriPelanggan\KategoriPelangganService;
use App\Services\KategoriProduk\IKategoriProdukService;
use App\Services\KategoriProduk\KategoriProdukService;
use App\Services\Kelurahan\IKelurahanService;
use App\Services\Kelurahan\KelurahanService;
use App\Services\Login\ILoginService;
use App\Services\Login\LoginService;
use App\Services\Pelanggan\IPelangganService;
use App\Services\Pelanggan\PelangganService;
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
  public static function kelurahanService($getShared = true): IKelurahanService
  {
    if ($getShared) {
      return static::getSharedInstance('kelurahanService');
    }

    return new KelurahanService;
  }

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

  public static function jenisBankService($getShared = true): IJenisBankService
  {
    if ($getShared) {
      return static::getSharedInstance('jenisBankService');
    }

    return new JenisBankService;
  }

  public static function kategoriProdukService($getShared = true): IKategoriProdukService
  {
    if ($getShared) {
      return static::getSharedInstance('kategoriProdukService');
    }

    return new KategoriProdukService;
  }

  public static function kategoriPelangganService($getShared = true): IKategoriPelangganService
  {
    if ($getShared) {
      return static::getSharedInstance('kategoriPelangganService');
    }

    return new KategoriPelangganService;
  }

  public static function bankService($getShared = true): IBankService
  {
    if ($getShared) {
      return static::getSharedInstance('bankService');
    }

    return new BankService;
  }

  public static function pelangganService($getShared = true): IPelangganService
  {
    if ($getShared) {
      return static::getSharedInstance('pelangganService');
    }

    return new PelangganService;
  }
}
