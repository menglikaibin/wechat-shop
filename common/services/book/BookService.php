<?php

namespace app\common\services\book;

use app\models\book\Book;
use app\models\book\BookStockChangeLog;
use app\common\services\BaseService;

class BookService extends BaseService
{
    public static function getStockChangeLog($book_id=0, $unit=0, $note='')
    {
        if (!$book_id || !$unit) {
            return false;
        }

        $info = Book::find()->where(['id' => $book_id])->one();
        if (!$info) {
            return false;
        }

        $model_stock = new BookStockChangeLog();
        $model_stock->book_id = $book_id;
        $model_stock->unit = $unit;
        $model_stock->total_stock = $info['stock'];
        $model_stock->note = $note;
        $model_stock->created_time = date('Y-m-d H:i:s');
        return $model_stock->save(false);
    }
}