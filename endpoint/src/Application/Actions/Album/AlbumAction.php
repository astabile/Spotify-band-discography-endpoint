<?php
declare(strict_types=1);

namespace App\Application\Actions\Album;

use App\Application\Actions\Action;
use App\Domain\Album\AlbumRepository;
use App\Application\SpotifyWebAPI;
use Psr\Log\LoggerInterface;

abstract class AlbumAction extends Action
{
    /**
     * @var SpotifyWebAPI
     */
    protected $spotifyWebAPI;

    /**
     * @var AlbumRepository
     */
    protected $albumRepository;

    /**
     * @param LoggerInterface $logger
     * @param AlbumRepository  $albumRepository
     * @param SpotifyWebAPI  $spotifyWebAPI
     */
    public function __construct(LoggerInterface $logger, AlbumRepository $albumRepository, SpotifyWebAPI $spotifyWebAPI)
    {
        parent::__construct($logger);
        $this->albumRepository = $albumRepository;
        $this->spotifyWebAPI = $spotifyWebAPI;
    }
}
