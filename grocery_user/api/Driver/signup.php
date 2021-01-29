<?php
 
include_once '../config/database.php';
include_once '../objects/user.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
// set user property values
$user->type_id = $_POST['type_id'];
$user->email = $_POST['email'];
$user->phone = $_POST['phone'];
$user->password = base64_encode($_POST['password']);
$user->created_at = date('Y-m-d H:i:s');
$user->updated_at = date('Y-m-d H:i:s');
 $type =$_POST['type'];    

if($type=='simple'){
    // create the user
if($user->signup()){
                    $user_arr=array(
                        "status" => 200,
                        "message" => "Successfully Register!",
                        "id" => $user->id,
                        "type_id" => $user->type_id,
                        "phone" => $user->phone,
                        "email" => $user->email
                       
                    );
            }
            else{
                         $user_arr=array(
                        "status" => 404,
                       "message" => "Username already exists!"
                        );
            }
                
}else{

    
                
                        if($user->signup()){
                        $user_arr=array(
                            "status" => true,
                            "message" => "Successfully Register!",
                            "id" => $user->id,
                            "type_id" => $user->type_id,
                            "phone" => $user->phone,
                            "email" => $user->email
                           
                        );
                        
            }
            else{
                
                       $user->email = $_POST['email'];
                         $stmt = $user->isAlreadyCheck();
                        if($stmt->rowCount() > 0){
                            // get retrieved row
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            // create array
                            $user_arr=array(
                                "status" => true,
                                "message" => "Successfully Login!",
                                "id" => $row['id'],
                                "type_id" => $row['type_id'],
                                "phone" => $row['phone'],
                                "email" => $row['email']
                              
                            );
                        }
            }
    
    
}


print_r(json_encode($user_arr));
?>