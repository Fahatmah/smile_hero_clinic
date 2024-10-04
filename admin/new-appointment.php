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
    <title>Create Appointment | Admin</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>

      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="new-appointment__container">
          <h1>create new appointment</h1>

          <form action="" id="appointmentForm">
            <section
              class="appointment-form__section appointment-form__section--personal-details"
            >
              <div class="appointment-form__field">
                <label for="name" class="appointment-form__label">Name</label>
                <input
                  type="text"
                  name="name"
                  id="name"
                  placeholder="e.g. Fahatmah Mabang"
                  class="appointment-form__input"
                />
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <div class="appointment-form__field">
                <label for="email" class="appointment-form__label">Email</label>
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="e.g. fahatmahmabang@gmail.com"
                  class="appointment-form__input"
                />
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <div class="appointment-form__field">
                <label for="contactnumber" class="appointment-form__label"
                  >Contact Number</label
                >
                <input
                  type="tel"
                  name="contactnumber"
                  id="contactnumber"
                  placeholder="e.g. 09123456789"
                  class="appointment-form__input"
                />
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <div class="appointment-form__field">
                <label for="message" class="appointment-form__label"
                  >Message/Requests</label
                >
                <input
                  type="text"
                  name="message"
                  id="message"
                  class="appointment-form__input"
                />
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
            </section>

            <div class="modal" style="display: none">
              <div class="modal__content">
                <div class="body-text">
                  <div class="modal__header">
                    <h3 id="modalStatus" class="modal__status">
                      appointment <br> successfully <br> created
                    </h3>
                    <p id="modalMessage" class="modal__message">
                      <a href="">
                        Go to appointments
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
                    <g clip-path="url(#clip0_635_2797)">
                    <rect width="369" height="369" fill="#1D72F2"/>
                    <g clip-path="url(#clip1_635_2797)">
                    <path d="M314.728 368.609L318.18 435.027C318.18 435.027 172.154 295.76 153.961 255.013C135.769 214.265 170.013 113.468 170.013 113.468L245.993 155.288L314.728 368.609Z" fill="#E84531"/>
                    <path d="M90.8233 85.5874L68.3505 87.732C68.3505 87.732 56.579 113.467 92.9636 115.612L90.8233 85.5874Z" fill="#E84531"/>
                    <path d="M90.8233 125.263L68.3505 127.408C68.3505 127.408 56.579 153.143 92.9636 155.288L90.8233 125.263Z" fill="#E84531"/>
                    <path d="M90.8233 168.156L68.3505 170.3C68.3505 170.3 56.579 196.036 92.9636 198.18L90.8233 168.156Z" fill="#E84531"/>
                    <path d="M97.2441 211.048L74.7712 213.192C74.7712 213.192 62.9997 238.928 99.3843 241.073L97.2441 211.048Z" fill="#E84531"/>
                    <path d="M79.8826 95.9264H81.5878V49.1185C81.5877 45.5608 82.2871 42.038 83.6457 38.7512C85.0044 35.4643 86.9959 32.4778 89.5064 29.9622C92.017 27.4465 94.9974 25.451 98.2776 24.0895C101.558 22.7281 105.073 22.0273 108.624 22.0273H207.591C211.142 22.0273 214.658 22.7281 217.938 24.0895C221.218 25.451 224.198 27.4465 226.709 29.9621C229.219 32.4778 231.211 35.4642 232.57 38.7511C233.928 42.0379 234.628 45.5608 234.628 49.1184V305.91C234.628 309.468 233.928 312.991 232.57 316.277C231.211 319.564 229.22 322.551 226.709 325.066C224.198 327.582 221.218 329.578 217.938 330.939C214.658 332.301 211.142 333.001 207.592 333.001H108.624C101.454 333.001 94.5768 330.147 89.5065 325.067C84.4363 319.986 81.5878 313.095 81.5878 305.91V129.245H79.8826V95.9264Z" fill="#3F3D56"/>
                    <path d="M107.533 29.0755H120.452C119.858 30.5349 119.631 32.1184 119.791 33.6864C119.952 35.2544 120.495 36.7588 121.372 38.067C122.249 39.3752 123.435 40.4472 124.823 41.1884C126.211 41.9296 127.76 42.3173 129.333 42.3175H186.03C187.603 42.3174 189.152 41.9296 190.54 41.1884C191.928 40.4472 193.114 39.3752 193.991 38.067C194.868 36.7588 195.411 35.2544 195.572 33.6864C195.732 32.1184 195.505 30.5349 194.911 29.0754H206.977C212.332 29.0754 217.468 31.2069 221.254 35.001C225.04 38.7952 227.168 43.9411 227.168 49.3068V305.722C227.168 308.378 226.645 311.009 225.631 313.464C224.616 315.918 223.129 318.149 221.254 320.027C219.379 321.906 217.153 323.396 214.704 324.413C212.254 325.43 209.629 325.953 206.977 325.953H107.533C104.882 325.953 102.256 325.43 99.8066 324.413C97.357 323.396 95.1312 321.906 93.2564 320.027C91.3815 318.149 89.8943 315.918 88.8797 313.464C87.865 311.009 87.3428 308.379 87.3428 305.722V49.3068C87.3428 46.65 87.865 44.0192 88.8797 41.5646C89.8943 39.11 91.3815 36.8797 93.2564 35.0011C95.1312 33.1224 97.357 31.6322 99.8066 30.6155C102.256 29.5987 104.882 29.0755 107.533 29.0755Z" fill="white"/>
                    <path d="M178.561 100.91H135.949V111.214H178.561V100.91Z" fill="#1D72F2"/>
                    <path d="M180.59 145.184H133.921V155.487H180.59V145.184Z" fill="#E5E5E5"/>
                    <path d="M209.335 167.317H105.175V177.62H209.335V167.317Z" fill="#E5E5E5"/>
                    <path d="M209.335 189.45H105.175V199.753H209.335V189.45Z" fill="#E5E5E5"/>
                    <path d="M415.534 403.202L295.754 266.272L291.474 178.342L246.528 103.281L233.686 71.1113C233.686 71.1113 203.723 74.3283 228.336 135.45L238.502 168.155C229.338 187.934 224.59 209.477 224.59 231.283V306.227C224.59 323.874 308.515 419.998 318.284 434.681L415.534 403.202Z" fill="#E84531"/>
                    <path opacity="0.2" d="M237.21 109.641L246.145 105.241L245.841 104.62L237.585 108.686L225.122 75.9451L224.477 76.1921L237.21 109.641Z" fill="black"/>
                    <path opacity="0.2" d="M68.4701 87.4064L68.2314 88.0557L81.468 92.9415L81.7067 92.2922L68.4701 87.4064Z" fill="black"/>
                    <path opacity="0.2" d="M68.4701 127.534L68.2314 128.183L81.468 133.069L81.7067 132.42L68.4701 127.534Z" fill="black"/>
                    <path opacity="0.2" d="M68.4701 170.429L68.2314 171.078L81.468 175.964L81.7067 175.315L68.4701 170.429Z" fill="black"/>
                    <path opacity="0.2" d="M75.4049 213.337L75.1062 213.96L81.5505 217.06L81.8492 216.436L75.4049 213.337Z" fill="black"/>
                    <path d="M157.308 288.672C173.793 288.672 187.156 275.282 187.156 258.763C187.156 242.245 173.793 228.854 157.308 228.854C140.823 228.854 127.46 242.245 127.46 258.763C127.46 275.282 140.823 288.672 157.308 288.672Z" fill="#1D72F2"/>
                    <path d="M154.463 271.389L145.53 259.878L150.725 255.829L154.955 261.279L169.245 246.164L174.024 250.7L154.463 271.389Z" fill="white"/>
                    </g>
                    <g filter="url(#filter0_f_635_2797)">
                    <circle cx="12.0337" cy="368.527" r="67.5" fill="#EBEBEB"/>
                    </g>
                    <g filter="url(#filter1_f_635_2797)">
                    <circle cx="394.034" cy="109.527" r="67.5" fill="#EBEBEB"/>
                    </g>
                    </g>
                    <defs>
                    <filter id="filter0_f_635_2797" x="-155.466" y="201.027" width="335" height="335" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                    <feGaussianBlur stdDeviation="50" result="effect1_foregroundBlur_635_2797"/>
                    </filter>
                    <filter id="filter1_f_635_2797" x="226.534" y="-57.9727" width="335" height="335" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                    <feGaussianBlur stdDeviation="50" result="effect1_foregroundBlur_635_2797"/>
                    </filter>
                    <clipPath id="clip0_635_2797">
                    <rect width="369" height="369" fill="white"/>
                    </clipPath>
                    <clipPath id="clip1_635_2797">
                    <rect width="349" height="413" fill="white" transform="translate(66.5337 22.0273)"/>
                    </clipPath>
                    </defs>
                  </svg>
                </div>
              </div>
            </div>

            <section
              class="appointment-form__section appointment-form__section--preferences"
            >
              <div class="appointment-form__field">
                <label for="appointmentDate" class="appointment-form__label">
                  Date
                </label>
                <select
                  name="appointmentDate"
                  id="appointmentDate"
                  class="appointment-form__select"
                ></select>
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <div class="appointment-form__field">
                <label for="appointmentTime" class="appointment-form__label">
                  Time
                </label>
                <select
                  name="appointmentTime"
                  id="appointmentTime"
                  class="appointment-form__select"
                >
                  <option value="-">Select time</option>
                  <option value="9:00 AM">09:00 AM</option>
                  <option value="10:00 AM">10:00 AM</option>
                  <option value="11:00 AM">11:00 AM</option>
                  <option value="1:00 PM">01:00 PM</option>
                  <option value="2:00 PM">02:00 PM</option>
                  <option value="3:00 PM">03:00 PM</option>
                  <option value="4:00 PM">04:00 PM</option>
                  http://localhost/smile_hero_clinic/user_pages/appointment_form_page.php
                  <option value="5:00 PM">05:00 PM</option>
                </select>
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <div class="appointment-form__field">
                <label for="dentalService" class="appointment-form__label">Service</label>
                <select name="dentalService" id="dentalService" class="appointment-form__select">
                  <option value="-">Select service</option>
                  <option value="cleaning">Teeth Cleaning</option>
                  <option value="whitening">Teeth Whitening</option>
                  <option value="extraction">Tooth Extraction</option>
                  <option value="filling">Dental Filling</option>
                  <option value="checkup">Routine Check-up</option>
                  <option value="braces">Braces Consultation</option>
                  <option value="root_canal">Root Canal Treatment</option>
                  <option value="implants">Dental Implants</option>
                </select>
                <div class="appointment-form__validation">
                  <p class="appointment-form__text appointment-form__text--error">Error</p>
                  <p class="appointment-form__text appointment-form__text--valid">Valid</p>
                </div>
              </div>

              <div class="appointment-form__field">
                <label for="location" class="appointment-form__label"
                  >Location</label
                >
                <select
                  name="location"
                  id="location"
                  class="appointment-form__select"
                >
                  <option value="Bayani Road, Taguig City" selected>
                    Bayani Road, Taguig City
                  </option>
                </select>
                <div class="appointment-form__validation">
                  <p
                    class="appointment-form__text appointment-form__text--error"
                  >
                    Error
                  </p>
                  <p
                    class="appointment-form__text appointment-form__text--valid"
                  >
                    Valid
                  </p>
                </div>
              </div>
              <input
                type="submit"
                name="submit"
                value="Create Appointment"
                class="appointment-form__submit-button"
              />
            </section>
          </form>
        </div>
      </section>
    </main>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const appointmentForm = document.getElementById('appointmentForm')
      const modalContainer = document.querySelector('.modal')
      const exitBtn = modalContainer.querySelector('#exitButton')
      const modalStatus = modalContainer.querySelector('#modalStatus')
      const modalMessage = modalContainer.querySelector('#modalMessage')
      const appointmentDateSelect = document.getElementById('appointmentDate')

      // Check if the modal should be displayed
      <?php if ($showModal) : ?>
      modalStatus.innerText = "<?php echo $modalStatus; ?>";
      modalMessage.innerText = "<?php echo $modalMessage; ?>";
      modalContainer.style.display = 'flex'
      modalContainer.style.transform = 'scale(1)'
      <?php endif; ?>
      exitBtn.addEventListener('click', () => {
        modalContainer.style.transform = 'scale(0)'
        window.close()
      })

      appointmentForm.addEventListener('submit', (e) => {
        e.preventDefault()

        const fields = [
          {
            id: 'name',
            errorMessage: 'Name cannot be empty',
          },
          {
            id: 'email',
            errorMessage: 'Email cannot be empty',
          },
          {
            id: 'contactnumber',
            errorMessage: 'Contact number cannot be empty',
          },
          {
            id: 'appointmentDate',
            errorMessage: 'Please select a date',
          },
          {
            id: 'appointmentTime',
            errorMessage: 'Please select a time',
          },
          {
            id: 'location',
            errorMessage: 'Please select a location',
          },
        ]

        let isValid = true
        fields.forEach((field) => {
          const fieldElement = document.getElementById(field.id)
          const errorElement = fieldElement.nextElementSibling.querySelector(
            '.appointment-form__text--error'
          )
          const validElement = fieldElement.nextElementSibling.querySelector(
            '.appointment-form__text--valid'
          )

          if (
            fieldElement.value.trim() === '-' ||
            fieldElement.value.trim() === ''
          ) {
            errorElement.innerText = field.errorMessage
            errorElement.style.display = 'block' // Show error message
            validElement.style.display = 'none' // Hide valid message
            isValid = false
          } else {
            errorElement.style.display = 'none' // Hide error message
            validElement.style.display = 'block' // Show valid message
          }
        })

        if (isValid) {
          HTMLFormElement.prototype.submit.call(appointmentForm)
        }
      })

      function generateWeekdayOptions() {
        const today = new Date()
        const options = []
        let addedDays = 0 // To count the weekdays added

        while (options.length < 5) {
          // We need 5 weekdays
          const currentDay = new Date()
          currentDay.setDate(today.getDate() + addedDays + 1) // Increment by 1, then 2, etc.
          const dayOfWeek = currentDay.getDay()

          if (dayOfWeek >= 1 && dayOfWeek <= 5) {
            // Only weekdays (Monday to Friday)
            const formattedDate = currentDay.toISOString().split('T')[0] // Format as YYYY-MM-DD
            const weekdayName = currentDay.toLocaleString('en-US', {
              weekday: 'long',
            }) // Get the weekday name

            // Combine formatted date and weekday name
            const formattedDateWithWeekday = `${formattedDate}, ${weekdayName}`

            options.push(formattedDateWithWeekday)
          }

          addedDays++ // Increment days to move to the next date
        }

        // Clear existing options and add new ones
        appointmentDateSelect.innerHTML = '' // Clear existing options

        // Add the placeholder option
        const placeholderOption = document.createElement('option')
        placeholderOption.value = ''
        placeholderOption.textContent = 'Select date'
        placeholderOption.disabled = true // Make it unselectable
        placeholderOption.selected = true // Make it the default selected option
        appointmentDateSelect.appendChild(placeholderOption)

        // Add generated date options
        options.forEach((date) => {
          const option = document.createElement('option')
          option.value = date
          option.textContent = date
          appointmentDateSelect.appendChild(option)
        })
      }

      generateWeekdayOptions()
    })     
  </script>
</html>
