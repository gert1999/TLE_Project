<?php

//update.php

$connect = new PDO('mysql:host=boostworks.online;dbname=boostworksonline_ced', 'boostworksonline_ced-dashboard', '&G!0N995QE1tgq%3cujW');

if(isset($_POST["id"]))
{
    $query = "
 UPDATE appointments
 SET subject=:title, start_time=:start_event, end_time=:end_event
 WHERE id=:id
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':id'   => $_POST['id']
        )
    );
}

?>
