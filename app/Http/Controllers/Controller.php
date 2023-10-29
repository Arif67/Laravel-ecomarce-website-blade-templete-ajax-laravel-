<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Summary of Controller
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
