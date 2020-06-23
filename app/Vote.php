<?php

namespace App;

class Vote extends Model
{
    public function votebale()
    {
        return $this->morphTo();
    }
}
