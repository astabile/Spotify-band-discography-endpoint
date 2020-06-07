<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\SpotifyWebAPI\SearchArtistAPI;
use App\Domain\SpotifyWebAPI\TokenAPI;
use App\Domain\SpotifyWebAPI\AlbumAPI;
use App\Domain\Album\Album;
use App\Domain\Album\Cover;
use App\Domain\SpotifyWebAPI\SearchAPI;
use App\Domain\SpotifyWebAPI\ArtistAPI;
use GuzzleHttp\Client;

// https://developer.spotify.com/dashboard/applications/a268e150dca64df8bfbc478377a023e3

class SpotifyWebAPI implements ISpotifyWebAPI
{

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $authorization;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var TokenAPI
     */
    private $token;

    public function __construct()
    {
        $this->clientId = 'a268e150dca64df8bfbc478377a023e3';
        $this->clientSecret = '3d21fec0a1d64b14a1cb00d2c2ad41cd';
        $this->authorization = 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret);
        $this->token = new TokenAPI();
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        if ($this->token->isValidToken())
            return $this->token->getAccessToken();

        $client = new Client(['base_uri' => 'https://accounts.spotify.com']);

        $response = $client->request('POST', '/api/token', [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization'     => $this->authorization
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        $json = $response->getBody()->getContents();

        $this->token->map($json);
        $this->token->setExpirationTime();

        return $this->token->getAccessToken();
    }

    /**
     * @param string $name
     * @return SearchArtistAPI
     */
    public function getArtistByName(string $name): SearchArtistAPI
    {
        $client = new Client(['base_uri' => 'https://api.spotify.com']);

        $response = $client->request('GET', '/v1/search?q=' . urlencode($name) . '&type=artist&offset=0', [
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization'     => $this->getAccessToken()
            ]
        ]);

        $json = $response->getBody()->getContents();

        $search = new SearchArtistAPI();
        $search->map($json);

        return $search;
    }

    /**
     * @param string $id
     * @return array
     */
    private function getAlbumsByArtistId(string $id): array
    {
        $client = new Client(['base_uri' => 'https://api.spotify.com']);

        $response = $client->request('GET', 'v1/artists/' . $id . '/albums?market=ES', [
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization'     => $this->getAccessToken()
            ]
        ]);

        $json = $response->getBody()->getContents();

        $search = new SearchAPI();
        $search->map($json);

        return $search->getAlbumItems();
    }

    /**
     * @param string $name
     * @return array
     */
    public function getAlbumsByArtistName(string $name): array
    {
        $searchArtistResult = $this->getArtistByName($name);

        $artist = $searchArtistResult->getFistArtist();

        $albums = $this->getAlbumsByArtistId($artist->getId());

        $result = [];
        foreach ($albums as $albumAPI) {
            $name = $albumAPI->getName();
            $releaseDate = $albumAPI->getReleaseDate();
            $totalTracks = $albumAPI->getTotalTracks();

            $cover = $albumAPI->getCover();
            $height = $cover->getHeight();
            $width = $cover->getWidth();
            $url = $cover->getUrl();

            $album = new Album($name, $releaseDate, $totalTracks, new Cover($height, $width, $url));
            array_push($result, $album);
        }

        return $result;
    }
}
