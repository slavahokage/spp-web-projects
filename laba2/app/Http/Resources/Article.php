<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class Article extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = new Carbon($this->created_at);
        $formatDate = $date->toDateTimeString();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' =>  $formatDate,
        ];
    }
}
