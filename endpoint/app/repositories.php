<?php

declare(strict_types=1);

use App\Domain\Album\AlbumRepository;
use App\Application\ISpotifyWebAPI;
use App\Application\SpotifyWebAPI;
use App\Infrastructure\Persistence\Album\InMemoryAlbumRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our AlbumRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        AlbumRepository::class => \DI\autowire(InMemoryAlbumRepository::class),
        ISpotifyWebAPI::class => \DI\autowire(SpotifyWebAPI::class)
    ]);
};
