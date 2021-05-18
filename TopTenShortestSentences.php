<?php
/**
 * @param string $text
 *
 * @return array
 */
function topTenShortestSentences(string $text): array
{
    $res   = preg_split('/[?]|[.]|[!]/', $text);
    $res   = array_filter($res, function ($val) {
        return empty($val) ? false : true;
    });
    $array = array_flip(array_unique($res));
    foreach ($array as $key => &$value) {
        $value = mb_strlen($key);
    }
    asort($array);

    return array_slice($array, 0, 10);
}
