<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository
{

    public function getProducts(string $x): array
    {
        $productsTable = [];
        if ($x == "all") {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.product');
        }else {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.product p 
                                                        JOIN users_product_statistics ups ON p.id = ups.id_product 
                                                        WHERE ups.id_user = :iduser AND ups.like = 1;');
            $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
            $stmt->bindParam(':iduser', $id_user, PDO::PARAM_INT);
        }
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product){
            $productsTable[] = new Product(
                $product['title'],
                $product['description'],
                $product['image'],
                $product['like'],
                $product['dislike'],
                $product['id']
            );
        }
        return $productsTable;
    }

    public function addProduct(Product $product) {
        $stmt = $this->database->connect()->prepare('INSERT INTO product (title, description, id_assigned_by, image ) 
                                                        VALUES (?, ?, ?, ?)');

        $assignedById = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt->execute([
            $product->getTitle(),
            $product->getDescription(),
            $assignedById,
            $product->getImage()
        ]);
    }

    public function getProductByKeywords(string $search){
        $search = '%'.strtolower($search).'%';
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.product WHERE LOWER(title) 
                                                            LIKE :search OR LOWER(description) LIKE :search;');
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id){
        $stmt = $this->database->connect()->prepare('UPDATE public.product SET "like" = "like" + 1 WHERE id = :id');
        $stmt2 = $this->database->connect()->prepare('INSERT INTO public.users_product_statistics (id_user, id_product, "like") 
                                                            VALUES (:iduser, :id, 1)');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt2->bindParam(':iduser', $id_user, PDO::PARAM_INT);

        $stmt->execute();
        $stmt2->execute();
    }

    public function disLike(int $id){
        $stmt = $this->database->connect()->prepare('UPDATE public.product SET "dislike" = "dislike" + 1 WHERE id = :id');
        $stmt2 = $this->database->connect()->prepare('INSERT INTO public.users_product_statistics (id_user, id_product, dislike) 
                                                            VALUES (:iduser, :id, 1)');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt2->bindParam(':iduser', $id_user, PDO::PARAM_INT);

        $stmt->execute();
        $stmt2->execute();
    }

    public function checkLikeDislike(int $id, string $x): ?array{
        if($x == "like"){
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.users_product_statistics 
                                                        WHERE id_user = :iduser AND id_product = :id AND "like" = 1;');
        }else{
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.users_product_statistics 
                                                    WHERE id_user = :iduser AND id_product = :id AND dislike = 1;');
        }
        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt->bindParam(':iduser', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $statistics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($statistics == null){
            return null;
        }else {
            return $statistics;
        }
    }

    public function deleteStatisticRowAndUpdateProduct(int $id, string $x){
        $stmt = $this->database->connect()->prepare('DELETE FROM public.users_product_statistics 
                                                            WHERE id_user = :iduser AND id_product = :id;');
        if($x == "like"){
            $stmt2 = $this->database->connect()->prepare('UPDATE public.product SET "like" = "like" -1 
                                                                WHERE id = :id');
        }else{
            $stmt2 = $this->database->connect()->prepare('UPDATE public.product SET "dislike" = dislike -1 
                                                                WHERE id = :id');
        }

        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt->bindParam(':iduser', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $stmt2->execute();
    }

    public function getFavourites(){
        $productsTable = [];

        $stmt = $this->database->connect()->prepare('SELECT * FROM public.product');
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product){
            $productsTable[] = new Product(
                $product['title'],
                $product['description'],
                $product['image'],
                $product['like'],
                $product['dislike'],
                $product['id']
            );
        }
        return $productsTable;
    }
}