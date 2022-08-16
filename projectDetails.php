<?php
session_start();
include("connection.php");
include("functions.php");

$project_id = $_GET['id'];
$project_data = getById("Projects",$project_id);
$data = $project_data->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['createMilestone'])){
    $milestoneTitle = $_POST['title'];
    $milestoneStatus = $_POST['status'];
    $milestoneCost = $_POST['cost'];
    $milestoneSummary = $_POST['summary'];

    $select = " SELECT * FROM [Milestones] WHERE milestone_title = '$milestoneTitle'";
    $result = $conn->query($select);

    if($result->rowCount() == -1){
        $error[] = 'milestone already exist';
    }
    else{
        $insert = "INSERT INTO [Milestones] (milestone_projectID, milestone_statusID, milestone_title, milestone_cost, milestone_summary) VALUES ('$project_id', '$milestoneStatus', '$milestoneTitle', '$milestoneCost', '$milestoneSummary')";
        $conn->query($insert);
    }
}
if(isset($_POST['editProject'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $startDate = $_POST['start_date'];
    $status = $_POST['status'];
    $endDate = $_POST['end_date'];
    $budget = $_POST['budget'];

    $select = test($name);
    $rowCount = $select->fetchColumn();
    if($rowCount == 2){
        $error[] = 'project already exist';
    }
    else{
        $update = " UPDATE [Projects] SET project_name = '$name', project_description = '$description', project_start_date = '$startDate', project_end_date = '$endDate', project_statusID = '$status', project_budget = '$budget' WHERE project_id = '$project_id' ";
        $conn->query($update);
        header("location: projectDetails.php?id=$project_id");
    }
}
if(isset($_POST['_methodProject'])){
    
    $delete = " DELETE FROM [Projects] WHERE project_id = '$project_id' ";
    $result = $conn->query($delete);
    header("location: projects.php");
}
if(isset($_POST['_methodMilestone'])){
    $milestoneID = $_POST['milestone_id'];
    
    $delete = " DELETE FROM [Milestones] WHERE milestone_id = '$milestoneID' ";
    $result = $conn->query($delete);
    header("location: projectDetails.php?id=$project_id");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectDetail</title>
    <link rel="stylesheet" href="Main2.css">
    <link rel="stylesheet" href="colors.css">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="spacing.css">
    <link rel="stylesheet" href="text.css">
    <script src="https://kit.fontawesome.com/de4dd1ef2c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawCurveTypes);

        function drawCurveTypes() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Todo');
            data.addColumn('number', 'In Progress');
            data.addColumn('number', 'Review');
            data.addColumn('number', 'Done');

            var todoMon = document.querySelector('input[name="todoNumMon"]');
            var inprogressMon = document.querySelector('input[name="inprogressNumMon"]');
            var reviewMon = document.querySelector('input[name="reviewNumMon"]');
            var doneMon = document.querySelector('input[name="doneNumMon"]');
            var todoTue = document.querySelector('input[name="todoNumTue"]');
            var inprogressTue = document.querySelector('input[name="inprogressNumTue"]');
            var reviewTue = document.querySelector('input[name="reviewNumTue"]');
            var doneTue = document.querySelector('input[name="doneNumTue"]');
            var todoWed = document.querySelector('input[name="todoNumWed"]');
            var inprogressWed = document.querySelector('input[name="inprogressNumWed"]');
            var reviewWed = document.querySelector('input[name="reviewNumWed"]');
            var doneWed = document.querySelector('input[name="doneNumWed"]');
            var todoThu = document.querySelector('input[name="todoNumThu"]');
            var inprogressThu = document.querySelector('input[name="inprogressNumThu"]');
            var reviewThu = document.querySelector('input[name="reviewNumThu"]');
            var doneThu = document.querySelector('input[name="doneNumThu"]');
            var todoFri = document.querySelector('input[name="todoNumFri"]');
            var inprogressFri = document.querySelector('input[name="inprogressNumFri"]');
            var reviewFri = document.querySelector('input[name="reviewNumFri"]');
            var doneFri = document.querySelector('input[name="doneNumFri"]');
            var todoSat = document.querySelector('input[name="todoNumSat"]');
            var inprogressSat = document.querySelector('input[name="inprogressNumSat"]');
            var reviewSat = document.querySelector('input[name="reviewNumSat"]');
            var doneSat = document.querySelector('input[name="doneNumSat"]');
            var todoSun = document.querySelector('input[name="todoNumSun"]');
            var inprogressSun = document.querySelector('input[name="inprogressNumSun"]');
            var reviewSun = document.querySelector('input[name="reviewNumSun"]');
            var doneSun = document.querySelector('input[name="doneNumSun"]');

            const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            const d = new Date();
            let day = days[d.getDay() - 1];
            data.addRows([
                [days[d.getDay()], parseInt(todoThu.value),parseInt(inprogressThu.value),parseInt(reviewThu.value),parseInt(doneThu.value)],[days[d.getDay() + 1], parseInt(todoFri.value),parseInt(inprogressFri.value),parseInt(reviewFri.value),parseInt(doneFri.value)],[days[d.getDay() + 2], parseInt(todoSat.value),parseInt(inprogressSat.value),parseInt(reviewSat.value),parseInt(doneSat.value)],[days[d.getDay() + 3], parseInt(todoSun.value),parseInt(inprogressSun.value),parseInt(reviewSun.value),parseInt(doneSun.value)],[days[d.getDay() - 3], parseInt(todoMon.value),parseInt(inprogressMon.value),parseInt(reviewMon.value),parseInt(doneMon.value)],[days[d.getDay() - 2], parseInt(todoTue.value),parseInt(inprogressTue.value),parseInt(reviewTue.value),parseInt(doneTue.value)],[days[d.getDay() - 1], parseInt(todoWed.value),parseInt(inprogressWed.value),parseInt(reviewWed.value),parseInt(doneWed.value)]
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data);
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var ongoing = document.querySelector('input[name="ongoingNum"]');
            var finished = document.querySelector('input[name="finishedNum"]');
            var onhold = document.querySelector('input[name="onholdNum"]');

            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Ongoing',     parseInt(ongoing.value)],
            ['OnHold',      parseInt(onhold.value)],
            ['Finished', parseInt(finished.value)]
            ]);
            
            var options = {
                colors:['#3466CC', '#DC3912', '#0F9618']
            }


            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

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
            $(".btnInviteUsers").click(function(){
                $(".inviteUser").toggleClass("active");
            });
            $(".btnCreateMilestone").click(function(){
                $(".createMilestone").toggleClass("active");
            });
            $(".btnEditProject").click(function(){
                $(".editProject").toggleClass("active");
            });
            $(".btnCancel").click(function(){
                $(".modal").removeClass("active");
            });
            $(".close").click(function(){
                $(".modal").removeClass("active");
            });
            $(".btnSettings").click(function(){
                $(".dropdown-menu").toggleClass("active");
                $(".messages").removeClass("active");
                $(".notifications").removeClass("active");
                $(".profile").removeClass("active");
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(".btnDeleteProject").click(function(){
                $(".popupMsg").html("Your project will be deleted Permanently!")
                $(".popup_box").css({
                    "display":"block", "pointer-events":"auto"
                });
            });
            $(".btnDeleteMilestone").click(function(){
                $(".btn2").addClass("deleteMilestoneConfirm");
                $(".popupMsg").html("Your milestone will be deleted Permanently!")
                $(".popup_box").css({
                    "display":"block", "pointer-events":"auto"
                });
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
                if(!($(".btn2").hasClass("deleteMilestoneConfirm"))){
                    document.getElementById('deleteProject').submit();
                }
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
        });
    </script>

    <script>
        function deleteSection(id){
            $(".btn1").click(function(){
                $(".popup_box").css({
                    "display":"none","pointer-events":"auto"
                });
                $(".btn2").removeClass("deleteMilestoneConfirm");
            });
            $(".btn2").click(function(){
                document.getElementById(id).submit();
                $(".alert").removeClass("hide");
                $(".alert").addClass("show");
                $(".alert").addClass("showAlert");
                setTimeout(function(){
                    $(".alert").addClass("hide");
                    $(".alert").removeClass("show");
                    $(".btn2").removeClass("deleteMilestoneConfirm");
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
        <div class="main_content">
            <div class="section">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h2 class="section-title">Project Details</h2>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary">Gantt Chart</a>
                                <a href="task.php?id=<?= $project_id ?>" class="btn btn-primary">Task Board</a>
                                <a href="#" class="btn btn-primary">Bug Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 animated">
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="card-header-action">
                                    <div class="dropdown card-widget">
                                        <div class="btn dropdown-toggle btnSettings">
                                            <i class="fa-solid fa-gear"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-120px, 35px, 0); top: 0px; left: 0px; will-change: transform;">
                                            <a href="#" class="dropdown-item btnEditProject">
                                                <i class="fa-solid fa-pen"></i>
                                                Edit
                                            </a>
                                            <a href="#" class="dropdown-item btnDeleteProject">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </a>
                                            <form action="" id="deleteProject" style="display: none;" method="post">
                                                <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
                                                <input type="hidden" name="_methodProject" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="author-box-name">
                                    <a href="#" class="text-title"><?= $data['project_name'] ?></a>
                                </div>
                                <div class="author-box-job">
                                    <div class="badge badge-secondary">
                                    <?php
                                        $status = getStatusProject("ProjectStatus", $data['project_statusID']);
                                        $statusData = $status->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <?= $statusData['projectStatus_status'] ?>
                                    </div>
                                </div>
                                <div class="mt-4 font-weight-bold">
                                    Project Overview:
                                </div>
                                <div class="author-box-description">
                                    <p></p>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold">
                                                Start Date
                                            </div>
                                            <p><?= $data['project_start_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold">
                                                End Date
                                            </div>
                                            <p><?= $data['project_end_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold">
                                                Budget
                                            </div>
                                            <p>$<?= $data['project_budget'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card card-statistic-2">
                                    <div class="card-icon shadow-primary bg-primary">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Days Left</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= daysLeft($data) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                    $tasksCount = getTasksCount2("Tasks", $project_id);
                                    $taskCount = $tasksCount->fetchColumn();
                                ?>
                                <div class="card card-statistic-2">
                                    <div class="card-icon shadow-danger bg-danger">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>TotalTask</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= $taskCount ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card card-statistic-2">
                                    <div class="card-icon shadow-success bg-success">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Comments</h4>
                                        </div>
                                        <div class="card-body">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card author-box card-primary">
                            <div class="card-body pr-2 pl-3">
                                <div class="card-header-action">
                                    <div class="dropdown card-widgets">
                                        <div class="btn btn-sm btn-primary btnInviteUsers">
                                            <i class="fa-solid fa-envelope" style="line-height: 24px;"></i>
                                            Invite
                                        </div>
                                    </div>
                                </div>
                                <div class="author-box-name mb-4" style="font-size: 16px; line-height: 28px; color: #4FD1FE; padding-right: 10px; margin-bottom: 0;">
                                    <h4>Team Members (1)</h4>
                                </div>
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="person1.png" alt="test">
                                        <div class="media-body">
                                            <h6 class="media-title">
                                                <a href=""><?= $_SESSION['user']['userFirstName'] ?></a>
                                            </h6>
                                            <div class="text-small text-muted">
                                            <?= $_SESSION['user']['userEmail'] ?>
                                                <div class="bullet"></div>
                                                <span class="text-primary">0 / 1</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="card-header-action">
                                    <div class="dropdown card-widget">
                                        <div class="btn btn-sm btn-primary btnCreateMilestone">
                                            Create Milestone
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $milestones = getMilestonesByProject($project_id);
                                $row = getMilestonesByProjectCount($project_id);
                                $rowCount = $row->fetchColumn();
                                ?>
                                <div class="author-box-name mb-4">
                                Milestones (<?= $rowCount ?>)
                                </div>
                                <?php
                                $index = 1;
                                if($rowCount > 0){
                                    foreach($milestones as $milestone){
                                        ?>
                                        <div class="ribbon-wrapper bg-white b-all mb-4 milestones">
                                            <div class="ribbon ribbon-corner">
                                                <span class="milestone-count">#<?= $index++ ?></span>
                                            </div>
                                            <div class="ribbon-content">
                                                <h5 class="media-heading text-info font-light">
                                                    <div class="btnMilestoneDetails" style="cursor: pointer;">
                                                        <a href="milestoneDetails.php?projectId=<?= $project_id ?>&milestoneId=<?= $milestone['milestone_id'] ?>"><?= $milestone['milestone_title'] ?></a>
                                                    </div>
                                                    <div class="float-right">
                                                        <small>
                                                            <a href="milestoneEdit.php?projectId=<?= $project_id ?>&milestoneId=<?= $milestone['milestone_id'] ?>" class="btn btn-sm btn-outline-primary btnEditMilestone">
                                                                <i class="fa-solid fa-pen" style="line-height: 12px;"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-outline-primary btnDeleteMilestone" onclick="deleteSection(<?= $milestone['milestone_id'] ?>);">
                                                                <i class="fa-solid fa-trash" style="line-height: 12px;"></i>
                                                            </a>
                                                            <form action="" id="<?= $milestone['milestone_id'] ?>" style="display: none;" method="post">
                                                                <input type="hidden" name="milestone_id" value="<?= $milestone['milestone_id'] ?>">
                                                                <input type="hidden" name="_methodMilestone" value="DELETE">
                                                            </form>
                                                        </small>
                                                    </div>
                                                </h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <?php
                                                        $statuesData = getStatusMilestone("MilestoneStatus", $milestone['milestone_statusID']);
                                                        $statusData = $statuesData->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <label class="badge badge-warning"><?= $statusData['milestoneStatus_status'] ?></label>
                                                    </div>
                                                    <div class="col-6">
                                                        <strong>Milestone Cost:</strong>
                                                        <?= $milestone['milestone_cost'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No milestones";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="author-box-name mb-4">
                                    Files
                                </div>
                                <div class="col-md-12 dropzone dz-clickable" id="dropzonewidget">
                                    <div class="dz-message" data-dz-message=""><span>Drop files here to upload</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 animated" data-sr-id="3" style="visibility: visible; transform: none; opacity: 1; transition: none 0s ease 0s;">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Progress</h4>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    <?php
                                        $todoMon = fillChart2("Tasks", "Projects", 1, $project_id, "Monday");
                                        $todoNumMon = $todoMon->fetchColumn();
                                        $inprogressMon = fillChart2("Tasks", "Projects", 2, $project_id, "Monday");
                                        $inprogressNumMon = $inprogressMon->fetchColumn();
                                        $reviewMon = fillChart2("Tasks", "Projects", 3, $project_id, "Monday");
                                        $reviewNumMon = $reviewMon->fetchColumn();
                                        $doneMon = fillChart2("Tasks", "Projects", 4, $project_id, "Monday");
                                        $doneNum = $doneMon->fetchColumn();
                                        $todoTueMon = fillChart2("Tasks", "Projects", 1, $project_id, "Tuesday");
                                        $todoNumTue = $todoTueMon->fetchColumn();
                                        $inprogressTue = fillChart2("Tasks", "Projects", 2, $project_id, "Tuesday");
                                        $inprogressNumTue = $inprogressTue->fetchColumn();
                                        $reviewTue = fillChart2("Tasks", "Projects", 3, $project_id, "Tuesday");
                                        $reviewNumTue = $reviewTue->fetchColumn();
                                        $doneTue = fillChart2("Tasks", "Projects", 4, $project_id, "Tuesday");
                                        $doneNumTue = $doneTue->fetchColumn();
                                        $todoWed = fillChart2("Tasks", "Projects", 1, $project_id, "Wednesday");
                                        $todoNumWed = $todoWed->fetchColumn();
                                        $inprogressWed = fillChart2("Tasks", "Projects", 2, $project_id, "Wednesday");
                                        $inprogressNumWed = $inprogressWed->fetchColumn();
                                        $reviewWed = fillChart2("Tasks", "Projects", 3, $project_id, "Wednesday");
                                        $reviewNumWed = $reviewWed->fetchColumn();
                                        $doneWed = fillChart2("Tasks", "Projects", 4, $project_id, "Wednesday");
                                        $doneNumWed = $doneWed->fetchColumn();
                                        $todoThu = fillChart2("Tasks", "Projects", 1, $project_id, "Thursday");
                                        $todoNumThu = $todoThu->fetchColumn();
                                        $inprogressThu = fillChart2("Tasks", "Projects", 2, $project_id, "Thursday");
                                        $inprogressNumThu = $inprogressThu->fetchColumn();
                                        $reviewThu = fillChart2("Tasks", "Projects", 3, $project_id, "Thursday");
                                        $reviewNumThu = $reviewThu->fetchColumn();
                                        $doneThu = fillChart2("Tasks", "Projects", 4, $project_id, "Thursday");
                                        $doneNumThu = $doneThu->fetchColumn();
                                        $todoFri = fillChart2("Tasks", "Projects", 1, $project_id, "Friday");
                                        $todoNumFri = $todoFri->fetchColumn();
                                        $inprogressFri = fillChart2("Tasks", "Projects", 2, $project_id, "Friday");
                                        $inprogressNumFri = $inprogressFri->fetchColumn();
                                        $reviewFri = fillChart2("Tasks", "Projects", 3, $project_id, "Friday");
                                        $reviewNumFri = $reviewFri->fetchColumn();
                                        $doneFri = fillChart2("Tasks", "Projects", 4, $project_id, "Friday");
                                        $doneNumFri = $doneFri->fetchColumn();
                                        $todoSat = fillChart2("Tasks", "Projects", 1, $project_id, "Saturday");
                                        $todoNumSat = $todoSat->fetchColumn();
                                        $inprogressSat = fillChart2("Tasks", "Projects", 2, $project_id, "Saturday");
                                        $inprogressNumSat = $inprogressSat->fetchColumn();
                                        $reviewSat = fillChart2("Tasks", "Projects", 3, $project_id, "Saturday");
                                        $reviewNumSat = $reviewSat->fetchColumn();
                                        $doneSat = fillChart2("Tasks", "Projects", 4, $project_id, "Saturday");
                                        $doneNumSat = $doneSat->fetchColumn();
                                        $todoSun = fillChart2("Tasks", "Projects", 1, $project_id, "Sunday");
                                        $todoNumSun = $todoSun->fetchColumn();
                                        $inprogressSun = fillChart2("Tasks", "Projects", 2, $project_id, "Sunday");
                                        $inprogressNumSun = $inprogressSun->fetchColumn();
                                        $reviewSun = fillChart2("Tasks", "Projects", 3, $project_id, "Sunday");
                                        $reviewNumSun = $reviewSun->fetchColumn();
                                        $doneSun = fillChart2("Tasks", "Projects", 4, $project_id, "Sunday");
                                        $doneNumSun = $doneSun->fetchColumn();
                                    ?>
                                    <div class="mt-3" style="height: 320px;">
                                        <input type="hidden" name="todoNumMon" value="<?= $todoNumMon ?>">
                                        <input type="hidden" name="inprogressNumMon" value="<?= $inprogressNumMon ?>">
                                        <input type="hidden" name="reviewNumMon" value="<?= $reviewNumMon ?>">
                                        <input type="hidden" name="doneNumMon" value="<?= $doneNumMon ?>">
                                        <input type="hidden" name="todoNumTue" value="<?= $todoNumTue ?>">
                                        <input type="hidden" name="inprogressNumTue" value="<?= $inprogressNumTue ?>">
                                        <input type="hidden" name="reviewNumTue" value="<?= $reviewNumTue ?>">
                                        <input type="hidden" name="doneNumTue" value="<?= $doneNumTue ?>">
                                        <input type="hidden" name="todoNumWed" value="<?= $todoNumWed ?>">
                                        <input type="hidden" name="inprogressNumWed" value="<?= $inprogressNumWed ?>">
                                        <input type="hidden" name="reviewNumWed" value="<?= $reviewNumWed ?>">
                                        <input type="hidden" name="doneNumWed" value="<?= $doneNumWed ?>">
                                        <input type="hidden" name="todoNumThu" value="<?= $todoNumThu ?>">
                                        <input type="hidden" name="inprogressNumThu" value="<?= $inprogressNumThu ?>">
                                        <input type="hidden" name="reviewNumThu" value="<?= $reviewNumThu ?>">
                                        <input type="hidden" name="doneNumThu" value="<?= $doneNumThu ?>">
                                        <input type="hidden" name="todoNumFri" value="<?= $todoNumFri ?>">
                                        <input type="hidden" name="inprogressNumFri" value="<?= $inprogressNumFri ?>">
                                        <input type="hidden" name="reviewNumFri" value="<?= $reviewNumFri ?>">
                                        <input type="hidden" name="doneNumFri" value="<?= $doneNumFri ?>">
                                        <input type="hidden" name="todoNumSat" value="<?= $todoNumSat ?>">
                                        <input type="hidden" name="inprogressNumSat" value="<?= $inprogressNumSat ?>">
                                        <input type="hidden" name="reviewNumSat" value="<?= $reviewNumSat ?>">
                                        <input type="hidden" name="doneNumSat" value="<?= $doneNumSat ?>">
                                        <input type="hidden" name="todoNumSun" value="<?= $todoNumSun ?>">
                                        <input type="hidden" name="inprogressNumSun" value="<?= $inprogressNumSun ?>">
                                        <input type="hidden" name="reviewNumSun" value="<?= $reviewNumSun ?>">
                                        <input type="hidden" name="doneNumSun" value="<?= $doneNumSun ?>">
                                        <div id="chart_div" style="height: 100%; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Activity</h4>
                            </div>
                            <div class="card-body pr-2 pl-3">
                                <div class="activities top-10-scroll" tabindex="4" style="max-height: 630px; overflow: hidden; outline: none;">
                                    <div class="activity">
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="fa-solid fa-list-check" style="line-height: 50px;"></i>
                                        </div>
                                        <div class="activity-detail">
                                            <div class="mb-2">
                                                <span class="text-job">21 minutes ago</span>
                                            </div>
                                            <p>hakan Create new Task <b>task1</b></p>
                                        </div>
                                    </div>
                                    <div class="activity">
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="fa-solid fa-bullseye" style="line-height: 50px;"></i>
                                        </div>
                                        <div class="activity-detail">
                                            <div class="mb-2">
                                                <span class="text-job">21 minutes ago</span>
                                            </div>
                                            <p>hakan Create new Milestone <b>milestone1</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show createMilestone" id="createMilestone" style="display: hidden; padding-right: 17px;">
        <div class="modal-dialog modal-undefined">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Create Milestone</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <input type="hidden" name="_token" value="">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="milestone-title">Milestone Title</label>
                                    <input type="text" class="form-control form-control-light" placeholder="Enter Title" name="title" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="milestone-status">Status</label>
                                    <select class="form-control form-control-light" name="status" required="">
                                        <option value="1">Incomplete</option>
                                        <option value="2">Complete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="milestone-title">Milestone Cost</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </span>
                                <input type="number" class="form-control form-control-light" placeholder="Enter Cost" value="0" min="0" name="cost" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-summary">Summary</label>
                            <textarea class="form-control form-control-light" rows="3" name="summary"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btnCancel" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="createMilestone">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show inviteUser" id="inviteUser" tabindex="-1" style="padding-right: 17px; display: hidden;">
        <div class="modal-dialog modal-undefined">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Invite</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                         <input type="hidden" name="_token" value="">
                         <input type="hidden" name="_method" value="">
                         <div class="form-group">
                            <label for="users_list">Users</label>
                            <select class="select2 form-control select2-multiple select2-hidden-accessible" required="" name="users_list[]" data-placeholder="Select Users ..." ></select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select Users ..." style="width: 396px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Invite Users</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show mileStoneDetails" style="padding-right: 17px; display: hidden;">
        <div class="modal-dialog modal-undefined">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Milestones Details</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div>
                                    <div class="font-weight-bold">Milestone Title</div>
                                    <p class="mt-1">milestone1</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <div class="font-weight-bold">Milestone Summary</div>
                                    <p class="mt-1"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div class="font-weight-bold">Status</div>
                                    <p class="mt-1">
                                        <label class="badge badge-warning">Incomplete</label>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div class="font-weight-bold">Milestone Cost</div>
                                        <p class="mt-1">$0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show editProject" style="display: hidden;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Project</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectname">Name</label>
                                    <input type="hidden" name="id" value="<?= $project_id?>">
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
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="start_date" name="start_date" value="<?= $data['project_start_date'] ?>" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control date hasDatepicker" data-provide="datepicker" data-date-format="yy-mm-dd" type="date" id="end_date" name="end_date" value="<?= $data['project_end_date'] ?>" autocomplete="off" required="required">
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
                            <button class="btn btn-primary" type="submit" name="editProject" class="editProject">Edit Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show editMilestone" style="display: hidden; padding-right: 17px;">
        <div class="modal-dialog modal-undefined">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Milestone</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post" action="">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="milestone-title">Milestone Title</label>
                                    <input type="text" class="form-control form-control-light" placeholder="Enter Title" value="<?= $_POST['id'] ?>" name="title" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="milestone-status">Status</label>
                                    <select class="form-control form-control-light" name="status" required="">
                                        <option value="incomplete" selected="">Incomplete</option>
                                        <option value="complete">Complete</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="milestone-title">Milestone Cost</label>
                            <input type="number" class="form-control form-control-light" placeholder="Enter Cost" value="0.00" min="0" name="cost" required="">
                        </div>
                        <div class="form-group">
                            <label for="task-summary">Summary</label>
                            <textarea class="form-control form-control-light" rows="3" name="summary"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btnCancel">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="editMilestone">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_box">
        <i class="fa-solid fa-exclamation"></i>
        <h1 class="popupMsg"></h1>
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