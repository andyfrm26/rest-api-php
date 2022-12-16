<?php

// require_once('connection.php');

// if(empty($_GET)){
//     $query = mysqli_query($connection, "SELECT * FROM mahasiswa");
//     $result = array();
//     while ($row = mysqli_fetch_array($query)) {
//         array_push($result, array(
//             'id' => $row['id'],
//             'nrp' => $row['nrp'],
//             'nama' => $row['nama'],
//             'email' => $row['email'],
//             'jurusan' => $row['jurusan'],
//             'image' => $row['image'],
//         ));
//     }
    
//     echo json_encode(
//         array('data' => $result)
//     );
// } else {
//     $query = mysqli_query($connection, "SELECT * FROM mahasiswa WHERE nrp =".$_GET['nrp']);

//     $result = array();
//     while ($row = $query->fetch_assoc()) {
//         $result = array(
//             'id' => $row['id'],
//             'nrp' => $row['nrp'],
//             'nama' => $row['nama'],
//             'email' => $row['email'],
//             'jurusan' => $row['jurusan'],
//             'image' => $row['image'],
//         );
//     }
    
//     echo json_encode(
//        $result
//     );
// }

require_once "method.php";
$mhs = new Mahasiswa();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
      if(!empty($_GET["id"])) {
         $id=intval($_GET["id"]);
         $mhs->get_mhs($id);
      } else if(!empty($_GET["nrp"])){
         $nrp=intval($_GET["nrp"]);
         $mhs->get_mhs_by_nrp($nrp);
      } else {
         $mhs->get_mhss();
      }
      break;
   case 'POST':
      $mhs->insert_mhs();
      break; 
   case 'DELETE':
      parse_str(file_get_contents('php://input'), $post);
      $mhs->delete_mhs($post['id']);
      break;
   case 'PUT':
      parse_str(file_get_contents('php://input'), $post);
      $mhs->update_mhs($post['id']);
      break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}
 
