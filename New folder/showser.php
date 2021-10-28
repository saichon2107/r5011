<?php   session_start(); 
require('sessionexp.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>แสดงข้อมูลจอง</title>
</head>

<body>
    <div class="container">
        <?php
        include_once('header.php');
        include_once('dbconnect.php');
        $status = "active";
        ?>
        

        <div class="row">
            <form action="showser.php" method="GET" class="pt-3">
                <div class="row gx-3">
                    <div class="col-sm-2">
                        <input type="text" value="" class="form-control bg bg-light pb-2  " name="id_ser" placeholder="กรอกรหัส" />
                    </div>
                    <div class="col">
                        <input type="submit" class="btn  btn-outline-primary col-sm-3 " value="ค้นหาข้อมูล" name="find" />
                    </div>
                </div>
            </form>
        </div>

        <?php
        if (isset($_GET['find']) &&  $_GET['id_ser'] != '') {
            $id_ser = $_GET['id_ser'];
            $sql = "SELECT  s.id_ser, s.pre_ser, s.fname_ser, s.lname_ser, s.tel_ser, s.email_ser, s.j_ser, r.name_room
            FROM    list s, room r
            WHERE   s.id_room = r.id_room
            AND     s.id_ser = $id_ser";
        } else {


            $sql = "SELECT  s.id_ser, s.pre_ser, s.fname_ser, s.lname_ser, s.tel_ser, s.email_ser, s.j_ser, r.name_room
            FROM     list s, room r
            WHERE  s.id_room = r.id_room";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $pre, $fname, $lname, $tel, $email, $j, $name_room);

        if ($stmt->num_rows() > 0) {

        ?>
            <table class="table table-Success table-striped table-hover table-responsive mt-3 ">
                <thead>
                    <tr>
                        <th scope="col">รหัส</th>
                        <th scope="col">คำนำหน้า</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col">email</th>
                        <th scope="col">จำนวนผู้พัก</th>
                        <th scope="col">ห้อง</th>
                        <?php 
                        if($_SESSION['u'] != null){ ?>
                        <th scope="colspan='2'">Action</th>
                        <th scope="col"></th>
                        <?php }else { ?>
                            <th scope="colspan='2'"></th>
                            <th scope="col"></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($stmt->fetch()) {
                        echo "<tr>";
                        echo "<th>" . $id . "</th>";
                        echo "<td>" . $pre . "</td>";
                        echo "<td>" . $fname . "</td>";
                        echo "<td>" . $lname . "</td>";
                        echo "<td>" . $tel . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $j . "</td>";
                        echo "<td>" . $name_room . "</td>";
                        if($_SESSION['u'] != null){
                            echo "<td><a href='deleteser.php?id_ser=" . $id . "'><input type='submit' class='btn btn-danger' value='DELETE'/></a></td>";
                            echo "<td><a href='editser.php?id_ser=" . $id . "'><input type='submit' class='btn btn-warning' value='UPDATE'/></a></td>";
                        }else {
                            echo "<td></td>";
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>

        <?php } else { ?>
            <div class="alert alert-warning mt-5 pt-3" role="alert">
                ไม่พบข้อมูล
            </div>

        <?php  } ?>
        <div class="container">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/16.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/Untitled-3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="img/Untitled-4.jpg" class="d-block w-100" alt="...">
          </div>
            <div class="carousel-item">
              <img src="img/88.jpg" class="d-block w-100" alt="...">
            </div>
          
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

     
    </div>
</body>

</html>