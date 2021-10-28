<?php
        session_start();
        if($_SESSION['u'] != null){
        include_once('dbconnect.php');
        $id_ser = $_GET['id_ser'];
       

        $sql = "SELECT id_ser FROM     list   WHERE   id_ser like ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id_ser);

        $stmt->execute();
        $stmt -> store_result(); 
        $stmt -> bind_result($id_ser); 

        if($stmt->fetch()){
                $sql1 = "DELETE FROM   list   WHERE id_ser like ?";
                $stmt = $conn->prepare($sql1);
                $stmt->bind_param("s",$id_ser);
                $stmt->execute();

                $sql2 = "DELETE FROM account WHERE id_ser like ?";
                $stmt = $conn->prepare($sql2);
                $stmt->bind_param("s",$id_ser);
                $stmt->execute();

                $stmt->close();
                header( 'Location: showser.php');
        }else { ?>
                <div class="alert alert-warning mt-5 pt-3" role="alert">
                ไม่พบข้อมูลที่ต้องการลบ <?php echo $id_ser;  ?>
            </div>
      <?php  } }else { header( 'Location: showlist .php'); }?>
?>
