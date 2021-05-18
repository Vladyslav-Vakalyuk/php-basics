<?php
/**
 * @param string $text
 *
 * @return array
 */
function topTenShortestWords(string $text): array
{
    $res   = explode(' ', $text);
    $array = array_flip(array_unique($res));
    foreach ($array as $key => &$value) {
        $value = mb_strlen($key);
    }
    asort($array);

    return array_slice($array, 0, 10);
}
