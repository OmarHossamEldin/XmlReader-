<?php

namespace Reneknox\XmlReader\Reader;

use SimpleXMLElement;

class XmlReader
{
    private $data;

    public static function read(string $file): self
    {
        $xml = new static();
        $xml->set_data(simplexml_load_string(File::get_contents($file)));
        return $xml;
    }

    public function to_array(): self
    {
        $this->data = json_encode($this->data);
        $this->data = json_decode($this->data, true);
        return $this;
    }

    public function set_data(SimpleXMLElement $data): void
    {
        $this->data = $data;
    }

    public function get_data(): array
    {
        $this->to_array();
        return $this->data;
    }
}
