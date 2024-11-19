<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="./assets/images/logoipsum.svg"
      type="image/x-icon"
    />
    <title>Forgot Password | Smile Hero Clinic</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="src/dist/styles.css" />
   </head>
  <body>
    <main class="form-modal f-c">
      <form method="post" action="includes/send_password_reset.php" class="forgot-pass-form f-c">
        <p class="form-header">
          Enter your email below, and we’ll send you a reset link
        </p>
        <div class="field f-c">
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Your email here"
            required
          />
          <button type="submit">Send Reset Link</button>
        </div>
        <p class="form-note">
          If you don't receive the email within a few minutes, check your spam
          folder or try again.
        </p>
      </form>
    </main>
  </body>
</html>