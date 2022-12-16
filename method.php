<?php
require_once("connection.php");
class Mahasiswa {
    public function get_mhss() {
        global $mysqli;

        $query = "SELECT * FROM mahasiswa ORDER BY id DESC";
        $data = array();
        $result = $mysqli->query($query);
        while($row=mysqli_fetch_object($result)) {
            $data[]=$row;
        }
        $response = array(
            'status' => true,
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
 
    public function get_mhs($id=0) {
        global $mysqli;
        $query="SELECT * FROM mahasiswa";
        if($id != 0) {
            $query.=" WHERE id=".$id." LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        while($row = mysqli_fetch_object($result)){
            $data[]=$row;
        }
        $response = array(
            'status' => true,
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);       
    }

    public function get_mhs_by_nrp($nrp=0) {
        global $mysqli;
        $query="SELECT * FROM mahasiswa";
        if($nrp != 0) {
            $query.=" WHERE nrp=".$nrp." LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        while($row = mysqli_fetch_object($result)){
            $data[]=$row;
        }
        $response = array(
            'status' => true,
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);       
    }
 
    public function insert_mhs() {
        global $mysqli;
        $arrcheckpost = array(
            'nrp' => '', 
            'nama' => '', 
            'email' => '', 
            'jurusan' => ''
            // 'image'   => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
            $id = "NULL";
            $nrp = $_POST['nrp'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $jurusan = $_POST['jurusan'];
            $image = "uploads/default.jpg";
            $query = "INSERT INTO mahasiswa VALUES ($id, '$nrp', '$nama', '$email', '$jurusan', '$image')";
            // $image = $_POST['image'];

            $result = $mysqli->query($query);
            // die($result);
            if($result) {
                $response = array(
                    'status' => true,
                );
            } else {
                $response=array(
                    'status' => false,
                    'message' => $query
                );
            }
        } else {
            $response=array(
                    'status' => false,
                    'message' => 'Wrong count'
                );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
 
    function update_mhs($id) {
        global $mysqli;
        parse_str(file_get_contents('php://input'), $post);
        $arrcheckpost = array(
            'id' => '',
            'nrp' => '', 
            'nama' => '', 
            'email' => '', 
            'jurusan' => '', 
            // 'image' => ''
        );
        $hitung = count(array_intersect_key($post, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
            $nrp = $post['nrp'];
            $nama = $post['nama'];
            $email = $post['email'];
            $jurusan = $post['jurusan'];
            $query = "UPDATE mahasiswa SET nrp = '$nrp', nama = '$nama', email = '$email', jurusan = '$jurusan' WHERE id='$id'";
            $result = mysqli_query($mysqli, $query);
            if($result) {
                $response=array(
                    'status' => true,
                );
            } else {
                $response=array(
                    'status' => false,
                    'message' => 'awikwok'
                );
            }
        } else {
            $response=array(
                'status' => false,
                'message' => $post
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
 
    function delete_mhs($id) {
        global $mysqli;
        $query = "DELETE FROM mahasiswa WHERE id=".$id;
        if(mysqli_query($mysqli, $query))
        {
            $response=array(
                'status' => true,
                'message' => 'Mahasiswa deleted'
            );
        } else {
            $response=array(
                'status' => false,
                'message' => 'Failed to delete'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}