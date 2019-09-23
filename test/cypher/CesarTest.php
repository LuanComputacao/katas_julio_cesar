<?php

namespace Codenation\Cyphers;

use PHPUnit\Framework\TestCase;

class CesarTest extends TestCase
{
    protected $cesar;

    protected function setUp(): void
    {
        $this->cesar = new Cesar(1, "");
    }

    public function testMustShiftLetter()
    {
        $this->cesar->string = 'a';
        $this->cesar->encrypt();
        $this->assertEquals('b', $this->cesar->encrypted);
    }

    public function testMustUnshiftLetter()
    {
        $this->cesar->string = 'b';
        $this->cesar->decrypt();
        $this->assertEquals('a', $this->cesar->encrypted);
    }

    public function testMustShiftLastLetter()
    {
        $this->cesar->string = 'z';
        $this->cesar->encrypt();
        $this->assertEquals('a', $this->cesar->encrypted);
    }

    public function testMustUnshiftLastLetter()
    {
        $this->cesar->string = 'a';
        $this->cesar->decrypt();
        $this->assertEquals('z', $this->cesar->encrypted);
    }

    public function testMustShiftMoreThanOneLetter()
    {
        $this->cesar->string = 'ab';
        $this->cesar->encrypt();
        $this->assertEquals('bc', $this->cesar->encrypted);
    }

    public function testMustUnshiftMoreThanOneLetter()
    {
        $this->cesar->string = 'bc';
        $this->cesar->decrypt();
        $this->assertEquals('ab', $this->cesar->encrypted);
    }

    public function testMustNotShiftNumber()
    {
        $this->cesar->string = '1';
        $this->cesar->encrypt();
        $this->assertEquals('1', $this->cesar->encrypted);
    }

    public function testMustNotUnshiftNumber()
    {
        $this->cesar->string = '1';
        $this->cesar->decrypt();
        $this->assertEquals('1', $this->cesar->encrypted);
    }

    public function testMustCypherMixedStringWithNumber()
    {
        $this->cesar->range = 3;
        $this->cesar->string = '1a.a';
        $this->cesar->encrypt();
        $this->assertEquals('1d.d', $this->cesar->encrypted);
    }

    public function testMustDecipherMixedStringWithNumber()
    {
        $this->cesar->range = 3;
        $this->cesar->string = '1d.d';
        $this->cesar->decrypt();
        $this->assertEquals('1a.a', $this->cesar->encrypted);
    }

    public function testMustCypherLongString()
    {
        $this->cesar->range = 3;
        $this->cesar->string = 'a ligeira raposa marrom saltou sobre o cachorro cansado';
        $expected = 'd oljhlud udsrvd pduurp vdowrx vreuh r fdfkruur fdqvdgr';

        $this->cesar->encrypt();
        $this->assertEquals($expected, $this->cesar->encrypted);
    }

    public function testMustDecipherLongString()
    {
        $this->cesar->range = 3;
        $this->cesar->string = 'd oljhlud udsrvd pduurp vdowrx vreuh r fdfkruur fdqvdgr';
        $expected = 'a ligeira raposa marrom saltou sobre o cachorro cansado';
        $this->cesar->decrypt();
        $this->assertEquals($expected, $this->cesar->encrypted);
    }
}
