<?php

session_start();
include("connection.php");
include("functions.php");

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $color = $_POST['color'];
    $userID = $_SESSION['user']['userId'];

    $select = " SELECT * FROM [Notes] WHERE note_title = '$title'";
    $result = $conn->query($select);

    if($result->rowCount() == -1){
        $error[] = 'project already exist';
    }
    else{
        $insert = "INSERT INTO [Notes] (note_title, note_description, note_color, note_userID) VALUES ('$title','$description','$color', '$userID')";
        $conn->query($insert);
    }
}
if(isset($_POST['_method'])){
    $noteID = $_POST['note_id'];
    
    $delete = " DELETE FROM [Notes] WHERE note_id = '$noteID' ";
    $result = $conn->query($delete);
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
            });
            
            $(".profile .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".notifications").removeClass("active");
            });

            $(".notifications .icon_wrap").click(function(){
                $(this).parent().toggleClass("active");
                $(".messages").removeClass("active");
                $(".profile").removeClass("active");
            });
            $(".btnCreateNote").click(function(){
                $(".modal").toggleClass("active");
            });
            $(".close").click(function(){
                $(".modal").removeClass("active");
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
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h2 class="section-title">Notes</h2>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-right">
                            <button type="button" class="btn btn-primary btn-rounded-mt4 btnCreateNote">
                                <i class="fa-solid fa-plus"></i>
                                Create Note
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <?php
                                $notes = getNotesByUser($_SESSION['user']['userId']);
                                foreach($notes as $note){
                                    ?>
                                    <div class="col-md-4">
                                        <div class="card mb-0 mt-3 text-white <?= $note['note_color'] ?>">
                                            <div class="card-body">
                                                <div class="card-widgets float-right">
                                                    <a href="noteEdit.php?id=<?= $note['note_id'] ?>">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <a href="#">
                                                        <i class="fa-solid fa-trash btnDelete" onclick="deleteSection(<?= $note['note_id'] ?>);"></i>
                                                    </a>
                                                    <form action="" id="<?= $note['note_id'] ?>" style="display: none;" method="post">
                                                        <input type="hidden" name="note_id" value="<?= $note['note_id'] ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </div>
                                                <h5 class="card-title mb-0"><?= $note['note_title'] ?></h5>
                                                <div id="cardCollpase2" class="collapse pt-3 show">
                                                    <?= $note['note_description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                This website made by Hakan Karaotcu
            </div>
        </footer>
    </div>
    <div class="modal fade show" style="padding-right: 17px; display: hidden;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Note</h4>
                    <button type="button" class="close">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" required="" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control" name="color" required="">
                                <option value="bg-primary">Primary</option>
                                <option value="bg-secondary">Secondary</option>
                                <option value="bg-info">Info</option>
                                <option value="bg-warning">Warning</option>
                                <option value="bg-danger">Danger</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit">Create Note</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_box">
        <i class="fa-solid fa-exclamation"></i>
        <h1>Your note will be deleted Permanently!</h1>
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