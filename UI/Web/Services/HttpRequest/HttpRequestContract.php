<?php

declare(strict_types = 1);

namespace UI\Web\Services\HttpRequest;

interface HttpRequestContract
{

    public function send(RequestDto $dto): array;
}
