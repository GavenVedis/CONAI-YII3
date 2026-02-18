<?php
namespace App\Model\Repository;

use App\Model\Entity\CasiSuccessoDTO;
use App\Model\Entity\UtentiDossierDTO;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

class CasiSuccesso
{
    public function __construct(
        private ConnectionInterface $db,
        private DatiLeve $datiLeve
    ) {}

    public function getPages(
        mixed $categoria,
        mixed $anno_bando,
        mixed $azienda,
        mixed $materiale,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $casi_successo = (new Query($this->db))
            ->from('casi_successo');
        $conditions = false;
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $casi_successo->where(['IN', 'id', implode(",", $ids_brand)]);
        } else {
            if ($categoria != '') {
                $casi_successo->where(['categoria' => $categoria]);
                $conditions = true;
            }
            if ($anno_bando != '') {
                if (!$conditions) {
                    $casi_successo->where(['anno' => $anno_bando]);
                    $conditions = true;
                } else {
                    $casi_successo->andWhere(['anno' => $anno_bando]);
                }
            }
            if ($azienda != '') {
                if (!$conditions) {
                    $casi_successo->where(['azienda' => $azienda]);
                    $conditions = true;
                } else {
                    $casi_successo->andWhere(['azienda' => $azienda]);
                }
            }
            if ($materiale != '') {
                if (!$conditions) {
                    $casi_successo->where(['LIKE', 'materiale', $materiale]);
                    $conditions = true;
                } else {
                    $casi_successo->andWhere(['LIKE', 'materiale', $materiale]);
                }
            }
            if ($leve != '') {
                if (!$conditions) {
                    $casi_successo->where(['LIKE', 'leve', $leve]);
                } else {
                    $casi_successo->andWhere(['LIKE', 'leve', $leve]);
                }
            }
        }
        return array_map(fn($caso_successo) => CasiSuccessoDTO::fromRow($caso_successo), $casi_successo->all());
    }

    public function getCategorie(
        mixed $categoria,
        mixed $anno_bando,
        mixed $azienda,
        mixed $materiale,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['categoria', 'count(*) as num_categorie'])
            ->from('casi_successo')
            ->groupBy('categoria')
            ->all();
        ;

        $categorie = [];
        foreach ($results as $result) {
            $categorie[$result['categoria']] = [
                'label' => $result['categoria'] . ' (' . $this->getNumeroCategoria($anno_bando, $azienda, $materiale, $leve, $result['categoria'], $brand_prodotto) . ')',
                'selected' => $categoria != '' && $result['categoria'] == $categoria
            ];
        }
        return $categorie;
    }

    public function getAnniBando(
        mixed $anno_bando,
        mixed $categoria,
        mixed $azienda,
        mixed $materiale,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['anno', 'count(*) as num_anni'])
            ->from('casi_successo')
            ->groupBy('anno')
            ->orderBy('anno ASC')
            ->all();
        ;
        $anni = [];
        foreach ($results as $result) {
            $anni[$result['anno']] = [
                'label' => $result['anno'] . ' (' . $this->getNumeroAnni($categoria, $azienda, $materiale, $leve, $result['anno'], $brand_prodotto) . ')',
                'selected' => $anno_bando != '' && $result['anno'] == $anno_bando
            ];
        }

        return $anni;
    }

    public function getAziende(
        mixed $azienda,
        mixed $anno_bando,
        mixed $categoria,
        mixed $materiale,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['azienda', 'count(*) as num_azienda'])
            ->from('casi_successo')
            ->groupBy('azienda')
            ->orderBy('azienda ASC')
            ->all();
        ;

        $aziende = [];
        foreach ($results as $result) {
            $azienda_formatted = addslashes($result['azienda']);
            $aziende[$azienda_formatted] = [
                'label' => $azienda_formatted . ' (' . $this->getNumeroAziende($categoria, $anno_bando, $materiale, $leve, $azienda_formatted, $brand_prodotto) . ')',
                'selected' => $azienda != '' && $azienda_formatted == $azienda
            ];
        }

        return $aziende;
    }

    public function getNomiProdotto(
        mixed $azienda,
        mixed $anno_bando,
        mixed $categoria,
        mixed $materiale,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['nome_prodotto', 'leve'])
            ->distinct()
            ->from('casi_successo')
            ->where(['LIKE', 'categoria', $categoria])
            ->andWhere(['LIKE', 'anno', $anno_bando])
            ->andWhere(['LIKE', 'azienda', $azienda])
            ->andWhere(['LIKE', 'materiale', $materiale])
            ->orderBy('nome_prodotto ASC')
            ->all()
        ;
        $prodotti = array();

        foreach ($results as $result) {
            $leve_inner =  explode(",", $result['leve']);
            if (in_array($leve, $leve_inner) || $leve == '') {
                $nome_prodotto = trim($result['nome_prodotto']);
                if (!isset($prodotti[$nome_prodotto])) {
                    $prodotti[$nome_prodotto] = ['label' => $nome_prodotto, 'selected' => $nome_prodotto == $brand_prodotto];
                }
            }
        }
        return $prodotti;
    }

    public function getMateriali(
        mixed $materiale,
        mixed $anno_bando,
        mixed $azienda,
        mixed $categoria,
        mixed $leve,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['materiale'])
            ->from('casi_successo')
            ->orderBy('materiale ASC')
            ->all()
        ;
        $materiali = [];
        foreach ($results as $result) {
            $sub_materiale = explode(",", $result['materiale']);
            foreach ($sub_materiale as $in_materiale) {
                $search_materiale = trim($in_materiale);
                if (!isset($materiali[$search_materiale])) {
                    $materiali[$search_materiale] = [
                        'label' => $search_materiale,
                        'selected' => $materiale != '' && $search_materiale == $materiale,
                        'num' => $this->getNumeroMateriale($categoria, $anno_bando, $azienda, $leve, $search_materiale, $brand_prodotto)
                    ];
                }
            }
        }
        return $materiali;
    }

    public function getLeve(
        mixed $leva,
        mixed $anno_bando,
        mixed $azienda,
        mixed $materiale,
        mixed $categoria,
        mixed $brand_prodotto
    ) {
        $results = (new Query($this->db))
            ->select(['leve'])
            ->from('casi_successo')
            ->groupBy('leve')
            ->all()
        ;
        $leve = [];
        foreach ($results as $result) {
            $sub_level = explode(",", $result['leve']);
            foreach ($sub_level as $in_leva) {
                $leva_search = trim(str_replace("x2", "", trim($in_leva)));
                if ($leva_search) {
                    $search_leva = $this->datiLeve->findById($leva_search);
                    if ($search_leva) {
                        if (!isset($leve[$leva_search])) {
                            $leve[$leva_search] = [
                                'label' => $search_leva['descrizione'],
                                'selected' => $leva != '' && $leva_search == $leva,
                                'num' => $this->getNumeroLeve($categoria, $anno_bando, $azienda, $materiale, $leva_search, $brand_prodotto)
                            ];
                        }
                    }
                }
            }
        }
        return $leve;
    }

    private function getIdByBrand(mixed $brand_prodotto)
    {
        $id_return = [];
        if (trim($brand_prodotto) != '') {
            $results = (new Query($this->db))
                ->from('casi_successo')
                ->where(['nome_prodotto' => trim($brand_prodotto)])
                ->all();
            foreach($results as $result) {
                $id_return[] = $result['id'];
            }
        }
        return array_unique($id_return);
    }

    private function getNumeroCategoria(
        mixed $anno_bando,
        mixed $azienda,
        mixed $materiale,
        mixed $leve,
        $ricerca,
        mixed $brand_prodotto
    ) {
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $sub_results = (new Query($this->db))
                ->select(['categoria', 'leve'])
                ->from('casi_successo')
                ->where(['IN', 'id', implode(",", $ids_brand)])
                ->all();
        } else {
            $sub_results = (new Query($this->db))
                ->select(['categoria', 'leve'])
                ->from('casi_successo')
                ->where(['categoria' => $ricerca])
                ->andWhere(['LIKE', 'anno', $anno_bando])
                ->andWhere(['LIKE', 'azienda', $azienda])
                ->andWhere(['LIKE', 'materiale', $materiale])
                ->andWhere(['LIKE', 'nome_prodotto', $brand_prodotto])
                ->all();
        }
        $totale = 0;
        if ($brand_prodotto != '') {
            foreach ($sub_results as $result) {
                if ($ricerca == $result['categoria']) {
                    if ($leve != '') {
                        $leve_inner =  explode(",", $result['leve']);
                        if (in_array($leve, $leve_inner)) {
                            $totale++;
                        }
                    } else {
                        $totale++;
                    }
                }
            }
        } else {
            foreach ($sub_results as $result) {
                if ($leve != '') {
                    $leve_inner =  explode(",", $result['leve']);
                    if (in_array($leve, $leve_inner)) {
                        $totale++;
                    }
                } else {
                    $totale++;
                }
            }
        }
        return $totale;
    }

    private function getNumeroAnni(
        mixed $categoria,
        mixed $azienda,
        mixed $materiale,
        mixed $leve,
        $ricerca,
        mixed $brand_prodotto
    ) {
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $sub_results = (new Query($this->db))
                ->select(['anno', 'leve'])
                ->from('casi_successo')
                ->where(['IN', 'id', implode(",", $ids_brand)])
                ->all();
        } else {
            $sub_results = (new Query($this->db))
                ->select(['anno', 'leve'])
                ->from('casi_successo')
                ->where(['LIKE', 'categoria', $categoria])
                ->andWhere(['anno' => $ricerca])
                ->andWhere(['LIKE', 'azienda', $azienda])
                ->andWhere(['LIKE', 'materiale', $materiale])
                ->andWhere(['LIKE', 'nome_prodotto', $brand_prodotto])
                ->all();
        }

        $totale = 0;
        if ($brand_prodotto != '') {
            foreach ($sub_results as $result) {
                if ($ricerca == $result['anno']) {
                    if ($leve != '') {
                        $leve_inner =  explode(",", $result['leve']);
                        if (in_array($leve, $leve_inner)) {
                            $totale++;
                        }
                    } else {
                        $totale++;
                    }
                }
            }
        } else {
            foreach ($sub_results as $result) {
                if ($leve != '') {
                    $leve_inner =  explode(",", $result['leve']);
                    if (in_array($leve, $leve_inner)) {
                        $totale++;
                    }
                } else {
                    $totale++;
                }
            }
        }
        return $totale;
    }

    private function getNumeroAziende(
        mixed $categoria,
        mixed $anno_bando,
        mixed $materiale,
        mixed $leve,
        string $ricerca,
        mixed $brand_prodotto
    ) {
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $sub_results = (new Query($this->db))
                ->select(['azienda', 'leve'])
                ->from('casi_successo')
                ->where(['IN', 'id', implode(",", $ids_brand)])
                ->all();
        } else {
            $sub_results = (new Query($this->db))
                ->select(['azienda', 'leve'])
                ->from('casi_successo')
                ->where(['LIKE', 'categoria', $categoria])
                ->andWhere(['LIKE', 'anno', $anno_bando])
                ->andWhere(['azienda' => $ricerca])
                ->andWhere(['LIKE', 'materiale', $materiale])
                ->andWhere(['LIKE', 'nome_prodotto', $brand_prodotto])
                ->all();
        }

        $totale = 0;
        if ($brand_prodotto != '') {
            foreach ($sub_results as $result) {
                if ($result['azienda'] == $ricerca) {
                    if ($leve != '') {
                        $leve_inner =  explode(",", $result['leve']);
                        if (in_array($leve, $leve_inner)) {
                            $totale++;
                        }
                    } else {
                        $totale++;
                    }
                }
            }
        } else {
            foreach ($sub_results as $result) {
                if ($leve != '') {
                    $leve_inner =  explode(",", $result['leve']);
                    if (in_array($leve, $leve_inner)) {
                        $totale++;
                    }
                } else {
                    $totale++;
                }
            }
        }

        return $totale;
    }

    private function getNumeroMateriale(
        mixed $categoria,
        mixed $anno_bando,
        mixed $azienda,
        mixed $leve,
        string $ricerca,
        mixed $brand_prodotto
    ) {
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $sub_results = (new Query($this->db))
                ->select(['materiale', 'leve'])
                ->from('casi_successo')
                ->where(['IN', 'id', implode(",", $ids_brand)])
                ->all();
        } else {
            $sub_results = (new Query($this->db))
                ->select(['materiale', 'leve'])
                ->from('casi_successo')
                ->where(['LIKE', 'categoria', $categoria])
                ->andWhere(['LIKE', 'anno', $anno_bando])
                ->andWhere(['LIKE', 'azienda', $azienda])
                ->andWhere(['LIKE', 'materiale', $ricerca])
                ->all();
        }

        $totale = 0;
        if ($brand_prodotto != '') {
            foreach ($sub_results as $result) {
                if (in_array($ricerca, explode(",", $result['materiale']))) {
                    if ($leve != '') {
                        $leve_inner =  explode(",", $result['leve']);
                        if (in_array($leve, $leve_inner)) {
                            $totale++;
                        }
                    } else {
                        $totale++;
                    }
                }
            }
        } else {
            foreach ($sub_results as $result) {
                if ($leve != '') {
                    $leve_inner = explode(",", $result['leve']);
                    if (in_array($leve, $leve_inner)) {
                        $totale++;
                    }
                } else {
                    $totale++;
                }
            }
        }
        return $totale;
    }

    private function getNumeroLeve(
        mixed $categoria,
        mixed $anno_bando,
        mixed $azienda,
        mixed $materiale,
        string $ricerca,
        mixed $brand_prodotto
    ) {
        if ($brand_prodotto != '') {
            $ids_brand = $this->getIdByBrand($brand_prodotto);
            $sub_results = (new Query($this->db))
                ->select(['leve'])
                ->from('casi_successo')
                ->where(['IN', 'id', implode(",", $ids_brand)])
                ->all();
        } else {
            $sub_results = (new Query($this->db))
                ->select(['leve'])
                ->from('casi_successo')
                ->where(['LIKE', 'categoria', $categoria])
                ->andWhere(['LIKE', 'anno', $anno_bando])
                ->andWhere(['LIKE', 'azienda', $azienda])
                ->andWhere(['LIKE', 'materiale', $materiale])
                ->all();
        }
        $totale = 0;
        foreach ($sub_results as $result) {
            $leve =  explode(",", $result['leve']);
            if (in_array($ricerca, $leve)) {
                $totale++;
            }
        }

        return $totale;
    }


}
