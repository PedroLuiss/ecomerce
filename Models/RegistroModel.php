<?php
class RegistroModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($email)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
        return $this->select($sql);
    }

    public function registrar($email, $nombre, $clave, $tipo, $estado_id, $municipio_id, $ciudade_id, $parroquia_id) {
        $sql = "INSERT INTO usuarios (correo, nombre, clave, tipo,estado_id,municipio_id,ciudade_id,parroquia_id) VALUES (?,?,?,?,?,?,?,?)";
        return $this->insertar($sql, [$email, $nombre, $clave, $tipo,$estado_id,$municipio_id,$ciudade_id,$parroquia_id]);
    }

    public function getProducto($id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";      
        return $this->select($sql);
    }

    public function registrarPedido($transaccion, $total, $nombre,
    $apellido,$direccion,$ciudad,$cod,$pais,$telefono,$envio, $id_usuario, $estado_id, $ciudade_id, $municipio_id, $parroquia_id){
        $sql = "INSERT INTO ventas (transaccion, total, nombre,
        apellido,direccion,ciudad,cod,pais,telefono,envio, id_usuario,estado_id,id_ciudad,id_municipio,id_parroquia) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->insertar($sql, [$transaccion, $total, $nombre,
        $apellido,$direccion,$ciudad,$cod,$pais,$telefono,$envio, $id_usuario, $estado_id, $ciudade_id, $municipio_id, $parroquia_id]);
    }

    public function registrarDetalle($producto, $precio, $cantidad, $idProducto, $id_venta){
        $sql = "INSERT INTO detalle_ventas (producto, precio, cantidad,id_producto, id_venta) VALUES (?,?,?,?,?)";
        return $this->insertar($sql, [$producto, $precio, $cantidad, $idProducto, $id_venta]);
    }

    public function actualizarStock($cantidad, $ventas, $idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ?, ventas=? WHERE id = ?";
        return $this->save($sql, [$cantidad, $ventas, $idProducto]);
    }
    
}
 
?>