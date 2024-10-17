<?php
require_once("init_pdo.php");

function setHeaders() {
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}

if(isset($_SERVER['PATH_INFO'])) {
    $cleanedString = trim($_SERVER['PATH_INFO'], '/');
    $inputArray = explode('/', $cleanedString);
} else {
    $inputArray = [
        0 => '',
        1 => '',
        2 => ''
    ];
}

function get_users($db, $id) {
    if(isset($id) && $id != '') {
        $sql = "SELECT * FROM users WHERE id=:user_id"; 
        $exe = $db->prepare($sql);
    
        $exe->bindParam(':user_id', $id);
        $exe->execute();
        $res = $exe->fetch(PDO::FETCH_OBJ);
    } else {
        $sql = "SELECT * FROM users"; 
        $exe = $db->query($sql); 
        $res = $exe->fetchAll(PDO::FETCH_OBJ);
    }
    
    return $res;
}

function new_user($db, $login, $email) {
    $sql = "INSERT INTO users (login, email) VALUES (:login, :email)"; 
    $exe = $db->prepare($sql);

    $exe->bindParam(':login', $login);
    $exe->bindParam(':email', $email);

    if ($exe->execute()) {
        $newUserId = $db->lastInsertId();
        $res = [
            'id' => $newUserId,
            'login' => $login,
            'email' => $email];
        http_response_code(201);
    } else {
        $res = ["error" => "Failed to create user."];
        http_response_code(500);
    }
    return $res;
}

function update_user($db, $user_id, $login, $email) {
    $sql = "UPDATE users SET login = :login, email = :email WHERE id = :id";
    $exe = $db->prepare($sql);

    $exe->bindParam(':login', $login);
    $exe->bindParam(':email', $email);
    $exe->bindParam(':id', $user_id);

    if ($exe->execute()) {
        $rowCount = $exe->rowCount();

        if ($rowCount > 0) {
            $res = [
                'id' => $user_id,
                'login' => $login,
                'email' => $email];
            http_response_code(200);
        } else {
            $res = ['error' => "User not found or no changes made."];
            http_response_code(404);
        }
    } else {
        $res = ["error" => "Failed to update user."];
        http_response_code(500);
    }

    return $res;
}

function delete_user($db, $userId) {
    $sql = "DELETE FROM users WHERE id = :user_id"; 
    $exe = $db->prepare($sql);

    $exe->bindParam(':user_id', $userId);

    if ($exe->execute()) {
        if ($exe->rowCount() > 0) {
            $res = [
                "message" => "User deleted successfully.",
                "id" => $userId];
            http_response_code(200);
        } else {
            $res = ["error" => "User not found."];
            http_response_code(404);
        }
    } else {
        $res = ["error" => "Failed to delete user."];
        http_response_code(500);
    }

    return $res;
}

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $result = get_users($pdo, $inputArray[0]);
        setHeaders();
        echo json_encode($result);
        exit;
        
    case 'POST':
        $result = new_user($pdo, $inputArray[0], $inputArray[1]);
        echo json_encode($result);
        exit;
        
    case 'PUT':
        $result = update_user($pdo, $inputArray[0], $inputArray[1], $inputArray[2]);
        echo json_encode($result);
        exit;
    
    case 'DELETE':
        $result = delete_user($pdo, $inputArray[0]);
        echo json_encode($result);
        exit;
        
    default:
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
        http_response_code(405);
        exit(json_encode(["error" => "Method Not Allowed"]));
}
?>
