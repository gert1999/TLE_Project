<?php

//load.php

$connect = new PDO('mysql:host=boostworks.online;dbname=boostworksonline_ced', 'boostworksonline_ced-dashboard', '&G!0N995QE1tgq%3cujW');

$data = array();

$query = "SELECT * FROM appointments WHERE counselor_id= 2 ORDER BY id ";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["student_id"],
        'start'   => $row["start_time"],
        'end'   => $row["end_time"]
    );
}

echo json_encode($data);

?>
