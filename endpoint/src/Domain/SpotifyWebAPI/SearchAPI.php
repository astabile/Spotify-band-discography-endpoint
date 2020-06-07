<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class SearchAPI extends ObjectAPI
{
    /**
     * @var string
     */
    protected $href;

    /**
     * @var array
     */
    public $items;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $next;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var string
     */
    protected $previous;

    /**
     * @var int
     */
    protected $total;

    /**
     * @return array
     */
    public function getArtistItems()
    {
        $result = [];
        foreach($this->items as $item){
            $artistAPI = new ArtistAPI();
            $artistAPI->map(json_encode($item));
            array_push($result, $artistAPI);
        }
        
        return $result;
    }

    /**
     * @return array
     */
    public function getAlbumItems()
    {
        $result = [];
        foreach($this->items as $item){
            $albumAPI = new AlbumAPI();
            $albumAPI->map(json_encode($item));
            array_push($result, $albumAPI);
        }
        
        return $result;
    }
}
