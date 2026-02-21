<?php

namespace App\Utility;

use Safe\Exceptions\JsonException;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Http\Status;

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

    /**
     * @throws JsonException
     */
    public function responseAsJson($response, array $data) {
        $response->getBody()->write(
            \Safe\json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR)
        );
        return $response
            ->withStatus(Status::OK)
            ->withHeader('Content-Type', 'application/json');
    }

    public function generaPassword(int $pswLenght): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $newPass = '';

        do {
            $numBytes = ceil($pswLenght * 3 / 4);

            $randomBytes = openssl_random_pseudo_bytes($numBytes);

            $randomString = base64_encode($randomBytes);

            $randomString = preg_replace("/[\/=+]/", "", $randomString);
        } while (strlen($randomString) < $pswLenght);
        for ($i = 0; $i < $pswLenght; $i++) {
            $newPass .= $characters[ord($randomString[$i]) % $charactersLength];
        }
        return $newPass;
    }
}
