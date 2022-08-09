<?php

namespace Tests;

use Reneknox\XmlReader\Exceptions\NotSupportedFileException;
use Reneknox\XmlReader\Exceptions\FileNotFoundException;
use Reneknox\XmlReader\Reader\XmlReader;
use PHPUnit\Framework\TestCase;

class XmlReaderTest extends TestCase
{
    private string $file;

    public function setUp(): void
    {
        $this->file = __DIR__;
    }
    /** @test */
    public function xml_read_not_supported()
    {
        $this->expectException(NotSupportedFileException::class);
        $this->file .= '/Samples/example.xmal';
        XmlReader::read($this->file);
    }

    /** @test */
    public function xml_read_file_not_found()
    {
        $this->expectException(FileNotFoundException::class);
        $this->file .= '/Samples/example1.xml';
        XmlReader::read($this->file);
    }

    /** @test */
    public function xml_read_file_success()
    {
        $this->file .= '/Samples/example.xml';
        $xml = XmlReader::read($this->file);
        $this->assertNotEmpty( $xml->get_data());
        $this->assertIsObject($xml);
    }

    /** @test */
    public function xml_to_array_success()
    {
        $this->file .= '/Samples/example.xml';
        $xml = XmlReader::read($this->file);
        $xml->to_array();
        $xml = $xml->get_data();
        $this->assertIsArray($xml);
    }
}
