<?php
function downloadLikeXML(
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
	$xml                                   = "<text_analize>";

	$xml .= '<text_info numberOfCharacter="' . $numberOfCharacter . '" countWords="' . $countWords . '" countSentences="' . $countSentences . '" frequencyCharacters="' . $frequencyCharacters . '" distributionCharactersPercentageTotal="' . $distributionCharactersPercentageTotal . '" averageWordLength="' . $averageWordLength . '" averageCountWordsSentence="' . $averageCountWordsSentence . '" topTenMostUsedWords="' . $topTenMostUsedWords . '" topTenLongestWord="' . $topTenLongestWords . '" topTenShortestWords="' . $topTenShortestWords . '" topTenLongestSentences="' . $topTenLongestSentences . '" topTenShortestSentences="' . $topTenShortestSentences . '" countPalindromeWords="' . $countPalindromeWords . '" topTenLongestPalindromeWords="' . $topTenLongestPalindromeWords . '" isTheWholeTextAPalindrome="' . $isTheWholeTextAPalindrome . '" timeTheReport="' . $timeTheReport . '" theReversedText="' . $theReversedText . '" reversedTextCharacter="' . $reversedTextCharacter . '" />';

	$xml .= "</text_analize>";

	$sxe                     = new SimpleXMLElement( $xml );
	$dom                     = new DOMDocument( '1,0' );
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput       = true;
	$dom->loadXML( $sxe->asXML() );

	$dom->save( 'file.xml' );

	$filename = 'file.xml';
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