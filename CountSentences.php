<?php
/**
 * @param string $text
 *
 * @return int
 */
function countSentences(string $text): int
{
    $res = preg_split('/[?]|[.]|[!]/', $text);
    $res = array_filter($res, function ($val) {
        return empty($val) ? false : true;
    });

    return count($res);
}
