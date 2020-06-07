<?php

declare(strict_types=1);

namespace App\Application\Actions\Album;

use App\Domain\SpotifyWebAPI\TokenAPI;
use Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;

class ListAlbumsAction extends AlbumAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $albums = $this->spotifyWebAPI->getAlbumsByArtistName("Yngwie Malmsteen");

        return $this->respondWithData($albums);
    }
}
