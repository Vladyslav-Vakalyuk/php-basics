<?php
require "vendor/autoload.php";

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
require_once 'downloadLikeCSV.php';
require_once 'downloadLikeXLS.php';
require_once 'downloadLikeXML.php';
require_once 'TextAnalizer.php';
require_once 'bootstrap.php';
session_start();

$textAnalizer = new TextAnalizer();
$upload       = null;

$time_start = microtime( true );
mb_internal_encoding( "UTF-8" );

if ( isset( $_POST['data'] ) && isset( $_FILES['file'] ) ) {
	if ( empty( $_POST['text-db'] ) ) {

		$text = $_POST['data'] ? $_POST['data'] : file_get_contents( $_FILES['file']['tmp_name'] );
	}
	$hash = $_POST['text-db'] ?? hash( 'md5', $text );//hash
	if ( TextAnalizer::where( 'session_id', '=', session_id() )->where( 'hash', '=', $hash )->count() > 0 ) {
		$data                                  = TextAnalizer::where( 'session_id', '=', session_id() )->where( 'hash', '=', $hash )->get();
		$data                                  = json_decode( $data[0]->data, JSON_OBJECT_AS_ARRAY );
		$numberOfCharacter                     = $data['numberOfCharacter'];
		$countWords                            = $data['countWords'];
		$countSentences                        = $data['countSentences'];
		$frequencyCharacters                   = $data['frequencyCharacters'];
		$distributionCharactersPercentageTotal = $data['distributionCharactersPercentageTotal'];
		$averageWordLength                     = $data['averageWordLength'];
		$averageCountWordsSentence             = $data['averageCountWordsSentence'];
		$topTenMostUsedWords                   = $data['topTenMostUsedWords'];
		$topTenLongestWords                    = $data['topTenLongestWords'];
		$topTenShortestWords                   = $data['topTenShortestWords'];
		$topTenLongestSentences                = $data['topTenLongestSentences'];
		$topTenShortestSentences               = $data['topTenShortestSentences'];
		$countPalindromeWords                  = $data['countPalindromeWords'];
		$topTenLongestPalindromeWords          = $data['topTenLongestPalindromeWords'];
		$isTheWholeTextAPalindrome             = $data['isTheWholeTextAPalindrome'];
		$timeTheReport                         = $data['timeTheReport'];
		$theReversedText                       = $data['theReversedText'];
		$reversedTextCharacter                 = $data['reversedTextCharacter'];
	} else {
		$numberOfCharacter                     = strlen( $text );
		$countWords                            = countWords( $text );
		$countSentences                        = countSentences( $text );
		$frequencyCharacters                   = frequencyCharacters( $text );
		$distributionCharactersPercentageTotal = distributionCharactersPercentageTotal( $text, $frequencyCharacters );
		$averageWordLength                     = averageWordLength( $text );
		$averageCountWordsSentence             = averageCountWordsSentence( $countSentences, $countWords );
		$topTenMostUsedWords                   = topTenMostUsedWords( $text );
		$topTenLongestWords                    = topTenLongestWords( $text );
		$topTenShortestWords                   = topTenShortestWords( $text );
		$topTenLongestSentences                = topTenLongestSentences( $text );
		$topTenShortestSentences               = topTenShortestSentences( $text );
		$countPalindromeWords                  = countPalindromeWords( $text );
		$topTenLongestPalindromeWords          = topTenLongestPalindromeWords( $text );
		$isTheWholeTextAPalindrome             = isTheWholeTextAPalindrome( $text );
		$timeTheReport                         = date( 'Y-m-d H-i-s' );
		$theReversedText                       = theReversedText( $text );
		$reversedTextCharacter                 = reversedTextCharacter( $text );
	}


	$prepareSave = [
		'numberOfCharacter'                     => $numberOfCharacter,
		'countWords'                            => $countWords,
		'countSentences'                        => $countSentences,
		'frequencyCharacters'                   => $frequencyCharacters,
		'distributionCharactersPercentageTotal' => $distributionCharactersPercentageTotal,
		'averageWordLength'                     => $averageWordLength,
		'averageCountWordsSentence'             => $averageCountWordsSentence,
		'topTenMostUsedWords'                   => $topTenMostUsedWords,
		'topTenLongestWords'                    => $topTenLongestWords,
		'topTenShortestWords'                   => $topTenShortestWords,
		'topTenLongestSentences'                => $topTenLongestSentences,
		'topTenShortestSentences'               => $topTenShortestSentences,
		'countPalindromeWords'                  => $countPalindromeWords,
		'topTenLongestPalindromeWords'          => $topTenLongestPalindromeWords,
		'isTheWholeTextAPalindrome'             => $isTheWholeTextAPalindrome,
		'timeTheReport'                         => $timeTheReport,
		'theReversedText'                       => $theReversedText,
		'reversedTextCharacter'                 => $reversedTextCharacter
	];
	if ( TextAnalizer::where( 'session_id', '=', session_id() )->where( 'hash', '=', $hash )->count() == 0 ) {
		if ( TextAnalizer::where( 'session_id', '=', session_id() )->count() > 10 ) {
			$itemForDElete = TextAnalizer::where( 'session_id', '=', session_id() )->orderBy( 'id' )->limit( 1 )->delete();
		}

		$model             = new TextAnalizer();
		$model->session_id = session_id();
		$model->hash       = $hash;
		$model->text       = $text;
		$model->data       = json_encode( $prepareSave );
		$model->save();
	}

	if ( $_POST['donwload'] === 'csv' ) {
		downloadLikeCSV(
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

		);
	}
	if ( $_POST['donwload'] === 'xml' ) {
		downloadLikeXML(
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

		);
	}
	if ( $_POST['donwload'] === 'xls' ) {
		downloadLikeXLS(
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

		);
	}
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

	<form enctype="multipart/form-data" method="post" action="/">
		<textarea name="data"><?= isset( $_POST['data'] ) ? $_POST['data'] : '' ?></textarea>
		<input name="file" type="file">
		<select name="donwload">
			<option value="">select</option>
			<option value="csv">csv</option>
			<option value="xml">xml</option>
			<option value="xls">xls</option>
		</select>
		<?php $textFromDb = TextAnalizer::where( 'session_id', '=', session_id() )->get(); ?>
		<?php if ( ! empty( $textFromDb ) ): ?>
			<h1>History</h1>
			<select name="text-db">
				<option value="">select</option>
				<?php foreach ( $textFromDb as $key => $value ): ?>
					<option value="<?= $value->hash ?>"><?= $value->text ?></option>
				<?php endforeach; ?>
			</select>
		<?php endif; ?>
		<br>
		<button type="submit">SEND</button>
	</form>

	<h2>Statistic data</h2>
<?php $statisticData = TextAnalizer::get(); ?>
	Count Statistic = <?= count( $statisticData ) ?>
	<br>
	<h2>Average of statistical data of submitted texts</h2>
<?php

$numberOfCharacter   = 0;
$countWords          = 0;
$countSentences      = 0;
$frequencyCharacters = 0;
?>
<?php foreach ( $statisticData as $key => $value ): ?>

	<?php
	$data              = json_decode( $value->data, JSON_OBJECT_AS_ARRAY );
	$numberOfCharacter += $data['numberOfCharacter'];
	$countWords        += $data['countWords'];
	$countSentences    += $data['countSentences'];
	?>
<?php endforeach; ?>

<?= 'numberOfCharacter = ' . $numberOfCharacter / count( $statisticData ) . '<br>' ?>
<?= 'countWords = ' . $countWords / count( $statisticData ) . '<br>' ?>
<?= 'countSentences = ' . $countSentences / count( $statisticData ) . '<br>' ?>