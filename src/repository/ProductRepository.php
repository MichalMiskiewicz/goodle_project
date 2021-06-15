<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Product.php';

class ProductRepository extends Repository
{

    public function getProducts(string $x): array
    {
        $pdo = $this->database->connect();
        $productsTable = [];
        if ($x == "all") {
            $stmt = $pdo->prepare('SELECT * FROM public.product');
        }else {
            $stmt = $pdo->prepare('SELECT * FROM public.product p 
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
                $product['id'],
                $product['id_assigned_by']
            );
        }
        return $productsTable;
    }

    public function addProduct(Product $product) {
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('INSERT INTO product (title, description, id_assigned_by, image ) 
                                                        VALUES (?, ?, ?, ?)');
        $assignedById = (int)explode('@id', $_COOKIE['accept'])[1];

        $pdo->beginTransaction();
        try {
        $stmt->execute([
            $product->getTitle(),
            $product->getDescription(),
            $assignedById,
            $product->getImage()
        ]);
            $pdo->commit();
        }
        catch (Exception $e) {
            $pdo->rollBack();
        }
    }

    public function deleteProduct($id) {
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('DELETE FROM public.product WHERE id = :id AND 
                                                           id_assigned_by = :iduser;');

        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt->bindParam(':iduser', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getProductByKeywords(string $search){
        $pdo = $this->database->connect();
        $search = '%'.strtolower($search).'%';
        $stmt = $pdo->prepare('SELECT * FROM public.product WHERE LOWER(title) 
                                                            LIKE :search OR LOWER(description) LIKE :search;');
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id){
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('UPDATE public.product SET "like" = "like" + 1 WHERE id = :id');
        $stmt2 = $pdo->prepare('INSERT INTO public.users_product_statistics (id_user, id_product, "like") 
                                                            VALUES (:iduser, :id, 1)');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt2->bindParam(':iduser', $id_user, PDO::PARAM_INT);

        $pdo->beginTransaction();
        try {
            $stmt->execute();
            $stmt2->execute();
            $pdo->commit();
        }
        catch (Exception $e) {
            $pdo->rollBack();
        }

    }

    public function disLike(int $id){
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('UPDATE public.product SET "dislike" = "dislike" + 1 WHERE id = :id');
        $stmt2 = $pdo->prepare('INSERT INTO public.users_product_statistics (id_user, id_product, dislike) 
                                                            VALUES (:iduser, :id, 1)');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt2->bindParam(':iduser', $id_user, PDO::PARAM_INT);

        $pdo->beginTransaction();
        try {
            $stmt->execute();
            $stmt2->execute();
            $pdo->commit();
        }
        catch (Exception $e) {
            $pdo->rollBack();
        }
    }

    public function checkLikeDislike(int $id, string $x): ?array{
        $pdo = $this->database->connect();
        if($x == "like"){
            $stmt = $pdo->prepare('SELECT * FROM public.users_product_statistics 
                                                        WHERE id_user = :iduser AND id_product = :id AND "like" = 1;');
        }else{
            $stmt = $pdo->prepare('SELECT * FROM public.users_product_statistics 
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
        $pdo = $this->database->connect();
        $stmt =  $pdo->prepare('DELETE FROM public.users_product_statistics 
                                                            WHERE id_user = :iduser AND id_product = :id;');
        if($x == "like"){
            $stmt2 =  $pdo->prepare('UPDATE public.product SET "like" = "like" -1 
                                                                WHERE id = :id');
        }else{
            $stmt2 =  $pdo->prepare('UPDATE public.product SET "dislike" = dislike -1 
                                                                WHERE id = :id');
        }

        $id_user = (int)explode('@id', $_COOKIE['accept'])[1];
        $stmt->bindParam(':iduser', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $pdo->beginTransaction();
        try {
            $stmt2->execute();
            $pdo->commit();
        }
        catch (Exception $e) {
            $pdo->rollBack();
        }
    }
}