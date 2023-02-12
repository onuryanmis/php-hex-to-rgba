<?php

use Onur\PhpCase\HexToRgbaException;
use Onur\PhpCase\HexCodeConverter;
use PHPUnit\Framework\TestCase;

final class HexToRgbaTest extends TestCase
{
    /**
     * @throws HexToRgbaException
     */
    public function testHexToRgba(): void
    {
        $converter = new HexCodeConverter();

        $converter->setHexCode('#FFF');
        $converter->setAlpha('.3');
        $this->assertEquals('rgba(255, 255, 255, .3)', $converter->convertToRgba());

        $converter->setHexCode('#FFFFFF');
        $converter->setAlpha('1');
        $this->assertEquals('rgba(255, 255, 255, 1)', $converter->convertToRgba());

        $converter->setHexCode('FFF');
        $converter->setAlpha('.5');
        $this->assertEquals('rgba(255, 255, 255, .5)', $converter->convertToRgba());

        $converter->setHexCode('FFFFFF');
        $converter->setAlpha('1');
        $this->assertEquals('rgba(255, 255, 255, 1)', $converter->convertToRgba());
    }

    public function testHexToRgbaException(): void
    {
        $this->expectException(HexToRgbaException::class);
        $converter = new HexCodeConverter();
        $converter->setHexCode('FFFFF');
        $converter->setAlpha('1');
        $converter->convertToRgba();
    }
}