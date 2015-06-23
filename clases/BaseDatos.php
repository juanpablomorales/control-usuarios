<?php
/**
 * Class BaseDatos
 *
 * @version 0.2
 * @author juanpablo
 * 
 */
class BaseDatos {
    private $conexion;
    private $sentencia;
    function __construct() {
        try {
            $this->conexion = new PDO(
                    'mysql:host=' . Configuracion::SERVIDOR . ';dbname=' . Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
        } catch (PDOException $e) {
            $this->conexion = false;
        }
    }
    /**
     * Cierra la conexion
     * @access public
     */
    function closeConexion() {
        $this->closeConsulta();
        $this->conexion = null;
    }
    
    /**
     * Cierra la consulta
     * @access public
     */
    function closeConsulta(){
        if($this->sentencia != null){
            $this->sentencia->closeCursor();
            $this->sentencia = null;
        }
    }
    /**
     * Devuelve el ID de la última fila insertada 
     * @access public
     * @return string|int devuelve el campo ID de la última fila insertada
     */
    function getAutonumerico() {
        return $this->conexion->lastInsertId();
    }
    /**
     * Devuelve el mensaje de error de la sentencia sql 
     * @access public
     * @return string devuelve el mensaje de error de la sentencia sql
     */
    function getError(){
        return $this->sentencia->errorInfo[2];
    }
    /**
     * Devuelve la siguiente fila del último select ejecutado 
     * @access public
     * @return array|null devuelve un array asociativo con los campos de la consulta
     */
    function getFila() {
        if ($this->sentencia != null) {
            return $this->sentencia->fetch();
        }
        return false;
    }
    /**
     * Devuelve el número de fila de la última consulta 
     * @access public
     * @return int devuelve un entero con el número de filas afectadas, -1 si no hay consulta 
     */
    function getNumeroFilas() {
        if ($this->sentencia) {
            return $this->sentencia->rowCount();
        }
        return -1;
    }
    /**
     * Devuelve si esta o no conectado a la base de datos
     * @access public
     * @return boolean devuelve un booleano, si esta o no conectado 
     */
    function isConetado() {
        return $this->conexion !== null;
        /*if($this->conexion != null){
            return true;
        }
        return false;*/
    }
    /**
     * Establece la base de datos a la que se va ha conectar.
     * @access public
     * @param string $param Cadena con el nombre de la base de datos
     */
    function setBaseDatos($baseDatos) {
        return $this->conexion->query("use $baseDatos") !== FALSE;
    }
    /**
     * Ejecuta una sentencia sql con una consulta preparada con parametros con nombre
     * @access public
     * @param string $sql Cadena la consulta sql
     * @param array $parametros Array con los parametros de la sentecia
     */
    function setConsulta($sql, $parametros = array()) {
        $this->sentencia = $this->conexion->prepare($sql);
        foreach ($parametros as $indice => $valor) {
            $this->sentencia->bindValue($indice, $valor);
        }
        return $this->sentencia->execute();
    }
    /**
     * Ejecuta una sentencia sql con una consulta preparada con parametros con ?
     * @access public
     * @param string $sql Cadena la consulta sql
     * @param array $param Array con los parametros de la sentecia
     */
    function setConsultaPreparada($sql, $param = array()) {
        $this->sentencia = $this->conexion->prepare($sql);
        $pos = 1;
        foreach ($param as $valor) {
            $this->sentencia->bindValue($pos, $valor);
            $pos++;
        }
        /*
          foreach ($param as $i => $valor) {
          $this->sentencia->bindValue($i+1, $valor);
          }
         */
        return $this->sentencia->execute();
    }
    /**
     * Ejecuta una sentencia sql
     * @access public
     * @param string $sql Cadena con la consulta sql
     */
    function setConsultaSql($sql) {
        return $this->sentencia = $this->conexion->query($sql);       
    }
    /**
     * Inicia una transaccion
     * @access public
     */
    function setTransaccion() {
        $this->conexion->beginTransaction();
    }
    /**
     * Anula la transaccion
     * @access public
     */
    function anulaTransaccion() {
        $this->conexion->rollBack();
    }
    /**
     * Valida una transaccion
     * @access public
     */
    function validaTransaccion() {
        $this->conexion->commit();
    }
    /**
     * Ejecuta una transaccion con consultas preparadas
     * @access public
     * @param array $consultas array de cadena con las consulta sql
     * @param array $parametros Array con los parametros de la sentecia
     * @return boolean si se ha realizado o no la transaccion
     */
    function ejecutaTransaccion($consultas, $parametros) {
        $this->setTransaccion();
        $error = false;
        foreach ($consultas as $i => $consulta) {
            $resultado = $this->setConsulta($consulta, $parametros[$i]);
            //if ($resultado < 1) {
            if($resultado === false || $this->getNumeroFilas() < 1){
                $error = true;
                break;
            }
        }
        if ($error) {
            $this->anulaTransaccion();
            return false;
        } else {
            $this->validaTransaccion();
            return true;
        }
    }
}