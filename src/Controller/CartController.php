<?php
namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'cart_show')]
    public function show(Request $request, ProductRepository $productRepository): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);
        $cartWithData = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            if ($product) {
                $cartWithData[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
                $total += $product->getPrice() * $quantity;
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total
        ]);
    }

    #[Route('/add/{id}', name: 'cart_add')]
    public function add($id, Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/remove/{id}', name: 'cart_remove')]
    public function remove($id, Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        unset($cart[$id]);
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/clear', name: 'cart_clear')]
    public function clear(Request $request): Response
    {
        $request->getSession()->remove('cart');
        return $this->redirectToRoute('cart_show');
    }

    #[Route('/checkout', name: 'cart_checkout')]
    public function checkout(Request $request, ProductRepository $productRepository): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);
        $cartWithData = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            if ($product) {
                $cartWithData[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
                $total += $product->getPrice() * $quantity;
            }
        }

        // Optionnel : ici, tu pourrais enregistrer une commande en base (bonus)

        // On vide le panier après validation
        $session->remove('cart');

        return $this->render('cart/checkout.html.twig', [
            'items' => $cartWithData,
            'total' => $total,
        ]);
    }
}
