<?php
/**
 * @param string $text
 *
 * @return array
 */
function frequencyCharacters( string $text ): array {
    $textToArray = mb_str_split( $text );
    $array       = array_flip( array_unique( $textToArray ) );
    foreach ( $array as &$val ) {
        $val = 0;
    }
    foreach ( $textToArray as $str ) {
        $array[ $str ] ++;
    }

    return $array;
}