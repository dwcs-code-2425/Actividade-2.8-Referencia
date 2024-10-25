<?php

      /**
       * Representa calificación mínima
       * @var int
       */
const MIN_CAL_VALUE = 0;
      /**
       * Representa la calificación máxima
       * @var int
       */
const MAX_CAL_VALUE = 10;
      /**
       * Representa el porcentaje mínimo
       * @var int
       */
const MIN_PERCENTAGE_VALUE = 0;
      /**
       * Representa el porcentaje máximo
       * @var int
       */
const MAX_PERCENTAGE_VALUE = 100;

const INCREMENTO_CUALIFI= 0.1;
/**
 * Comprueba para cada elemento del array si está entre el valor min y max,
 *  ambos incluídos.
 * @param array $values_array array de elementos a comprobar.
 * @param float $min Valor mínimo permitido.
 * @param float $max Valor máximo permitido.
 * @return bool Devuelve true si todos los elementos del array están dentro
 *  del rango determinado por min y max, false en caso contrario.
 */
function is_valid_range(array $values_array, float $min, float $max): bool
{
    foreach ($values_array as $value) {
        if ($value < $min || $value > $max) {
            return false;
        }
    }
    return true;
}
/**
 * Elimina los elementos del array que pueden reducirse a cadena vacía, como una serie de espacios.
 * @param array $array Array sobre el que eliminar los elementos reducibles a cadena vacía.
 * @return array Devuelve el array filtrado.
 */
function eliminar_cadenas_vacias(array $array): array
{
    return array_filter($array, "es_equiv_cadena_vacia");
}
/**
 * Comprueba si una cadena de texto es reducible a cadena vacía, como una serie de espacios.
 * @param string $var Cadena de texto a comprobar.
 * @return bool Devuelve `true` si  `var` es reducible a cadena vacía,  `false` en caso contrario.
 */
function es_equiv_cadena_vacia(string $var):bool
{
    return trim($var) != "";
}


/**
 * Comprueba si array está compuesto solo de números o cadenas numéricas.
 * @param array $array sobre el que iterar.
 * @return bool Devuelve `true` si  `var` todos los elementos son números o cadenas numéricas,  `false` en caso contrario.
 */
function validar_numeric_values(array $array): bool
{
    foreach ($array as $value) {
        if (!is_numeric($value)) {
            return false;
        }
    }
    return true;
}
/**
 * Comprueba si la suma de los elementos del del array es igual a la constante  MAX_PERCENTAGE_VALUE.
 * @param array $pesos_array Array a comprobar.
 * @return bool Devuelve `true` si  la suma de los elementos del del array es igual a la constante  MAX_PERCENTAGE_VALUE,  `false` en caso contrario.
 */
function validar_pesos(array $pesos_array): bool
{
    $suma = array_sum($pesos_array);
    return ($suma ==  MAX_PERCENTAGE_VALUE);
}
/**
 * Comprueba si los arrays de entrada tienen el mismo número de elementos.
 * @param array $cals_array Array 1 a comprobar.
 * @param array $pesos_array Array 2 a comprobar.
 * @return bool Devuelve `true` si los dos arrays de entrada tienen el mismo número de elementos,  `false` en caso contrario.
 */
function validar_count_arrays(array $cals_array, array $pesos_array): bool
{
    return sizeof($cals_array) == count($pesos_array);
}

/**
 * Calcula el resultado de sumar los productos de multiplicar cada elemento de la posición i del primer array por el elemento de la misma posición i del segundo array.
 * @param array $cals_array Array 1 que contiene los elementos a multiplicar.
 * @param array $pesos_array Array 2 que contiene los elementos a multiplicar.
 * @return float Devuelve el resultado de sumar los productos de multiplicar cada elemento de la posición i del primer array por el elemento de la misma posición i del segundo array.
 */
function calcular_media_ponderada(array $cals_array, array $pesos_array): float
{
    $media_ponderada = 0;
    for ($i = 0; $i < count($cals_array); $i++) {
        $media_ponderada += $cals_array[$i] * $pesos_array[$i] /  MAX_PERCENTAGE_VALUE;
    }
    return $media_ponderada;
}
/**
 * Modifica todos los elementos del array de entrada, multiplicando su valor por INCREMENTO_CUALIFI.
 * Aunque la función no devuelve nada, el array de entrada es pasado por referencia, por lo que se verá modificado tras la llamada a esta función.
 * @param mixed $array Array de elementos a modificar
 * @return void
 */
function corregir_notas(&$array): void
{
    
    // for ($i = 0; $i < count($array); $i++) {
    //     $array[$i] = $array[$i] + $array[$i] * 0.1;
    //     if ($array[$i] > 10) {
    //         $array[$i] = 10;
    //     }
    // }

    foreach ($array as &$valor) {
        //$valor += $valor * 0.1;
        $valor*=(1+ INCREMENTO_CUALIFI);
        if ($valor > MAX_CAL_VALUE) {
            $valor = MAX_CAL_VALUE;
        }
    }
    unset($valor);
}
