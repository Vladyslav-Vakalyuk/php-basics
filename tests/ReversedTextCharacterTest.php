<?php
require_once 'ReversedTextCharacter.php';
use PHPUnit\Framework\TestCase;

class ReversedTextCharacterTest extends TestCase {

	/**
	 * @dataProvider additionProvider
	 */
	public function testAdd($words, $expected)
	{
		$this->assertSame($expected, reversedTextCharacter($words));
	}

	public function additionProvider()
	{
		return [
			['one. two! three?', '?three !two .one'],
			['one! two? three. fourth.', '.fourth .three ?two !one'],
			['one! two!', '!two !one'],
		];
	}
}