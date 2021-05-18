<?php
/**
 * @param int $countSentences
 * @param int $countWords
 *
 * @return int
 */
function averageCountWordsSentence(int $countSentences, int $countWords): int
{
    return round($countWords / $countSentences, 2);
}
