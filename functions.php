<?php

include("connection.php");

    function random_num($length){
        $text = "";
        if($length < 5){
            $length = 5;
        }
        $len = rand(4,$length);

        for($i = 0;$i < $len; $i++){
            $text .= rand(0,9);
        }

        return $text;
    }

    function daysLeft($data){
        $date1 = new DateTime($data['project_start_date']);
        $date2 = new DateTime($data['project_end_date']);
        $currentDate = new DateTime(date("Y-m-d"));
        $diff = $date2->diff($date1)->format("%a");
        $diff1 = $date2->diff($currentDate)->format("%a");
        $daysLeft = intval(min($diff,$diff1));

        return $daysLeft;
    }

    function getAll($table){
        global $conn;

        $select = " SELECT * FROM $table ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getById($table, $id){
        global $conn;

        $select = " SELECT * FROM $table WHERE $table.[project_id] = '$id' ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getMilestoneById($table, $id){
        global $conn;

        $select = " SELECT * FROM $table WHERE $table.[milestone_id] = '$id' ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getTaskById($table, $id){
        global $conn;

        $select = " SELECT * FROM $table WHERE $table.[task_id] = '$id' ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getNoteById($table, $id){
        global $conn;

        $select = " SELECT * FROM $table WHERE $table.[note_id] = '$id' ";

        $result = $conn->query($select);

        return $result;
    }

    function getByName($table, $name){
        global $conn;

        $select = " SELECT * FROM $table WHERE name = '$name' ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getProjectsByUser($user_id){
        global $conn;

        $select = " SELECT * FROM [Projects] WHERE project_userID = '$user_id' ";
        
        $result = $conn->query($select);

        return $result;
    }

    function getMilestonesByProjectCount($id){
        global $conn;

        $select = " SELECT COUNT(*) FROM [Milestones] WHERE milestone_projectID = '$id'";

        $result = $conn->query($select);

        return $result;
    }

    function getMilestonesByProject($id){
        global $conn;

        $select = " SELECT * FROM [Milestones] WHERE milestone_projectID = '$id'";

        $result = $conn->query($select);

        return $result;
    }

    function getNotesByUser($id){
        global $conn;

        $select = " SELECT * FROM [Notes] WHERE note_userID = '$id'";

        $result = $conn->query($select);

        return $result;
    }

    function test($name){
        global $conn;

        $select = " SELECT COUNT(*) FROM [Projects] WHERE project_name = '$name'";

        $result = $conn->query($select);
        
        return $result;
    }

    function test1($title){
        global $conn;

        $select = " SELECT COUNT(*) FROM [Milestones] WHERE milestone_title = '$title'";

        $result = $conn->query($select);
        
        return $result;
    }

    function test2($title){
        global $conn;

        $select = " SELECT COUNT(*) FROM [Milestones] WHERE milestone_title = '$title'";

        $result = $conn->query($select);
        
        return $result;
    }

    function noteCount($title){
        global $conn;

        $select = " SELECT COUNT(*) FROM [Notes] WHERE note_title = '$title'";

        $result = $conn->query($select);

        return $result;
    }

    function getStatusProject($table,$id){
        global $conn;

        $select = " SELECT * FROM $table WHERE projectStatus_id = '$id' ";

        $result = $conn->query($select);

        return $result;
    }

    function getStatusMilestone($table,$id){
        global $conn;

        $select = " SELECT * FROM $table WHERE milestoneStatus_id = '$id' ";

        $result = $conn->query($select);

        return $result;
    }

    function rowCount($table, $user_id){
        global $conn;

        $select = " SELECT COUNT(*) FROM $table WHERE userID = '$user_id' ";

        $result = $conn->query($select);

        return $result;
    }

    function manyToManyProjectCount($table1, $table2, $table3, $user_id){
        global $conn;

        $select = " SELECT COUNT(*) FROM $table1 INNER JOIN $table2 ON '$user_id' = $table2.userID INNER JOIN $table3 ON $table2.projectID = $table3.[project_id] WHERE $table1.[user_id] = '$user_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function manyToManyProject($table1, $table2, $table3, $user_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON '$user_id' = $table2.[userID] INNER JOIN $table3 ON $table2.[projectID] = $table3.[project_id] WHERE $table1.[user_id] = '$user_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function manyToManyProject1($table1, $table2, $table3, $table4, $user_id, $status_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON '$user_id' = $table2.[userID] INNER JOIN $table3 ON $table2.[projectID] = $table3.[project_id] INNER JOIN $table4 ON $table3.[project_statusID] = $table4.[projectStatus_id] WHERE $table1.[user_id] = '$user_id' AND $table4.[projectStatus_id] = '$status_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function manyToManyTaskCount($table1, $table2, $table3, $user_id){
        global $conn;

        $select = " SELECT COUNT(*) FROM $table1 INNER JOIN $table2 ON '$user_id' = $table2.[userID] INNER JOIN $table3 ON $table2.[taskID] = $table3.[task_id] WHERE $table1.[user_id] = '$user_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function manyToManyTask($table1, $table2, $table3, $user_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON '$user_id' = $table2.[userID] INNER JOIN $table3 ON $table2.[taskID] = $table3.[task_id] WHERE $table1.[user_id] = '$user_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks($table1, $table2, $table3, $table4, $table5, $table6, $table7, $user_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON $user_id = $table2.[userID] INNER JOIN $table3 ON $table2.[taskID] = $table3.[task_id] INNER JOIN $table4 ON $table3.[task_projectID] = $table4.[project_id] INNER JOIN $table5 ON $table3.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table3.[task_milestoneID] = $table6.[milestone_id] INNER JOIN $table7 ON $table3.[task_statusID] = $table7.[taskStatus_id] WHERE $table1.[user_id] = '$user_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks1($table1, $table2, $table3, $table4, $table5, $table6, $table7, $user_id, $project_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] INNER JOIN $table7 ON $table2.[task_statusID] = $table7.[taskStatus_id] WHERE $table1.[project_id] = '$project_id' AND $table4.[user_id] = $user_id ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks2($table1, $table2, $table3, $table4, $table5, $table6, $user_id, $task_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] WHERE $table2.[task_id] = '$task_id' AND $table4.[user_id] = $user_id ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks3($table1, $table2, $table3, $table4, $table5, $table6, $task_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] WHERE $table2.[task_id] = '$task_id' ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks4($table1, $table2, $table3, $table4, $table5, $table6, $table7, $user_id, $project_id, $status_id){
        global $conn;

        $select = " SELECT * FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] INNER JOIN $table7 ON $table2.[task_statusID] = $table7.[taskStatus_id] WHERE $table1.[project_id] = '$project_id' AND $table4.[user_id] = $user_id AND $table7.[taskStatus_id] = $status_id";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks5($table1, $table2, $table3, $table4, $table5, $table6, $table7, $user_id, $project_id, $status_id, $priority_id){
        global $conn;

        $select = "SELECT * FROM $table1 INNER JOIN $table2 ON $table1.[user_id] = $table2.[userID] INNER JOIN $table3 ON $table2.[taskID] = $table3.[task_id] INNER JOIN $table4 ON $table3.[task_projectID] = $table4.[project_id] INNER JOIN $table5 ON $table3.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table3.[task_milestoneID] = $table6.[milestone_id] INNER JOIN $table7 ON $table3.[task_statusID] = $table7.[taskStatus_id] ";
          
        if($project_id != '0'){
            $select .= "WHERE $table3.[task_projectID] = '$project_id' ";
        }
        if($user_id != '0'){
            $select .= "AND $table2.[userID] = '$user_id' ";
        }
        if($status_id != '0'){
            $select .= "AND $table3.[task_statusID] = '$status_id' ";
        }
        if($priority_id != '0'){
            $select .= "AND $table3.[task_priorityID] = '$priority_id' ";
        }

        $result = $conn->query($select);

        return $result; 
    }

    function getTasks1Count($table1, $table2, $table3, $table4, $table5, $table6, $user_id, $project_id){
        global $conn;

        $select = " SELECT COUNT(*) FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] WHERE $table1.[project_id] = '$project_id' AND $table4.[user_id] = $user_id ";

        $result = $conn->query($select);

        return $result; 
    }

    function getTasksCount2($table, $project_id){
        global $conn;
        
        $select = " SELECT COUNT(*) FROM $table WHERE $table.[task_projectID] = $project_id ";

        $result = $conn->query($select);
        
        return $result;
    }

    function getTasksCount3($table1, $table2, $table3, $table4, $table5, $table6, $table7, $user_id, $project_id, $status_id){
        global $conn;

        $select = " SELECT COUNT(*) FROM $table1 INNER JOIN $table2 ON $table1.[project_id] = $table2.[task_projectID] INNER JOIN $table3 ON $table2.[task_id] = $table3.[taskID] INNER JOIN $table4 ON $table3.[userID] = $table4.[user_id] INNER JOIN $table5 ON $table2.[task_priorityID] = $table5.[taskPriority_id] INNER JOIN $table6 ON $table2.[task_milestoneID] = $table6.[milestone_id] INNER JOIN $table7 ON $table2.[task_statusID] = $table7.[taskStatus_id] WHERE $table1.[project_id] = '$project_id' AND $table4.[user_id] = $user_id AND $table7.[taskStatus_id] = $status_id";

        $result = $conn->query($select);

        return $result; 
    }

    function lastOneTask($table){
        global $conn;
        
        $select = " SELECT TOP 1 * FROM $table ORDER BY task_id DESC ";

        $result = $conn->query($select);
        
        return $result;
    }

    function lastOneProject($table){
        global $conn;
        
        $select = " SELECT TOP 1 * FROM $table ORDER BY project_id DESC ";

        $result = $conn->query($select);
        
        return $result;
    }

    function getRecommended($category_id){
        global $conn;

        $select = " SELECT * FROM products WHERE category_id = '$category_id' Limit 4";
        
        $result = $conn->query($select);

        return $result;
    }

    function fillChart($table, $id, $day){
        global $conn;
        
        $select = " SELECT COUNT(*) FROM $table WHERE $table.[task_StatusID] = $id AND $table.[task_created_at] = '$day' ";

        $result = $conn->query($select);
        
        if(!(isset($result))){
            $result = 0;
        }
        
        return $result;
    }

    function fillChart1($table, $id){
        global $conn;
        
        $select = " SELECT COUNT(*) FROM $table WHERE $table.[project_statusID] = $id ";

        $result = $conn->query($select);
        
        if(!(isset($result))){
            $result = 0;
        }
        
        return $result;
    }

    function fillChart2($table, $table1, $id, $projectid, $day){
        global $conn;
        
        $select = " SELECT COUNT(*) FROM $table INNER JOIN $table1 ON $table1.[project_id] = $table.[task_projectID] WHERE $table.[task_StatusID] = $id AND $table.[task_created_at] = '$day' AND $table1.[project_id] = $projectid ";

        $result = $conn->query($select);
        
        if(!(isset($result))){
            $result = 0;
        }
        
        return $result;
    }

    function calPercentage($numAmount, $numTotal){
        $count1 = $numAmount / $numTotal;
        $count2 = $count1 * 100;
        $count = number_format($count2,0);

        return $count;
    }

    function getDoneTask($table, $id){
        global $conn;
        
        $select = " SELECT COUNT(*) FROM $table WHERE $table.[task_StatusID] = $id ";

        $result = $conn->query($select);
        
        if(!(isset($result))){
            $result = 0;
        }
        
        return $result;
    }
?>
