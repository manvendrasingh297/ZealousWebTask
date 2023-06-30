<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BookChapter;
use App\Models\Book;

class StudyPlanBook extends Model
{
    use HasFactory;
    
    public function plan_book_chapter(){  
        $dec_Arr = json_decode($this->chapter_ids);
                                    
        $crr = \App\Models\BookChapter::whereIn('id',$dec_Arr)->pluck('chapter_title')->implode(',');
        return $crr;

    }

    public function plan_book_detail()
    {       
        return $this->hasOne(Book::class, 'id','book_id');
    } 
}
