<?php
namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class ProductService
{
    private $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @throws \Exception
     */
    public function searchByArticle(string $article, string $apiKey): array
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $this->apiUrl . 'StockByArticle', [
            'query' => [
                'Article' => $article,
                'api_key' => $apiKey
            ]
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode !== Response::HTTP_OK) {
            throw new \Exception('Failed to fetch data from API');
        }

        $data = $response->toArray();

        // Проверка на наличие данных
        if (empty($data)) {
            throw new \Exception('No data found for the provided article');
        }

        return $data;
    }
}
