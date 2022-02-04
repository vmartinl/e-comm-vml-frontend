<?php

namespace App\Controller;

use App\Network\BackendClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(BackendClient $client): Response
    {
        $productsResponse = $client->getClient()->get('/products');
        if ($productsResponse->getStatusCode() !== Response::HTTP_OK) {
            $this->createNotFoundException("No products found !");
        }

        return $this->render('products/index.html.twig', [
            'products' => json_decode($productsResponse->getBody()),
        ]);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function product(BackendClient $client, int $id): Response
    {
        $productResponse = $client->getClient()->get(sprintf('/product/%d', $id));
        if ($productResponse->getStatusCode() === Response::HTTP_OK) {
            return $this->render('products/product.html.twig', [
                'product' => json_decode($productResponse->getBody()),
            ]);
        }

        $this->createNotFoundException("Product not found !");
    }
}
