<?php
// Definindo o local para português do Brasil
setlocale(LC_TIME, 'pt_BR.UTF-8');

function linha($semana, $mes, $ano, $dia_atual) {
    echo "<tr>";
    for ($i = 0; $i <= 6; $i++) {
        $classe = '';
        if (isset($semana[$i])) {
            if ($semana[$i] == $dia_atual) {
                $classe = 'class="bg-primary text-white"';
            } elseif ($i == 0) {
                $classe = 'class="font-weight-bold"'; // Domingo
            }
            echo "<td $classe>{$semana[$i]}</td>";
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}

function calendario($mes, $ano, $dia_atual) {
    $dia = 1;
    $semana = [];

    // Obter o primeiro dia do mês
    $primeiro_dia_mes = mktime(0, 0, 0, $mes, 1, $ano);
    $dias_semana = date('w', $primeiro_dia_mes);

    // Preencher os dias vazios antes do primeiro dia do mês
    for ($i = 0; $i < $dias_semana; $i++) {
        array_push($semana, "");
    }

    // Número de dias no mês
    $dias_no_mes = date('t', $primeiro_dia_mes);

    while ($dia <= $dias_no_mes) {
        array_push($semana, $dia);
        if (count($semana) == 7) {
            linha($semana, $mes, $ano, $dia_atual);
            $semana = [];
        }
        $dia++;
    }
    linha($semana, $mes, $ano, $dia_atual);
}

$mes_atual = date('n');
$ano_atual = date('Y');
$dia_atual = date('j');

$formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, NULL, NULL, 'MMMM');
$nome_mes = $formatter->format(mktime(0, 0, 0, $mes_atual, 1));
?>
