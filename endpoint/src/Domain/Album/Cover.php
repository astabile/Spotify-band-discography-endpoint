<?php
declare(strict_types=1);

namespace App\Domain\Album;

use JsonSerializable;

class Cover implements JsonSerializable
{
    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var string
     */
    private $url;

    /**
     * @param int    $height
     * @param int    $width
     * @param string $url
     */
    public function __construct(int $height, int $width, string $url)
    {
        $this->height = $height;
        $this->width = $width;
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'url' => $this->url
        ];
    }
}