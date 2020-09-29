<?php

declare(strict_types=1);

namespace App;

interface RequestInterface
{
    public function getOptions(): array;
    public function getUrl(): string;
    public function getMethod(): string;
}