<?
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH");
header('Content-type: application/json; charset=utf-8');

require "connect.php";
require "core.php";

$method=$_SERVER['REQUEST_METHOD'];
$rout = $_GET['rout'] ?? '';
$param = explode('/',$rout);
$type = $param[0];
$id = $param[1] ?? '';

if($type === 'users'){
    if($method === 'GET'){
        if(!empty($id)){
            getUser($connect, $id);
        } else {
            getUsers($connect);
        }
    } elseif($method === 'POST'){
        addUser($connect, $_POST);
    } elseif($method === 'PATCH'){
        if(!empty($id)){
            $data = json_decode(file_get_contents('php://input'), true);
            echo($data);
            edUser($connect, $data, $id);
        }
    } elseif($method === 'DELETE'){
        if(!empty($id)){
            delUser($connect, $id);
        }
    }
} else {
    http_response_code(404);
    echo json_encode(array("message"=>"Такой информации нет"));
}