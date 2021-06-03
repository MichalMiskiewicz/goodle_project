<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../repository/ProductRepository.php';
class ProductController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }


    public function addProduct(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $product = new Product($_POST['name'], $_POST['description'], $_FILES['file']['name']);
            $this->productRepository->addProduct($product);

            return $this->render('products', ["messages" => $this->messages, 'product' => $product]);
        }


        $this->render('addproduct', ["messages" => $this->messages]);
    }

    public function showProduct(){
        if ($this->isPost()) {
            return $this->render('products', ["messages" => $this->messages, 'product' =>  $this->productRepository->getProduct(1)]);
        }

    }

    private function validate($file): bool{
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is too large!';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'File type is not supported';
            return false;
        }

        return true;
    }
}