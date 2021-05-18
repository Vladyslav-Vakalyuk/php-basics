<?php
/**
 * @param string $text
 *
 * @return false|string[]
 */
function topTenMostUsedWords(string $text): array
{
    $res = explode(' ', $text);
    $res = array_count_values($res);
    arsort($res);

    return array_slice($res, 0, 10);
}
