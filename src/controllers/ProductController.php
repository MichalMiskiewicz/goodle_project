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
        parent::cookie();
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $product = new Product($_POST['name'], $_POST['description'], $_FILES['file']['name']);
            $this->productRepository->addProduct($product);
            header("Location: http://$_SERVER[HTTP_HOST]/products");

        }else{
            $this->render('addproduct', ["messages" => $this->messages]);
        }
    }

    public function products(){
        parent::cookie();
        $this->render('products', ['messages' => $this->messages, 'products' =>
            $this->productRepository->getProducts("all")]);

    }

    public function favourites(){
        parent::cookie();
        $this->render('products', ['messages' => $this->messages, 'products' =>
            $this->productRepository->getProducts("favourites")]);
    }

    public function search(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->productRepository->getProductByKeywords($decoded['search']));
        }
    }

    public function like(int $id){
        if(($this->productRepository->checkLikeDislike($id, "like") == null)) {
            $this->productRepository->like($id);
            echo json_encode($this->productRepository->checkLikeDislike($id, "like")[0]);
        }else{
            $this->productRepository->deleteStatisticRowAndUpdateProduct($id, "like");
            echo json_encode(array('like' => 'null'));
        }
        http_response_code(200);

    }

    public function dislike(int $id){
        if(($this->productRepository->checkLikeDislike($id, "dislike") == null)) {
            $this->productRepository->dislike($id);
            echo json_encode($this->productRepository->checkLikeDislike($id, "dislike")[0]);
        }else{
            $this->productRepository->deleteStatisticRowAndUpdateProduct($id, "dislike");
            echo json_encode(array('dislike' => 'null'));
        }
        http_response_code(200);
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