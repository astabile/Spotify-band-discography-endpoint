<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class CoverAPI extends ObjectAPI
{
    /**
     * @var int
     */

    protected $height;

    /**
     * @var int
     */

    protected $width;

    /**
     * @var string
     */
    protected $url;

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
}
