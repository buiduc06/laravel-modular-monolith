<?php

declare(strict_types = 1);

namespace UI\Web\Services\HttpRequest;

class LaravelRequestImpl implements HttpRequestContract
{

    public function send(RequestDto $dto)
    : array{
        $request  = \Request::create(...$dto->toArray());
        $response = \Route::dispatch($request);

        return json_decode($response->getContent(), true);
    }
}
