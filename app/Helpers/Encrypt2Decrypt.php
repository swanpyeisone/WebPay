<?php

use Hashids\Hashids;

    function Id2Hash($id){
        $hashid = new Hashids('ajfasdfasdf',8);
        return $hashid->encode($id);
    }
    function Hash2Id($hash){
        $hashid = new Hashids();
        return $hashid->decode($hash)[0];
    }
?>