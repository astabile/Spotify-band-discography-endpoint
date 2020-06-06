<?php
declare(strict_types=1);

namespace App\Domain\Album;

use JsonSerializable;

class Album implements JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $released;

    /**
     * @var int
     */
    private $tracks;

    /**
     * @var Cover
     */
    private $cover;

    /**
     * @param string    $name
     * @param string    $released
     * @param int       $tracks
     * @param Cover     $cover
     */
    public function __construct(?string $name, string $released, int $tracks, Cover $cover)
    {
        $this->name = $name;
        $this->released = $released;
        $this->tracks = $tracks;
        $this->cover = $cover;
    }

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
    public function getReleased(): string
    {
        return $this->released;
    }

    /**
     * @return string
     */
    public function getTracks(): int
    {
        return $this->tracks;
    }

    /**
     * @return Cover
     */
    public function getCover(): Cover
    {
        return $this->cover;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'released' => $this->released,
            'tracks' => $this->tracks,
            'cover' => $this->cover
        ];
    }
}