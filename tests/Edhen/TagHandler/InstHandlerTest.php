<?php

namespace Edhen\TagHandler;

use DateTime;
use Edhen\Token;
use Edhen\Tokenizer;
use Edhen\Decoder;

class InstHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->handler = new InstHandler();
    }

    protected function assertInst($input)
    {
        $tokenizer = new Tokenizer('"' . $input . '"');
        $decoder = new Decoder($tokenizer);
        $actual = $this
            ->handler
            ->decode($decoder);

        $this->assertEquals($input, $actual[0]->format(DateTime::RFC3339));
    }

    public function testCanHandle()
    {
        $this->assertTrue($this->handler->canHandle(new Token(Token::TAG, 'inst')));
        $this->assertFalse($this->handler->canHandle(new Token(Token::SYMBOL)));
    }

    public function testInstsCanBeDecoded()
    {
        $this->assertInst('1996-12-19T16:39:57+00:00');
    }
}
