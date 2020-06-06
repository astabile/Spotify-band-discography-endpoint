<?php
declare(strict_types=1);

namespace App\Application\Actions\Album;

use App\Application\Actions\Action;
use App\Domain\Album\AlbumRepository;
use Psr\Log\LoggerInterface;

abstract class AlbumAction extends Action
{
    /**
     * @var AlbumRepository
     */
    protected $albumRepository;

    /**
     * @param LoggerInterface $logger
     * @param AlbumRepository  $albumRepository
     */
    public function __construct(LoggerInterface $logger, AlbumRepository $albumRepository)
    {
        parent::__construct($logger);
        $this->albumRepository = $albumRepository;
    }
}
