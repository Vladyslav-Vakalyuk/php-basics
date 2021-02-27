<?php
$time_start = microtime( true );
mb_internal_encoding( "UTF-8" );
if ( isset( $_POST['data'] ) ) {
	$numberOfCharacter                                    = strlen( $_POST['data'] );
	$numberOfWords                                        = numberOfWords( $_POST['data'] );
	$numberOfSentences                                    = numberOfSentences( $_POST['data'] );
	$frequencyOfCharacters                                = frequencyOfCharacters( $_POST['data'] );
	$distributionOfCharactersAsAPercentageOfTotal         = distributionOfCharactersAsAPercentageOfTotal( $_POST['data'], $frequencyOfCharacters );
	$averageWordLength                                    = averageWordLength( $_POST['data'] );
	$theAverageNumberOfWordsInASentence                   = theAverageNumberOfWordsInASentence( $numberOfSentences, $numberOfWords );
	$top10MostUsedWords                                   = top10MostUsedWords( $_POST['data'] );
	$top10longestWords                                    = top10LongestWords( $_POST['data'] );
	$top10ShortestWords                                   = top10ShortestWords( $_POST['data'] );
	$top10LongestSentences                                = top10LongestSentences( $_POST['data'] );
	$top10shortestSentences                               = top10shortestSentences( $_POST['data'] );
	$numberOfPalindromeWords                              = numberOfPalindromeWords( $_POST['data'] );
	$top10LongestPalindromeWords                          = top10LongestPalindromeWords( $_POST['data'] );
	$isTheWholeTextAPalindrome                            = isTheWholeTextAPalindrome( $_POST['data'] );
	$timeTheReport                                        = date( 'Y-m-d H-i-s' );
	$theReversedText                                      = theReversedText( $_POST['data'] );
	$theReversedTextButTheCharacterOrderInWordsKeptIntact = theReversedTextButTheCharacterOrderInWordsKeptIntact( 'This is the text.' );
}

function numberOfWords( $string ) {
	$res = explode( ' ', $string );

	return count( $res );
}

function numberOfSentences( $string ) {
	$res = preg_split( '/[?]|[.]|[!]/', $string );
	$res = array_filter( $res, function ( $val ) {
		return empty( $val ) ? false : true;
	} );

	return count( $res );
}

function frequencyOfCharacters( $string ) {
	$stringToArray = mb_str_split( $string );
	$array         = array_flip( array_unique( $stringToArray ) );
	foreach ( $array as &$val ) {
		$val = 0;
	}
	foreach ( $stringToArray as $str ) {
		$array[ $str ] ++;
	}

	return $array;
}

function distributionOfCharactersAsAPercentageOfTotal( $string, $frequencyOfCharacters ) {
	$koe = count( mb_str_split( $string ) );
	foreach ( $frequencyOfCharacters as $key => &$value ) {
		$value = round( ( $value * 100 ) / $koe, 2 );
	}

	return $frequencyOfCharacters;
}

function averageWordLength( $string ) {
	$res                = explode( ' ', $string );
	$countSymbolOfWords = 0;
	foreach ( $res as $value ) {
		$countSymbolOfWords += count( mb_str_split( $value ) );
	}

	return round( $countSymbolOfWords / count( $res ), 2 );
}

function theAverageNumberOfWordsInASentence( $numberOfSentences, $numberOfWords ) {
	return round( $numberOfWords / $numberOfSentences, 2 );
}

function top10MostUsedWords( $string ) {
	$res = explode( ' ', $string );
	$res = array_count_values( $res );
	arsort( $res );

	return array_slice( $res, 0, 10 );
}

function top10LongestWords( $string ) {
	$res   = explode( ' ', $string );
	$array = array_flip( array_unique( $res ) );
	foreach ( $array as $key => &$value ) {
		$value = mb_strlen( $key );
	}
	arsort( $array );

	return array_slice( $array, 0, 10 );
}

function top10ShortestWords( $string ) {
	$res   = explode( ' ', $string );
	$array = array_flip( array_unique( $res ) );
	foreach ( $array as $key => &$value ) {
		$value = mb_strlen( $key );
	}
	asort( $array );

	return array_slice( $array, 0, 10 );
}

function top10LongestSentences( $string ) {
	$res   = preg_split( '/[?]|[.]|[!]/', $string );
	$res   = array_filter( $res, function ( $val ) {
		return empty( $val ) ? false : true;
	} );
	$array = array_flip( array_unique( $res ) );
	foreach ( $array as $key => &$value ) {
		$value = mb_strlen( $key );
	}
	arsort( $array );

	return array_slice( $array, 0, 10 );
}

function top10shortestSentences( $string ) {
	$res   = preg_split( '/[?]|[.]|[!]/', $string );
	$res   = array_filter( $res, function ( $val ) {
		return empty( $val ) ? false : true;
	} );
	$array = array_flip( array_unique( $res ) );
	foreach ( $array as $key => &$value ) {
		$value = mb_strlen( $key );
	}
	asort( $array );

	return array_slice( $array, 0, 10 );
}

function numberOfPalindromeWords( $string ) {
	$string                = str_replace( [ ',', '!', '?', '.' ], '', $string );
	$res                   = explode( ' ', $string );
	$count_palindrome_word = 0;
	foreach ( $res as $value ) {
		$check_word = mb_str_split( $value );
		if ( $check_word === array_reverse( $check_word ) ) {
			$count_palindrome_word ++;
		}
	}

	return $count_palindrome_word;
}

function top10LongestPalindromeWords( $string ) {
	$string          = str_replace( [ ',', '!', '?', '.' ], '', $string );
	$res             = explode( ' ', $string );
	$palindrome_word = [];
	foreach ( $res as $value ) {
		$check_word = mb_str_split( $value );
		if ( $check_word === array_reverse( $check_word ) ) {
			$palindrome_word[] = $value;
		}
	}

	$array = array_flip( array_unique( $palindrome_word ) );
	foreach ( $array as $key => &$value ) {
		$value = mb_strlen( $key );
	}
	arsort( $array );

	return array_slice( $array, 0, 10 );
}

function isTheWholeTextAPalindrome( $string ) {
	$string = str_replace( [ ',', '!', '?', '.', ' ' ], '', $string );
	$array  = mb_str_split( $string );

	return $array === array_reverse( $array );
}

function theReversedText( $string ) {
	$array = mb_str_split( $string );
	$array = array_reverse( $array );

	return $string . '=>' . implode( '', $array );
}

function theReversedTextButTheCharacterOrderInWordsKeptIntact( $string ) {
	$array     = str_split( $string );
	$array     = array_reverse( $array );
	$start_pos = $end_pos = 0;
	foreach ( $array as $key => $value ) {
		if ( 0 == preg_match( '/[?]|[.]|[!]|[,]|[ ]/', $value ) && $start_pos == 0 && $end_pos == 0 ) {
			$start_pos = $key;
		}

		if ( 1 == preg_match( '/[?]|[.]|[!]|[,]|[ ]/', $value ) && $start_pos != 0 ) {
			$end_pos = $key - 1;
		}
		if ( $start_pos != 0 && $end_pos == 0 && $key == array_key_last( $array ) ) {
			$end_pos = $key;
		}
		if ( ! empty( $start_pos ) && ! empty( $end_pos ) ) {
			$rev = array_slice( $array, $start_pos, ( $end_pos - ( $start_pos - 1 ) ) );
			$rev = array_reverse( $rev );
			for ( $i = $start_pos; $i <= $end_pos; $i ++ ) {
				$array[ $i ] = array_shift( $rev );
			}
			$start_pos = $end_pos = 0;
		}
	}

	return implode( '', $array );
}

$theRimeItTookToProcessTheTextInMs = ( microtime( true ) - $time_start );
if ( isset( $_POST['data'] ) ) {
	echo "TIME REPORT: $timeTheReport<br>";
	echo 'Number Of Character: ' . $numberOfCharacter;
	echo '<br>Number Of Words: ' . $numberOfWords;
	echo '<br>Number Of Sentences: ' . $numberOfSentences;
	echo '<br>Frequency Of Characters: ';
	print_r( $frequencyOfCharacters );
	echo '<br>Distribution Of Characters As A Percentage Of Total: ';
	print_r( $distributionOfCharactersAsAPercentageOfTotal );
	echo '<br>Average Word Length: ' . $averageWordLength;
	echo '<br>The Average Number Of Words In A Sentence: ' . $theAverageNumberOfWordsInASentence;
	echo '<br>Top 10 Most Used Words: ';
	print_r( $top10MostUsedWords );
	echo '<br>Top 10 Longest Words: ';
	print_r( $top10longestWords );
	echo '<br>Top 10 Shortest Words: ';
	print_r( $top10ShortestWords );
	echo '<br>Top 10 Longest Sentences: ';
	print_r( $top10LongestSentences );
	echo '<br>Top 10 Shortest Sentences: ';
	print_r( $top10shortestSentences );
	echo '<br>Number Of Palindrome Words: ' . $numberOfPalindromeWords;
	echo '<br>Top 10 Longest Palindrome Words: ';
	print_r( $top10LongestPalindromeWords );
	echo '<br>Is The Whole Text A Palindrome: ' . $isTheWholeTextAPalindrome;
	echo '<br>Time The Report: ' . $timeTheReport;
	echo '<br>The Reversed Text: ' . $theReversedText;
	echo '<br>The Reversed Text But The Character Order In Words Kept Intact: This is the text. =>' . $theReversedTextButTheCharacterOrderInWordsKeptIntact;
	echo "<br>Time script process: $theRimeItTookToProcessTheTextInMs ms";
}
?>

<form method="post" action="">
	<textarea name="data"><?= isset( $_POST['data'] ) ? $_POST['data'] : '' ?></textarea>
	<br>
	<button type="submit">SEND</button>
</form>
