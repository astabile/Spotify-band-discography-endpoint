<?php
declare(strict_types=1);

namespace App\Domain\Cover;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CoverNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The cover you requested does not exist.';
}
