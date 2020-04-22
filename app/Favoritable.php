<?php


namespace App;


trait Favoritable
{

    public function isFavorited()
    {
        return !!$this->favorites->where(['user_id' => auth()->id()])->count();
    }

    public function getFavoritesCountAttributes()
    {
        return $this->favorites->count();
    }
}
