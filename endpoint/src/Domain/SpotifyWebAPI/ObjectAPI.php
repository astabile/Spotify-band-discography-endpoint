<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class ObjectAPI
{
    public function map(string $json)
    {
        $data = json_decode($json);

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
            
    }
}
