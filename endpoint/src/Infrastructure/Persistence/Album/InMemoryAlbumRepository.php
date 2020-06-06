<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Album;

use App\Domain\Album\Album;
use App\Domain\Album\Cover;
use App\Domain\Album\AlbumNotFoundException;
use App\Domain\Album\AlbumRepository;
use App\Domain\Album\CoverNotFoundException;
use App\Domain\Album\CoverRepository;

class InMemoryAlbumRepository implements AlbumRepository
{
    /**
     * @var Album[]
     */
    private $albums;

    /**
     * InMemoryAlbumRepository constructor.
     *
     * @param array|null $albums
     */
    public function __construct(array $albums = null)
    {
        $this->albums = $albums ?? [
            1 => new Album('Blue Lightning', '2019-03-29', 12, new Cover(640, 640, 'https://i.scdn.co/image/ab67616d0000b2731d67110d7606d2318f51954d')),
            2 => new Album('World on Fire', '2016-06-02', 11, new Cover(640, 640, 'https://i.scdn.co/image/ab67616d0000b273d861cf2263b191bfc06ddc29'))
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->albums);
    }

    /**
     * {@inheritdoc}
     */
    public function findAlbumOfId(int $id): Album
    {
        if (!isset($this->albums[$id])) {
            throw new AlbumNotFoundException();
        }

        return $this->albums[$id];
    }
}
