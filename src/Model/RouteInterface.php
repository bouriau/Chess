<?php

declare(strict_types=1);

namespace Chess\Model;

interface RouteInterface
{
    public function match($url): bool;

    public function call();

    public function with($param, $regex): static;

    public function getUrl($params): array|string;
}