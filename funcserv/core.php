<?

function getUsers($connect){
    $users = $connect->query("SELECT * FROM `users`");
    $list = [];
    while($user = mysqli_fetch_assoc($users)){
        $list[]=$user;
    }
    if($users){
        http_response_code(200);
        echo json_encode($list);
    } else {
        http_response_code(404);
        echo json_encode(array("message"=>"Ошибка: не найдены пользователи"));
    }
}

function getUser($connect, $id){
    $users = $connect->query("SELECT * FROM `users` where `users`.`id`='$id'");
    $list = [];
    $user = mysqli_fetch_assoc($users);
    $list[]=$user;
    if($user){
        http_response_code(200);
        echo json_encode($list);
    } else {
        http_response_code(404);
        echo json_encode(array("message"=>"Ошибка: такого пользователя нет"));
    }
}

function addUser($connect, $post){
    $email = $post['email'];
    $pass = $post['pass'];
    $add = $connect->query("INSERT INTO `users` (`id`,`email`,`pass`,`role`) values (null, '$email', '$pass', 'user')");
    if($add){
        http_response_code(202);
        echo json_encode(array("message"=>"Пользователь был успешно добавлен в бд"));
    } else {
        http_response_code(503);
        echo json_encode(array("message"=>"Ошибка: не удалось добавить пользователя в бд"));
    }
}

function edUser($connect, $data, $id){
    $email = $data['email'];
    $pass = $data['pass'];
    $edit = $connect->query("UPDATE `users` SET `email`='$email', `pass`='$pass' where `users`.`id`='$id'");
    if($edit){
        http_response_code(202);
        echo json_encode(array("message"=>"Данные пользователя были успешно изменены"));
    } else {
        http_response_code(503);
        echo json_encode(array("message"=>"Ошибка: не удалось изменить данные пользователя"));
    } 
}

function delUser($connect, $id){
    $delete = $connect->query("DELETE FROM `users` where `users`.`id`='$id'");
    if($delete){
        http_response_code(202);
        echo json_encode(array("message"=>"Удаление пользователя прошло успешно"));
    } else {
        http_response_code(503);
        echo json_encode(array("message"=>"Ошибка: не удалось удалить пользователя"));
    }
}