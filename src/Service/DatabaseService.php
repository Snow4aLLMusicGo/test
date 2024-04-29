<?php

namespace App\Service;

use App\Entity\RequestData;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveData(array $requestData): void
    {
        $requestDataEntity = new RequestData();
        $requestDataEntity->setBrand($requestData['brand'] ?? null);
        $requestDataEntity->setArticle($requestData['article'] ?? null);
        $requestDataEntity->setName($requestData['name'] ?? null);
        $requestDataEntity->setQuantity($requestData['quantity'] ?? null);
        $requestDataEntity->setPrice($requestData['price'] ?? null);
        $requestDataEntity->setDeliveryDuration($requestData['delivery_duration'] ?? null);
        $requestDataEntity->setVendorId($requestData['vendorId'] ?? null);
        $requestDataEntity->setWarehouseAlias($requestData['warehouseAlias'] ?? null);

        $this->entityManager->persist($requestDataEntity);
        $this->entityManager->flush();
    }
}
