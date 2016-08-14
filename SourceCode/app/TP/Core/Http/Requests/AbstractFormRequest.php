<?php

/**
 * Created by PhpStorm.
 * User: phamt
 * Date: 8/9/2016
 * Time: 10:51 PM
 */
namespace App\TP\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbstractFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}