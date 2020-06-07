<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class SearchArtistAPI extends ObjectAPI
{
    /**
     * @var object
     */
    public $artists;

    /**
     * @return ArtistAPI
     */
    public function getFistArtist(): ArtistAPI
    {
        $searchAPI = new SearchAPI();
        $searchAPI->map(json_encode($this->artists));
        
        $items = $searchAPI->getArtistItems();

        if(count($items) == 0)
            return null;
        
        return $items[0];
    }
}