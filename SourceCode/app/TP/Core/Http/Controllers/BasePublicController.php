<?php

/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:22 AM
 */
namespace App\TP\Core\Http\Controllers;

use Illuminate\Routing\Controller;

abstract class BasePublicController extends Controller
{
    protected $repository;

    public function __construct($repository = null)
    {
        $this->middleware('public');
        $this->repository = $repository;
    }
}
