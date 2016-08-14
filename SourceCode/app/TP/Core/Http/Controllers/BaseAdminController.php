<?php

/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:22 AM
 */
namespace App\TP\Core\Http\Controllers;
use App\Http\Controllers\Controller;

abstract class BaseAdminController extends Controller
{
    protected $repository;

    public function __construct($repository = null)
    {
        $this->middleware('admin');
        $this->repository = $repository;
    }

    /**
     * Sort list.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sort()
    {
        $this->repository->sort(Request::all());

        return response()->json([
            'error'   => false,
            'message' => trans('global.Items sorted'),
        ]);
    }

    /**
     * Redirect after a form is saved.
     *
     * @param $request
     * @param $model
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect($request, $model)
    {
        $redirectUrl = $request->get('exit') ? $model->indexUrl() : $model->editUrl();

        return redirect($redirectUrl);
    }
}