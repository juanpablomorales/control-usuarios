<?php

class Ruta {

    public static function getRutaServidor() {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function getRutaPadre($ruta) {
        $pos = strrpos($ruta, "/");
        return substr($ruta, 0, $pos+1);
    }

}
