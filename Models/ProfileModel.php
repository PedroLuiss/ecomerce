<?php
class ProfileModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario($correo)
    {
        $sql = "SELECT u.*, e.estado,m.municipio,c.ciudad,p.parroquia FROM usuarios u INNER JOIN estados e ON u.estado_id = e.id_estado  INNER JOIN municipios m ON u.municipio_id = m.id_municipio  INNER JOIN ciudades c ON u.ciudade_id = c.id_ciudad  INNER JOIN parroquias p ON u.parroquia_id = p.id_parroquia WHERE u.correo = '$correo' AND u.estado = 1";
        return $this->select($sql);
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }
    public function getNegocio()
    {
        return $this->select("SELECT * FROM configuracion");
    }
    public function getPedidos($id_usuario)
    {
        $sql = "SELECT * FROM ventas WHERE id_usuario = $id_usuario";
        return $this->selectAll($sql);
    }
    public function getDetalle($id_venta)
    {
        $sql = "SELECT * FROM detalle_ventas WHERE id_venta = $id_venta";
        return $this->selectAll($sql);
    }

    public function getPedido($id)
    {
        $sql = "SELECT v.*,e.estado,m.municipio,p.parroquia,c.ciudad FROM ventas v INNER JOIN estados e ON v.estado_id = e.id_estado  INNER JOIN municipios m ON v.id_municipio = m.id_municipio  INNER JOIN ciudades c ON v.id_ciudad = c.id_ciudad  INNER JOIN parroquias p ON v.id_parroquia = p.id_parroquia WHERE v.id = $id";
        return $this->select($sql);
    }

    public function modificarInfo($nombre, $apellido, $id)
    {
        $sql = "UPDATE usuarios SET nombre=?, apellido=?  WHERE id = ?";
        $array = array( $nombre, $apellido, $id);
        return $this->save($sql, $array);
    }

    public function modificarDireccion($estado_id, $ciudade_id,$municipio_id,$parroquia_id,$direccion, $id)
    {
        $sql = "UPDATE usuarios SET estado_id=?, ciudade_id=?,municipio_id=?,parroquia_id=?,direccion=?  WHERE id = ?";
        $array = array( $estado_id, $ciudade_id,$municipio_id,$parroquia_id,$direccion, $id);
        return $this->save($sql, $array);
    }

    public function modificarClave($clave, $id)
    {
        $sql = "UPDATE usuarios SET clave=? WHERE id = ?";
        $array = array($clave, $id);
        return $this->save($sql, $array);
    }
}
