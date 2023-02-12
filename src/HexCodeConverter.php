<?php

namespace Onur\PhpCase;

class HexCodeConverter
{
    /** @var string $hexCode */
    private string $hexCode;

    /** @var string $alpha */
    private string $alpha = '1';

    /**
     * @param string $hexCode
     *
     * @return $this
     */
    public function setHexCode(string $hexCode): self
    {
        $this->hexCode = $hexCode;

        return $this;
    }

    /**
     * @param string $alpha
     *
     * @return $this
     */
    public function setAlpha(string $alpha): self
    {
        $this->alpha = $alpha;

        return $this;
    }

    /**
     * @return string
     *
     * @throws HexToRgbaException
     */
    public function convertToRgba(): string
    {
        $values = str_replace('#', '', $this->hexCode);

        switch (strlen($values)) {
            case 3;
                list($r, $g, $b) = sscanf($values, "%1s%1s%1s");
                $rgba = [hexdec("$r$r"), hexdec("$g$g"), hexdec("$b$b")];
                break;
            case 6;
                $rgba = array_map('hexdec', sscanf($values, "%2s%2s%2s"));
                break;
            default:
                throw new HexToRgbaException();
        }

        $rgba[] = $this->alpha;

        return sprintf('rgba(%s)', implode(', ', $rgba));
    }
}