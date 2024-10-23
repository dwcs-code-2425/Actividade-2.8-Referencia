<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media ponderada</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Cálculo de calificación final</h1>

    <form method="post">

        <p>
            <label for="cals">Introduzca las calificaciones separadas por /. Por ejemplo: 5/4</label>
            <input type="text" name="cals" id="cals" required>
        </p>


        <p>
            <label for="pesos">Introduzca los pesos separados por %. Por ejemplo: 50%50</label>
            <input type="text" name="pesos" id="pesos" required>
        </p>

        <input type="submit" value="Calcular media">

    </form>

    <?php

    require_once 'util.php';

    if (isset($_POST["cals"], $_POST["pesos"])) {
        $cals = $_POST["cals"];
        $pesos = $_POST["pesos"];

        $cals_array = explode("/", $cals);
        $pesos_array = explode("%", $pesos);

        //depuración
        echo "<pre>";
        print_r($cals_array);
        var_dump($cals_array);
        echo "</pre>";


        echo "<pre>";
        print_r($pesos_array);
        var_dump($pesos_array);
        echo "</pre>";

        $cals_array = eliminar_cadenas_vacias($cals_array);
        $pesos_array = eliminar_cadenas_vacias($pesos_array);

        if (validar_numeric_values($cals_array) && validar_numeric_values($pesos_array)) {
            if (
                is_valid_range($cals_array, MIN_CAL_VALUE, MAX_CAL_VALUE)
                && is_valid_range($pesos_array, MIN_PERCENTAGE_VALUE, MAX_PERCENTAGE_VALUE)
            ) {
                if (validar_pesos($pesos_array)) {
                    if (validar_count_arrays($cals_array, $pesos_array)) {
                        corregir_notas($cals_array);
                        var_dump($cals_array);
                        printf("<p class='ok'> La media ponderada es %.2f </p>", calcular_media_ponderada($cals_array, $pesos_array));
                    } else {
                        echo "<p class='error'> El número de UDs y el números de porcentajes no coincide </p>";
                    }
                } else {
                    echo "<p class='error'> La suma de porcentajes debe ser " . TOTAL_PERCENTAGE . " </p>";
                }
            } else {
                echo "<p class='error'> Los valores mínimos y máximos para calificaciones son " . MIN_CAL_VALUE . " y " . MAX_CAL_VALUE . " </p>";
                echo "<p class='error'> Los valores mínimos y máximos para pesos son " . MIN_PERCENTAGE_VALUE . " y " . MAX_PERCENTAGE_VALUE . " </p>";
            }
        } else {
            echo "<p class='error'> Solo se permiten valores numéricos entre los símbolos / y % </p>";
        }
    }

    ?>