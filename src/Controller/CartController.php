<?php

namespace App\Controller;

use App\Network\BackendClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(BackendClient $client): Response
    {
        $cartResponse = $client->getClient()->get(sprintf('/cart'));
        if ($cartResponse->getStatusCode() === Response::HTTP_OK) {
            return $this->render('cart/index.html.twig', [
                'cart' => json_decode($cartResponse->getBody()),
            ]);
        }

        $this->createNotFoundException("Error while fetching cart !");
    }
}
