<?php

//insert.php

$connect = new PDO('mysql:host=boostworks.online;dbname=boostworksonline_ced', 'boostworksonline_ced-dashboard', '&G!0N995QE1tgq%3cujW');

if(isset($_POST["title"]))
{
    $query = "
 INSERT INTO appointments
 (student_id, start_time, end_time)
 VALUES (:title, :start_event, :end_event)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end']
        )
    );
}


?>
