<?php

declare(strict_types=1);

namespace App\Domain\SpotifyWebAPI;

class AlbumAPI extends ObjectAPI
{
    /**
     * @var string
     */

    protected $name;

    /**
     * @var string
     */

    protected $release_date;

    /**
     * @var int
     */
    protected $total_tracks;

     /**
     * @var array
     */
    public $images;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->release_date;
    }

    /**
     * @return int
     */
    public function getTotalTracks(): int
    {
        return $this->total_tracks;
    }

    /**
     * @return CoverAPI
     */
    public function getCover(): CoverAPI
    {
        $result = [];
        foreach($this->images as $image){
            $coverAPI = new CoverAPI();
            $coverAPI->map(json_encode($image));
            array_push($result, $coverAPI);
        }
        
        return $result[0];
    }
}