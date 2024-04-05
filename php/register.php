<?php
include '../base.php';
?>	

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="register_action.php" method="post" class="bg-dark p-4 rounded">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark btn-outline-light">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
