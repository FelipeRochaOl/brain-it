<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\RequestTrait;
use App\Models\Product;

class ProductController extends Controller
{
    use RequestTrait;

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
