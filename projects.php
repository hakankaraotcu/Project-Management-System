<?php
session_start();
include("connection.php");
include("functions.php");

$filteredProjects = manyToManyProject("Users","UsersProjects","Projects", $_SESSION['user']['userId']);

if(isset($_POST['createProject'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $userID = $_POST['userID'];

    $select = " SELECT * FROM [Projects] WHERE project_name = '$name'";
    $result = $conn->query($select);

    if($result->rowCount() == -1){
        $error[] = 'project already exist';
    }
    else{
        $insert = "INSERT INTO [Projects] (project_userID, project_statusID, project_name, project_budget, project_start_date, project_end_date, project_description) VALUES ($userID, 1, '$name', 0, null, null, '$description')";
        $conn->query($insert);
        $addedProject = lastOneProject("Projects");
        $addedProjectData = $addedProject->fetch(PDO::FETCH_ASSOC);
        $projectID = $addedProjectData['project_id'];
        $insert = "INSERT INTO [UsersProjects] (userID, projectID) VALUES ('$userID','$projectID')";
        $conn->query($insert);
    }
}
if(isset($_POST['_method'])){
    $projectID = $_POST['project_id'];
    
    $delete = " DELETE FROM [Projects] WHERE project_id = '$projectID' ";
    $result = $conn->query($delete);
}
if(isset($_POST['all'])){
    $filteredProjects = manyToManyProject("Users","UsersProjects","Projects", $_SESSION['user']['userId']);
}
if(isset($_POST['btnOngoing'])){
    $filter = $_POST['btnOngoing'];

    $filteredProjects = manyToManyProject1("Users","UsersProjects","Projects","ProjectStatus", $_SESSION['user']['userId'], $filter);
}
if(isset($_POST['btnFinished'])){
    $filter = $_POST['btnFinished'];

    $filteredProjects = manyToManyProject1("Users","UsersProjects","Projects","ProjectStatus", $_SESSION['user']['userId'], $filter);
}
if(isset($_POST['btnOnhold'])){
    $filter = $_POST['btnOnhold'];

    $filteredProjects = manyToManyProject1("Users","UsersProjects","Projects","ProjectStatus", $_SESSION['user']['userId'], $filter);
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
            $(".btnCreateProject").click(function(){
                $(".createProject").toggleClass("active");
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

    <script>
        function filter(){
            document.getElementById('filter').submit();
        }
        function filter1(){
            document.getElementById('filter1').submit();
        }
        function filter2(){
            document.getElementById('filter2').submit();
        }
        function filter3(){
            document.getElementById('filter3').submit();
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
                                <button type="button" class="btn btn-primary" onclick="filter()" value="All">All</button>
                            </div>
                            <div class="btn-group mb-3 ml-1">
                                <form action="projects.php" id="filter" method="POST">
                                    <input type="hidden" name="all" value="all">
                                </form>
                                <form action="projects.php" id="filter1" method="POST">
                                    <input type="hidden" name="btnOngoing" value="1">
                                </form>
                                <form action="projects.php" id="filter2" method="POST">
                                    <input type="hidden" name="btnFinished" value="2">
                                </form>
                                <form action="projects.php" id="filter3" method="POST">
                                    <input type="hidden" name="btnOnhold" value="3">
                                </form>
                                <button type="button" class="btn btn-light" onclick="filter1()">On going</button>
                                <button type="button" class="btn btn-light" onclick="filter2()">Finished</button>
                                <button type="button" class="btn btn-light" onclick="filter3()">On hold</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if($filteredProjects->rowCount() == -1){
                        foreach($filteredProjects as $filteredProject){
                            $tasksCount = getTasksCount2("Tasks", $filteredProject['project_id']);
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
                                                    <a href="projectEdit.php?id=<?= $filteredProject['project_id'] ?>" class="dropdown-item btnEdit">
                                                        <i class="fa-solid fa-pen"></i>
                                                        Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item btnDelete" onclick="deleteSection(<?= $filteredProject['project_id'] ?>);">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Delete
                                                    </a>
                                                    <form action="" id="<?= $filteredProject['project_id'] ?>" style="display: none;" method="post">
                                                        <input type="hidden" name="project_id" value="<?= $filteredProject['project_id'] ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
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
                                            <a href="projectDetails.php?id=<?= $filteredProject['project_id'] ?>" class="text-title"><?= $filteredProject['project_name'] ?></a>
                                        </div>
                                        <div class="author-box-job">
                                            <?php
                                                $statusData = getStatusProject("ProjectStatus", $filteredProject['project_statusID']);
                                                $data = $statusData->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="badge badge-secondary">
                                                <?= $data['projectStatus_status'] ?>
                                            </div>
                                        </div>
                                        <div class="author-box-description">
                                            <p><?= $filteredProject['project_description'] ?></p>
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
                                            <a href="projectDetails.php?id=<?= $filteredProject['project_id'] ?>" class="btn btn-sm btn-primary">View More
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
    <div class="modal fade show createProject" style="display: hidden;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Project</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label for="projectname">Name</label>
                            <input class="form-control" type="text" id="projectname" name="name" required="" placeholder="Project Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="users_list">Users</label>
                            <select class="select2 form-control select2-multiple select2-hidden-accessible" data-placeholder="Select Users ..." multiple></select>
                            <span class="select2 select2-container select2-container--default">
                                <span class="selection">
                                    <span class="select2-selection select2-selection--multiple">
                                        <ul class="select2-selection__rendered">
                                            <li class="select2-search select2-search--inline">
                                                <input class="select2-search__field" type="search" name="userID" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" placeholder="Select Users ..." style="width: 696px;">
                                            </li>
                                        </ul>
                                    </span>
                                </span>
                                <span class="dropdown-wrapper"></span>
                            </span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="createProject">Create Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_box">
        <i class="fa-solid fa-exclamation"></i>
        <h1>Your project will be deleted Permanently!</h1>
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