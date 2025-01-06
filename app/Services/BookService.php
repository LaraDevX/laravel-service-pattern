<?php

namespace App\Services;

use App\Interfaces\Repositories\BookRepositoryInterface;
use App\Interfaces\Services\BookServiceInterface;
use App\Traits\ResponseTrait;


class BookService implements BookServiceInterface
{
    use ResponseTrait;
    public function __construct(protected BookRepositoryInterface $bookRepository)
    {
        //
    }
    public function getAllBooks($num){
        return $this->bookRepository->getAllBooks($num);
    }
    public function createBook($bookDTO){
        $translations = $this->prepareTranslations(['translations' => $bookDTO->translations], ['title' => $bookDTO->title, 'content' => $bookDTO->content]);
        $data = [
            'user_id' => $bookDTO->user_id,
            'images' => $bookDTO->images,
            'translations' => $translations
        ];
        return $this->bookRepository->createBook($data);
    }
    public function getBookById($id){

    }
    public function updateBook($bookDTO, $id){

    }
    public function deleteBook($id){

    }

}
