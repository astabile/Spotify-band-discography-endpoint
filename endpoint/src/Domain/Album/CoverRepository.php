<?php

declare(strict_types=1);

namespace App\Domain\Album;

interface CoverRepository
{
    /**
     * @return Cover[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Cover
     * @throws CoverNotFoundException
     */
    public function findCoverOfId(int $id): Cover;
}
