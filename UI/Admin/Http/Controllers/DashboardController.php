<?php

declare(strict_types = 1);

namespace UI\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use UI\Admin\Services\HttpRequest\HttpRequestContract;

class DashboardController extends Controller
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
        return view('admin::dashboard');
    }
}

