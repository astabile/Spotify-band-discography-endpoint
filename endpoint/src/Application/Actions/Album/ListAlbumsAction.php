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
        $albums = $this->albumRepository->findAll();

        $this->logger->info("Albums list was viewed.");

        return $this->respondWithData($albums);
    }
}
