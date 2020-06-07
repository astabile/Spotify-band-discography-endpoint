<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class ArtistAPI extends ObjectAPI
{
    /**
     * @var string
     */
    protected $href;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */

    protected $name;

    /**
     * @var int
     */
    protected $popularity;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
