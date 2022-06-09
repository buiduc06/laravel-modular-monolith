<?php

declare(strict_types = 1);

namespace UI\Admin\Services\HttpRequest;

interface HttpRequestContract
{

    public function send(RequestDto $dto): array;
}
