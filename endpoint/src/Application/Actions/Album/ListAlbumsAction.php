<?php

declare(strict_types=1);

namespace App\Application\Actions\Album;

use Psr\Http\Message\ResponseInterface as Response;

class ListAlbumsAction extends AlbumAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $artistName = (string) $this->request->getQueryParams()['q'];
        
        if($artistName == '') {
            echo 'Empty artist. Try again.';
            die();
        }
        
        $albums = $this->spotifyWebAPI->getAlbumsByArtistName($artistName);

        return $this->respondWithData($albums);
    }
}
