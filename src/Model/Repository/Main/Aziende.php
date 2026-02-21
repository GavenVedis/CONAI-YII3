<?php
namespace App\Model\Repository\Main;

use App\Model\Entity\Main\AziendeDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Db\Query\Query;

class Aziende
{
    public function __construct(
        private readonly ConnectionInterface $db
    ) {}

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findById(int $id): ?AziendeDTO
    {
        $azienda = (new Query($this->db))
            ->from('aziende')
            ->where(['id' => $id])
            ->one();
        return $azienda ? AziendeDTO::fromRow($azienda) : null;
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findByPiva(string $piva): ?AziendeDTO
    {
        $azienda = (new Query($this->db))
            ->from('aziende')
            ->where(['piva' => $piva])
            ->one();
        return $azienda ? AziendeDTO::fromRow($azienda) : null;
    }

}
