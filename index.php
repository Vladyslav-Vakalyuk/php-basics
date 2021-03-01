<?php

require_once 'AverageCountWordsSentence.php';
require_once 'AverageWordLength.php';
require_once 'CountPalindromeWords.php';
require_once 'CountSentences.php';
require_once 'CountWords.php';
require_once 'DistributionCharactersPercentageTotal.php';
require_once 'FrequencyCharacters.php';
require_once 'IsTheWholeTextAPalindrome.php';
require_once 'ReversedTextCharacter.php';
require_once 'TheReversedText.php';
require_once 'TopTenLongestPalindromeWords.php';
require_once 'TopTenLongestSentences.php';
require_once 'TopTenLongestWords.php';
require_once 'TopTenMostUsedWords.php';
require_once 'TopTenShortestSentences.php';
require_once 'TopTenShortestWords.php';

$time_start = microtime( true );
mb_internal_encoding( "UTF-8" );
if ( isset( $_POST['data'] ) ) {
    $numberOfCharacter                     = strlen( $_POST['data'] );
    $countWords                            = countWords( $_POST['data'] );
    $countSentences                        = countSentences( $_POST['data'] );
    $frequencyCharacters                   = frequencyCharacters( $_POST['data'] );
    $distributionCharactersPercentageTotal = distributionCharactersPercentageTotal( $_POST['data'], $frequencyCharacters );
    $averageWordLength                     = averageWordLength( $_POST['data'] );
    $averageCountWordsSentence             = averageCountWordsSentence( $countSentences, $countWords );
    $topTenMostUsedWords                   = topTenMostUsedWords( $_POST['data'] );
    $topTenLongestWords                    = topTenLongestWords( $_POST['data'] );
    $topTenShortestWords                   = topTenShortestWords( $_POST['data'] );
    $topTenLongestSentences                = topTenLongestSentences( $_POST['data'] );
    $topTenShortestSentences               = topTenShortestSentences( $_POST['data'] );
    $countPalindromeWords                  = countPalindromeWords( $_POST['data'] );
    $topTenLongestPalindromeWords          = topTenLongestPalindromeWords( $_POST['data'] );
    $isTheWholeTextAPalindrome             = isTheWholeTextAPalindrome( $_POST['data'] );
    $timeTheReport                         = date( 'Y-m-d H-i-s' );
    $theReversedText                       = theReversedText( $_POST['data'] );
    $reversedTextCharacter                 = reversedTextCharacter( $_POST['data'] );
}

$theRimeItTookToProcessTheTextInMs = ( microtime( true ) - $time_start );
if ( isset( $_POST['data'] ) ) {
    echo "TIME REPORT: $timeTheReport<br>";
    echo 'Number Of Character: ' . $numberOfCharacter;
    echo '<br>Number Of Words: ' . $countWords;
    echo '<br>Number Of Sentences: ' . $countSentences;
    echo '<br>Frequency Of Characters: ';
    print_r( $frequencyCharacters );
    echo '<br>Distribution Of Characters As A Percentage Of Total: ';
    print_r( $distributionCharactersPercentageTotal );
    echo '<br>Average Word Length: ' . $averageWordLength;
    echo '<br>The Average Number Of Words In A Sentence: ' . $averageCountWordsSentence;
    echo '<br>Top 10 Most Used Words: ';
    print_r( $topTenMostUsedWords );
    echo '<br>Top 10 Longest Words: ';
    print_r( $topTenLongestWords );
    echo '<br>Top 10 Shortest Words: ';
    print_r( $topTenShortestWords );
    echo '<br>Top 10 Longest Sentences: ';
    print_r( $topTenLongestSentences );
    echo '<br>Top 10 Shortest Sentences: ';
    print_r( $topTenShortestSentences );
    echo '<br>Number Of Palindrome Words: ' . $countPalindromeWords;
    echo '<br>Top 10 Longest Palindrome Words: ';
    print_r( $topTenLongestPalindromeWords );
    echo '<br>Is The Whole Text A Palindrome: ' . $isTheWholeTextAPalindrome;
    echo '<br>Time The Report: ' . $timeTheReport;
    echo '<br>The Reversed Text: ' . $theReversedText;
    echo '<br>The Reversed Text But The Character Order In Words Kept Intact:' . $_POST['data'] . ' => ' . $reversedTextCharacter;
    echo "<br>Time script process: $theRimeItTookToProcessTheTextInMs ms";
}
?>

<form method="post" action="">
	<textarea name="data"><?= isset( $_POST['data'] ) ? $_POST['data'] : '' ?></textarea>
	<br>
	<button type="submit">SEND</button>
</form>