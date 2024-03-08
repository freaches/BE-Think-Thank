<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvatarResource extends JsonResource
{
    //define properti
    public $status;
    public $message;
    public $resource;

    
    // /**
    //  * __construct
    //  *
    //  * @param  mixed $image
    //  * @param  mixed $diamond
    //  * @param  mixed $isLocked
    //  * @param  mixed $resource
    //  * @return void
    //  */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;

    }

    public function toArray($request)
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
//     public function toArray(Request $request)
//     {
//         return[
//             'image' => $this->image,
//             'diamond' => $this->diamond,
//             'isLocked' => $this->isLocked,
//         ];
//     }
};
