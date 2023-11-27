<?php
$action = $_REQUEST['action'];
// var_dump($_REQUEST);

if (!empty($action)){
    require_once 'partials/User.php';
    $obj = new User();
}

// adding user action
if($action =='adduser' && !empty($_POST)){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo'];

    $playerId = (!empty($_POST['userId'])) ? $_POST['userId'] : '';

    $imagename='';
    if (!empty($photo['name'])){
        $imagename =$obj->uploadPhoto($photo);
        $playerData = [
            'username' => $username,
            'email' => $email,
            'mobile'=> $mobile,
            'photo' => $imagename,
        ];
    } else {
        $playerData = [
            'username' => $username,
            'email' => $email,
            'mobile'=> $mobile,
        ];
    }
    if ($playerId){
        $obj->update($playerData, $playerId);
    } else {
        $playerId = $obj->add($playerData);

    }

    if(!empty($playerId)){
        $player = $obj->getRow('id', $playerId);
        echo json_encode($player);
        exit();
    }

    echo json_encode($player);
}

// get count of function and getallusers action

if($action=='getallusers'){
    $page = (!empty($_GET['page'])) ? $_GET['page']:1;
    $limit =4;

    // page=2
    // limit=4
    // start = 1*4=8 
    $start=($page-1)*$limit;
    $users=$obj->getRows($start, $limit);
    if(!empty($users)){
        $userlist = $users;
    } else {
        $userlist =[];
    }

    $total = $obj->getCount();
    $userArr=['count'=>$total,'users'=>$userlist];
    echo json_encode($userArr);
    exit();

}

// action to perform search
if ($action == "searcjhh"){
    $page = (!empty($_GET['page'])) ? $_GET['page']:1;
    $limit = 4;

    $start = ($page-1)*$limit;
    $searchTerm = $_POST['searchBar'];
    $users = $obj->search($searchTerm, $start, $limit);
    if(!empty($users)){
        $userlist = $users;
    } else {
        $userlist = [];
    }

    $total = $userlist->getCount();
    $userArr = ['count'=>$total, 'users'=>$userlist];
    echo json_encode($userArr);
    exit();
}

// action to perform search
if ($action == "search"){
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']):'';

    $results = $obj->search($queryString);
    // $total = $results->count();
    // $userArr = ['count'=>$total, 'users'=>$results];
    echo json_encode($results);
    exit();

}

// action to perform editing
if($action=="editusersdata"){
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if(!empty($playerId)){
        $user = $obj->getRow('id', $playerId);
        echo json_encode($user);
        exit();
    }
}

if($action=="viewuserdata"){
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';

    if(!empty($playerId)){
        $userToView = $obj->getRow('id', $playerId);
        echo json_encode($userToView);
        exit();
    }
}


// Perform deleting of users
if($action == "deleteuserdata"){
    $userId = (!empty($_GET['id'])) ? $_GET['id'] : '';

    if (!empty($userId)){
        $isDeleted = $obj->deleteUser($userId);
        if($isDeleted){
            $displaymessage=['deleted'=>1];
        } else {
            $displaymessage=['deleted'=>0];
        }

        echo json_encode($displaymessage);
        exit();
    }
}
?>