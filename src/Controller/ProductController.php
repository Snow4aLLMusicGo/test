<?php 
namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function searchByArticle(Request $request): JsonResponse
    {
     
        $article = $request->query->get('article');

        
        if (!$article) {
          
            return new JsonResponse(['error' => 'Article parameter is missing'], 400);
        }

        try {
            
            $responseData = $this->productService->searchByArticle($article);
            return new JsonResponse($responseData);
        } catch (\Exception $e) {
                        return new JsonResponse(['error' => 'Failed to search product: ' . $e->getMessage()], 500);
        }
    }
}