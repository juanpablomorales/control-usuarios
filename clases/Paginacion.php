<?php

class Paginacion {

    private function __construct() {
    }

    private static function getEnlace($pagina, $paginas, $url){
        if($pagina<0)
            return "";
        if($pagina>$paginas)
            return "";
        $paginaUsuario = $pagina+1;
        return "<a href='".$url."pagina=$pagina'>$paginaUsuario</a>";
    }

    private static function getEnlaceJSON($pagina, $paginas){
        if($pagina<0)
            return -1;
        if($pagina>$paginas)
            return -1;
        return $pagina;
    }

    public static function getEnlacesPaginacion($pagina, $nr, $nrpp, $url = "") {
        $pos = strpos($url, "?");
        if($pos===false){
            $url .= "?";
        } else {
            $url .= "&";
        }
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $resultado["inicio"] = "<a href='".$url."pagina=0'>&lt;&lt;</a>";
        $resultado["anterior"] = "<a href='".$url."pagina=$ant'>&lt;</a>";
        $resultado["siguiente"] = "<a href='".$url."pagina=$sig'>&gt;</a>";
        $resultado["ultimo"] = "<a href='".$url."pagina=$paginas'>&gt;&gt;</a>";
        if($pagina==0){
            $resultado["primero"] = $pagina+1;
            $resultado["segundo"] = self::getEnlace(1, $paginas, $url);
            $resultado["actual"] = self::getEnlace(2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace(3, $paginas, $url);;
            $resultado["quinto"] = self::getEnlace(4, $paginas, $url);;
        } elseif($pagina==1){
            $resultado["primero"] = self::getEnlace(0, $paginas, $url);
            $resultado["segundo"] = $pagina+1;
            $resultado["actual"] = self::getEnlace(2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace(3, $paginas, $url);
            $resultado["quinto"] = self::getEnlace(4, $paginas, $url);
        } elseif($pagina==$paginas){
            $resultado["primero"] = self::getEnlace($pagina-4, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-3, $paginas, $url);
            $resultado["actual"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["quinto"] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado["primero"] = self::getEnlace($pagina-3, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["actual"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["cuarto"] = $pagina+1;
            $resultado["quinto"] = self::getEnlace($pagina+1, $paginas, $url);
        } else {
            $resultado["primero"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["actual"] = $pagina+1;
            $resultado["cuarto"] = self::getEnlace($pagina+1, $paginas, $url);
            $resultado["quinto"] = self::getEnlace($pagina+2, $paginas, $url);
        }
        return $resultado;
    }

    public static function getEnlacesPaginacionJSON($pagina, $nr, $nrpp, $url = "") {
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        $resultado["inicio"] = 0;
        $resultado["anterior"] = $ant;
        $resultado["siguiente"] = $sig;
        $resultado["ultimo"] = $paginas;
        if($pagina==0){
            $resultado["primero"] = $pagina+1;
            $resultado["segundo"] = self::getEnlaceJSON(1, $paginas);
            $resultado["actual"] = self::getEnlaceJSON(2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON(3, $paginas);;
            $resultado["quinto"] = self::getEnlaceJSON(4, $paginas);;
        } elseif($pagina==1){
            $resultado["primero"] = self::getEnlaceJSON(0, $paginas);
            $resultado["segundo"] = $pagina+1;
            $resultado["actual"] = self::getEnlaceJSON(2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON(3, $paginas);
            $resultado["quinto"] = self::getEnlaceJSON(4, $paginas);
        } elseif($pagina==$paginas){
            $resultado["primero"] = self::getEnlaceJSON($pagina-4, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado["actual"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["quinto"] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado["primero"] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["actual"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["cuarto"] = $pagina+1;
            $resultado["quinto"] = self::getEnlaceJSON($pagina+1, $paginas);
        } else {
            $resultado["primero"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["actual"] = $pagina+1;
            $resultado["cuarto"] = self::getEnlaceJSON($pagina+1, $paginas);
            $resultado["quinto"] = self::getEnlaceJSON($pagina+2, $paginas);
        }
        return $resultado;
    }

    public static function getPaginacionJSON($pagina, $nr, $nrpp, $url = "") {
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        $resultado[] = 0;
        $resultado[] = $ant;
        $resultado[] = $sig;
        $resultado[] = $paginas;
        if($pagina==0){
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON(1, $paginas);
            $resultado[] = self::getEnlaceJSON(2, $paginas);
            $resultado[] = self::getEnlaceJSON(3, $paginas);;
            $resultado[] = self::getEnlaceJSON(4, $paginas);;
        } elseif($pagina==1){
            $resultado[] = self::getEnlaceJSON(0, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON(2, $paginas);
            $resultado[] = self::getEnlaceJSON(3, $paginas);
            $resultado[] = self::getEnlaceJSON(4, $paginas);
        } elseif($pagina==$paginas){
            $resultado[] = self::getEnlaceJSON($pagina-4, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado[] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON($pagina+1, $paginas);
        } else {
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON($pagina+1, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina+2, $paginas);
        }
        return $resultado;
    }

}