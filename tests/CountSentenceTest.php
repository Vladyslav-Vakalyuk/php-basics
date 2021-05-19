<?php
require_once 'CountSentences.php';
use PHPUnit\Framework\TestCase;

class CountSentenceTest extends TestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testAdd($words, $expected)
	{
		$this->assertSame($expected, countSentences($words));
	}

	public function additionProvider()
	{
		return [
			['one. two! three?', 3],
			['one! two? three. fourth.', 4],
			['one! two!', 2],
		];
	}
}