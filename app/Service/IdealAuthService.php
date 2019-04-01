<?php

namespace App\Services;

/**
 * Class IdealAuthService
 * @package App\Services
 */
class IdealAuthService
{
    /**
     * @var bool
     */
    public $token = false;

    /**
     * IdealAuthService constructor.
     * @param $request
     */
    public function __construct($request)
    {
        if ($request->header('authorization') && $request->header('authorization') === "Bearer " . openssl_encrypt('As meninas super poderosas', 'AES-256-OFB', md5("Macaco louco" . env('AUTH_TOKEN')), 0, env('AUTH_TOKEN'))) {
            $this->token = true;
        }
    }

    /**
     * @return bool
     */
    public function autorizaUser()
    {
        return $this->token;
    }

}