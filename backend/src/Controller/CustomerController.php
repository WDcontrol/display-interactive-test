<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CustomerRepository;

class CustomerController extends AbstractController
{
    #[Route('/customers', name: 'get_customers', methods: ['GET'])]
    public function getCustomers(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();
        return $this->json($customers);
    }
}