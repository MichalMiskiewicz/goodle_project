<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository
{

    public function getProduct(string $id): ?Product
    {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.product WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product == false) {
            return null;
        }
        echo "działa!!!";
        return new Product(
            $product['title'],
            $product['description'],
            $product['image']
        );
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