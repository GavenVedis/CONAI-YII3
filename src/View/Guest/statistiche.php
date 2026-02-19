<?php
declare(strict_types=1);

use App\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 * @var Yiisoft\Aliases\Aliases $aliases
 * @var array $benefici
 * @var array $anni
 * @var int $aziende_partecipanti
 * @var int $casi_presentati
 * @var int $casi_premiati
 * @var int $casi_incentivati
 * @var int $montepremi
 * @var array $leve_attivate
 * @var bool $is_admin
 * @var App\Utility\UtilityFaseTwo $utilityFaseTwo
 */

$this->setTitle($applicationParams->name . " - Statistiche");
?>
<style>
  .counter-container {
    text-align: left;
  }

  .counter {
    font-size: 2rem;
    font-weight: bold;
  }

  .description {
    font-size: 1.2rem;
    font-weight: bold;
  }

  .line-container {
    position: relative;
    width: 80%;
  }

  .line {
    width: 100%;
    height: 2px;
    background-color: #2C6489;
    position: relative;
  }

  .circle {
    width: 20px;
    height: 20px;
    background-color: white;
    border-radius: 50%;
    border: 2px solid #2C6489;
    position: absolute;
    top: -10px;
    left: 0;
  }

</style>
<div class="statistiche">

        <div class="row">
            <div class="col">
                <h2>Statistiche</h2>
            </div>
        </div>
        <div class="row mb-3 elenco-anni" style="margin-top: 1rem; margin-bottom: 1rem;">
            <div class="col" style="text-align: left">
                <?php
                for ($i = 0; $i < count($anni); $i++): ?>
                    <span class="anno-breadcrumb<?= $i == 0 ? ' selected' : '' ?>"><?= $anni[$i] ?></span>&nbsp;
                <?php
                endfor; ?>
                <hr/>
            </div>
        </div>

        <div class="row justify-content-md-center mb-3" style="margin-top: 1rem; margin-bottom: 1rem;">
            <?php
            /*$blocchi_numeri = [
                ['label' => 'Aziende partecipanti', 'value' => $aziende_partecipanti, 'id' => 0],
                ['label' => 'Numero di casi presentati', 'value' => $casi_presentati, 'id' => 1],
                ['label' => 'Numero di casi premiati', 'value' => $casi_premiati, 'id' => 2],
                ['label' => 'Numero di casi incentivati', 'value' => $casi_incentivati, 'id' => 3],
                ['label' => '&euro; di montepremi', 'value' => $montepremi, 'id' => 4],
            ];*/
			//rimozione casi incentivati
			$blocchi_numeri = [
				['label' => 'Aziende partecipanti', 'value' => $aziende_partecipanti, 'id' => 0],
                ['label' => 'Numero di casi presentati', 'value' => $casi_presentati, 'id' => 1],
                ['label' => 'Numero di casi premiati', 'value' => $casi_premiati, 'id' => 2],
                ['label' => '&euro; di montepremi', 'value' => $montepremi, 'id' => 3],
			];
            foreach ($blocchi_numeri as $blocco):
                ?>
                <div class="col-12 col-lg-2 counter-container" data-contatore="<?= $blocco['id'] ?>">
                <span class="counter" data-value="<?= $blocco['value'] ?>" data-startvalue="0"
                      data-timing="2000">0</span>
                    <p class="description"><?= $blocco['label'] ?></p>
                    <div class="line-container">
                        <div class="line"></div>
                        <div class="circle"></div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
        <?php
        if (count($leve_attivate) > 0 && $is_admin): ?>
            <div class="row" style="margin-top: 3rem">
                <div class="col">
                    <h3>Leve attivate - bando <span class="anno-bando"><?= $anni[0] ?></span></h3>
                </div>
            </div>
            <div class="row justify-content-md-center mb-3" style="margin-top: 1rem; margin-bottom: 1rem;">
                <div class="col col-md-6">
                    <canvas id="graficoLeve" width="400" height="400" data-leve='<?= json_encode($leve_attivate) ?>'></canvas>
                </div>
            </div>
        <?php
        endif; ?>
        <div class="row" style="margin-top: 3rem">
            <div class="col">
                <h3>Indicatori ambientali - benefici medi <span class="anno-bando"><?= $anni[0] ?></span></h3>
            </div>
        </div>
        <div class="row justify-content-md-center mb-3" style="margin-top: 1rem; margin-bottom: 1rem;">
            <div class="col-12 col-md-6">
                <?php
                foreach ($benefici as $beneficio): ?>
                    <div class="row mb-3 beneficio-row"
                         style="display: flex; align-items: center; justify-content: center;"
                         data-row="<?= $beneficio['id'] ?>">
                        <div class="col-2">
                            <img src="<?= $aliases->get($beneficio['img']) ?>"
                                 alt="<?= $beneficio['altImage'] ?>"
                                 style="max-width:100%"></div>
                        <div class="col-2"><h4
                                    style="text-align: left; font-size: .875rem"><?= $beneficio['label'] ?></h4>
                        </div>
                        <div class="col-8 pl-0">
                            <div class="<?= $beneficio['value']['dopo']['class'] ?>"
                                 style="width: <?= $beneficio['value']['dopo']['value'] ?>%;" data-value="dopo"> Dopo
                            </div>
                            <div class="<?= $beneficio['value']['prima']['class'] ?>"
                                 style="width: <?= $beneficio['value']['prima']['value'] ?>%;" data-value="prima"> Prima
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
                <div class="row" style="text-align: right">
                    <div class="col-4 pr-0"> 0%|</div>
                    <div class="col-8 pl-0">
                        <div class="row">
                            <div class="col-3"> 25%|</div>
                            <div class="col-3"> 50%|</div>
                            <div class="col-3"> 75%|</div>
                            <div class="col-3"> 100%|</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?= $utilityFaseTwo->generaUrlHTML('/libraries-web/chart.js', 'js') ?>
<?= $utilityFaseTwo->generaUrlHTML('/libraries-web/chartjs-plugin-datalabels.js', 'js') ?>

<script type="text/javascript">

  window.onscroll = function() {myFunction()};

  const elencoAnni = document.getElementsByClassName("elenco-anni")[0];
  const posizioneElencoAnni = elencoAnni.offsetTop;

  function myFunction() {
    if ((document.getElementsByClassName("barra-menu")[0].offsetTop +  window.scrollY) > posizioneElencoAnni) {
      elencoAnni.classList.add("sticky");
    } else {
      elencoAnni.classList.remove("sticky");
    }
  }

  function animateCounter(element, start, end, duration) {
    let startTime = null;
    const circleElement = element.querySelector('.circle');
    const lineElement = element.querySelector('.line');
    const lineWidth = lineElement.offsetWidth;

    function animation(currentTime) {
      if (startTime === null) startTime = currentTime;
	  end = parseInt(end);
	  start = parseInt(start);
      const elapsedTime = currentTime - startTime;
      const progress = Math.min(elapsedTime / duration, 1);
      start = parseInt(start);
      end = parseInt(end);
      element.querySelector('.counter').innerText = Math.floor(progress * (end - start) + start);

      const position = progress * lineWidth;
      circleElement.style.left = `${position}px`;

      if (progress < 1) {
        requestAnimationFrame(animation);
      }
    }

    requestAnimationFrame(animation);
  }
  <?php if ($is_admin): ?>
  function creaGraficoLeve(graficoLeve, dataLeve) {
    const ctx = graficoLeve.getContext('2d');
    const chartStatus = Chart.getChart('graficoLeve');
    if (chartStatus) {
      chartStatus.destroy();
    }
    const datasets = JSON.parse(dataLeve).map(elemento =>
        ({
          label: elemento.label,
          data: [elemento.value],
          backgroundColor: elemento.colore,
        }));
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [''],
        datasets,
      },
      options: {
        plugins: {
          datalabels: {
            color: '#000',
            anchor: 'center',
            align: 'center',
            font: {
              weight: 'bold',
            },
            formatter: function(value, context) {
              return value;
            },
          },
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              padding: 10,
            },
          },
        },
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true,
          },
        },
      },
      plugins: [ChartDataLabels],
    });
  }
  <?php endif; ?>
  function cambioAnno(element) {
    const anno = element.target.innerText;
    element.target.parentElement.querySelector('.selected').classList.remove('selected');
    element.target.classList.add('selected');
    $('.anno-bando').html(anno);
    fetch(`/guest/get-statistiche/${anno}`).then(async response => {
      const result = await response.json();

        <?php if($is_admin): ?>
      if (result.leve_attivate) {
        const graficoLeve = document.getElementById('graficoLeve');
        creaGraficoLeve(graficoLeve, JSON.stringify(result.leve_attivate));
      }

        <?php endif; ?>
      const counterElements = document.querySelectorAll('.counter-container');
      const contatori = result.contatore;
      counterElements.forEach(counterElement => {
        let contatorePresente = false;
        contatori.forEach(contatore => {
          if (parseInt(counterElement.getAttribute('data-contatore')) === contatore.id) {
            contatorePresente = true;
            const elementoCounter = counterElement.querySelector('.counter');
            elementoCounter.innerHTML = 0;
            animateCounter(counterElement, elementoCounter.getAttribute('data-startvalue'), contatore.value,
                elementoCounter.getAttribute('data-timing'));
          }
        });
        if (!contatorePresente) {
          const elementoCounter = counterElement.querySelector('.counter');
          elementoCounter.innerHTML = 0;
          animateCounter(counterElement, 0, 0, elementoCounter.getAttribute('data-timing'));
        }
      });

      const benefici = result.benefici;
      const beneficiDom = document.querySelectorAll('.beneficio-row');
      beneficiDom.forEach(beneficio => {
        let beneficioPresente = false;
        const valorePrima = beneficio.querySelector('[data-value=\'prima\']'),
            valoreDopo = beneficio.querySelector('[data-value=\'dopo\']');
        benefici.forEach(beneficioPassed => {

          if (parseInt(beneficio.getAttribute('data-row')) === beneficioPassed.id) {
            beneficioPresente = true;
            valorePrima.style = `width: ${beneficioPassed.value.prima}%`;
            //valorePrima.innerHTML = `Prima: ${beneficioPassed.value.prima}%`;
            valoreDopo.style = `width: ${beneficioPassed.value.dopo}%`;
            //valoreDopo.innerHTML = `Dopo: ${beneficioPassed.value.dopo}%`;
          }
        });
        if (!beneficioPresente) {
          valorePrima.style = `width: 0%`;
          //valorePrima.innerHTML = 'Prima: 0%';
          valoreDopo.style = `width: 0%`;
          //valoreDopo.innerHTML = 'Dopo: 0%';
        }
      });

    });
  }

  $(document).ready(function() {
    const counterElements = document.querySelectorAll('.counter-container');
    counterElements.forEach(counterElement => {
      const elementoCounter = counterElement.querySelector('.counter');
      animateCounter(counterElement, elementoCounter.getAttribute('data-startvalue'),
          elementoCounter.getAttribute('data-value'), elementoCounter.getAttribute('data-timing'));
    });
      <?php if($is_admin): ?>
    const graficoLeve = document.getElementById('graficoLeve');
    creaGraficoLeve(graficoLeve, graficoLeve.getAttribute('data-leve'));
      <?php endif; ?>
    $('.anno-breadcrumb').click(cambioAnno);
  });
</script>
