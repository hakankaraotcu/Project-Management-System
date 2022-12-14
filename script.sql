USE [master]
GO
/****** Object:  Database [db_project]    Script Date: 16.08.2022 16:58:26 ******/
CREATE DATABASE [db_project]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_test', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_test.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'db_test_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_test_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [db_project] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [db_project].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [db_project] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [db_project] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [db_project] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [db_project] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [db_project] SET ARITHABORT OFF 
GO
ALTER DATABASE [db_project] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [db_project] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [db_project] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [db_project] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [db_project] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [db_project] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [db_project] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [db_project] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [db_project] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [db_project] SET  DISABLE_BROKER 
GO
ALTER DATABASE [db_project] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [db_project] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [db_project] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [db_project] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [db_project] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [db_project] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [db_project] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [db_project] SET RECOVERY FULL 
GO
ALTER DATABASE [db_project] SET  MULTI_USER 
GO
ALTER DATABASE [db_project] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [db_project] SET DB_CHAINING OFF 
GO
ALTER DATABASE [db_project] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [db_project] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [db_project] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [db_project] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'db_project', N'ON'
GO
ALTER DATABASE [db_project] SET QUERY_STORE = OFF
GO
USE [db_project]
GO
/****** Object:  Table [dbo].[Milestones]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Milestones](
	[milestone_id] [int] IDENTITY(1,1) NOT NULL,
	[milestone_projectID] [int] NOT NULL,
	[milestone_statusID] [int] NULL,
	[milestone_title] [varchar](250) NOT NULL,
	[milestone_cost] [int] NOT NULL,
	[milestone_summary] [text] NULL,
 CONSTRAINT [PK_Milestones] PRIMARY KEY CLUSTERED 
(
	[milestone_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MilestoneStatus]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MilestoneStatus](
	[milestoneStatus_id] [int] IDENTITY(1,1) NOT NULL,
	[milestoneStatus_status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_MilestoneStatus] PRIMARY KEY CLUSTERED 
(
	[milestoneStatus_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notes]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notes](
	[note_id] [int] IDENTITY(1,1) NOT NULL,
	[note_title] [varchar](250) NOT NULL,
	[note_description] [text] NOT NULL,
	[note_color] [varchar](50) NOT NULL,
	[note_userID] [int] NOT NULL,
 CONSTRAINT [PK_Notes] PRIMARY KEY CLUSTERED 
(
	[note_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Projects]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Projects](
	[project_id] [int] IDENTITY(1,1) NOT NULL,
	[project_userID] [int] NOT NULL,
	[project_statusID] [int] NULL,
	[project_name] [varchar](250) NOT NULL,
	[project_budget] [int] NOT NULL,
	[project_start_date] [date] NULL,
	[project_end_date] [date] NULL,
	[project_description] [text] NULL,
 CONSTRAINT [PK_Projects] PRIMARY KEY CLUSTERED 
(
	[project_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ProjectStatus]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ProjectStatus](
	[projectStatus_id] [int] IDENTITY(1,1) NOT NULL,
	[projectStatus_status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_ProjectStatus] PRIMARY KEY CLUSTERED 
(
	[projectStatus_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TaskPriority]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TaskPriority](
	[taskPriority_id] [int] IDENTITY(1,1) NOT NULL,
	[taskPriority_priority] [varchar](50) NOT NULL,
 CONSTRAINT [PK_TaskPriority] PRIMARY KEY CLUSTERED 
(
	[taskPriority_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Tasks]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Tasks](
	[task_id] [int] IDENTITY(1,1) NOT NULL,
	[task_projectID] [int] NULL,
	[task_milestoneID] [int] NULL,
	[task_priorityID] [int] NULL,
	[task_statusID] [int] NULL,
	[task_title] [varchar](250) NOT NULL,
	[task_start_date] [date] NOT NULL,
	[task_end_date] [date] NOT NULL,
	[task_description] [text] NULL,
	[task_created_at] [varchar](50) NULL,
 CONSTRAINT [PK_Tasks] PRIMARY KEY CLUSTERED 
(
	[task_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TaskStatus]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TaskStatus](
	[taskStatus_id] [int] IDENTITY(1,1) NOT NULL,
	[taskStatus_status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_TaskStatus] PRIMARY KEY CLUSTERED 
(
	[taskStatus_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Users]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Users](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[first_name] [varchar](50) NOT NULL,
	[last_name] [varchar](50) NOT NULL,
	[role] [varchar](50) NOT NULL,
	[password] [varchar](50) NOT NULL,
	[email] [varchar](250) NOT NULL,
 CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsersProjects]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsersProjects](
	[userID] [int] NOT NULL,
	[projectID] [int] NOT NULL,
 CONSTRAINT [PK_UsersProjects] PRIMARY KEY CLUSTERED 
(
	[userID] ASC,
	[projectID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UsersTasks]    Script Date: 16.08.2022 16:58:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UsersTasks](
	[userID] [int] NOT NULL,
	[taskID] [int] NOT NULL,
 CONSTRAINT [PK_UsersTasks] PRIMARY KEY CLUSTERED 
(
	[userID] ASC,
	[taskID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Milestones] ON 

INSERT [dbo].[Milestones] ([milestone_id], [milestone_projectID], [milestone_statusID], [milestone_title], [milestone_cost], [milestone_summary]) VALUES (25, 19, 1, N'milestone3', 0, N'')
SET IDENTITY_INSERT [dbo].[Milestones] OFF
GO
SET IDENTITY_INSERT [dbo].[MilestoneStatus] ON 

INSERT [dbo].[MilestoneStatus] ([milestoneStatus_id], [milestoneStatus_status]) VALUES (1, N'Incomplete')
INSERT [dbo].[MilestoneStatus] ([milestoneStatus_id], [milestoneStatus_status]) VALUES (2, N'Complete')
SET IDENTITY_INSERT [dbo].[MilestoneStatus] OFF
GO
SET IDENTITY_INSERT [dbo].[Notes] ON 

INSERT [dbo].[Notes] ([note_id], [note_title], [note_description], [note_color], [note_userID]) VALUES (5, N'note2', N'Lorem impus', N'bg-danger', 1)
SET IDENTITY_INSERT [dbo].[Notes] OFF
GO
SET IDENTITY_INSERT [dbo].[Projects] ON 

INSERT [dbo].[Projects] ([project_id], [project_userID], [project_statusID], [project_name], [project_budget], [project_start_date], [project_end_date], [project_description]) VALUES (19, 1, 1, N'projetct4', 0, NULL, NULL, N'')
INSERT [dbo].[Projects] ([project_id], [project_userID], [project_statusID], [project_name], [project_budget], [project_start_date], [project_end_date], [project_description]) VALUES (23, 1, 2, N'Project1', 0, CAST(N'2022-08-03' AS Date), CAST(N'2022-08-04' AS Date), N'')
SET IDENTITY_INSERT [dbo].[Projects] OFF
GO
SET IDENTITY_INSERT [dbo].[ProjectStatus] ON 

INSERT [dbo].[ProjectStatus] ([projectStatus_id], [projectStatus_status]) VALUES (1, N'Ongoing')
INSERT [dbo].[ProjectStatus] ([projectStatus_id], [projectStatus_status]) VALUES (2, N'Finished')
INSERT [dbo].[ProjectStatus] ([projectStatus_id], [projectStatus_status]) VALUES (3, N'OnHold')
SET IDENTITY_INSERT [dbo].[ProjectStatus] OFF
GO
SET IDENTITY_INSERT [dbo].[TaskPriority] ON 

INSERT [dbo].[TaskPriority] ([taskPriority_id], [taskPriority_priority]) VALUES (1, N'Low')
INSERT [dbo].[TaskPriority] ([taskPriority_id], [taskPriority_priority]) VALUES (2, N'Medium')
INSERT [dbo].[TaskPriority] ([taskPriority_id], [taskPriority_priority]) VALUES (3, N'High')
SET IDENTITY_INSERT [dbo].[TaskPriority] OFF
GO
SET IDENTITY_INSERT [dbo].[Tasks] ON 

INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (29, 19, 25, 1, 1, N'task1', CAST(N'2022-08-02' AS Date), CAST(N'2022-08-06' AS Date), N'', NULL)
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (33, 19, 25, 1, 2, N'task2', CAST(N'2022-08-02' AS Date), CAST(N'2022-08-06' AS Date), N'', N'Wednesday')
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (34, 19, 25, 1, 1, N'task3', CAST(N'2022-08-05' AS Date), CAST(N'2022-08-26' AS Date), N'', NULL)
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (35, 19, 25, 3, 1, N'task4', CAST(N'2022-08-03' AS Date), CAST(N'2022-08-13' AS Date), N'', N'Wednesday')
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (36, 23, 25, 3, 1, N'task5', CAST(N'2022-08-03' AS Date), CAST(N'2022-08-11' AS Date), N'', N'Wednesday')
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (37, 19, 25, 3, 3, N'task6', CAST(N'2022-08-03' AS Date), CAST(N'2022-08-12' AS Date), N'', N'Wednesday')
INSERT [dbo].[Tasks] ([task_id], [task_projectID], [task_milestoneID], [task_priorityID], [task_statusID], [task_title], [task_start_date], [task_end_date], [task_description], [task_created_at]) VALUES (38, 23, 25, 2, 1, N'task7', CAST(N'2022-08-05' AS Date), CAST(N'2022-08-14' AS Date), N'', N'Wednesday')
SET IDENTITY_INSERT [dbo].[Tasks] OFF
GO
SET IDENTITY_INSERT [dbo].[TaskStatus] ON 

INSERT [dbo].[TaskStatus] ([taskStatus_id], [taskStatus_status]) VALUES (1, N'TODO')
INSERT [dbo].[TaskStatus] ([taskStatus_id], [taskStatus_status]) VALUES (2, N'IN PROGRESS')
INSERT [dbo].[TaskStatus] ([taskStatus_id], [taskStatus_status]) VALUES (3, N'REVIEW')
INSERT [dbo].[TaskStatus] ([taskStatus_id], [taskStatus_status]) VALUES (4, N'DONE')
SET IDENTITY_INSERT [dbo].[TaskStatus] OFF
GO
SET IDENTITY_INSERT [dbo].[Users] ON 

INSERT [dbo].[Users] ([user_id], [first_name], [last_name], [role], [password], [email]) VALUES (1, N'hakan', N'kara', N'Project Manager', N'123', N'hakan@gmail.com')
INSERT [dbo].[Users] ([user_id], [first_name], [last_name], [role], [password], [email]) VALUES (2, N'ibrahim', N'ak', N'Project Manager', N'123', N'ibrahim@gmail.com')
SET IDENTITY_INSERT [dbo].[Users] OFF
GO
INSERT [dbo].[UsersProjects] ([userID], [projectID]) VALUES (1, 19)
INSERT [dbo].[UsersProjects] ([userID], [projectID]) VALUES (1, 23)
GO
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 29)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 33)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 34)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 35)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 36)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (1, 37)
INSERT [dbo].[UsersTasks] ([userID], [taskID]) VALUES (2, 38)
GO
ALTER TABLE [dbo].[Milestones]  WITH CHECK ADD  CONSTRAINT [FK_Milestones_MilestoneStatus] FOREIGN KEY([milestone_statusID])
REFERENCES [dbo].[MilestoneStatus] ([milestoneStatus_id])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Milestones] CHECK CONSTRAINT [FK_Milestones_MilestoneStatus]
GO
ALTER TABLE [dbo].[Milestones]  WITH CHECK ADD  CONSTRAINT [FK_Milestones_Projects] FOREIGN KEY([milestone_projectID])
REFERENCES [dbo].[Projects] ([project_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Milestones] CHECK CONSTRAINT [FK_Milestones_Projects]
GO
ALTER TABLE [dbo].[Notes]  WITH CHECK ADD  CONSTRAINT [FK_Notes_Users] FOREIGN KEY([note_userID])
REFERENCES [dbo].[Users] ([user_id])
GO
ALTER TABLE [dbo].[Notes] CHECK CONSTRAINT [FK_Notes_Users]
GO
ALTER TABLE [dbo].[Projects]  WITH CHECK ADD  CONSTRAINT [FK_Projects_ProjectStatus] FOREIGN KEY([project_statusID])
REFERENCES [dbo].[ProjectStatus] ([projectStatus_id])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Projects] CHECK CONSTRAINT [FK_Projects_ProjectStatus]
GO
ALTER TABLE [dbo].[Tasks]  WITH CHECK ADD  CONSTRAINT [FK_Tasks_Milestones] FOREIGN KEY([task_milestoneID])
REFERENCES [dbo].[Milestones] ([milestone_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Tasks] CHECK CONSTRAINT [FK_Tasks_Milestones]
GO
ALTER TABLE [dbo].[Tasks]  WITH CHECK ADD  CONSTRAINT [FK_Tasks_Projects] FOREIGN KEY([task_projectID])
REFERENCES [dbo].[Projects] ([project_id])
GO
ALTER TABLE [dbo].[Tasks] CHECK CONSTRAINT [FK_Tasks_Projects]
GO
ALTER TABLE [dbo].[Tasks]  WITH CHECK ADD  CONSTRAINT [FK_Tasks_TaskPriority] FOREIGN KEY([task_priorityID])
REFERENCES [dbo].[TaskPriority] ([taskPriority_id])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Tasks] CHECK CONSTRAINT [FK_Tasks_TaskPriority]
GO
ALTER TABLE [dbo].[Tasks]  WITH CHECK ADD  CONSTRAINT [FK_Tasks_TaskStatus1] FOREIGN KEY([task_statusID])
REFERENCES [dbo].[TaskStatus] ([taskStatus_id])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Tasks] CHECK CONSTRAINT [FK_Tasks_TaskStatus1]
GO
ALTER TABLE [dbo].[UsersProjects]  WITH CHECK ADD  CONSTRAINT [FK_UsersProjects_Projects] FOREIGN KEY([projectID])
REFERENCES [dbo].[Projects] ([project_id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[UsersProjects] CHECK CONSTRAINT [FK_UsersProjects_Projects]
GO
ALTER TABLE [dbo].[UsersProjects]  WITH CHECK ADD  CONSTRAINT [FK_UsersProjects_Users] FOREIGN KEY([userID])
REFERENCES [dbo].[Users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[UsersProjects] CHECK CONSTRAINT [FK_UsersProjects_Users]
GO
ALTER TABLE [dbo].[UsersTasks]  WITH CHECK ADD  CONSTRAINT [FK_UsersTasks_Tasks] FOREIGN KEY([taskID])
REFERENCES [dbo].[Tasks] ([task_id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[UsersTasks] CHECK CONSTRAINT [FK_UsersTasks_Tasks]
GO
ALTER TABLE [dbo].[UsersTasks]  WITH CHECK ADD  CONSTRAINT [FK_UsersTasks_Users] FOREIGN KEY([userID])
REFERENCES [dbo].[Users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[UsersTasks] CHECK CONSTRAINT [FK_UsersTasks_Users]
GO
USE [master]
GO
ALTER DATABASE [db_project] SET  READ_WRITE 
GO
