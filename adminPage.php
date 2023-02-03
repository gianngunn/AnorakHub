<div class="container">
    <form action="dbServices/loginAdmin.php" method="post">
        <div class="form-group">
            <label for="uemail">Email address</label>
            <input type="email" class="form-control" name="uemail" aria-describedby="emailHelp">

        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php
?>