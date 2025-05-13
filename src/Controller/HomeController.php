<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        $products=$productRepository->findAll();
        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }
    #[Route('/details-produit/{id}', name: 'product_show')]
    public function product_show(Product $product){
        return $this->render('home/show_product.html.twig', [
            'product' => $product,
        ]);
    }
}
