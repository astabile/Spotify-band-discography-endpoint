<?php
declare(strict_types=1);

namespace App\Domain\Album;

interface AlbumRepository
{
    /**
     * @return Album[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Album
     * @throws AlbumNotFoundException
     */
    public function findAlbumOfId(int $id): Album;
}
