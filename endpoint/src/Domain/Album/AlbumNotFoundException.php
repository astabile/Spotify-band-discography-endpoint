<?php
declare(strict_types=1);

namespace App\Domain\Album;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AlbumNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The album you requested does not exist.';
}
