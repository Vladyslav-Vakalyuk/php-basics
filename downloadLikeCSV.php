<?php
function downloadLikeCSV(
	$numberOfCharacter,
	$countWords,
	$countSentences,
	$frequencyCharacters,
	$distributionCharactersPercentageTotal,
	$averageWordLength,
	$averageCountWordsSentence,
	$topTenMostUsedWords,
	$topTenLongestWords,
	$topTenShortestWords,
	$topTenLongestSentences,
	$topTenShortestSentences,
	$countPalindromeWords,
	$topTenLongestPalindromeWords,
	$isTheWholeTextAPalindrome,
	$timeTheReport,
	$theReversedText,
	$reversedTextCharacter

) {
	$list = [
		[
			'numberOfCharacter',
			'countWords',
			'countSentences',
			'frequencyCharacters',
			'distributionCharactersPercentageTotal',
			'averageWordLength',
			'averageCountWordsSentence',
			'topTenMostUsedWords',
			'topTenLongestWords',
			'topTenShortestWords',
			'topTenLongestSentences',
			'topTenShortestSentences',
			'countPalindromeWords',
			'topTenLongestPalindromeWords',
			'isTheWholeTextAPalindrome',
			'timeTheReport',
			'theReversedText',
			'reversedTextCharacter'
		],
		[
			$numberOfCharacter,
			$countWords,
			$countSentences,
			implode( $frequencyCharacters ),
			implode( $distributionCharactersPercentageTotal ),
			$averageWordLength,
			$averageCountWordsSentence,
			implode( $topTenMostUsedWords ),
			implode( $topTenLongestWords ),
			implode( $topTenShortestWords ),
			implode( $topTenLongestSentences ),
			implode( $topTenShortestSentences ),
			$countPalindromeWords,
			implode( $topTenLongestPalindromeWords ),
			$isTheWholeTextAPalindrome,
			$timeTheReport,
			$theReversedText,
			$reversedTextCharacter
		],
	];

	$fp = fopen( 'file.csv', 'w' );

	foreach ( $list as $fields ) {
		fputcsv( $fp, $fields );
	}

	fclose( $fp );

	//
	$filename = 'file.csv';
	header( 'Content-Description: File Transfer' );
	header( 'Content-Type: application/octet-stream' );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Expires: 0" );
	header( 'Content-Disposition: attachment; filename="' . basename( $filename ) . '"' );
	header( 'Content-Length: ' . filesize( $filename ) );
	header( 'Pragma: public' );

	flush();

	readfile( $filename );

	die();
}