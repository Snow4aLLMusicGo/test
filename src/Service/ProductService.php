<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductService
{
    private $httpClient;
    private $baseUrl;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = 'http://api.tmparts.ru';
        $this->apiKey = $apiKey;
    }

    public function searchByArticle(string $article): array
    {
        $response = $this->httpClient->request('GET', $this->baseUrl . '/StockByArticle', [
            'query' => [
                'Article' => $article
            ],
            'headers' => [
                'X-Api-Key' => $this->apiKey
            ]
        ]);

        $productData = $response->toArray();

        
        $responseData = [
            'brand' => $productData[0]['brand'] ?? null,
            'article' => $productData[0]['article'] ?? null,
            'name' => $productData[0]['article_name'] ?? null,
            'quantity' => (int) $productData[0]['warehouse_offers'][0]['quantity'] ?? null,
            'price' => (float) $productData[0]['warehouse_offers'][0]['price'] ?? null,
            'delivery_duration' => (float) $productData[0]['warehouse_offers'][0]['delivery_period'] ?? null,
            'vendorId' => (float) $productData[0]['vendorId'] ?? null,
            'warehouseAlias' => (float) $productData[0]['warehouseAlias'] ?? null
        ];

        return $responseData;
    }
}
