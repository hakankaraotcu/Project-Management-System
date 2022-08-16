<?php
session_start();
include("connection.php");
include("functions.php");

$project_id = $_GET['id'];

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $projectID = $_POST['project_id'];
    $milestoneID = $_POST['milestone_id'];
    $priority = $_POST['priority'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $createdDate = date("l");

    $select = " SELECT * FROM [Tasks] WHERE task_title = '$title'";
    $result = $conn->query($select);
    
    if($result->rowCount() == -1){
        $error[] = 'task already exist';
    }
    else{
        $insert = " INSERT INTO [Tasks] (task_projectID, task_milestoneID, task_priorityID, task_statusID, task_title, task_start_date, task_end_date, task_description, task_created_at) VALUES ('$projectID','$milestoneID','$priority',1,'$title','$startDate','$endDate','$description','$createdDate') ";
        $conn->query($insert);
        $addedTask = lastOneTask("Tasks");
        $addedTaskData = $addedTask->fetch(PDO::FETCH_ASSOC);
        $taskID = $addedTaskData['task_id'];
        if(!empty($_POST['assign_to'])){
            foreach($_POST['assign_to'] as $selected){
                $insert = " INSERT INTO [UsersTasks] (userID, taskID) VALUES ('$selected','$taskID')";
                $conn->query($insert);
            }
        }
    }
}
if(isset($_POST['_method'])){
    $taskID = $_POST['task_id'];
    $taskStatus = $_POST['task_status'];
    
    $delete = " DELETE FROM [Tasks] WHERE task_id = '$taskID' ";
    $result = $conn->query($delete);
    
    /*else if($_POST['_method'] == 'DRAG'){
        $update = " UPDATE [tasks] set task_statusID = '$taskStatus' WHERE task_id = '$taskID' ";
        $conn->query($update);
    }*/
}
if(isset($_POST['_method1'])){
    $taskID = $_POST['task_id1'];
    $taskStatus = $_POST['task_status1'];
    $createdDate = date("l");

    $update = " UPDATE [tasks] SET task_statusID = '$taskStatus', task_created_at = '$createdDate' WHERE task_id = '$taskID' ";
    $conn->query($update);
}
if(isset($_POST['_method2'])){
    $taskID = $_POST['task_id2'];
    $taskStatus = $_POST['task_status2'];
    $createdDate = date("l");

    $update = " UPDATE [tasks] set task_statusID = '$taskStatus', task_created_at = '$createdDate' WHERE task_id = '$taskID' ";
    $conn->query($update);
}
if(isset($_POST['_method3'])){
    $taskID = $_POST['task_id3'];
    $taskStatus = $_POST['task_status3'];
    $createdDate = date("l");

    $update = " UPDATE [tasks] set task_statusID = '$taskStatus', task_created_at = '$createdDate' WHERE task_id = '$taskID' ";
    $conn->query($update);
}
if(isset($_POST['_method4'])){
    $taskID = $_POST['task_id4'];
    $taskStatus = $_POST['task_status4'];
    $createdDate = date("l");

    $update = " UPDATE [tasks] set task_statusID = '$taskStatus', task_created_at = '$createdDate' WHERE task_id = '$taskID' ";
    $conn->query($update);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link rel="stylesheet" href="Main2.css">
    <link rel="stylesheet" href="colors.css">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="spacing.css">
    <link rel="stylesheet" href="text.css">
    <script src="https://kit.fontawesome.com/de4dd1ef2c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script>
        $(document).ready(function(){
            $(".messages .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".profile").removeClass("active");
                $(".notifications").removeClass("active");
                $(".dropdown-menu").removeClass("active");
            });
            
            $(".profile .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".notifications").removeClass("active");
                $(".dropdown-menu").removeClass("active");
            });

            $(".notifications .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".profile").removeClass("active");
                $(".dropdown-menu").removeClass("active");
            });
            $(".btnAddNew").click(function(){
                $(".addNew").toggleClass("active");
            });
            $(".btnCancel").click(function(){
                $(".modal").removeClass("active");
            });
            $(".close").click(function(){
                $(".modal").removeClass("active");
            });
            $(".btnSettings").click(function(){
                var t = $(this);
                t.next('.dropdown-menu').toggleClass('active');
                $(".messages").removeClass("active");
                $(".notifications").removeClass("active");
                $(".profile").removeClass("active");
            });
        });
    </script>
    <script>
        function deleteSection(id){
            $(".popup_box").css({
                    "display":"block", "pointer-events":"auto"
            });
            $(".btn1").click(function(){
                $(".popup_box").css({
                    "display":"none","pointer-events":"auto"
                });
            });
            $(".btn2").click(function(){
                $(".popup_box").css({
                    "display":"none","pointer-events":"auto"
                });
                document.getElementById(id).submit();
                $(".alert").removeClass("hide");
                $(".alert").addClass("show");
                $(".alert").addClass("showAlert");
                setTimeout(function(){
                    $(".alert").addClass("hide");
                    $(".alert").removeClass("show");
                },3000);
            });
            $(".close-btn").click(function(){
                $(".alert").addClass("hide");
                $(".alert").removeClass("show");
            })
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <i class="fa-solid fa-copyright"></i>
                    <div class="logo_name">ProjectName</div>
                </div>
            </div>
            <ul class="nav_list">
                <li>
                    <a href="dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="projects.php">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="links_name">Projects</span>
                    </a>
                    <span class="tooltip">Projects</span>
                </li>
                <li>
                    <a href="tasks.php">
                        <i class="fa-solid fa-list-check"></i>
                        <span class="links_name">Tasks</span>
                    </a>
                    <span class="tooltip">Tasks</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-clock"></i>
                        <span class="links_name">Timesheet</span>
                    </a>
                    <span class="tooltip">Timesheet</span>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="links_name">Users</span>
                    </a>
                    <span class="tooltip">Users</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="links_name">Calendar</span>
                    </a>
                    <span class="tooltip">Calendar</span>
                </li>
                <li>
                    <a href="notes.php">
                        <i class="fa-solid fa-clipboard"></i>
                        <span class="links_name">Notes</span>
                    </a>
                    <span class="tooltip">Notes</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-comment-dots"></i>
                        <span class="links_name">Chat</span>
                    </a>
                    <span class="tooltip">Chat</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="links_name">Workspace Settings</span>
                    </a>
                    <span class="tooltip">Workspace Settings</span>
                </li>
            </ul>
        </div>
        <div class="header">
            <div class="navbar-bg"></div>
            <div class="navbar_left">
                <div class="bars">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-bars" id="menuBtn"></i>
                    </div>
                </div>
            </div>
            <div class="navbar_right">
                <div class="messages">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="message_dd" id="notification_dd">
                        <ul class="message_ul">
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="show_all">
                                <p class="link">Show All Messages</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="notifications">
                    <div class="icon_wrap">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="notification_dd" id="notification_dd">
                        <ul class="notification_ul">
                            <li class="success starbucks">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed baskin_robbins">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success mcd">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="failed pizza_hut">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Failed</p>
                                </div>
                            </li>
                            <li class="success kfc">
                                <div class="notify_icon">
                                    <span class="icon"></span>
                                </div>
                                <div class="notify_data">
                                    <div class="title">
                                        Lorem ipsum dolor sit.
                                    </div>
                                    <div class="sub_title">
                                        Lorem ipsum dolor sit amet consectetur.
                                    </div>
                                </div>
                                <div class="notify_status">
                                    <p>Success</p>
                                </div>
                            </li>
                            <li class="show_all">
                                <p class="link">Show All Notifications</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="profile">
                    <?php
                    if(isset($_SESSION['user'])){
                        ?>
                            <div class="icon_wrap">
                                <img src="person1.png" alt="profile_pic">
                                <span class="name"><?= $_SESSION['user']['userFirstName']," ", $_SESSION['user']['userLastName'] ?></span>
                                <?php
                                if(isset($error)){
                                    foreach($error as $error){
                                        echo '<span class="error-msg">'.$error.'</span>';
                                    }
                                }
                                ?>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                        <?php
                    }
                    else{
                        echo "Something went wrong";
                    }
                    ?>
                    <div class="profile_dd" id="profile_dd">
                        <ul class="profile_ul">
                            <li class="profile_li">
                                <a class="profile" href="#" style="text-align: center;">
                                    <?= $_SESSION['user']['role'] ?>
                                </a>
                            </li>
                            <li>
                                <a class="profile" href="#">
                                    <span class="picon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="settings" href="#">
                                    <span class="picon">
                                        <i class="fa-solid fa-gear"></i>
                                    </span>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a class="logout" href="logout.php">
                                    <span class="picon">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_content" style="min-height: 517px;">
            <section class="section">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h2 class="section-title">
                            Task
                        </h2>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <div class="mt-4">
                                <a href="projectDetails.php?id=<?= $project_id ?>" class="btn btn-primary ml-3"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                <button type="button" class="btn btn-primary ml-3 btnAddNew"><i class="fa-solid fa-plus" style="padding-right: 5px;"></i>Add New</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="board">
                            <div class="tasks" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                             <?php
                                    $tasks1 = getTasksCount3("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 1);
                                    $tasksCount1 = $tasks1->fetchColumn();
                                ?>
                                <div class="mt-0 task-header text-uppercase">Todo (<span class="count"><?= $tasksCount1 ?></span>)</div>
                                    <div class="task-list-items 1 todo">
                                <?php
                                    $tasks = getTasks4("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 1);
                                    foreach($tasks as $task){
                                        ?>
                                            <div class="card mb-0 taskBox <?= $task['task_id'] ?>" id="<?= $task['task_id'] ?> todo" draggable="true" ondragstart="dragStart(event)" ondragend="dragEnd(event)">
                                                <div class="card-body p-3">
                                                    <div class="dropdown float-right">
                                                        <div class="dropdown-toggle text-mutex btnSettings">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(14px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="taskEdit.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="dropdown-item btnEdit">
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item btnDelete" onclick="deleteSection(<?= $task['task_id'] ?>);">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <form action="" id="<?= $task['task_id'] ?>" style="display: none;" method="post">
                                                                <input type="hidden" name="task_status" value="">
                                                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method" value="">
                                                            </form>
                                                            <form action="" id="<?= $task['task_id'] ?>todo" style="display: none;" method="post" name="<?= $task['task_id'] ?>todo">
                                                                <input type="hidden" name="task_status1" value="">
                                                                <input type="hidden" name="task_id1" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method1" value="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="taskDetails.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                    </div>
                                                    <span class="badge badge-success"><?= $task['taskPriority_priority'] ?></span>
                                                     <p class="mt-2 mb-2">
                                                         <span class="text-nowrap d-inline-block">
                                                            <i class="fa-solid fa-comments text-muted"></i>
                                                            <b>0</b> Comments
                                                        </span>
                                                    </p>
                                                    <small class="float-right text-muted mt-2">22 Jul 2022</small>
                                                    <figure class="avatar avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="hakan" data-sr-id="3" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                                        <img class="rounded-circle" src="person1.png" alt="hakan">
                                                    </figure>
                                                </div>
                                            </div>
                                        
                                    <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="tasks" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <?php
                                    $tasks2 = getTasksCount3("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 2);
                                    $tasksCount2 = $tasks2->fetchColumn();
                                ?>
                                <div class="mt-0 task-header text-uppercase">In Progress (<span class="count"><?= $tasksCount2 ?></span>)</div>
                                    <div class="task-list-items 2 inprogress">
                                <?php
                                    $tasks = getTasks4("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 2);
                                    foreach($tasks as $task){
                                        ?>
                                            <div class="card mb-0 taskBox <?= $task['task_id'] ?>" id="<?= $task['task_id'] ?> inprogress" draggable="true" ondragstart="dragStart(event)" ondragend="dragEnd(event)">
                                                <div class="card-body p-3">
                                                    <div class="dropdown float-right">
                                                        <div class="dropdown-toggle text-mutex btnSettings">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(14px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="taskEdit.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="dropdown-item btnEdit">
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item btnDelete" onclick="deleteSection(<?= $task['task_id'] ?>);">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <form action="" id="<?= $task['task_id'] ?>" style="display: none;" method="post">
                                                                <input type="hidden" name="task_status" value="">
                                                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method" value="">
                                                            </form>
                                                            <form action="" id="<?= $task['task_id'] ?>inprogress" style="display: none;" method="post" name="<?= $task['task_id'] ?>inprogress">
                                                                <input type="hidden" name="task_status2" value="">
                                                                <input type="hidden" name="task_id2" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method2" value="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="taskDetails.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                    </div>
                                                    <span class="badge badge-success"><?= $task['taskPriority_priority'] ?></span>
                                                     <p class="mt-2 mb-2">
                                                         <span class="text-nowrap d-inline-block">
                                                            <i class="fa-solid fa-comments text-muted"></i>
                                                            <b>0</b> Comments
                                                        </span>
                                                    </p>
                                                    <small class="float-right text-muted mt-2">22 Jul 2022</small>
                                                    <figure class="avatar avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="hakan" data-sr-id="3" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                                        <img class="rounded-circle" src="person1.png" alt="hakan">
                                                    </figure>
                                                </div>
                                            </div>
                                    <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="tasks" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <?php
                                    $tasks3 = getTasksCount3("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 3);
                                    $tasksCount3 = $tasks3->fetchColumn();
                                ?>
                                <div class="mt-0 task-header text-uppercase">Review (<span class="count"><?= $tasksCount3 ?></span>)</div>
                                    <div class="task-list-items 3 review">
                                <?php
                                    $tasks = getTasks4("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 3);
                                    foreach($tasks as $task){
                                        ?>
                                            <div class="card mb-0 taskBox <?= $task['task_id'] ?>" id="<?= $task['task_id'] ?> review" draggable="true" ondragstart="dragStart(event)" ondragend="dragEnd(event)">
                                                <div class="card-body p-3">
                                                    <div class="dropdown float-right">
                                                        <div class="dropdown-toggle text-mutex btnSettings">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(14px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="taskEdit.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="dropdown-item btnEdit">
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item btnDelete" onclick="deleteSection(<?= $task['task_id'] ?>);">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <form action="" id="<?= $task['task_id'] ?>" style="display: none;" method="post">
                                                                <input type="hidden" name="task_status" value="">
                                                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method" value="">
                                                            </form>
                                                            <form action="" id="<?= $task['task_id'] ?>review" style="display: none;" method="post" name="<?= $task['task_id'] ?>review">
                                                                <input type="hidden" name="task_status3" value="">
                                                                <input type="hidden" name="task_id3" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method3" value="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="taskDetails.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                    </div>
                                                    <span class="badge badge-success"><?= $task['taskPriority_priority'] ?></span>
                                                     <p class="mt-2 mb-2">
                                                         <span class="text-nowrap d-inline-block">
                                                            <i class="fa-solid fa-comments text-muted"></i>
                                                            <b>0</b> Comments
                                                        </span>
                                                    </p>
                                                    <small class="float-right text-muted mt-2">22 Jul 2022</small>
                                                    <figure class="avatar avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="hakan" data-sr-id="3" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                                        <img class="rounded-circle" src="person1.png" alt="hakan">
                                                    </figure>
                                                </div>
                                            </div>
                                    <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="tasks" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <?php
                                $tasks4 = getTasksCount3("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 4);
                                $tasksCount4 = $tasks4->fetchColumn();
                                ?>
                                <div class="mt-0 task-header text-uppercase">Done (<span class="count"><?= $tasksCount4 ?></span>)</div>
                                    <div class="task-list-items 4 done">
                                <?php
                                    $tasks = getTasks4("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id, 4);
                                    foreach($tasks as $task){
                                        ?>
                                            <div class="card mb-0 taskBox <?= $task['task_id'] ?>" id="<?= $task['task_id'] ?> done" draggable="true" ondragstart="dragStart(event)" ondragend="dragEnd(event)">
                                                <div class="card-body p-3">
                                                    <div class="dropdown float-right">
                                                        <div class="dropdown-toggle text-mutex btnSettings">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(14px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="taskEdit.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="dropdown-item btnEdit">
                                                                <i class="fa-solid fa-pen"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item btnDelete" onclick="deleteSection(<?= $task['task_id'] ?>);">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <form action="" id="<?= $task['task_id'] ?>" style="display: none;" method="post">
                                                                <input type="hidden" name="task_status" value="">
                                                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method" value="">
                                                            </form>
                                                            <form action="" id="<?= $task['task_id'] ?>done" style="display: none;" method="post" name="<?= $task['task_id'] ?>done">
                                                                <input type="hidden" name="task_status4" value="">
                                                                <input type="hidden" name="task_id4" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method4" value="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="taskDetails.php?projectId=<?= $project_id ?>&taskId=<?= $task['task_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                    </div>
                                                    <span class="badge badge-success"><?= $task['taskPriority_priority'] ?></span>
                                                     <p class="mt-2 mb-2">
                                                         <span class="text-nowrap d-inline-block">
                                                            <i class="fa-solid fa-comments text-muted"></i>
                                                            <b>0</b> Comments
                                                        </span>
                                                    </p>
                                                    <small class="float-right text-muted mt-2">22 Jul 2022</small>
                                                    <figure class="avatar avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="hakan" data-sr-id="3" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                                        <img class="rounded-circle" src="person1.png" alt="hakan">
                                                    </figure>
                                                </div>
                                            </div>
                                    <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade show addNew" style="display: hidden; padding-right: 17px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Task</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <input type="hidden" name="_token" value="">
                        <?php
                        $projects = getAll("Projects");
                        $milestones = getAll("Milestones");
                        $priorities = getAll("TaskPriority");
                        $users = getAll("Users");
                        ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Project</label>
                                    <select class="form-control form-control-light" name="project_id" required="">
                                        <?php
                                            if($projects->rowCount() == -1){
                                                foreach($projects as $project){
                                                    ?>
                                                    <option value="<?= $project['project_id'] ?>"><?= $project['project_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="task-milestone">Milestone</label>
                                    <select class="form-control form-control-light" name="milestone_id" required="required">
                                        <?php
                                            if($milestones->rowCount() == -1){
                                                foreach($milestones as $milestone){
                                                    ?>
                                                    <option value="<?= $milestone['milestone_id'] ?>"><?= $milestone['milestone_title'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="task-title">Title</label>
                                    <input type="text" class="form-control form-control-light" placeholder="Enter Title" name="title" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="task-priority">Priority</label>
                                    <select class="form-control form-control-light" name="priority" required="">
                                        <?php
                                            if($priorities->rowCount() == -1){
                                                foreach($priorities as $priority){
                                                    ?>
                                                    <option value="<?= $priority['taskPriority_id'] ?>"><?= $priority['taskPriority_priority'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="start_date" name="start_date" value="" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="end_date" name="end_date" value="" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assign_to">Assign To</label>
                                    <select class="form-control form-control-light" name="assign_to[]" required="" multiple>
                                        <?php
                                            if($users->rowCount() == -1){
                                                foreach($users as $user){
                                                    ?>
                                                    <option value="<?= $user['user_id'] ?>"><?= $user['first_name'],$user['email']?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-description">Description</label>
                            <textarea class="form-control form-control-light" rows="3" name="description"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btnCancel">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_box">
        <i class="fa-solid fa-exclamation"></i>
        <h1>Your task will be deleted Permanently!</h1>
        <label>Are you sure to proceed?</label>
        <div class="btns">
            <a href="#" class="btn1">Cancel</a>
            <a href="#" class="btn2">Delete</a>
        </div>
    </div>
    <div class="alert hide">
        <span class="fa-solid fa-circle-exclamation"></span>
        <span class="msg">Warning: This is a warning alert!</span>
        <span class="fa-solid fa-xmark close-btn"></span>
    </div>
    <script>
        let btn = document.querySelector("#menuBtn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>
    <script>
        const taskHeader = document.querySelector('.task-header');
        const taskSection1 = document.querySelector('.todo');
        const taskSection2 = document.querySelector('.inprogress');
        const taskSection3 = document.querySelector('.review');
        const taskSection4 = document.querySelector('.done');
        var Myelement;
        var taskBox;
        var taskid;
        var space;
        var taskclass;
        var taskcl;
        
        function dragStart(event){
            console.log('dragStart has been triggered');
            const taskclass = event.target.classList;
            taskcl = taskclass[3];
            event.target.className += ' hold';
            taskid = event.target.id;
            taskBox = event.target;
            setTimeout(() => {
                event.target.className = 'hide';
            }, 0);
        }

        function dragEnd(event){
            console.log('dragEnd has been triggered');
            event.target.className = 'card mb-0 taskBox ';
            console.log(taskcl);
            event.target.className += taskcl;
        }

        taskSection1.addEventListener('dragover', (e)=>{
            e.preventDefault();
            console.log('dragOver has been triggered');
        });
        taskSection1.addEventListener('dragenter', (e)=>{
            console.log('dragEnter has been triggered');
        });
        taskSection1.addEventListener('dragleave', ()=>{
            console.log('dragLeave has been triggered');
        });
        taskSection1.addEventListener('drop', (e)=>{
            console.log('dragDrop has been triggered');
            $changeStatus = taskSection1.classList;
            e.target.append(taskBox);
            space = taskid.slice(0, taskid.indexOf(" "));
            taskid = taskid.replace(/\s+/g, '');
            console.log(taskid);
            Myelement = document.forms[taskid][0];
            Myelement.value = $changeStatus[1];
            document.getElementById(taskid).submit();
        });
        taskSection2.addEventListener('dragover', (e)=>{
            e.preventDefault();
            console.log('dragOver has been triggered');
        });
        taskSection2.addEventListener('dragenter', ()=>{
            console.log('dragEnter has been triggered');
        });
        taskSection2.addEventListener('dragleave', ()=>{
            console.log('dragLeave has been triggered');
        });
        taskSection2.addEventListener('drop', (e)=>{
            console.log('dragDrop has been triggered');
            $changeStatus = taskSection2.classList;
            e.target.append(taskBox);
            space = taskid.slice(0, taskid.indexOf(" "));
            taskid = taskid.replace(/\s+/g, '');
            console.log(taskid);
            Myelement = document.forms[taskid][0];
            Myelement.value = $changeStatus[1];
            document.getElementById(taskid).submit();
        });
        taskSection3.addEventListener('dragover', (e)=>{
            e.preventDefault();
            console.log('dragOver has been triggered');
        });
        taskSection3.addEventListener('dragenter', ()=>{
            console.log('dragEnter has been triggered');
        });
        taskSection3.addEventListener('dragleave', ()=>{
            console.log('dragLeave has been triggered');
        });
        taskSection3.addEventListener('drop', (e)=>{
            console.log('dragDrop has been triggered');
            $changeStatus = taskSection3.classList;
            e.target.append(taskBox);
            space = taskid.slice(0, taskid.indexOf(" "));
            taskid = taskid.replace(/\s+/g, '');
            console.log(taskid);
            Myelement = document.forms[taskid][0];
            Myelement.value = $changeStatus[1];
            document.getElementById(taskid).submit();
        });
        taskSection4.addEventListener('dragover', (e)=>{
            e.preventDefault();
            console.log('dragOver has been triggered');
        });
        taskSection4.addEventListener('dragenter', ()=>{
            console.log('dragEnter has been triggered');
        });
        taskSection4.addEventListener('dragleave', ()=>{
            console.log('dragLeave has been triggered');
        });
        taskSection4.addEventListener('drop', (e)=>{
            console.log('dragDrop has been triggered');
            $changeStatus = taskSection4.classList;
            e.target.append(taskBox);
            space = taskid.slice(0, taskid.indexOf(" "));
            taskid = taskid.replace(/\s+/g, '');
            console.log(taskid);
            Myelement = document.forms[taskid][0];
            Myelement.value = $changeStatus[1];
            document.getElementById(taskid).submit();
        });
    </script>
</body>
</html>