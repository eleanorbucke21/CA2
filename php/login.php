<?php
include '../base.php';
?>	

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3"> 
            <form action="login_action.php" method="post" class="bg-dark p-4 rounded">
            <div class="mb-3"> 
                <label for="email" class="form-label text-white">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark btn-outline-light">Login</button>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-white">If you don't have an account, </span>
                    <a href="register.php" class="text-light">register here.</a>
                </div>
            </form>
        </div>
    </div>
</div>
