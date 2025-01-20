<?php

namespace app\Controllers;

use app\Models\Log;
use app\Helpers\Translator;
use DateTime;
use Exception;

class Movies
{
    private $model;
    private $language;

    public function __construct()
    {
        $this->model = new Log();
        $language = $_SESSION['language'] ?? 'en';
        $this->translator = new Translator($language);
    }

    public function index()
    {
        return MainController::view('home',);
    }

    public function movieIndex($filmId)
    {
        try {
            $response = $this->callApi('https://swapi.py4e.com/api/films/' . $filmId);
            $data = json_decode($response, true);
            if ($data === null || !isset($data['title'])) {
                throw new Exception("Filme não encontrado.", 404);
            }
            $filmData = $this->formatMovieData($data, 'movie', $filmId);
            return MainController::view('movie', ['filmData' => $filmData]);
        } catch (Exception $e) {
            if ($e->getCode() === 404) {
                http_response_code(404);
                return MainController::view('errors/404', ['message' => $e->getMessage()]);
            }
            http_response_code(500);
            return MainController::view('errors/500', ['message' => $e->getMessage()]);
        }
    }

    public function docs()
    {
        return MainController::view('docs');
    }

    public function getMovies()
    {
        header('Content-Type: application/json');
        $sort = $_GET['sort'] ?? 'date_asc';
        try {
            $response = $this->callApi('https://swapi.py4e.com/api/films');
            $data = json_decode($response, true);
            if ($data === null || !isset($data['results'])) {
                throw new Exception("Erro ao obter os filmes.", 500);
            }

            $movies = $this->formatMovieData($data['results'], 'movies');
            $sortedMovies = $this->sortMovies($sort, $movies);
            echo json_encode([
                'status' => 'success',
                'code' => http_response_code(200),
                'message' => 'Filmes obtidos com sucesso.',
                'data' => $sortedMovies
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            $this->model->save("Erro ao obter os filmes.");
        }
    }

    public function getMovie($filmId)
    {
        header('Content-Type: application/json');
        try {
            $response = $this->callApi('https://swapi.py4e.com/api/films/' . $filmId);
            $data = json_decode($response, true);
            if ($data === null || !isset($data['title'])) {
                throw new Exception("Filme não encontrado.", 404);
            }
            $this->model->save("Dados do filme ID: " . $filmId . " obtidos com sucesso.");
            $filmData = $this->formatMovieData($data, 'movie', $filmId);
            echo json_encode([
                'status' => 'success',
                'code' => http_response_code(200),
                'message' => "Filme ID: " . $filmId . " obtido com sucesso.",
                'data' => $filmData
            ]);
        } catch (Exception $e) {
            if ($e->getCode() === 404) {
                http_response_code(404);
                return MainController::view('error_404', ['message' => $e->getMessage()]);
            }
            $this->model->save("Erro ao obter os dados do filme ID: " . $filmId);
        }
    }

    public function getTranslations()
    {
        header('Content-Type: application/json');
        try {
            $this->model->save("Traduções obtidas com sucesso.");
            echo json_encode($this->translator->getTranslations());
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            $this->model->save("Erro ao obter as traduções.");
        }
    }

    private function callApi($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception("Erro cURL: " . curl_error($ch));
            $this->model->save("Erro cURL: " . curl_error($ch));
        }

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        curl_close($ch);

        return $body;
    }

    private function formatMovieData($data, $type, $filmId = null)
    {
        if ($type === 'movies') {
            $movies = [];
            foreach ($data as $movie) {
                $urlParts = explode('/', rtrim($movie['url'], '/'));
                $filmId = end($urlParts);
                $translatedTitle = $this->getTranslation(strtolower(str_replace(' ', '_', $movie['title'])), 'title');
                $movies[] = [
                    'film_id' => $filmId,
                    'title' => $translatedTitle,
                    'episode_id' => $movie['episode_id'],
                    'release_date' => date('d/m/Y', strtotime($movie['release_date'])),
                ];
            }
            return $movies;
        }

        if ($type === 'movie') {
            $translatedTitle = $this->getTranslation(strtolower(str_replace(' ', '_', $data['title'])), 'title');
            $translatedCrawl = $this->getTranslation("ep" . $data['episode_id'] . "_opening_crawl", 'opening_crawl');

            $movie = [
                'film_id' => $filmId,
                'title' => $translatedTitle,
                'episode_id' => $data['episode_id'],
                'release_date' => date('d/m/Y', strtotime($data['release_date'])),
                'opening_crawl' => $translatedCrawl,
                'director' => $data['director'],
                'producer' => $data['producer'],
                'characters' => $this->getCharactersNames($data['characters']),
                'film_age' => $this->getDateInterval($data['release_date'])
            ];

            return $movie;
        }
    }

    private function sortMovies($sort, $movies)
    {
        switch ($sort) {
            case 'title':
                $this->model->save("Filmes ordenados por título.");
                usort($movies, function ($a, $b) {
                    return strcasecmp($a['title'], $b['title']);
                });
                break;
            case 'date_asc':
                $this->model->save("Filmes ordenados por data de lançamento crescente.");
                usort($movies, function ($a, $b) {
                    return strtotime($a['release_date']) - strtotime($b['release_date']);
                });
                break;
            case 'date_desc':
                $this->model->save("Filmes ordenados por data de lançamento decrescente.");
                usort($movies, function ($a, $b) {
                    return strtotime($b['release_date']) - strtotime($a['release_date']);
                });
                break;
            case 'ep_asc':
                $this->model->save("Filmes ordenados por episódio crescente.");
                usort($movies, function ($a, $b) {
                    return $a['episode_id'] - $b['episode_id'];
                });
                break;
            case 'ep_desc':
                $this->model->save("Filmes ordenados por episódio decrescente.");
                usort($movies, function ($a, $b) {
                    return $b['episode_id'] - $a['episode_id'];
                });
                break;
            default:
                break;
        }
        return $movies;
    }

    private function getDateInterval($releaseDate)
    {
        $releaseDate = new DateTime($releaseDate);
        $currentDate = new DateTime();
        $interval = $currentDate->diff($releaseDate);

        $years = $this->translator->translate('years');
        $months = $this->translator->translate('months');
        $days = $this->translator->translate('days');

        return $interval->format("%y {$years}, %m {$months} {$this->translator->translate('and')} %d {$days}");
    }

    private function getCharactersNames($characters)
    {
        $charactersNames = [];
        foreach ($characters as $character) {
            $characterData = json_decode($this->callApi($character));
            $charactersNames[] = $characterData->name;
            $this->model->save("Personagem: " . $characterData->name . " obtido com sucesso.");
        }
        return $charactersNames;
    }

    private function getTranslation($translationKey, $stringType)
    {
        if ($stringType === 'title') {
            return $this->translator->translate($translationKey);
        }

        if ($stringType === 'opening_crawl') {
            return $this->translator->translate($translationKey);
        }
    }
}
