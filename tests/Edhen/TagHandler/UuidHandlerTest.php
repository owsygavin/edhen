<?php

namespace Edhen\TagHandler;

use Edhen\Decoder;
use Edhen\Token;
use Edhen\Tokenizer;

class UuidHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->handler = new UuidHandler();
    }

    public function testCanHandle()
    {
        $this->assertTrue($this->handler->canHandle(new Token(Token::TAG, 'uuid')));
        $this->assertFalse($this->handler->canHandle(new Token(Token::SYMBOL)));
    }

    public function testDecodingAUuid()
    {
        $uuid = 'f81d4fae-7dec-11d0-a765-00a0c91e6bf6';
        $tokenizer = new Tokenizer('"' . $uuid . '"');
        $decoder = new Decoder($tokenizer);

        $this->assertEquals(array($uuid), $this->handler->decode($decoder));
    }
}
