<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "function.php"; ?>
<?php include "classes/Comment.php"; ?>
<?php $comment_obj = new Comment($connection); ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Blogging System &mdash; Minimal Blog Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">

    <style> 
    .CommentBlock {
      background-color: #F6F7F9;
    }
    .comment {
      margin-top: -2px;
      padding-bottom: 10px;
      font-size: 1.1em;
    }
    </style>
  </head>
  <body>
