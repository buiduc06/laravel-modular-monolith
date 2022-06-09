<?php

declare(strict_types = 1);

namespace UI\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Laracon\Inventory\Domain\Models\Product;
use UI\Admin\Http\Requests\StoreProductRequest;
use UI\Admin\Http\Requests\UpdateProductRequest;
use UI\Admin\Services\HttpRequest\HttpRequestContract;
use UI\Admin\Services\HttpRequest\RequestDto;

class ProductController extends Controller
{

    private HttpRequestContract $httpRequestContract;

    public function __construct(HttpRequestContract $httpRequestContract)
    {
        $this->httpRequestContract = $httpRequestContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dto      = new RequestDto('/inventory-module/products');
        $data     = $this->httpRequestContract->send($dto);
        $products = $data['data'] ?? [];

        return view('admin::products.index', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \UI\Admin\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laracon\Inventory\Domain\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \UI\Admin\Http\Requests\UpdateProductRequest  $request
     * @param  \Laracon\Inventory\Domain\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Laracon\Inventory\Domain\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

