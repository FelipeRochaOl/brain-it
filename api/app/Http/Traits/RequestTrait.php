<?php

namespace App\Http\Traits;

use App\Http\Helper\RequestHelper;
use Illuminate\Http\Request;

trait RequestTrait
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $requestHelper = new RequestHelper($request);
            list($limit, $order, $where, $like) = $requestHelper->getFilterParams();
            list($orderField, $orderType) = $order;
            list($field, $search) = $like;
            $products = $this->model->orderBy($orderField, $orderType)
                ->where(function ($query) use ($field, $search) {
                    if ($field && $search) {
                        return $query->where($field, 'like', $search);
                    }
                    return $query;
                })
                ->where($where)
                ->paginate($limit);
            return $this->createResponse(true, $products);
        } catch (\Exception $error) {
            logger()->error($error->getMessage(), ['exception' => $error]);
            return $this->createResponse(false, [], [__('Whoops! Something went wrong.')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = $this->model->create($request->all());
            return $this->createResponse(true, $product);
        } catch (\Exception $error) {
            logger()->error($error->getMessage(), ['exception' => $error]);
            return $this->createResponse(false, [], [__('Whoops! Something went wrong.')]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = $this->model->findOrFail($id);
            return $this->createResponse(true, $product);
        } catch (\Exception $error) {
            logger()->error($error->getMessage(), ['exception' => $error]);
            return $this->createResponse(false, [], [__('Whoops! Something went wrong.')]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = $this->model->findOrFail($id);
            $product->update($request->all());
            return $this->createResponse(true, $product);
        } catch (\Exception $error) {
            logger()->error($error->getMessage(), ['exception' => $error]);
            return $this->createResponse(false, [], [__('Whoops! Something went wrong.')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = $this->model->findOrFail($id);
            $product->delete();
            return $this->createResponse(true, $product);
        } catch (\Exception $error) {
            logger()->error($error->getMessage(), ['exception' => $error]);
            return $this->createResponse(false, [], [__('Whoops! Something went wrong.')]);
        }
    }
}
