<?php

namespace App\Http\Controllers;

use App\Traits\HasPermission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    // wajib menggunakan ketiga fungsionalitas ini
    use AuthorizesRequests, ValidatesRequests, HasPermission;
}

