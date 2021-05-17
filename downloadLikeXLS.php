<?php
function downloadLikeXLS(
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
	$frequencyCharacters                   = implode( $frequencyCharacters );
	$distributionCharactersPercentageTotal = implode( $distributionCharactersPercentageTotal );
	$topTenMostUsedWords                   = implode( $topTenMostUsedWords );
	$topTenLongestWords                    = implode( $topTenLongestWords );
	$topTenShortestWords                   = implode( $topTenShortestWords );
	$topTenLongestSentences                = implode( $topTenLongestSentences );
	$topTenShortestSentences               = implode( $topTenShortestSentences );
	$topTenLongestPalindromeWords          = implode( $topTenLongestPalindromeWords );

	$filename = "file.xls";

	header( "Content-Disposition: attachment; filename=\"$filename\"" );
	header( "Content-Type: application/vnd.ms-excel" );

	echo implode( "\t", [
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
		] ) . "\r\n";
	echo implode( "\t", [
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
		] ) . "\r\n";
	exit;
}

;