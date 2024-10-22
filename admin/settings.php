<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';
require_once '../includes/dbh.inc.php';

if (!isset($_SESSION['adminID'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php?login=failed");
  exit();
}

$showModal = false;
if (isset($_SESSION['admin_process'])) {
    if ($_SESSION['admin_process'] === 'created') {
        $showModal = true;
    }
    unset($_SESSION['admin_process']);
}

$admin_id = $_SESSION['adminID'];

$query = "SELECT * FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare(query: $query);
$stmt->bind_param("s", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../assets/images/logoipsum.svg"
      type="image/x-icon"
    />
    <title>Add Admin | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="admin-settings__container">
          <h1>Profile Settings</h1>

          <?php if($row = $result->fetch_assoc()){?>
          <div class="admin-settings">
            <div class="current-profile__container">
              <div class="profile-image__container">
                <img src="" alt="profile image" class="profile-image" id="profileDisplay" >

                <label for="profileImage" class="upload-label">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="24" height="24" rx="12" fill="#1D72F2"/>
                    <path d="M12.84 6.4008L7.36667 12.1941C7.16 12.4141 6.96 12.8475 6.92 13.1475L6.67334 15.3075C6.58667 16.0875 7.14667 16.6208 7.92 16.4875L10.0667 16.1208C10.3667 16.0675 10.7867 15.8475 10.9933 15.6208L16.4667 9.82746C17.4133 8.82746 17.84 7.68746 16.3667 6.29413C14.9 4.91413 13.7867 5.4008 12.84 6.4008Z" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9267 7.3667C12.2133 9.2067 13.7067 10.6134 15.56 10.8" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.99998 18.6675H18" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </label>
                <input type="file" name="profileImage" id="profileImage" accept="image/*">
              </div>

              <div class="current-profile__details">
                <h2 class="profile-details__role">System Administrator</h2>

                <div class="profile-details">
                  <h3 class="profile-details__name"><?php echo $row['first_name'] ." ". $row['last_name'] ?></h3>
                  <p class="profile-details__email"><?php echo $row['email']?></p>
                  <p class="profile-details__phone">0<?php echo $row['contact']?></p>
                </div>
              </div>
            </div>

            <form action="includes/admin_setting_update.php" method="post" id="adminForm">
              <section
                class="admin-form__section admin-form__section--personal-details"
              >
                <div class="admin-form__field">
                  <label for="firstname" class="admin-form__label">First Name</label>
                  <input
                    type="text"
                    name="firstname"
                    id="firstname"
                    placeholder="e.g. Juan"
                    value="<?php echo $row['first_name']?>"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p
                      class="admin-form__text admin-form__text--error"
                    >
                      Error
                    </p>
                    <p
                      class="admin-form__text admin-form__text--valid"
                    >
                      Valid
                    </p>
                  </div>
                </div>
                <div class="admin-form__field">
                  <label for="lastname" class="admin-form__label">Last Name</label>
                  <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    placeholder="e.g. Dela Cruz"
                     value="<?php echo $row['last_name']?>"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p class="admin-form__text admin-form__text--error">
                      Error
                    </p>
                    <p class="admin-form__text admin-form__text--valid">
                      Valid
                    </p>
                  </div>
                </div>
                <div class="admin-form__field">
                  <label for="email" class="admin-form__label">Email</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="e.g. juandelacruz@gmail.com"
                     value="<?php echo $row['email']?>"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p
                      class="admin-form__text admin-form__text--error"
                    >
                      Error
                    </p>
                    <p
                      class="admin-form__text admin-form__text--valid"
                    >
                      Valid
                    </p>
                  </div>
                </div>
                <div class="admin-form__field">
                  <label for="contactnumber" class="admin-form__label"
                    >Contact Number</label
                  >
                  <input
                    type="tel"
                    name="contactnumber"
                    id="contactnumber"
                    onkeypress="isNumber(event)"
                    placeholder="e.g. 09123456789"
                    value="0<?php echo $row['contact']?>"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p
                      class="admin-form__text admin-form__text--error"
                    >
                      Error
                    </p>
                    <p
                      class="admin-form__text admin-form__text--valid"
                    >
                      Valid
                    </p>
                  </div>
                </div>
              </section>
            
            <?php }?>

              <section
                class="admin-form__section admin-form__section--personal-details"
              >
                <div class="admin-form__field">
                  <label for="password" class="admin-form__label">Password</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p
                      class="admin-form__text admin-form__text--error"
                    >
                      Error
                    </p>
                    <p
                      class="admin-form__text admin-form__text--valid"
                    >
                      Valid
                    </p>
                  </div>
                </div>
                <div class="admin-form__field">
                  <label for="newPassword" class="admin-form__label">New Password</label>
                  <input
                    type="password"
                    name="newPassword"
                    id="newPassword"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p class="admin-form__text admin-form__text--error">
                      Error
                    </p>
                    <p class="admin-form__text admin-form__text--valid">
                      Valid
                    </p>
                  </div>
                </div>
                <div class="admin-form__field">
                  <label for="confirmPassword" class="admin-form__label">Confirm Password</label>
                  <input
                    type="password"
                    name="confirmPassword"
                    id="confirmPassword"
                    class="admin-form__input"
                  />
                  <div class="admin-form__validation">
                    <p
                      class="admin-form__text admin-form__text--error"
                    >
                      Error
                    </p>
                    <p
                      class="admin-form__text admin-form__text--valid"
                    >
                      Valid
                    </p>
                  </div>
                </div>
                <input
                  type="submit"
                  name="submit"
                  value="Save Changes"
                  class="admin-form__submit-button"
                />
              </section>

              <div class="modal" style="display: none">
                <div class="modal__content">
                  <div class="body-text">
                    <div class="modal__header">
                      <h3 id="modalStatus" class="modal__status">
                       admin profile <br> successfully <br> updated
                      </h3>
                      <p id="modalMessage" class="modal__message">
                        <a href="">
                          Go to admin
                          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.62 3.95337L13.6667 8.00004L9.62 12.0467" stroke="#E84531" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2.33333 8H13.5533" stroke="#E84531" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </a>
                      </p>
                    </div>
                    <button type="button" id="exitButton" class="modal__button">
                      okay, got it!
                    </button>
                  </div>
                  <div class="illustration__container">
                    <svg width="369" height="369" viewBox="0 0 369 369" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_672_4373)">
                      <rect width="369" height="369" fill="#1D72F2"/>
                      <g filter="url(#filter0_f_672_4373)">
                      <circle cx="229.5" cy="87.5" r="67.5" fill="#EBEBEB"/>
                      </g>
                      <g filter="url(#filter1_f_672_4373)">
                      <circle cx="43" cy="367" r="87" fill="#EBEBEB"/>
                      </g>
                      <g clip-path="url(#clip1_672_4373)">
                      <path d="M311.077 356.134C310.749 356.149 310.424 356.063 310.146 355.887C309.869 355.712 309.652 355.455 309.525 355.152C309.399 354.848 309.368 354.514 309.438 354.192C309.508 353.871 309.675 353.58 309.916 353.356L310.026 352.92C310.011 352.885 309.997 352.85 309.982 352.815C309.651 352.034 309.098 351.368 308.39 350.901C307.682 350.434 306.852 350.186 306.004 350.189C305.157 350.192 304.329 350.446 303.624 350.918C302.92 351.391 302.371 352.061 302.047 352.845C300.749 355.972 299.096 359.105 298.69 362.411C298.51 363.873 298.586 365.354 298.913 366.79C295.865 360.138 294.282 352.907 294.272 345.588C294.271 343.752 294.373 341.917 294.577 340.092C294.746 338.596 294.98 337.11 295.279 335.635C296.913 327.633 300.421 320.132 305.515 313.749C307.98 312.403 309.974 310.334 311.228 307.819C311.682 306.915 312.003 305.951 312.181 304.955C311.902 304.991 311.132 300.754 311.342 300.494C310.954 299.905 310.26 299.613 309.837 299.038C307.732 296.183 304.831 296.681 303.317 300.562C300.083 302.195 300.051 304.904 302.036 307.509C303.299 309.167 303.472 311.409 304.58 313.184C304.466 313.33 304.348 313.471 304.234 313.617C302.15 316.298 300.334 319.176 298.812 322.211C299.182 318.811 298.74 315.371 297.522 312.176C296.288 309.197 293.975 306.689 291.938 304.114C289.492 301.021 284.475 302.371 284.044 306.291C284.039 306.329 284.035 306.367 284.031 306.405C284.334 306.576 284.63 306.757 284.92 306.949C285.284 307.192 285.566 307.54 285.729 307.946C285.892 308.353 285.929 308.799 285.834 309.227C285.739 309.654 285.518 310.044 285.198 310.343C284.879 310.642 284.476 310.838 284.044 310.905L283.999 310.912C284.107 312.003 284.298 313.084 284.569 314.146C281.956 324.256 287.598 327.939 295.653 328.104C295.831 328.195 296.004 328.287 296.182 328.373C294.652 332.71 293.693 337.227 293.328 341.811C293.121 344.516 293.133 347.233 293.364 349.935L293.351 349.84C292.767 346.835 291.165 344.123 288.814 342.163C285.323 339.294 280.391 338.237 276.624 335.931C276.224 335.674 275.759 335.536 275.283 335.535C274.807 335.534 274.341 335.669 273.94 335.924C273.538 336.179 273.218 336.544 273.017 336.975C272.816 337.407 272.742 337.886 272.805 338.358C272.81 338.392 272.815 338.425 272.82 338.459C273.381 338.688 273.928 338.951 274.457 339.248C274.759 339.419 275.055 339.6 275.345 339.792C275.709 340.035 275.991 340.383 276.154 340.789C276.318 341.196 276.354 341.642 276.26 342.07C276.165 342.497 275.943 342.886 275.624 343.186C275.304 343.485 274.902 343.681 274.469 343.748L274.425 343.755C274.393 343.759 274.366 343.764 274.334 343.768C275.293 346.06 276.639 348.169 278.314 350.004C279.948 358.83 286.966 359.667 294.472 357.097H294.477C295.3 360.678 296.494 364.163 298.038 367.497H310.758C310.804 367.356 310.845 367.21 310.886 367.068C309.708 367.142 308.526 367.072 307.366 366.859C308.31 365.7 309.253 364.532 310.197 363.374C310.218 363.352 310.238 363.329 310.257 363.305C310.735 362.712 311.219 362.124 311.697 361.531L311.698 361.53C311.723 359.712 311.514 357.899 311.077 356.134Z" fill="#F2F2F2"/>
                      <path d="M289.881 242.966C293.252 230.719 299.541 220.289 309.694 212.265C310.096 211.644 310.728 211.208 311.45 211.052C312.173 210.897 312.928 211.034 313.55 211.435L336.725 226.405C337.345 226.807 337.781 227.439 337.937 228.162C338.093 228.885 337.955 229.64 337.555 230.262L317.741 260.963C317.34 261.584 316.708 262.02 315.985 262.176C315.263 262.332 314.508 262.194 313.886 261.794L290.711 246.823C290.091 246.421 289.655 245.789 289.499 245.066C289.343 244.343 289.481 243.588 289.881 242.966Z" fill="#F2F2F2"/>
                      <path d="M297.643 234.841C298.512 228.371 303.862 221.756 310.381 215.104C310.757 214.523 311.349 214.114 312.026 213.968C312.703 213.822 313.41 213.951 313.992 214.326L333.909 227.192C334.49 227.569 334.898 228.16 335.044 228.838C335.19 229.515 335.061 230.222 334.686 230.805L317.055 258.124C316.679 258.706 316.087 259.114 315.41 259.26C314.733 259.406 314.026 259.277 313.444 258.902L301.106 250.932C298.517 249.255 296.698 246.62 296.049 243.603C295.4 240.587 295.973 237.436 297.643 234.841Z" fill="white"/>
                      <path d="M299.42 261.224C296.48 248.867 296.97 236.696 302.006 224.771C302.059 224.034 302.402 223.347 302.961 222.862C303.519 222.378 304.247 222.134 304.985 222.186L332.502 224.139C333.239 224.193 333.925 224.536 334.41 225.095C334.894 225.654 335.137 226.382 335.086 227.12L332.5 263.573C332.447 264.31 332.104 264.997 331.545 265.481C330.987 265.966 330.259 266.209 329.522 266.158L302.005 264.204C301.267 264.151 300.581 263.808 300.097 263.249C299.612 262.69 299.369 261.962 299.42 261.224Z" fill="#F2F2F2"/>
                      <path d="M302.312 250.364C299.959 244.274 301.463 235.9 303.974 226.929C304.024 226.238 304.346 225.595 304.869 225.141C305.392 224.687 306.073 224.459 306.764 224.507L330.412 226.186C331.103 226.236 331.746 226.558 332.2 227.081C332.653 227.604 332.881 228.286 332.833 228.977L330.532 261.415C330.482 262.106 330.161 262.749 329.638 263.203C329.115 263.657 328.433 263.885 327.742 263.837L313.093 262.797C310.016 262.575 307.154 261.141 305.133 258.81C303.112 256.48 302.097 253.442 302.312 250.364Z" fill="white"/>
                      <path d="M301.793 184.939L290.005 141.286C289.5 139.438 288.289 137.863 286.633 136.9C284.978 135.937 283.01 135.665 281.156 136.14C280.196 136.387 279.297 136.826 278.512 137.431C277.728 138.036 277.075 138.795 276.593 139.661C276.111 140.527 275.811 141.482 275.71 142.468C275.61 143.454 275.711 144.45 276.007 145.396L289.642 190.365L296.776 218.04C295.737 218.834 294.967 219.928 294.572 221.175C294.176 222.421 294.173 223.759 294.565 225.007C294.956 226.255 295.721 227.353 296.757 228.15C297.793 228.948 299.049 229.407 300.355 229.465C301.661 229.523 302.954 229.178 304.056 228.476C305.159 227.774 306.02 226.749 306.52 225.541C307.021 224.333 307.137 223 306.854 221.723C306.571 220.446 305.902 219.287 304.938 218.404L301.793 184.939Z" fill="#FFB6B6"/>
                      <path d="M216.776 192.491L228.865 148.92C229.372 147.073 229.133 145.1 228.198 143.428C227.264 141.755 225.71 140.518 223.872 139.982C222.921 139.704 221.923 139.624 220.94 139.745C219.957 139.865 219.008 140.185 218.153 140.685C217.297 141.185 216.552 141.853 215.964 142.65C215.375 143.447 214.954 144.356 214.728 145.321L203.557 190.965L195.601 218.415C194.302 218.568 193.083 219.117 192.108 219.988C191.132 220.859 190.449 222.009 190.15 223.282C189.85 224.556 189.95 225.89 190.436 227.104C190.921 228.319 191.768 229.354 192.862 230.07C193.956 230.786 195.244 231.148 196.55 231.106C197.857 231.064 199.119 230.621 200.165 229.836C201.211 229.052 201.99 227.964 202.397 226.722C202.804 225.479 202.818 224.141 202.438 222.889L216.776 192.491Z" fill="#FFB6B6"/>
                      <path d="M285.957 359.86L278.253 359.859L274.589 330.132L285.958 330.132L285.957 359.86Z" fill="#FFB6B6"/>
                      <path d="M286.228 367.9L262.539 367.899V367.599C262.539 365.153 263.511 362.807 265.24 361.077C266.969 359.347 269.314 358.375 271.76 358.375L276.087 355.09L284.161 358.375L286.229 358.375L286.228 367.9Z" fill="#2F2E41"/>
                      <path d="M231.746 359.937L224.162 358.584L225.77 328.674L236.963 330.671L231.746 359.937Z" fill="#FFB6B6"/>
                      <path d="M230.602 367.9L207.281 363.739L207.334 363.444C207.763 361.035 209.131 358.896 211.137 357.497C213.143 356.097 215.622 355.552 218.029 355.982L222.866 353.508L230.238 358.16L232.274 358.523L230.602 367.9Z" fill="#2F2E41"/>
                      <path d="M232.497 223.177C232.497 223.177 225.317 233.351 225.61 236.765C225.903 240.179 228.438 237.455 225.903 240.179C223.367 242.902 221.89 241.075 223.136 244.44C224.381 247.805 224.888 245.626 224.381 247.805C223.874 249.984 224.888 333.326 224.888 333.326H238.091C238.091 333.326 245.536 285 244.593 282.744C243.651 280.488 243.672 281.47 244.676 279.073C245.679 276.675 246.623 273.823 246.623 273.823L257.059 244.44L265.108 285.81L274.583 334.97H287.235C287.235 334.97 289.402 262.68 290.359 261.779C291.317 260.878 290.171 258.854 288.969 257.687C287.768 256.52 288.007 255.336 288.394 252.932C288.782 250.529 290.416 249.188 290.359 247.679C290.303 246.171 293.853 222.203 288.275 218.39C282.697 214.577 232.497 223.177 232.497 223.177Z" fill="#2F2E41"/>
                      <path d="M276.64 121.837L261.872 118.009L254.979 108.497L238.608 110.51L235.123 123.485L223.468 130.253C244.36 130.378 233.109 190.934 236.18 194.841C238.679 198.02 223.707 205.584 228.4 210.409C233.092 215.234 231.357 213.303 230.268 218.556C229.179 223.809 221.242 229.369 230.268 229.313C239.294 229.258 293.757 228.48 292.201 222.253C290.645 216.025 290.669 217.607 288.323 213.702C285.976 209.798 284.397 211.98 285.187 206.218C285.976 200.457 283.412 196.001 285.198 193.451C287.941 189.538 285.177 161.289 282.591 162.043L276.64 121.837Z" fill="#1D72F2"/>
                      <path d="M272.423 122.04C272.423 122.04 283.226 117.448 287.116 126.011C288.359 128.746 289.405 135.615 290.413 134.091C291.421 132.568 290.448 135.908 291.072 135.912C291.629 135.915 292.486 135.014 291.839 138.119C291.636 139.138 291.694 140.191 292.008 141.181C292.322 142.171 292.882 143.065 293.635 143.78L274.859 155.03L272.423 122.04Z" fill="#1D72F2"/>
                      <path d="M231.836 129.824C231.836 129.824 221.034 125.232 217.144 133.795C216.05 136.203 216.322 141.554 214.191 140.953C212.061 140.352 213.573 142.616 213.292 143.402C212.979 144.278 214.347 146.759 212.426 145.891C210.505 145.023 210.625 151.565 210.625 151.565L229.4 162.815L231.836 129.824Z" fill="#1D72F2"/>
                      <path d="M236.958 117L233.846 122.448C233.846 122.448 225.287 127.119 225.287 127.897C225.287 128.676 226.843 135.032 225.287 140.027C223.731 145.022 228.258 154.417 229.178 162.147C233.068 194.841 221.499 206.72 219.063 227.534L243.752 234.748C243.752 234.748 247.851 180.051 247.851 167.596C247.851 155.142 236.958 117 236.958 117Z" fill="#2F2E41"/>
                      <path d="M259.521 114.665L265.881 118.284C265.881 118.284 274.205 120.12 274.304 120.892C274.403 121.664 274.433 129.869 276.614 134.625C278.795 139.38 278.194 141.909 284.068 155.967C287.07 163.15 293.96 220.62 293.96 220.62L270.394 230.93C270.394 230.93 259.346 177.204 257.756 164.852C256.165 152.499 259.521 114.665 259.521 114.665Z" fill="#2F2E41"/>
                      <path d="M243.618 107.243C252.503 107.243 259.706 100.037 259.706 91.1476C259.706 82.2584 252.503 75.0522 243.618 75.0522C234.733 75.0522 227.53 82.2584 227.53 91.1476C227.53 100.037 234.733 107.243 243.618 107.243Z" fill="#FFB6B6"/>
                      <path d="M254.205 103.653C250.403 100.679 255.601 87.5967 249.321 90.3891C249.321 90.3891 241.646 85.5024 240.103 88.7137C238.318 92.432 231.967 90.7452 228.067 89.4327C228.373 88.7198 228.591 87.9719 228.716 87.2058C227.996 87.7733 227.233 88.2845 226.434 88.7346C225.898 88.4482 225.424 88.0592 225.038 87.5897C224.658 87.1537 224.42 86.6117 224.356 86.0364C224.293 85.4611 224.407 84.8801 224.683 84.3715C225.332 83.3732 226.671 83.066 227.46 82.1794C227.551 82.0547 227.61 81.9098 227.633 81.757C227.656 81.6043 227.641 81.4483 227.591 81.3024C227.497 80.9457 227.483 80.5726 227.549 80.2098C227.616 79.847 227.762 79.5033 227.976 79.2033C228.191 78.9033 228.469 78.6543 228.79 78.4741C229.112 78.2939 229.47 78.1869 229.837 78.1607C229.985 78.1652 230.132 78.1332 230.265 78.0675C230.927 77.6622 231.538 77.1794 232.086 76.6295C231.172 76.6713 232.29 71.0734 241.352 72.1336C243.634 72.0499 244.826 74.5675 247.073 74.9654C252.519 71.8518 257.38 76.3432 259.746 80.6366C262.111 84.9299 264.672 98.7664 254.205 103.653Z" fill="#2F2E41"/>
                      <path d="M185.561 80.563H41.3508C38.6073 80.5653 35.9767 81.6563 34.0362 83.5966C32.0957 85.537 31.0038 88.1682 31 90.913V220.919C31.0036 223.665 32.0952 226.297 34.0356 228.238C35.976 230.179 38.6067 231.272 41.3508 231.275H185.561C188.304 231.271 190.934 230.179 192.874 228.238C194.813 226.296 195.904 223.664 195.906 220.919V90.913C195.903 88.1688 194.813 85.5377 192.873 83.5972C190.934 81.6567 188.304 80.5655 185.561 80.563Z" fill="white"/>
                      <path d="M119.669 110.402H104.263C103.506 110.402 102.78 110.101 102.245 109.566C101.71 109.03 101.41 108.304 101.41 107.547C101.41 106.79 101.71 106.064 102.245 105.529C102.78 104.994 103.506 104.693 104.263 104.693H119.669C120.426 104.693 121.152 104.994 121.687 105.529C122.222 106.064 122.522 106.79 122.522 107.547C122.522 108.304 122.222 109.03 121.687 109.566C121.152 110.101 120.426 110.402 119.669 110.402Z" fill="#1D72F2"/>
                      <path d="M323.947 241.551H308.541C307.784 241.551 307.058 241.25 306.523 240.715C305.988 240.18 305.688 239.454 305.688 238.697C305.688 237.94 305.988 237.214 306.523 236.678C307.058 236.143 307.784 235.842 308.541 235.842H323.947C324.704 235.842 325.43 236.143 325.965 236.678C326.5 237.214 326.8 237.94 326.8 238.697C326.8 239.454 326.5 240.18 325.965 240.715C325.43 241.25 324.704 241.551 323.947 241.551Z" fill="#1D72F2"/>
                      <path d="M159.612 170.191H64.3202C63.5635 170.191 62.8378 169.89 62.3028 169.355C61.7677 168.82 61.4672 168.094 61.4672 167.337C61.4672 166.58 61.7677 165.854 62.3028 165.318C62.8378 164.783 63.5635 164.482 64.3202 164.482H159.612C160.369 164.482 161.094 164.783 161.629 165.318C162.164 165.854 162.465 166.58 162.465 167.337C162.465 168.094 162.164 168.82 161.629 169.355C161.094 169.89 160.369 170.191 159.612 170.191Z" fill="#E6E6E6"/>
                      <path d="M159.612 189.03H64.3202C63.5635 189.03 62.8378 188.729 62.3028 188.194C61.7677 187.659 61.4672 186.933 61.4672 186.176C61.4672 185.419 61.7677 184.693 62.3028 184.157C62.8378 183.622 63.5635 183.321 64.3202 183.321H159.612C160.369 183.321 161.094 183.622 161.629 184.157C162.164 184.693 162.465 185.419 162.465 186.176C162.465 186.933 162.164 187.659 161.629 188.194C161.094 188.729 160.369 189.03 159.612 189.03Z" fill="#E6E6E6"/>
                      <path d="M159.612 207.869H64.3202C63.5635 207.869 62.8378 207.569 62.3028 207.033C61.7677 206.498 61.4672 205.772 61.4672 205.015C61.4672 204.258 61.7677 203.532 62.3028 202.997C62.8378 202.461 63.5635 202.161 64.3202 202.161H159.612C160.369 202.161 161.094 202.461 161.629 202.997C162.164 203.532 162.465 204.258 162.465 205.015C162.465 205.772 162.164 206.498 161.629 207.033C161.094 207.569 160.369 207.869 159.612 207.869Z" fill="#E6E6E6"/>
                      <path d="M140.135 118.966H83.7985C81.0549 118.969 78.4244 120.06 76.4839 122C74.5434 123.94 73.4514 126.572 73.4476 129.316V146.289C73.4512 149.034 74.5429 151.666 76.4833 153.607C78.4236 155.549 81.0543 156.641 83.7985 156.644H140.135C142.878 156.641 145.508 155.548 147.448 153.607C149.387 151.665 150.478 149.033 150.48 146.289V129.316C150.477 126.572 149.387 123.941 147.447 122.001C145.507 120.06 142.878 118.969 140.135 118.966ZM149.339 146.289C149.339 148.732 148.368 151.076 146.641 152.804C144.914 154.532 142.572 155.503 140.129 155.503H99.6883C93.0315 155.503 86.6474 152.857 81.9403 148.148C77.2332 143.438 74.5888 137.051 74.5888 130.391V129.316C74.5927 126.874 75.5645 124.534 77.2909 122.807C79.0174 121.081 81.3576 120.11 83.7985 120.108H140.135C142.575 120.111 144.914 121.082 146.64 122.808C148.365 124.534 149.336 126.875 149.339 129.316V146.289Z" fill="#E6E6E6"/>
                      <path d="M112.597 143.931C117.954 143.931 122.297 139.586 122.297 134.226C122.297 128.866 117.954 124.521 112.597 124.521C107.24 124.521 102.897 128.866 102.897 134.226C102.897 139.586 107.24 143.931 112.597 143.931Z" fill="#E6E6E6"/>
                      <path d="M134.914 156.644L91.4845 156.49L105.179 153.065L106.885 147.43L120.015 147.356L123.946 152.928L133.875 155.502L134.777 155.736L134.914 156.644Z" fill="#E6E6E6"/>
                      <path d="M107.084 140.422C109.166 138.794 106.32 131.633 109.758 133.162C109.758 133.162 113.959 130.487 114.803 132.245C115.781 134.28 119.257 133.357 121.392 132.638C121.224 132.248 121.105 131.839 121.037 131.419C121.431 131.73 121.848 132.01 122.285 132.256C122.579 132.1 122.838 131.887 123.049 131.63C123.258 131.391 123.388 131.094 123.423 130.779C123.458 130.464 123.395 130.146 123.244 129.868C122.889 129.322 122.156 129.153 121.724 128.668C121.674 128.6 121.642 128.521 121.629 128.437C121.617 128.353 121.625 128.268 121.652 128.188C121.704 127.993 121.712 127.789 121.675 127.59C121.639 127.391 121.559 127.203 121.441 127.039C121.324 126.875 121.172 126.739 120.996 126.64C120.82 126.541 120.624 126.483 120.423 126.468C120.342 126.471 120.261 126.453 120.189 126.417C119.826 126.196 119.492 125.931 119.192 125.63C119.692 125.653 119.08 122.589 114.12 123.169C112.871 123.123 112.218 124.502 110.989 124.719C108.007 123.015 105.346 125.474 104.051 127.824C102.757 130.174 101.355 137.747 107.084 140.422Z" fill="#E6E6E6"/>
                      <path d="M185.561 80.563H41.3508C38.6073 80.5653 35.9767 81.6563 34.0362 83.5966C32.0957 85.537 31.0038 88.1682 31 90.913V220.919C31.0036 223.665 32.0952 226.297 34.0356 228.238C35.976 230.179 38.6067 231.272 41.3508 231.275H185.561C188.304 231.271 190.934 230.179 192.874 228.238C194.813 226.296 195.904 223.664 195.906 220.919V90.913C195.903 88.1688 194.813 85.5377 192.873 83.5972C190.934 81.6567 188.304 80.5655 185.561 80.563ZM194.765 220.919C194.765 223.363 193.794 225.707 192.067 227.435C190.34 229.163 187.998 230.133 185.555 230.133H106.435C96.6785 230.133 87.0177 228.211 78.004 224.476C68.9902 220.74 60.8001 215.265 53.9013 208.363C47.0025 201.461 41.5301 193.267 37.7965 184.249C34.0629 175.231 32.1412 165.565 32.1412 155.804V90.913C32.1451 88.4711 33.1168 86.1303 34.8433 84.4041C36.5697 82.6779 38.91 81.7071 41.3508 81.7047H185.561C188.001 81.7073 190.341 82.6783 192.066 84.4047C193.792 86.131 194.762 88.4716 194.765 90.913V220.919Z" fill="#E6E6E6"/>
                      <path d="M336.223 368.825L156.277 369C156.097 368.999 155.925 368.927 155.799 368.8C155.672 368.673 155.601 368.5 155.601 368.321C155.601 368.141 155.672 367.968 155.799 367.841C155.925 367.714 156.097 367.642 156.277 367.641L336.223 367.465C336.402 367.466 336.574 367.538 336.701 367.666C336.828 367.793 336.899 367.965 336.899 368.145C336.899 368.325 336.828 368.497 336.701 368.624C336.574 368.752 336.402 368.824 336.223 368.825Z" fill="#CACACA"/>
                      </g>
                      </g>
                      <defs>
                      <filter id="filter0_f_672_4373" x="62" y="-80" width="335" height="335" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                      <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                      <feGaussianBlur stdDeviation="50" result="effect1_foregroundBlur_672_4373"/>
                      </filter>
                      <filter id="filter1_f_672_4373" x="-144" y="180" width="374" height="374" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                      <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                      <feGaussianBlur stdDeviation="50" result="effect1_foregroundBlur_672_4373"/>
                      </filter>
                      <clipPath id="clip0_672_4373">
                      <rect width="369" height="369" fill="white"/>
                      </clipPath>
                      <clipPath id="clip1_672_4373">
                      <rect width="307" height="297" fill="white" transform="translate(31 72)"/>
                      </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
  </body>
  <script>

document.addEventListener('DOMContentLoaded', () => {
    const adminForm = document.getElementById('adminForm');
    const modalContainer = document.querySelector(".modal");
    const exitBtn = modalContainer.querySelector("#exitButton");
    const profileImageInput = document.getElementById('profileImage');
    const profileDisplay = document.getElementById('profileDisplay');

    <?php if ($showModal) : ?>
      modalContainer.style.display = "flex";
    <?php endif; ?>

           // Close modal when exit button is clicked
           exitBtn.addEventListener("click", () => {
            modalContainer.style.transform = "scale(0)";
        });
  });

  function isNumber(evt) {
    var input = evt.target.value;

    // Ensure only digits are entered
    var contactNum = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(contactNum))) {
        evt.preventDefault();
        return;
    }

    // Check if the input starts with "09" and length is less than 11 digits
    if (input.length === 0 && contactNum !== '0') {
        evt.preventDefault();
    } else if (input.length === 1 && contactNum !== '9') {
        evt.preventDefault();
    } else if (input.length >= 11) {
        evt.preventDefault();
    }
  } 

    profileImageInput.addEventListener('change', function (e) {
      const file = e.target.files[0]
      if(file) {
        const reader = new FileReader()

        reader.onload = function (e) {
          profileDisplay.src = e.target.result
        }
        reader.readAsDataURL(file)
      }
    });

  </script>
  </html>
