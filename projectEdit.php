<?php
session_start();
include("connection.php");
include("functions.php");

$project_id = $_GET['id'];
$project_data = getById("Projects",$project_id);
$data = $project_data->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $status = $_POST['status'];
    $endDate = $_POST['endDate'];
    $budget = $_POST['budget'];

    $select = test($name);
    $rowCount = $select->fetchColumn();
    if($rowCount == 2){
        $error[] = 'project already exist';
    }
    else{
        $update = " UPDATE [Projects] SET project_name = '$name', project_description = '$description', project_start_date = '$startDate', project_end_date = '$endDate', project_statusID = '$status', project_budget = '$budget' WHERE project_id = '$project_id' ";
        $conn->query($update);
        header('location: projects.php');
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
    <script src="https://kit.fontawesome.com/de4dd1ef2c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                window.location.href = "projects.php";
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
                    <a href="dashboard.html">
                        <i class="fa-solid fa-house"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="projects.html">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="links_name">Projects</span>
                    </a>
                    <span class="tooltip">Projects</span>
                </li>
                <li>
                    <a href="tasks.html">
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
        <div class="main_content" style="min-height: 549px;">
            <section class="section">
                <h2 class="section-title">Projects</h2>
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <button type="button mb-3" class="btn btn-primary btnCreateProject">
                            <i class="fa-solid fa-plus"></i>
                            Create Project
                        </button>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-right">
                            <div class="btn-group mb-3">
                                <button type="button" class="btn btn-primary">All</button>
                            </div>
                            <div class="btn-group mb-3 ml-1">
                                <button type="button" class="btn btn-light">On going</button>
                                <button type="button" class="btn btn-light">Finished</button>
                                <button type="button" class="btn btn-light">On hold</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $projects = manyToManyProject("Users","UsersProjects","Projects", $_SESSION['user']['userId']);
                    if($projects->rowCount() == -1){
                        foreach($projects as $project){
                            $tasksCount = getTasksCount2("Tasks", $project['project_id']);
                            $taskCount = $tasksCount->fetchColumn();
                            ?>
                            <div class="col-12 col-lg-6 col-sm-12">
                                <div class="card author-box card-primary">
                                    <div class="card-body">
                                        <div class="card-header-action">
                                            <div class="dropdown">
                                                <div class="btn dropdown-toggle btnSettings">
                                                    <i class="fa-solid fa-gear"></i>
                                                </div>
                                                <div class="dropdown-menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(-120px, 35px, 0); top: 0px; left: 0px; will-change: transform;">
                                                    <a href="projectEdit.php?id=<?= $project['project_id'] ?>" class="dropdown-item btnEdit">
                                                        <i class="fa-solid fa-pen"></i>
                                                        Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Delete
                                                    </a>
                                                    <form action="" style="display: none;">
                                                        <input type="hidden">
                                                        <input type="hidden" value="DELETE">
                                                    </form>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        Invite
                                                    </a>
                                                    <a href="#" class="dropdown-item">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        Share
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="author-box-name">
                                            <a href="projectDetails.php?id=<?= $project['project_id'] ?>" class="text-title"><?= $project['project_name'] ?></a>
                                        </div>
                                        <div class="author-box-job">
                                            <?php
                                                $statuesData = getStatusProject("ProjectStatus", $project['project_statusID']);
                                                $statusData = $statuesData->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="badge badge-secondary">
                                                <?= $statusData['projectStatus_status'] ?>
                                            </div>
                                        </div>
                                        <div class="author-box-description">
                                            <p><?= $project['project_description'] ?></p>
                                        </div>
                                        <p class="mb-1">
                                            <span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                <i class="fa-solid fa-list text-muted"></i>
                                                <b><?= $taskCount ?></b>
                                                Tasks
                                            </span>
                                            <span class="text-nowrap mb-2 d-inline-block">
                                                <i class="fa-solid fa-comments text-muted"></i>
                                                <b>0</b>
                                                Comments
                                            </span>
                                        </p>
                                        <figure class="avatar">
                                            <img src="person1.png" alt="">
                                        </figure>
                                        <div class="float-right mt-sm-0 mt-3">
                                            <a href="projectDetails.php?id=<?= $project['project_id'] ?>" class="btn btn-sm btn-primary">View More
                                                <i></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "No projects";
                    }
                    ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                This website made by Hakan Karaotcu
            </div>
        </footer> 
    </div>
    <div class="modal fade show edit" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Project</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post" action="">
                        <input type="hidden" name="_token" value="">
                        <input type="hidden" name="_method" value="">
                        <div class="row">
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label for="projectname">Name</label>
                                    <input type="hidden" name="id" value="<?= $data['project_id']?>">
                                    <input class="form-control" type="text" name="name" value="<?= $data['project_name'] ?>" required="" placeholder="Project Name">                                     
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="1">On going</option>
                                                <option value="2">Finished</option>
                                                <option value="3">On hold</option>
                                            </select>
                                         </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="budget">Budget</label>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </span>
                                                <input class="form-control" type="number" min="0" id="budget" name="budget" value="<?= $data['project_budget'] ?>" placeholder="Project Budget">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="start_date" name="startDate" value="<?= $data['project_start_date'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="end_date" name="endDate" value="<?= $data['project_end_date'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description"><?= $data['project_description'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit">Edit Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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