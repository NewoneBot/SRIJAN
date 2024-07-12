<?php  

include 'login_db.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulma Form</title>
    <!-- Link to Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
    /* Custom style to limit form width */
    .custom-width {
        max-width: 400px;
        margin: 0 auto;
        /* Center the form horizontally */
        background-color: #ddd;

        padding: 20px;
        border-radius: 10px;
    }

    /* Center the login button */
    .is-flex-centered {
        display: flex;
        justify-content: center;
    }
    </style>
</head>

<body>

    <section class="section">
        <div class="container">
            <h2 class="title has-text-centered">Login Form</h2>
            <form action="" method="post" class="custom-width">
                <div class="field">
                    <label class="label" for="email">Email</label>
                    <div class="control">
                        <input class="input" type="email" id="email" name="email" placeholder="Enter your email"
                            required>
                        <?php if($email_error != "") { ?>
                        <p class="help is-danger"><?php echo $email_error; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="control">
                        <input class="input" type="password" id="password" name="password"
                            placeholder="Enter your password" required>
                        <?php if($password_error != "") { ?>
                        <p class="help is-danger"><?php echo $password_error; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div class="field is-flex-centered">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="login">Login</button>
                    </div>
                </div>
                <p class="has-text-centered">Don't have an account? <a href="register.php">Register Now</a></p>
            </form>

        </div>
    </section>

</body>

</html>