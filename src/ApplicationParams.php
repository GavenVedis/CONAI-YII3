<?php

declare(strict_types=1);

namespace App;


final readonly class ApplicationParams
{
    public function __construct(
        public string $name = 'My Project',
        public string $charset = 'UTF-8',
        public string $locale = 'en',
        public bool $nuova_homepage = true,
        public bool $chatbot = false
    ) {}
}
