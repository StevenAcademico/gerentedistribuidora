<?php

require_once "model/rolModel.php";

class Usuario extends Model{
    public $codigo;
    public $userlogin;
    public $clave;
    public $vigente;
    public $cliente;
    public $trabajador;
    public $rol;

    function __construct(){
        parent::__construct();

    }

    public function insert(){
        // insertar datos en la BD
    }

    public function update(){

    }



    public function delete(){

    }

    public function get(){

    }

    public function bloquear($usuario){
        try{
            $query = $this->db
                        ->connect()
                        ->prepare('UPDATE usuario SET vigente = 0 WHERE login = :usuario');
            $query->execute([
                            'usuario' => $usuario
                    ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }


    public function getById($id){
    }


    public function login(){
        $item = new Usuario();

        $query = $this->db->connect()->prepare("SELECT u.codigo as idusuario, case when u.codigoCli is null then (select concat(t.nombres,' ',t.apellidoPat,' ',t.apellidoMat) from trabajador t) 
                                                else (select c.nombre from cliente c) end as nombre,r.codigo as rol_id, r.nombre as rol,
                                                case when u.codigoCli is null then 0 else u.codigoCli end as cliente,
                                                case when u.codigoTra is null then 0 else u.codigoTra end as trabajador,
                                                u.vigente
                                                from usuario u
                                                inner join rolusuario r on r.codigo = u.codigoRolUsu
                                                WHERE u.login = :user and u.contraseña= :clave");
        try{       
            $query->execute([
                'user' => $this->userlogin,
                'clave' => md5($this->clave)
            ]);

            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $item->codigo = $row['idusuario'];
                    $item->userlogin  = $this->userlogin;
                    $item->nombre = $row["nombre"];
                    $item->vigente  = $row["vigente"];
                    $item->rol = new Rol();
                    $item->rol->codigo = $row['rol_id'];
                    $item->rol->nombre = $row['rol'];
                }
            }else{
                throw new PDOException("error");
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    




}

?>