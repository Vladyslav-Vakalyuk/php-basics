<?php
/**
 * @param string $text
 *
 * @return array
 */
function topTenLongestPalindromeWords(string $text): array
{
    $text            = str_replace([ ',', '!', '?', '.' ], '', $text);
    $res             = explode(' ', $text);
    $palindrome_word = [];
    foreach ($res as $value) {
        $check_word = mb_str_split($value);
        if ($check_word === array_reverse($check_word)) {
            $palindrome_word[] = $value;
        }
    }

    $array = array_flip(array_unique($palindrome_word));
    foreach ($array as $key => &$value) {
        $value = mb_strlen($key);
    }
    arsort($array);

    return array_slice($array, 0, 10);
}
