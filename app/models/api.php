<?php

class Api {
    private $omdbApiKey = 'f9f6d42b';

    public function getMovieDetails($imdbID) {
        $url = "http://www.omdbapi.com/?apikey={$this->omdbApiKey}&i={$imdbID}";
        $response = file_get_contents($url);
        if ($response !== false) {
            $data = json_decode($response, true);
            return $data;
        }
        return null;
    }
}
