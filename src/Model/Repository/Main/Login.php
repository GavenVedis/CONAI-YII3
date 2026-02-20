<?php
namespace App\Model\Repository\Main;

use App\ApplicationParams;
use App\User\IdentityRepository;
use App\Utility\MailUtility;
use Yiisoft\User\CurrentUser;
use Yiisoft\User\Login\Cookie\CookieLogin;

class Login
{
    public function __construct(
        private readonly UtentiDossier $utentiDossier,
        private readonly Utenti $utenti,
        private CurrentUser $currentUser,
        private IdentityRepository $identityRepository,
        private ApplicationParams $applicationParams,
        private MailUtility $mailUtility
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

    public function login(string $username, string $password)
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

    public function checkMailExistance2(string $mail)
    {
        $user = $this->utentiDossier->findByEmail($mail);
        return $user ? ["existance" => "OK", "username" => $user->username] : ["existance" => "NO_USER"];
    }

    public function sendUsername(string $mail, string $username)
    {
        $request_content = <<<HD
<h2>Gentilissimo consorziato,</h2>
<br />

Qui di seguito viene indicato il vostro username di accesso
<br/><br/>
        <b>Username: </b> $username<br/>
      <br/>
Ricordiamo che per qualsiasi informazione è possibile contattarci direttamente ai numeri 02.54044.242/256.
   <br/><br/>
        Cordiali Saluti
   <br/><br/>
Consorzio Nazionale Imballaggi - CONAI<br />
Via Pompeo Litta, 5 - 20122 Milano<br />
C.F. e P.IVA 05451271000<br />
R.I. ROMA - REA 888272

HD;
        if ($this->applicationParams->enableMail) {
            $this->mailUtility->sendMail([$mail], $request_content, 'CONAI Ecotoolbox - Recupero Username', "text/html");
        } else {
            echo json_encode(['status' => 'OK', 'message' => $request_content]);
        }
    }
}
