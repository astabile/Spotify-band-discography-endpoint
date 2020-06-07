<?php

declare(strict_types=1);

namespace App\Application\Actions\Album;

use Psr\Http\Message\ResponseInterface as Response;

class ViewAlbumAction extends AlbumAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $albumId = (int) $this->resolveArg('id');
        $album = $this->albumRepository->findAlbumOfId($albumId);

        $this->logger->info("Album of id `${albumId}` was viewed.");

        return $this->respondWithData($album);
    }
}
