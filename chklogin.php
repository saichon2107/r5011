<?php 
    session_start();
    $u = $_GET['username'];
    $p = $_GET['password'];

    include_once('dbconnect.php');

    $sql = "SELECT a.id_ser, a.username, a.password, s.pre_ser, s.fname_ser, s.lname_ser,
            s.tel_ser, s.email_ser, s.j_ser, d.name_room
            FROM account  a, list s, room d
            WHERE a.id_ser = s.id_ser
            AND   s.id_room = d.id_room
            AND   username like ? AND password like ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$u, $p);
    $stmt->execute();
    // $stmt -> store_result();
    // $stmt->bind_result($user,$pass);
    

    if($stmt->fetch()){
        $_SESSION['u'] = $u;
        $_SESSION['p'] = $p;
        require('sessionexp.php');
        header( 'Location: index.php');

    }else { header( 'Location: index.php');
    }
    ?>






?>