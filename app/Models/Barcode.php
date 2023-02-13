<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table ='tbl_barcode';
    public function showdictionary(){
        return $this->belongsTo(Dictionary::class,'dictionary_id');
        // so sánh theo khóa phụ là category_id (cấu trúc 'tenbang','khoa phụ của bảng này model','khoa chinh của bảng tenbang')
        // belongto . mỗi barcode thuộc 1 dictionary, has many thì là thuộc nhiều
        // đoạn này hiểu là 1 barcode thuộc 1 dictionary
    }
}