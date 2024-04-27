<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchController extends AbstractController
{
private $client;

public function __construct(HttpClientInterface $client)
{
$this->client = $client;
}

public function searchByArticle(string $article): JsonResponse
{
// отправляем GET-запрос на ресурс StockByArticle
$response = $this->client->request(
'GET',
'http://api.tmparts.ru/api/v1/StockByArticle',
[
'query' => [
'Article' => $article,
'api_key' => 'ваш_api_ключ',
],
]
);

// получаем статусный код ответа
$statusCode = $response->getStatusCode();

// если статусный код ответа равен 200, то парсим ответ в формате JSON
if ($statusCode == 200) {
$data = json_decode($response->getContent(), true);

// формируем массив с нужными данными
$result = [];
foreach ($data as $item) {
$result[] = [
'brand' => $item['brand'],
'article' => $item['article'],
'name' => $item['article_name'],
'quantity' => $item['quantity'],
'price' => $item['min_price'],
'delivery_duration' => $item['delivery_period'],
'vendorId' => $item['id'],
'warehouseAlias' => $item['warehouse_code'],
];
}

// возвращаем ответ в формате JSON
return new JsonResponse($result);
} else {
// если статусный код ответа не равен 200, то возвращаем ошибку
return new JsonResponse(['error' => 'Не удалось получить данные'], Response::HTTP_BAD_REQUEST);
}
}
}
