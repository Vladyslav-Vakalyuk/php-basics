<?php
/**
 * @param string $text
 *
 * @return string
 */
function theReversedText(string $text): string
{
    $array = mb_str_split($text);
    $array = array_reverse($array);

    return $text . '=>' . implode('', $array);
}
