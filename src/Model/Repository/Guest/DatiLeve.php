<?php
namespace App\Model\Repository\Guest;

use App\Model\Entity\Guest\DatiLeveDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Db\Query\Query;

class DatiLeve
{
    public function __construct(
        private ConnectionInterface $db
    ) {}

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findAll(): array
    {
        return (new Query($this->db))
            ->from('dati_leve')
            ->all();
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findById(int $id): ?DatiLeveDTO
    {
        $leva = (new Query($this->db))
            ->from('dati_leve')
            ->where(['id' => $id])
            ->one();

        return $leva ? DatiLeveDTO::fromRow($leva) : null;
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function findByIdentificativo(int|string $indice): ?DatiLeveDTO
    {
        $leva = (new Query($this->db))
            ->from('dati_leve')
            ->where(['identificativo' => $indice])
            ->one();

        return $leva ? DatiLeveDTO::fromRow($leva) : null;
    }
}
