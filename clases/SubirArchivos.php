<?php

/**
 * Description of SubirArchivos
 *
 * @author juanpablo
 * metodos:
 * setcarpetadestino($carpeta)[fijar el destino en el que queremos que se guarde el archivo,
 *       filtro solo texto en el parametro, no barras. 
 *       dentro de la carpeta repaso, al mismo nivel de htdocs(si no existe la carpeta se crea)
 * ]
 * settamaniomaximo($numero)
 * subir()[sube el archivo a la carpeta destino prefijada siempre que no supere el tamño maximo,
 *  si no esta establecido el tamaño o destino no lo sube.
 *       si son varios archivos debera de subirlos todos], los renombramos con numeros 1 2 3.. sin importar extension
 * constructor
 * 
 * --subir archivos y aplicacion que permita verlos
 *
 *   error 1: tamaño maximo excedido
 *   error 1.1: tamaño maximo no valido
 *   error 1.2: tamaño maximo no establecido
 *   error 2.1: no hay nombre carpeta
 *   error 2.2: no es valido el nombre carpeta
 *   error 3: no se ha elegido carpeta destino
 */
class SubirArchivos {

    private $nombre;
    private $carpetadestino;
    private $tamanomax;
    private $files;
    private $error;
    private $nombreOrginal;

    function __construct($param) {
        /* */
        if (is_array($_FILES[$param]["name"])) {
            foreach ($_FILES[$param]['name'] as $file) {
                $this->nombre[] = "";
                $this->nombreOrginal[]="";
                $this->error[] = 0;
            }
            foreach ($_FILES[$param] as $key => $value) {
                $this->files[] = $value;
            }
        } else {
            $this->nombre[] = "";
            $this->nombreOrginal[]="";
            $this->error[] = 0;
            $this->files[0][] = $_FILES[$param]["name"];
            $this->files[1][] = $_FILES[$param]["type"];
            $this->files[2][] = $_FILES[$param]["tmp_name"];
            $this->files[3][] = $_FILES[$param]["error"];
            $this->files[4][] = $_FILES[$param]["size"];
        }
        $this->carpetadestino = "";
        $this->tamanomax = 0;
        
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function getNombreOrginal() {
        return $this->nombreOrginal;
    }

        public function getTamanomax() {
        return $this->tamanomax;
    }

    public function getError() {
        return $this->error;
    }

    public function getFiles() {
        return $this->files;
    }

    public function setTamanomax($tamanomax) {
        if ($tamanomax == "") {
            $this->error = 1.1;
            return;
        } else {
            if (!is_integer($tamanomax)) {
                $this->tamanomax = -1; // para controlar que no le asigne otro error
                $this->error = 1.1;
                return;
            }
        }
        $this->tamanomax = $tamanomax;
    }

//estamos obligados a escoger una carpeta de destino
    public function setCarpetadestino($param) {
        if (!$param) {
            $this->error = 2.1;
            return;
        } else {
            $permitidos = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz ÁÉÍÓÚáéíóú123456789";
            for ($i = 0; $i < strlen($param); $i++) {
                if (strpos($permitidos, substr($param, $i, 1)) === false) {
                    $this->error = 2.2;
                    return;
                }
            }
        }
        $this->carpetadestino = Ruta::getRutaPadre(Ruta::getRutaServidor()).Configuracion::CARPETA. $param;
//crear carpeta si no existe
        if (!file_exists($this->carpetadestino)) {
            mkdir($this->carpetadestino, 0777, true);
        }
        $param = "/";
        $this->carpetadestino .= $param;
    }

    public function getCarpetadestino() {
        return $this->carpetadestino;
    }

    public function subir() {
        $archivossubidos=array();
        for ($i = 0; $i < sizeof($this->files[0]); $i++) {
            if ($this->carpetadestino == "") {
                $this->error[$i] = 3;
            }
            if ($this->tamanomax == 0) {
                $this->error[$i] = 1.2;
            } else {
                if (($this->tamanomax) <= ($this->files[4][$i])) {
                    $this->error[$i] = 1;
                }
            }
            if ($this->error[$i] == 0) {
                $contadornombre = 0;
                while (file_exists($this->carpetadestino . $contadornombre)) {
                    $contadornombre++;
                }
                $this->nombre = (String) $contadornombre;
                $this->nombreOrginal=(String) $this->files[0][$i];
                
                $archivossubidos[$i]=(array(0=>$this->files[0][$i],1=>$this->carpetadestino,2=>$this->nombre));
                move_uploaded_file($this->files[2][$i], $this->carpetadestino . $this->nombre);
            }else{
                $archivossubidos[$i]="error";
            }
        }
      return $archivossubidos;  
    }

}
