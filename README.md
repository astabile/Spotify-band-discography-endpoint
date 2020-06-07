# Spotify band discography endpoint

Using the Spotify API creates an endpoint to which by entering the name of the band an array of the entire discography is obtained.

Built with:

* Composer: https://getcomposer.org/download/
* Slim: http://www.slimframework.com/
* Guzzle: http://docs.guzzlephp.org/

Download the application. Install local composer dependencies. Run the application:

```
git clone https://github.com/astabile/Spotify-band-discography-endpoint.git
cd Spotify-band-discography-endpoint/endpoint
composer install
php -S localhost:8080 -t public public/index.php
```

Listening localhost in your browser...
Example: `http://localhost:8080/api/v1/albums?q=Malmsteen`.