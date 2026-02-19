<?php

namespace App\Utility;

use Yiisoft\Aliases\Aliases;

class UtilityFaseTwo
{
    function __construct(
        private Aliases $aliases
    ){}

    public function generaUrlHTML ($absolute_url, $type = 'js', $defer = false) {
        $last_modified = stat($this->aliases->get('@public') . $absolute_url);
        $src_url_with_ts = $absolute_url . "?v=" . $last_modified['mtime'];
        switch ($type) {
            case 'js':
                if ($defer) {
                    return "<script src=\"$src_url_with_ts\" defer='true'></script>";
                }
                return "<script src=\"$src_url_with_ts\"></script>";
            case 'url':
                return $src_url_with_ts;
            case 'css':
                return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$src_url_with_ts\"/>";
        }

    }

    public function getBase64FromImage(string $img)
    {
        $path = $this->aliases->get('@public' . $img);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
