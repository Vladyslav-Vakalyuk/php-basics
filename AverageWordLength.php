<?php
/**
 * @param string $text
 *
 * @return float
 */
function averageWordLength( string $text ): int {
    $res                = explode( ' ', $text );
    $countSymbolOfWords = 0;
    foreach ( $res as $value ) {
        $countSymbolOfWords += count( mb_str_split( $value ) );
    }

    return round( $countSymbolOfWords / count( $res ), 2 );
}