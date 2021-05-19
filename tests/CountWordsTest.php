<?php
require_once 'CountWords.php';
use PHPUnit\Framework\TestCase;

class CountWordsTest extends TestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testAdd($words, $expected)
	{
		$this->assertSame($expected, countWords($words));
	}

	public function additionProvider()
	{
		return [
			['one two three', 3],
			['one two three fourth', 4],
			['one two', 2],
		];
	}
}