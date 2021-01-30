<section id="register-form">
    <div class="register-card">
        <h2 class="form-h2">Register</h2>
        <form action="action_register.php" method="post">
            <input class="input-box" type="text" name="username" placeholder="Username" required>

            <input class="input-box" tpe="email" name="email" placeholder="Email" required>

            <input class="input-box" type="password" name="password" placeholder="Password" required title="Minimum 6 characters and at least 1 uppercase letter">

            <input class="input-box" type="password" name="repeat" placeholder="Repeat Password" required title="Minimum 6 characters and at least 1 uppercase letter">

            <input class="input-btn" type="submit" value="Register">
        </form>
        <div class="register-footer">
            <div id="register-footer-container">
                <span>Already have an account?</span>
                <a href="login.php">LogIn</a>
            </div>

            <a id="forget-password" href="#">Forgot Password?</a>
        </div>

    </div>
</section>