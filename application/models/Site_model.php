<?php
class Site_model extends CI_Model
{

    public function loginUser($data)
    {
        $this->db->select("*");
        $this->db->from("profesores");
        $this->db->where("username",$data["username"]);
        $this->db->where("password",md5($data["password"]));

        $query = $this->db->get();

        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            $this->db->select("*");
            $this->db->from("alumnos");
            $this->db->where("username",$data["username"]);
            $this->db->where("password",md5($data["password"]));

            $queryalumno = $this->db->get();

            if($queryalumno->num_rows()>0) {
                return $queryalumno->result();
            }

            return NULL;
        }
    }

    public function insertProfesor()
    {
        $array = array(
            "nombre" => "David",
            "apellidos" => "Navarro",
            "curso" => 3
        );

        //Para insertar en la BD hacemos lo siguiente:
        //(nombre de la tabla, datos)
        $this->db->insert("profesores", $array);
    }

    public function getProfesores()
    {
        $this->db->select("*");
        $this->db->from("profesores");
        //$this->db->where("id",1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function updateProfesores()
    {
        $array = array(
            "nombre" => "David",
            "apellidos" => "Navarro López",
            "curso" => 1
        );

        $this->db->where("id", 1);
        $this->db->update("profesores", $array);
    }

    public function getAlumnos($curso) {
        $this->db->select("*");
        $this->db->from("alumnos");
        $this->db->where("curso", $curso);
        $this->db->where("deleted", 0);

        //Guardamos en una variable el resultado
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }

    }

    public function deleteAlumno($id) {
        $array = array(
            "deleted"=>1
        );

        $this->db->where("id",$id);
        $this->db->update("alumnos", $array);
    }
    
    public function uploadTarea($data, $archivo) {
        $array = array(
            "nombre" => $data['nombre'],
            "descripcion" => $data['descripcion'],
            "fecha_final" => $data['fecha'],
            "archivo" => $archivo,
            "curso" => $data['curso']
        );

        $this->db->insert("tareas", $array);
    }

}