<?php

declare(strict_types=1);

namespace App\Layout\Conai;

use Yiisoft\Assets\AssetBundle;

final class MainAsset extends AssetBundle
{
    public ?string $basePath = '@assets/conai';
    public ?string $baseUrl = '@assetsUrl/conai';
    public ?string $sourcePath = '@assetsSource/conai';

    public array $css = [
        'site.css',
    ];

}
