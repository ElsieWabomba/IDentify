<?php
session_start();
include "functions.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kipande System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="app.js" type="text/javascript"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Kipande</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="agents.php">Agents</a>
                </li>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="requests.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Id Cards
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="requests.php?status=complete">Complete</a></li>
                                <li><a class="dropdown-item" href="requests.php?status=new">New Requests</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="requests.php?status=in progress">Pending</a></li>
                            </ul>
                        </li>
                        <?php if ($_SESSION['user_level'] == '2' || $_SESSION['user_level'] == '3'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="users.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Users
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="users.php?cat=1">Agents</a></li>
                                    <li><a class="dropdown-item" href="users.php?cat=2">Members</a></li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login
                            </button>
                        </li>
                    <?php endif; ?>
                </ul>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
            if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                    <?php echo $_SESSION['message']; ?>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['msg_type']);
                    ?>
                </div>
        <?php endif ?>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="loginForm" method="post" action="processor.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="loginUser">Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>