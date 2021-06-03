<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository
{

    public function getProducts(string $id): array
    {
        $productsTable = [];

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.product');
        //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product){
            $productsTable[] = new Product(
                $product['title'],
                $product['description'],
                $product['image']
            );
        }
        //echo "".$productsTable[1]->getDescription();

        //echo "działa!!!".$product['title'];

        return $productsTable;
    }

    public function addProduct(Product $product) {
        $stmt = $this->database->connect()->prepare('INSERT INTO product (title, description, id_assigned_by, image ) VALUES (?, ?, ?, ?)');

        $assignedById = 2;
        $stmt->execute([
            $product->getTitle(),
            $product->getDescription(),
            $assignedById,
            $product->getImage()
        ]);
    }
}