<?php
    include ('../connect.php');
    $start_time = microtime(TRUE);

    $query = "SELECT * FROM `post` ";

    $limit = 10; $specificID = ""; $id = -1;

    if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
        if ((int) $_GET['limit'] < 0) die("Limit can't be less than 1");
        $limit = (int) $_GET['limit'];
    }
    
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
        
        $specificID = "WHERE id = ?";
    }

    if ($stmt = $conn -> prepare('SELECT * FROM `post` $specificID ORDER BY time DESC limit ?')) {
        if (!empty($specificID) && $id != -1)
            $stmt->bind_param('ii', $id, $limit);
        else
            $stmt->bind_param('i', $limit);

        $stmt->execute();
        //$stmt->store_result();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            $array = array();
            while ($row = $result->fetch_array()) {
                $item = array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "article" => $row['article'],
                    "time" => $row['time'],
                    "writer" => $row['writer'],
                    "attachment" => $row['attachment'],
                    "cover" => $row['cover'],
                    "thumbnail" => $row['thumbnail'],
                    "tags" => $row['tags'],
                    "category" => $row['category'],
                    "visible" => $row['visible'],
                    "isPinned" => $row['isPinned'],
                    "isHidden" => $row['isHidden'],
                    "hotlink" => $row['hotlink']
                );
                array_push($array, $item);
            }
            
            $stmt->free_result();
            $stmt->close();
            echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            die("ID $id not found.");
        }
    }
?>