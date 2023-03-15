<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'link', 'status'
    ];

    public function getImageAttribute($image){
        if($image){
            return asset('storage/sliders/'.$image);
        }else{
            return asset('storage/sliders/default.png');
        }
    }

    // public function getStatusAttribute($attr){
    //     return ($attr == 1)? $this->status = 'Active' : $this->status = 'Deactive';
    // }
}
