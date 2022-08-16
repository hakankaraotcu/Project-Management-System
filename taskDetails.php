<?php
session_start();
include("connection.php");
include("functions.php");

$project_id = $_GET['projectId'];
$task_id = $_GET['taskId'];
$task_data = getTasks3("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", $task_id);
$dataTask = $task_data->fetch(PDO::FETCH_ASSOC);
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
            $(".close").click(function(){
                window.location.href = "task.php?id=<?= $project_id ?>";
            });
        });
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
                            <div class="tasks animated" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <?php
                                    $tasksCount = getTasks1Count("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", $_SESSION['user']['userId'], $project_id);
                                    $taskCount = $tasksCount->fetchColumn();
                                ?>
                                <div class="mt-0 task-header text-uppercase">Todo (<span class="count"><?= $taskCount ?></span>)</div>
                                <?php
                                    $tasks = getTasks1("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", "TaskStatus" , $_SESSION['user']['userId'], $project_id);
                                    foreach($tasks as $task){
                                        ?>
                                        <div class="task-list-items">
                                            <div class="card mb-0">
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
                                                            <a href="#" class="dropdown-item btnDelete">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <form action="" id="delete" style="display: none;" method="post">
                                                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a href="#" data-ajax-popup="true" data-size="lg" data-title="task1 <span class='badge badge-success'>Low</span>" class="text-body"><?= $task['task_title'] ?></a>
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
                                        </div>
                                    <?php
                                    }
                                ?>
                            </div>
                            <div class="tasks animated" data-sr-id="4" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                    <div class="mt-0 task-header text-uppercase">In Progress (<span class="count">0</span>)</div>
                                    <div id="task-list-18683" data-status="18683" class="task-list-items"></div>
                            </div>
                            <div class="tasks animated" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <div class="mt-0 task-header text-uppercase">Review (<span class="count">0</span>)</div>
                                <div class="task-list-items"></div>
                            </div>
                            <div class="tasks animated" data-sr-id="6" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                <div class="mt-0 task-header text-uppercase">Done (<span class="count">0</span>)</div>
                                <div class="task-list-items"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade show taskDetails" style="display: block; padding-left: 17px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Task1 <span class="badge badge-success"><?= $dataTask['taskPriority_priority'] ?></span></h4>
                    <button type="button" class="close">×</button>
                </div>
            <div class="modal-body"><div class="p-2">
                <div class="font-weight-bold">Description:</div>
                    <p class="text-muted mb-4">
                    <?= $dataTask['task_description'] ?>
                    </p>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div>
                                <div class="font-weight-bold">Create Date</div>
                                    <p class="mt-1"><?= $dataTask['task_start_date'] ?></p>
                                </div>
                            </div>
                        <div class="col-md-3">
                    <div>
                        <div class="font-weight-bold">Due Date</div>
                            <p class="mt-1"><?= $dataTask['task_end_date'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <div class="font-weight-bold">Asigned</div>
                                <p><?= $dataTask['first_name'] ?></p> <!--REMOVE-->
                                <figure class="avatar avatar-sm animated" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                    <img class="rounded-circle" src="person1.png" alt="<?= $dataTask['first_name'] ?>">
                                </figure>
                            <?php
                            foreach($task_data as $oneTask){
                                ?>
                                <p><?= $oneTask['first_name'] ?></p> <!--REMOVE-->
                                    <figure class="avatar avatar-sm animated" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                                        <img class="rounded-circle" src="person1.png" alt="<?= $oneTask['first_name'] ?>">
                                    </figure>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <div class="font-weight-bold">Milestone</div>
                            <p class="mt-1"><?= $dataTask['milestone_title'] ?></p>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <!--<li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        Comments
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Files
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!--<div class="tab-pane show active" id="home-b1">
                        <form method="post" id="form-comment" data-action="https://taskolly.com/app/hakan/projects/2716/comment/4098">
                            <textarea class="form-control form-control-light mb-2" name="comment" placeholder="Write message" id="example-textarea" rows="3" required=""></textarea>
                            <div class="text-right">
                                <div class="btn-group mb-2 ml-2 d-sm-inline-block">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border" id="comments">
                            </ul>
                        </div>
                    </div>-->
                    <div class="tab-pane" id="profile-b1">
                        <form method="post" id="form-file" enctype="multipart/form-data" data-action="">
                            <input type="hidden" name="_token" value="WdRKQyqTdXWdJX6bqwTekTONi9YQ3Uvx65YTlhBH">
                            <input type="file" class="form-control mb-2" name="file" id="file">
                            <span class="invalid-feedback" id="file-error" role="alert">
                                <strong></strong>
                            </span>
                            <div class="text-right">
                                <div class="btn-group mb-2 ml-2 d-sm-inline-block">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>