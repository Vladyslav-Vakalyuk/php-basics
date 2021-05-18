<?php
/**
 * @param string $text
 * @param array $frequencyCharacters
 *
 * @return array
 */
function distributionCharactersPercentageTotal(string $text, array $frequencyCharacters): array
{
    $koe = count(mb_str_split($text));
    foreach ($frequencyCharacters as $key => &$value) {
        $value = round(( $value * 100 ) / $koe, 2);
    }

    return $frequencyCharacters;
}
