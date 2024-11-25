<?php
namespace App\Actions;

class Alert 
{
    public function __invoke($type, $message ) {
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);
    }
}

