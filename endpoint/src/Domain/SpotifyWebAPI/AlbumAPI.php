<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class AlbumAPI extends ObjectAPI
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
