<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

use DateTime;
use DateInterval;

class TokenAPI extends ObjectAPI
{
    /**
     * @var string
     */
    protected $access_token;

    /**
     * @var string
     */
    protected $token_type;

    /**
     * @var int
     */
    protected $expires_in;

    /**
     * @var string
     */
    protected $scope;

    /**
     * @var Datetime
     */
    protected $expiration_time;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return 'Bearer ' . $this->access_token;
    }

    /**
     * @return string
     */
    public function setExpirationTime(): void
    {
        $this->expiration_time = new DateTime();
        $this->expiration_time->add(new DateInterval('PT' . $this->expires_in . 'S'));
    }

    /**
     * @return bool
     */
    public function isValidToken(): bool
    {

        if ($this->access_token == '')
            return false;
        
        $now = new Datetime();
        if($now > $this->expiration_time)
            return false;
        
        return true;
    }
}
