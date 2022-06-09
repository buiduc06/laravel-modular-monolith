<?php

declare(strict_types = 1);

namespace UI\Web\Http\Controllers;

use App\Http\Controllers\Controller;
use Laracon\Inventory\Domain\Models\Product;
use UI\Web\Http\Requests\StoreProductRequest;
use UI\Web\Http\Requests\UpdateProductRequest;
use UI\Web\Services\HttpRequest\HttpRequestContract;
use UI\Web\Services\HttpRequest\RequestDto;

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

        return view('web::products.index', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laracon\Inventory\Domain\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dto      = new RequestDto(
            uri: "/inventory-module/products",
            parameters: [ 'id' => $id ]
        );

        $data     = $this->httpRequestContract->send($dto);
        $products = $data['data'] ?? [];

        return view('web::products.show', ['products' => $products]);
    }
}

