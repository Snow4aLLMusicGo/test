<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends AbstractController
{
    private $httpClient;
    private $baseUrl;
    private $apiKey;

    // Конструктор класса
    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = 'http://api.tmparts.ru';
        $this->apiKey = $apiKey;
    }

    // Метод для поиска товара по артикулу
    public function searchByArticle(Request $request): JsonResponse
    {
        // Получаем артикул товара из запроса
        $article = $request->query->get('article');

        // Проверяем, был ли передан артикул
        if (!$article) {
            // Если артикул не был передан, возвращаем сообщение об ошибке
            return new JsonResponse(['error' => 'Article parameter is missing'], 400);
        }

        try {
            // Отправляем GET-запрос к ресурсу StockByArticle
            $response = $this->httpClient->request('GET', $this->baseUrl . '/StockByArticle', [
                'query' => [
                    'Article' => $article
                ],
                'headers' => [
                    'X-Api-Key' => $this->apiKey
                ]
            ]);

            // Обрабатываем ответ
            $productData = $response->toArray();

            // Формируем массив с данными
            $responseData = [
                'brand' => $productData[0]['brand'] ?? null,
                'article' => $productData[0]['article'] ?? null,
                'name' => $productData[0]['article_name'] ?? null,
                'quantity' => (int) ($productData[0]['warehouse_offers'][0]['quantity'] ?? null),
                'price' => (float) ($productData[0]['warehouse_offers'][0]['price'] ?? null),
                'delivery_duration' => (float) ($productData[0]['warehouse_offers'][0]['delivery_period'] ?? null),
                'vendorId' => (float) ($productData[0]['vendorId'] ?? null),
                'warehouseAlias' => (float) ($productData[0]['warehouseAlias'] ?? null)
            ];

            // Возвращаем данные о товаре в формате JSON
            return new JsonResponse($responseData);
        } catch (\Exception $e) {
            // Если произошла ошибка, возвращаем сообщение об ошибке
            return new JsonResponse(['error' => 'Failed to search product: ' . $e->getMessage()], 500);
        }
    }
}
