<?php
session_start();
include("connection.php");
include("functions.php");

$project_id = $_GET['projectId'];
$project_data = getById("Projects",$project_id);
$dataProject = $project_data->fetch(PDO::FETCH_ASSOC);
$milestone_id = $_GET['milestoneId'];
$milestone_data = getMilestoneById("Milestones",$milestone_id);
$dataMilestone = $milestone_data->fetch(PDO::FETCH_ASSOC);
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

            const days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            const d = new Date();
            let day = days[d.getDay() - 1];
            data.addRows([
                [days[d.getDay()], 0, 0, 0, 0],[days[d.getDay() - 6], 1,2,3,4],[days[d.getDay() - 5], 5,6,7,8],[days[d.getDay() - 4], 4,4,4,4],[days[d.getDay() - 3], 1,2,3,4],[days[d.getDay() - 2], 1,2,3,4],[days[d.getDay() - 1], 1,2,3,4]
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data);
        }
    </script>

    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                window.location.href = "projectDetails.php?id=<?= $project_id ?>";
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
                                    <a href="#" class="text-title"><?= $dataProject['project_name'] ?></a>
                                </div>
                                <div class="author-box-job">
                                    <div class="badge badge-secondary">
                                    <?php
                                        $status = getStatusProject("ProjectStatus", $dataProject['project_statusID']);
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
                                            <p><?= $dataProject['project_start_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold">
                                                End Date
                                            </div>
                                            <p><?= $dataProject['project_end_date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold">
                                                Budget
                                            </div>
                                            <p>$<?= $dataProject['project_budget'] ?></p>
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
                                            <?= daysLeft($dataProject) ?>
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
                                                        <?= $milestone['milestone_title'] ?>
                                                    </div>
                                                    <div class="float-right">
                                                        <small>
                                                            <a href="milestoneEdit.php?projectId=<?= $project_id ?>&milestoneId=<?= $milestone['milestone_id'] ?>" class="btn btn-sm btn-outline-primary btnEditMilestone">
                                                                <i class="fa-solid fa-pen" style="line-height: 12px;"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-outline-primary btnDeleteMilestone">
                                                                <i class="fa-solid fa-trash" style="line-height: 12px;"></i>
                                                            </a>
                                                            <form action="" id="deleteMilestone" style="display: none;" method="post">
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
                                    <div id="chart_div" style="height: 100%; width: 100%;"></div>
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
    <div class="modal fade show mileStoneDetails" style="padding-right: 17px; display: block;">
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
                                    <p class="mt-1"><?= $dataMilestone['milestone_title'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <div class="font-weight-bold">Milestone Summary</div>
                                    <p class="mt-1"><?= $dataMilestone['milestone_summary'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    $status = getStatusMilestone("MilestoneStatus",$dataMilestone['milestone_statusID']);
                                    $statusData = $status->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div>
                                    <div class="font-weight-bold">Status</div>
                                    <p class="mt-1">
                                        <label class="badge badge-warning"><?= $statusData['milestoneStatus_status'] ?></label>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div class="font-weight-bold">Milestone Cost</div>
                                        <p class="mt-1">$<?= $dataMilestone['milestone_cost'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
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