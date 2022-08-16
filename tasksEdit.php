<?php
session_start();
include("connection.php");
include("functions.php");

$projects = getAll("Projects");
$users = getAll("Users");

$task_id = $_GET['id'];
$task_data = getTasks2("Projects","Tasks","UsersTasks","Users", "TaskPriority", "Milestones", $_SESSION['user']['userId'], $task_id);
$dataTask = $task_data->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $projectID = $_POST['project_id'];
    $milestoneID = $_POST['milestone_id'];
    $priority = $_POST['priority'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $select = test2($title);
    $rowCount = $select->fetchColumn();
    if($rowCount == 2){
        $error[] = 'task already exist';
    }
    else{
        $update = " UPDATE [Tasks] SET task_title = '$title', task_description = '$description', task_start_date = '$startDate', task_end_date = '$endDate', task_priorityID = '$priority', task_projectID = '$projectID', task_milestoneID = '$milestoneID' WHERE task_id = '$task_id' ";
        $conn->query($update);
        header("location: tasks.php");
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="Main2.css">
    <link rel="stylesheet" href="colors.css">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="spacing.css">
    <link rel="stylesheet" href="text.css">
    <link rel="stylesheet" href="test.css">
    <script src="https://kit.fontawesome.com/de4dd1ef2c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                window.location.href = "tasks.php";
            });
            $(".btnCancel").click(function(){
                window.location.href = "tasks.php";
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
                        <h2 class="section-title">Tasks</h2>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <div class="mt-4">
                                <select class="form-control form-control-sm w-auto d-inline" size="sm" name="project" id="project">
                                    <option value>All Projects</option>
                                    <?php
                                        if(isset($projects)){
                                            foreach($projects as $project){
                                                ?>
                                                <option value="<?= $project['id'] ?>"><?= $project['project_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                                <select class="form-control form-control-sm w-auto d-inline" size="sm" name="assign_to" id="assign_to">
                                    <option value>All Users</option>
                                    <?php
                                        if(isset($users)){
                                            foreach($users as $user){
                                                ?>
                                                <option value="<?= $user['user_id'] ?>"><?= $user['first_name'],$user['last_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                                <select class="form-control form-control-sm w-auto d-inline" size="sm" name="status" id="status">
                                    <option value>All Status</option>
                                    <option value="18682">Todo</option>
                                    <option value="18683">In Progress</option>
                                    <option value="18684">Review</option>
                                    <option value="18685">Done</option>
                                </select>
                                <select class="form-control form-control-sm w-auto d-inline" size="sm" name="priority" id="priority">
                                    <option value>All Priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                <input type="text" class="form-control form-control-sm w-auto d-inline form-control-light" id="duration1" name="duration" value="Select Date Range">
                                <input type="hidden" name="start_date1" id="start_date1">
                                <input type="hidden" name="due_date1" id="due_date1">
                                <button class="btn btn-primary btn-sm ml-2" id="filter">
                                    <i class="fa-solid fa-check"></i>
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="selection-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="selection-datatable_length">
                                                    <label>Show 
                                                        <select name="selection-datatable_length" aria-controls="selection-datatable" class="custom-select custom-select-sm form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>entries
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="selection-datatable_filter" class="dataTables_filter">
                                                    <label>Search:
                                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="selection-datatable">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-centered table-hover mb-0 animated dataTable no-footer" id="selection-datatable" data-sr-id="2" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;" role="grid" aria-describedby="selection-datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 111.953px;" aria-label="Task: activate to sort column ascending">Task
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 145.016px;" aria-label="Project: activate to sort column ascending">Project
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 181.953px;" aria-label="Milestone: activate to sort column ascending">Milestone
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 137.328px;" aria-label="Due in: activate to sort column ascending">Due in
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 210.156px;" aria-label="Assigned to: activate to sort column ascending">Assigned to
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 137.703px;" aria-label="Status: activate to sort column ascending">Status
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 149.891px;" aria-label="Priority: activate to sort column ascending">Priority
                                                            </th>
                                                            <th class="text-right sorting" width="150px" tabindex="0" aria-controls="selection-datatable" rowspan="1" colspan="1" style="width: 150px;" aria-label="Action: activate to sort column ascending">Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $tasks = getTasks("Users","UsersTasks","Tasks","Projects", "TaskPriority", "Milestones", "TaskStatus", $_SESSION['user']['userId']);
                                                            //$count = $tasks->fetchColumn();
                                                            //printf($count);
                                                            foreach($tasks as $task){
                                                                ?>
                                                                <tr role="row" class="odd">
                                                                <td>
                                                                    <a href="task.php?id=<?= $task['project_id'] ?>" class="text-body"><?= $task['task_title'] ?></a>
                                                                </td>
                                                                <td><?= $task['project_name'] ?></td>
                                                                <td><?= $task['milestone_title'] ?></td>
                                                                <td>10 hours</td>
                                                                <td>
                                                                    <span class="badge badge-secondary"><?= $task['first_name'] ?></span> 
                                                                </td>
                                                                <td>
                                                                    <span class="badge badge-primary">TODO</span>
                                                                </td>
                                                                <td>
                                                                    <span class="badge badge-success"><?= $task['taskPriority_priority'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-sm btn-outline-primary btnEdit" data-ajax-popup="true" data-size="lg" data-title="Edit Task">    
                                                                        <i class="fa-solid fa-pen mr-1"></i>Edit
                                                                    </a>
                                                                    <a href="#" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-4013').submit(): '');">
                                                                        <i class="fa-solid fa-trash mr-1"></i>Delete
                                                                    </a>
                                                                    <form id="delete-form-4013" action="#" method="POST" style="display: none;">
                                                                        <input type="hidden" name="_token" value="mVUUMw69QUyoVbbOHn7AaVcmjteUGhpmOF3BCClW">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="selection-datatable_info" role="status" aria-live="polite">Showing 1 to 3 of 3 entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers" id="selection-datatable_paginate">
                                                    <ul class="pagination pagination-rounded">
                                                        <li class="paginate_button page-item previous disabled" id="selection-datatable_previous">
                                                            <a href="#" aria-controls="selection-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                                                <i class="fa-solid fa-less-than"></i>
                                                            </a>
                                                        </li>
                                                        <li class="paginate_button page-item active">
                                                            <a href="#" aria-controls="selection-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                        </li>
                                                        <li class="paginate_button page-item next disabled" id="selection-datatable_next">
                                                            <a href="#" aria-controls="selection-datatable" data-dt-idx="2" tabindex="0" class="page-link">
                                                                <i class="fa-solid fa-greater-than"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade show edit" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Task</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" name="_method" value="">
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
                                        <?= $dataTask['project_name'] ?>
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
                                    <select class="form-control form-control-light" name="milestone_id" id="task-milestone" required="required">
                                        <?= $dataTask['milestone_title'] ?>
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
                                    <input type="text" class="form-control form-control-light" id="task-title" placeholder="Enter Title" name="title" required="" value="<?= $dataTask['task_title'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="task-priority">Priority</label>
                                    <select class="form-control form-control-light" name="priority" id="task-priority" required="">
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
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="start_date" name="start_date" value="<?= $dataTask['task_start_date'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="end_date" name="end_date" value="<?= $dataTask['task_end_date'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assign_to">Assign To</label>
                                    <select class="form-control form-control-light select2 select2-hidden-accessible" id="assign_to" name="assign_to[]" required="">
                                        <option selected="" value="4825" data-select2-id="2">hakan - hakan@hotmail.com</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default">
                                        <span class="selection">
                                            <span class="select2-selection select2-selection--multiple">
                                                <ul class="select2-selection__rendered">
                                                    <li class="select2-selection__choice" title="hakan - hakan@hotmail.com">
                                                        <span class="select2-selection__choice__remove">×</span>
                                                        <?= $dataTask['first_name'] ?> - <?= $dataTask['email'] ?>
                                                    </li>
                                                    <li class="select2-search select2-search--inline">
                                                        <input class="select2-search__field" type="search" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" placeholder="" style="width: 0.75em;">
                                                    </li>
                                                </ul>
                                            </span>
                                        </span>
                                        <span class="dropdown-wrapper"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-description">Description</label>
                            <textarea class="form-control form-control-light" rows="3" name="description"><?= $dataTask['task_description'] ?></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btnCancel">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
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
</body>
</html>