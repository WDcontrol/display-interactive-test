<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PurchaseRepository;

class PurchaseController extends AbstractController
{
    #[Route('/customers/{customer_id}/purchases', name: 'customer_purchases', methods: ['GET'])]
    public function getCustomerPurchases(PurchaseRepository $purchaseRepository, int $customer_id): Response
    {
        $purchases = $purchaseRepository->findBy(['customer_id' => $customer_id]);
        return $this->json($purchases);
    }
}
