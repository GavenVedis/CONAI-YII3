<?php
namespace App\Model\Repository\Guest;

use App\Model\Entity\Guest\StatisticheGuestDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Exception\Exception;
use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Db\Query\Query;

class StatisticheGuest
{
    public function __construct(
        private ConnectionInterface $db
    ) {}

    public function findAll(): array
    {
        return (new Query($this->db))
            ->from('statistiche')
            ->all();
    }

    public function findById(int $id): ?StatisticheGuestDTO
    {
        $statistica = (new Query($this->db))
            ->from('statistiche')
            ->where(['id' => $id])
            ->one();

        return $statistica ? StatisticheGuestDTO::fromRow($statistica) : null;
    }

    /**
     * @throws InvalidConfigException
     * @throws \Throwable
     * @throws Exception
     */
    public function getLast(array &$anni)
    {
        $return = null;
        $benefici = [];
        $statistiche = (new Query($this->db))
            ->from('statistiche')
            ->orderBy('anno DESC')
            ->all();
        foreach ($statistiche as $statistica) {
            if (!in_array($statistica['anno'], $anni)){
                $anni[] = $statistica['anno'];
            }
            if (!$return) {
                $return = StatisticheGuestDTO::fromRow($statistica);
                $benefici = [
                    [
                        'label' => 'CO<sub>2</sub>',
                        'altImage' => 'CO2',
                        'id' => 0,
                        'value' => [
                            'prima' => [
                                'class' => 'before-value-co2',
                                'value' => $return->co2_prima
                            ],
                            'dopo' => [
                                'class' => 'after-value-co2',
                                'value' => $return->co2_dopo
                            ]
                        ],
                        'img' => '@baseUrl/img/icon-co2.jpg'
                    ],
                    [
                        'label' => 'Energia',
                        'altImage' => 'Energia',
                        'id' => 1,
                        'value' => [
                            'prima' => [
                                'class' => 'before-value-ger',
                                'value' => $return->ger_prima
                            ],
                            'dopo' => [
                                'class' => 'after-value-ger',
                                'value' => $return->ger_dopo
                            ]
                        ],
                        'img' => '@baseUrl/img/icon-energia.jpg'
                    ],
                    [
                        'label' => 'H<sub>2</sub>O',
                        'altImage' => 'H2O',
                        'id' => 2,
                        'value' => [
                            'prima' => [
                                'class' => 'before-value-h2o',
                                'value' => $return->h2o_prima
                            ],
                            'dopo' => [
                                'class' => 'after-value-h2o',
                                'value' => $return->h2o_dopo
                            ]
                        ],
                        'img' => '@baseUrl/img/icon-h2o.jpg'
                    ]
                ];
            }
        }
        return [$return, $benefici];
    }

    public function findByAnno(string $anno): ?StatisticheGuestDTO
    {
        $statistica = (new Query($this->db))
            ->from('statistiche')
            ->where(['anno' => $anno])
            ->one();

        return $statistica ? StatisticheGuestDTO::fromRow($statistica) : null;
    }

}
