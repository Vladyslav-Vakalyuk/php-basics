<?php
/**
 * @param string $text
 *
 * @return int
 */
function countPalindromeWords(string $text): int
{
    $text                  = str_replace([ ',', '!', '?', '.' ], '', $text);
    $res                   = explode(' ', $text);
    $count_palindrome_word = 0;
    foreach ($res as $value) {
        $check_word = mb_str_split($value);
        if ($check_word === array_reverse($check_word)) {
            $count_palindrome_word ++;
        }
    }

    return $count_palindrome_word;
}
