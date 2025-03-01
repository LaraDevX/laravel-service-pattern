<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Repositories\BookRepositoryInterface;


class BookService extends BaseService implements BookServiceInterface
{
    public function __construct(protected BookRepositoryInterface $bookRepository)
    {
        //
    }
    public function getAllBooks($num){
        return $this->bookRepository->getAllBooks($num);
    }
    public function createBook($bookDTO){
        $translations = $this->prepareTranslations(['translations' => $bookDTO->translations], ['title','content']);
        $data = [
            'user_id' => $bookDTO->user_id,
            'images' => $bookDTO->images,
            'translations' => $translations
        ];
        return $this->bookRepository->createBook($data);
    }
    public function getBookById($id){
        return $this->bookRepository->getBookById($id);
    }
    public function updateBook($bookDTO, $id){
        if(Auth::id() !== $bookDTO->user_id){
            return $this->error(__('errors.book.forbidden'), 403);
        }
        $translations = $this->prepareTranslations(['translations' => $bookDTO->translations], ['title','content']);
        $data = [
            'user_id' => $bookDTO->user_id,
            'images' => $bookDTO->images,
            'translations' => $translations
        ];
        return $this->bookRepository->updateBook($data, $id);
    }
    public function deleteBook($id){
        return $this->bookRepository->deleteBook($id);
    }

}
