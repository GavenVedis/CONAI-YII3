<?php
namespace App\Model\Repository\Main;

use App\User\IdentityRepository;
use Yiisoft\User\CurrentUser;
use Yiisoft\User\Login\Cookie\CookieLogin;

class Login
{
    public function __construct(
        private readonly UtentiDossier $utentiDossier,
        private readonly Utenti $utenti,
        private CurrentUser $currentUser,
        private IdentityRepository $identityRepository
    ) {}


    public function checkUserExistance(string $username, string $password): ?array
    {
        $user = $this->utentiDossier->findByUsername($username);
        $admin = $this->utenti->findByUsername($username);
        if ($user && $admin) {
            $encPass = md5($password);
            if ($admin["password"] != $encPass) {
                $result = ['status' => 'KO', 'message' => "WRONG_PASS"];
            } else {
                $result = ['status' => 'OK', 'message' => "OK", 'role' => $admin['tipo_utente']];
            }
            return $result;
        }
        if (!$user) {
            $result = ['status' => 'KO', 'message' => "NO_USER"];
        } else {
            $encPass = md5($password);
            if ($user["password"] != $encPass) {
                $result = ['status' => 'KO', 'message' => "WRONG_PASS"];
            } else {
                $result = ['status' => 'OK', 'message' => "OK", 'role' => 'USER'];
            }
        }

        return $result;
    }

    public function login(mixed $username, mixed $password)
    {
        $identity = $this->identityRepository->findByUsername($username);

        if ($identity === null){
            return false;
        }
        if (!$identity->validatePassword($password)) {
            return false;
        }

        return $this->currentUser->login($identity);
    }
}
