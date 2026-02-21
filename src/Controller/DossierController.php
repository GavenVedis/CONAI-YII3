<?php

namespace App\Controller;

use App\Model\Repository\Main\Aziende;
use App\Model\Repository\Main\Login;
use App\Utility\UtilityFaseTwo;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Safe\Exceptions\JsonException;
use Yiisoft\Aliases\Aliases;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class DossierController
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private Aliases $aliases,
        private CurrentUser $currentUser,
        private UtilityFaseTwo $utilityFaseTwo,
        private ResponseFactoryInterface $responseFactory,
        private Login $login,
        private Aziende $aziende
    ) {
    }

    public function index(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        if ($this->currentUser->isGuest()) {
            return $this->viewRenderer
                ->render($this->aliases->get('@view/Dossier/login'), []);
        }
        $link_utili = [];
        $link_utili[] = ['title' => 'Regolamento bando', 'url' => $this->aliases->get('@baseUrl/documents/Regolamento_2025.pdf')];

        $link_utili[] = [
            'title' => 'Istruzioni per l\'uso',
            'url' => $this->aliases->get('@baseUrl/documents/Conai_EcoTool_istruzioni_03.pdf')
        ];
        $link_utili[] = [
            'title' => 'Dichiarazione di verifica',
            'url' => 'https://www.conai.org/prevenzione-eco-design/pensare-futuro/bando-per-eco-design/conai_dichiarazione_verifica_bando_ecodesign_2023/'
        ];
        $link_utili[] = [
            'title' => 'Casi di successo',
            'url' => 'https://www.conai.org/prevenzione-eco-design/casi-di-successo-conai/'
        ];

        $link_utili[] = ['title' => 'Etichettatura ambientale', 'url' => 'https://www.etichetta-conai.com/'];
        $link_utili[] = ['title' => 'Contributo ambientale', 'url' => 'https://www.conai.org/imprese/contributo-ambientale/'];
        $link_utili[] = ['title' => 'Cos\'&egrave; imballaggio', 'url' => 'https://www.conai.org/imprese/cosa-e-imballaggio/'];
        $link_utili[] = ['title' => 'Cosa non &egrave; imballaggio', 'url' => 'https://www.conai.org/imprese/cosa-non-e-imballaggio/'];
        $link_utili[] = ['title' => 'Progettare riciclo', 'url' => 'https://www.progettarericiclo.com/'];
        return $this->viewRenderer
            ->render($this->aliases->get('@view/Dossier/index'), [
                'link_utili' => $link_utili
            ]);
    }

    public function register(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        return $this->viewRenderer
            ->render($this->aliases->get('@view/Dossier/register'), []);
    }

    /**
     * @throws JsonException
     */
    public function sendPassword(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getParsedBody();
        $mail = $params['mail'] ?? '';
        $response = $this->responseFactory->createResponse();
        if ($mail == '') {
            $return_array['result'] = 'INVALID';
            return $this->utilityFaseTwo->responseAsJson($response, $return_array);
        }
        $result = $this->login->checkMailExistance($mail);
        if ($result["existance"] == "OK") {
            $newPass = $this->utilityFaseTwo->generaPassword(8);

            $this->login->setNewPassword($result["username"], $newPass);
            $this->login->sendNewPassword($mail, $result["username"], $newPass);
        }
        return $this->utilityFaseTwo->responseAsJson($response, $result);
    }

    /**
     * @throws JsonException
     */
    public function sendUsername(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getParsedBody();
        $mail = $params['mail'] ?? '';
        $response = $this->responseFactory->createResponse();
        if ($mail == '') {
            $return_array['result'] = 'INVALID';
            return $this->utilityFaseTwo->responseAsJson($response, $return_array);
        }
        $result = $this->login->checkMailExistance($mail);
        if ($result["existance"] == "OK") {
            $this->login->sendUsername($mail, $result["username"]);
        }
        return $this->utilityFaseTwo->responseAsJson($response, $result);
    }
    /**
     * @throws JsonException
     */
    public function checkUserExistance(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getParsedBody();

        $username = $params['username'] ?? '';
        $password = $params['password'] ?? '';
        $cache_request = $params['cacheRequest'] ?? '';
        $register = $params["register"] ?? false;
        $return_array = [];
        $response = $this->responseFactory->createResponse();
        if ($username == '' || (!$register && $password == '')) {
            $return_array['result'] = 'INVALID';
            return $this->utilityFaseTwo->responseAsJson($response, $return_array);
        }
        $result = $this->login->checkUserExistance($username, $password);
        if ($result['status'] == 'OK') {
            if ($cache_request) {
                //$return_array['cache_generated'] = $this->utilityFaseTwo->getCacheLocalStorage($cache_request);
            }
            if (!$this->login->login($username, $password)) {
                return $this->utilityFaseTwo->responseAsJson($response, ['status' => 'KO', 'message' => "WRONG_PASS"]);
            }
        }
        $return_array['result'] = $result['message'];
        return $this->utilityFaseTwo->responseAsJson($response, $return_array);
    }

    public function checkRagioneSociale(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getParsedBody();

        $piva = $params['piva'] ?? '';
        $check_azienda = $params['check_azienda'] ?? false;
        $ragione_sociale = $params['ragione_sociale'] ?? '';
        $response = $this->responseFactory->createResponse();
        if ($piva) {
            $azienda = $this->aziende->findByPiva($piva);
            if ($azienda) {
                if ($check_azienda && $ragione_sociale) {
                    return $this->utilityFaseTwo->responseAsJson(
                        $response,
                        ['status' => $ragione_sociale == $azienda->ragione_sociale ? 'OK' : 'KO']
                    );
                }
            } else {
                if ($check_azienda) {
                    return $this->utilityFaseTwo->responseAsJson($response, ['status' => 'OK']);
                }
                return $this->utilityFaseTwo->responseAsJson($response, ['ragione_sociale' => '']);
            }
            return $this->utilityFaseTwo->responseAsJson($response, ['ragione_sociale' => $azienda->ragione_sociale]);
        }
        return $this->utilityFaseTwo->responseAsJson($response, ['ragione_sociale' => '']);
    }

    public function createAccount(ServerRequestInterface $request, LoggerInterface $logger): ResponseInterface
    {
        $params = $request->getParsedBody();
        var_dump($params);
        die();
    }
}
