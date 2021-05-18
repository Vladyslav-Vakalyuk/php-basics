<?php
/**
 * @param string $text
 *
 * @return int
 */
function countWords(string $text): int
{
    $res = explode(' ', $text);

    return count($res);
}
