<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table ='tbl_dictionary';
    public function showbarcode(){
        return $this->hasMany(Barcode::class,'dictionary_id')->orderBy('id','DESC');
        // đoạn này hiểu là 1 dictionary danh mục có nhiều barcode, quan hệ 1 nhiều nhé
        // so sánh theo khóa phụ là dictionary_id (cấu trúc 'tenbang','khoa phụ của bảng này model','khoa chinh của bảng tenbang')
        // belongto . mỗi barcode thuộc 1 dictionary, has many thì là thuộc nhiều
    }
}