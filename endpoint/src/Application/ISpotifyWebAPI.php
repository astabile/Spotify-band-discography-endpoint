<?php

declare(strict_types=1);

namespace App\Application;
use App\Domain\SpotifyWebAPI\SearchArtistAPI;

interface ISpotifyWebAPI
{
     /**
     * @param string $name
     * @return array
     */
    public function getAlbumsByArtistName(string $name): array;
}