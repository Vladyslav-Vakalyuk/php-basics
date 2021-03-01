<?php
/**
 * @param string $text
 *
 * @return bool
 */
function isTheWholeTextAPalindrome( string $text ): bool {
    $text  = str_replace( [ ',', '!', '?', '.', ' ' ], '', $text );
    $array = mb_str_split( $text );

    return $array === array_reverse( $array );
}