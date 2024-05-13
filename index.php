<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Smile Hero Clinic</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
  <!-- stylesheets -->
  <link rel="stylesheet" href="src/dist/styles.css" />
  <style>
  body {
    font-family: "DM Sans", sans-serif;
  }

  .branches__section .branches__container .branch .header__container {
    background: url('assets/images/landing_page/dental_clinic_branch.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }
  </style>
</head>

<body>
  <main class="landing__page"
    style='background: url(assets/images/mesh_bg.png); background-repeat: no-repeat; background-size: 100%'>
    <!-- navigation bar -->
    <?php include('nav.php') ?>

    <!-- header -->
    <header class="hero__section">
      <h1 class="header">Seamless smiles begin here</h1>
      <p class="sub__header">
        Streamlined dental appointments for your convenience
      </p>
      <form action="">
        <input type="email" name="email" id="email" placeholder="name@email.com" />
        <button type="submit">Subscribe</button>
      </form>

      <div class="hero__image"></div>
    </header>

    <!-- branches -->
    <section class="branches__section" id="branchesSection">
      <h2 class="header">Smile Hero Branches</h2>
      <article class="branches__container">
        <!-- branch -->
        <div class="branch">
          <div class="header__container">
            <p>Bayani Road,Taguig</p>
          </div>
          <div class="branch__details">
            <p class="branch__title">Main Clinic</p>
            <p class="branch__desc">
              Explore comprehensive dental services at our flagship clinic,
              backed by advanced technology and a skilled team.
            </p>
            <button>Sign up</button>
          </div>
        </div>
        <!-- branch -->
        <div class="branch">
          <div class="header__container">
            <p>Signal,Taguig</p>
          </div>
          <div class="branch__details">
            <p class="branch__title">Cosmetic Center</p>
            <p class="branch__desc">
              Transform your smile at our Cosmetic Dentistry Center,
              specializing in makeovers and teeth whitening.
            </p>
            <button>Sign up</button>
          </div>
        </div>
        <!-- branch -->
        <div class="branch">
          <div class="header__container">
            <p>BGC, Taguig</p>
          </div>
          <div class="branch__details">
            <p class="branch__title">Family Dentistry</p>
            <p class="branch__desc">
              Gentle Family Care. Experience personalized and gentle dental
              care for all ages at our Family Dentistry branch.
            </p>
            <button>Sign up</button>
          </div>
        </div>
      </article>
    </section>

    <!-- services -->
    <article class="services__section">
      <div class="heading">
        <h3 class="header">Our Specialized Services</h3>
        <p class="sub__header">
          Discover a range of comprehensive dental services at our clinic,
          from routine check-ups to transformative cosmetic treatments. Our
          skilled team is dedicated to ensuring your oral health and enhancing
          your smile with personalized care and expertise.
        </p>
      </div>

      <div class="card">
        <img src="./assets/images/landing_page/comprehensive_oral_care.webp" alt="Comprehensive Oral Care Image" />
        <div class="service__container">
          <p class="card__label">General Dentistry</p>
          <p class="card__header">Comprehensive Oral Care</p>
          <p class="card__desc">
            Our skilled general dentists provide a full spectrum of services,
            from routine check-ups to cavity fillings, ensuring your oral
            health is in top condition.
          </p>
        </div>
      </div>
      <div class="card">
        <img src="./assets/images/landing_page/enhance_your_smile.jpg" alt="Enhance Your Smile" />
        <div class="service__container">
          <p class="card__label">Cosmetic Dentistry</p>
          <p class="card__header">Enhance Your Smile</p>
          <p class="card__desc">
            Explore our cosmetic dentistry options, including teeth whitening,
            veneers, and smile makeovers, to achieve the confident, radiant
            smile you've always desired.
          </p>
        </div>
      </div>
    </article>

    <!-- testimonials -->
    <section class="testimonials__section">
      <h4 class="header">Hear from our users</h4>
      <div class="testimonial__container">
        <div class="testimonial__card">
          <p class="testimonial__text">
            Exceptional care and state-of-the-art facilities make this clinic
            stand out. The team's professionalism and advanced technology
            ensured a stress-free experience. I found my dental home for
            comprehensive care.
          </p>
          <div class="testimonial__details">
            <img src="./assets/images/landing_page/sarah.jpg" alt="" />
            <div class="testimonial__name">
              <p class="testimonial">Sarah L.</p>
              <p class="testimonial__branch">Main Clinic</p>
            </div>
          </div>
        </div>
        <div class="testimonial__card">
          <p class="testimonial__text">
            Thrilled with the results from the Cosmetic Dentistry Center! The
            team worked wonders on my smile, and the atmosphere is both
            inviting and comforting. Confidence has a new address!
          </p>
          <div class="testimonial__details">
            <img src="./assets/images/landing_page/alex.jpg" alt="" />
            <div class="testimonial__name">
              <p class="testimonial">Alex M.</p>
              <p class="testimonial__branch">Cosmetic Center</p>
            </div>
          </div>
        </div>
        <div class="testimonial__card">
          <p class="testimonial__text">
            From our toddler to grandparents, the Family Dentistry branch has
            been our go-to. Their personalized approach and gentle care make
            every visit enjoyable. Trustworthy, friendly, and perfect for the
            whole family.
          </p>
          <div class="testimonial__details">
            <img src="./assets/images/landing_page/johnson_family.jpg" alt="" />
            <div class="testimonial__name">
              <p class="testimonial">The Johnson Family</p>
              <p class="testimonial__branch">Family Dentistry</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- footer -->
  <?php include('footer.php') ?>

  <!-- font awesome -->
  <!-- <script
      src="https://kit.fontawesome.com/09032c3c23.js"
      crossorigin="anonymous"
    ></script> -->
</body>

</html>