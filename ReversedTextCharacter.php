<?php
/**
 * @param string $text
 *
 * @return string
 */
function reversedTextCharacter(string $text): string
{
    $array     = str_split($text);
    $array     = array_reverse($array);
    $start_pos = $end_pos = 0;
    foreach ($array as $key => $value) {
        if (0 == preg_match('/[?]|[.]|[!]|[,]|[ ]/', $value) && $start_pos == 0 && $end_pos == 0) {
            $start_pos = $key;
        }

        if (1 == preg_match('/[?]|[.]|[!]|[,]|[ ]/', $value) && $start_pos != 0) {
            $end_pos = $key - 1;
        }
        if ($start_pos != 0 && $end_pos == 0 && $key == array_key_last($array)) {
            $end_pos = $key;
        }
        if (! empty($start_pos) && ! empty($end_pos)) {
            $rev = array_slice($array, $start_pos, ( $end_pos - ( $start_pos - 1 ) ));
            $rev = array_reverse($rev);
            for ($i = $start_pos; $i <= $end_pos; $i ++) {
                $array[ $i ] = array_shift($rev);
            }
            $start_pos = $end_pos = 0;
        }
    }

    return implode('', $array);
}
