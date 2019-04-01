<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

/**
 * Class AclService
 * @package App\Services
 */
class AclService
{
    /**
     * @var
     * return bolean
     */
    public $acl;

    /**
     * AclService constructor.
     * @param $request
     */
    public function __construct($request)
    {
        if (!Auth::guard('admin')->check()) {
            $this->acl = false;
            return;
        }
        if ($user = Auth::guard('admin')->user()) {
            $this->acl = $user->hasPermissao($request->route()->getName());
        }
    }

    /**
     * @return mixed
     */
    public function getPemissao()
    {
        return $this->acl;
    }
}