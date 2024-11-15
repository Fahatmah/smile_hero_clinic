<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/login_view.inc.php';
require_once '../includes/appointment_view.inc.php';
require_once '../includes/dbh.inc.php';

if(!isset($_SESSION['user_id'])) {
  // Redirect user to login if not logged in
  header("Location: ../login.php");
  exit();
}

$showModal = false;
$modalStatus = '';
$modalMessage = '';
if (isset($_SESSION['appointment_status'])) {
    if ($_SESSION['appointment_status'] === 'created') {
        $showModal = true;
        $modalStatus = 'Appointment has been requested.';
        $modalMessage = '*Wait for our email for the confirmation of your appointment.*';
    } elseif ($_SESSION['appointment_status'] === 'exists') {
        $showModal = true;
        $modalStatus = 'You already requested an appointment.';
        $modalMessage = '*Please wait for our email for confirmation*';
    }
    unset($_SESSION['appointment_status']);
}

$query = "SELECT available_dates FROM appointment_dates WHERE available_dates >= CURDATE()";
$result = $conn->query($query);

$availableDates = [];
while ($row = $result->fetch_assoc()) {
    $availableDates[] = $row['available_dates'];
}

// Fetch dates with 5 or more appointments
$disabledDatesQuery = "SELECT date FROM appointments GROUP BY date HAVING COUNT(*) >= 20 ";
$disabledDatesResult = $conn->query($disabledDatesQuery);

$disabledDates = [];
while ($row = $disabledDatesResult->fetch_assoc()) {
    $disabledDates[] = $row['date'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../assets/images/logoipsum.svg" type="image/x-icon">
  <title>Create an appointment | Smile Hero Clinic</title>

  <style>
    .flatpickr-calendar {
      font-family: 'Inter', sans-serif !important;
      font-size: 0.68rem !important;
      color: #616161 !important;
      background-color: #fff !important;
      border: 1px solid #ccc;
      border-radius: .5rem !important;
      overflow: hidden !important;
    }

    .flatpickr-calendar > * {
      color: #616161 !important;
      letter-spacing: -1px !important;
    }

    .flatpickr-day.today {
      background-color: hsl(0, 0%, 38%, 0.6) !important;
      color: #fff !important;
      font-weight: 600 !important;
    }

    .flatpickr-day.selected {
      background-color: #1D72F2 !important;
      color: #fff !important; 
      font-weight: 600 !important;
    }

    .flatpickr-month {
      font-weight: 600 !important;
      letter-spacing: -1px !important;
    }

    .flatpickr-day.disabled {
      background-color: 	hsla(216, 89%, 53%, 0.5);
        color: white !important;
        pointer-events: none;
        cursor: progress;
    }
  </style>
  
  <link rel="stylesheet" href="../src/dist/styles.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="user__page">
  <main class="user__main">
    <!-- navigation header bar -->
    <nav class="account__header user-header">
      <svg class="header__icon" width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="44" height="44" rx="22" fill="#1D72F2" />
        <g clip-path="url(#clip0_246_1826)">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16 10C19.3137 10 22 12.6863 22 16V10H28C31.3137 10 34 12.6863 34 16C34 19.3137 31.3137 22 28 22C31.3137 22 34 24.6863 34 28C34 29.6454 33.3377 31.1361 32.2651 32.22L32.2427 32.2427L32.2227 32.2625C31.1385 33.3366 29.6468 34 28 34C26.3645 34 24.8817 33.3456 23.7994 32.2843C23.7854 32.2705 23.7713 32.2566 23.7573 32.2427C23.7442 32.2295 23.7311 32.2163 23.7181 32.2031C22.6554 31.1205 22 29.6368 22 28C22 31.3137 19.3137 34 16 34C12.6863 34 10 31.3137 10 28V22H16C12.6863 22 10 19.3137 10 16C10 12.6863 12.6863 10 16 10ZM20.8 16C20.8 18.651 18.651 20.8 16 20.8V11.2C18.651 11.2 20.8 13.349 20.8 16ZM32.8 28C32.8 25.349 30.651 23.2 28 23.2C25.349 23.2 23.2 25.349 23.2 28H32.8ZM11.2 23.2V28C11.2 30.651 13.349 32.8 16 32.8C18.651 32.8 20.8 30.651 20.8 28V23.2H11.2ZM23.2 20.8V11.2H28C30.651 11.2 32.8 13.349 32.8 16C32.8 18.651 30.651 20.8 28 20.8H23.2Z" fill="white" />
        </g>
        <defs>
          <clipPath id="clip0_246_1826">
            <rect width="24" height="24" fill="white" transform="translate(10 10)" />
          </clipPath>
        </defs>
      </svg>

      <div class="header__content">
        <div class="header__date">
          Getting date and time...
        </div>
      </div>
    </nav>

    <section class="user-contents">
      <!-- navigation side nav -->
      <?php include('includes/sidenav.php'); ?>

      <!-- appointment form -->
      <div class="appointment_form">
        <h1>Schedule fresh meeting</h1>

        <form action="../includes/appointment.inc.php" method="post" id="appointmentForm">
          <!-- Personal Details Section -->
          <section class="appointment-form__section appointment-form__section--personal-details">
            <div class="appointment-form__field">
              <label for="name" class="appointment-form__label">Name</label>
              <input type="text" name="name" id="name" placeholder="e.g. Fahatmah Mabang" value="<?php outputFullName() ?>" class="appointment-form__input" />
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
            <div class="appointment-form__field">
              <label for="email" class="appointment-form__label">Email</label>
              <input type="email" name="email" id="email" placeholder="e.g. fahatmahmabang@gmail.com" value="<?php outputEmail() ?>" class="appointment-form__input" />
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
            <div class="appointment-form__field">
              <label for="contactnumber" class="appointment-form__label">Contact Number</label>
              <input type="tel" name="contactnumber" id="contactnumber" placeholder="e.g. 09123456789" value="<?php outputContact() ?>" class="appointment-form__input" />
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
            <div class="appointment-form__field">
              <label for="message" class="appointment-form__label">Message/Requests</label>
              <input type="text" name="message" id="message" class="appointment-form__input" />
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
          </section> 
          <!-- Modal -->
          <div class="modal" style="display: none">
            <div class="modal__content">
              <div class="modal__header">
                <h3 id="modalStatus" class="modal__status"></h3>
                <p id="modalMessage" class="modal__message"></p>
              </div>
              <button type="button" id="exitButton" class="modal__button">Okay, got it!</button>
            </div>
          </div>
          <!-- Preferences Section -->
          <section class="appointment-form__section appointment-form__section--preferences">
            <!-- <div class="appointment-form__field">
              <label for="appointmentDate" class="appointment-form__label">Date</label>
              <select name="appointmentDate" id="appointmentDate" class="appointment-form__select"></select>
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div> -->
            <div class="appointment-form__field">
              <label for="appointmentDate" class="appointment-form__label">Date</label>
              <input type="text" name="appointmentDate" id="appointmentDate" class="appointment-form__input" placeholder="Select a date">
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>

            <div class="appointment-form__field">
              <label for="appointmentTime" class="appointment-form__label">Time</label>
              <select name="appointmentTime" id="appointmentTime" class="appointment-form__select">
                  <option value="-">Select time</option>
                  <option value="9:00 AM">09:00 AM</option>
                  <option value="10:00 AM">10:00 AM</option>
                  <option value="11:00 AM">11:00 AM</option>
                  <option value="1:00 PM">01:00 PM</option>
                  <option value="2:00 PM">02:00 PM</option>
                  <option value="3:00 PM">03:00 PM</option>
                  <option value="4:00 PM">04:00 PM</option>
                  <option value="5:00 PM">05:00 PM</option>
              </select>
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
            <div class="appointment-form__field">
              <label class="appointment-form__label">Service</label>
              <input type="button" value="Select service" class="services-btn" id="servicesBtn">
              <div class="selected-services" id="selectedServices"></div>
              <div class="appointment-form__checkbox-group">
                <div class="checkbox-container">
                    <input type="checkbox" id="cleaning" name="dentalService[]" value="teeth cleaning  ₱2,800">
                    <label for="cleaning">Teeth Cleaning <span class="service-price">₱2,800</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="whitening" name="dentalService[]" value="teeth whitening  ₱8,400">
                    <label for="whitening">Teeth Whitening <span class="service-price">₱8,400</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="extraction" name="dentalService[]" value="tooth extraction  ₱4,200">
                    <label for="extraction">Tooth Extraction <span class="service-price">₱4,200</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="filling" name="dentalService[]" value="dental filling  ₱6,700">
                    <label for="filling">Dental Filling <span class="service-price">₱6,700</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="checkup" name="dentalService[]" value="routine checkup-up ₱2,200">
                    <label for="checkup">Routine Check-up <span class="service-price">₱2,200</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="braces" name="dentalService[]" value="braces consultation  ₱5,600">
                    <label for="braces">Braces Consultation <span class="service-price">₱5,600</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="root_canal" name="dentalService[]" value="root canal treatment ₱16,800">
                    <label for="root_canal">Root Canal Treatment <span class="service-price">₱16,800</span></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="implants" name="dentalService[]" value="dental implants  ₱56,000">
                    <label for="implants">Dental Implants <span class="service-price">₱56,000</span></label>
                </div>
            </div>

              
              <!-- <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div> -->
            </div>

            <div class="appointment-form__field">
              <label for="location" class="appointment-form__label">Location</label>
              <select name="location" id="location" class="appointment-form__select">
                  <!-- <option value="-">Select location</option> -->
                  <option value="Bayani Road, Taguig City" selected>Bayani Road, Taguig City</option>
                  <!-- <option value="Main Street, Makati City">Main Street, Makati City</option>
                  <option value="Central Avenue, Quezon City">Central Avenue, Quezon City</option> -->
              </select>
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
            </div>
            <input type="submit" name="submit" value="Create Appointment" class="appointment-form__submit-button">
          </section>
        </form>

      </div>
    </section>
  </main>

  <!-- scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const appointmentForm = document.getElementById('appointmentForm');
      const modalContainer = document.querySelector(".modal");
      const exitBtn = modalContainer.querySelector("#exitButton");
      const modalStatus = modalContainer.querySelector("#modalStatus");
      const modalMessage = modalContainer.querySelector("#modalMessage");
      const appointmentDateSelect = document.getElementById('appointmentDate');

      // Check if the modal should be displayed
      <?php if ($showModal) : ?>
      modalStatus.innerText = "<?php echo $modalStatus; ?>";
      modalMessage.innerText = "<?php echo $modalMessage; ?>";
      modalContainer.style.display = "flex";
      modalContainer.style.transform = "scale(1)";
      <?php endif; ?>
      exitBtn.addEventListener("click", () => {
        modalContainer.style.transform = "scale(0)";
        // window.close()
      });

      appointmentForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const fields = [{
            id: 'name',
            errorMessage: 'Name cannot be empty'
          },
          {
            id: 'email',
            errorMessage: 'Email cannot be empty'
          },
          {
            id: 'contactnumber',
            errorMessage: 'Contact number cannot be empty'
          },
          {
            id: 'appointmentDate',
            errorMessage: 'Please select a date'
          },
          {
            id: 'appointmentTime',
            errorMessage: 'Please select a time'
          },
          {
            id: 'location',
            errorMessage: 'Please select a location'
          },
          // {
          //   id: 'selectedServices',
          //   errorMessage: 'Please select a service'
          // },
        ];

        let isValid = true;
        fields.forEach((field) => {
          const fieldElement = document.getElementById(field.id);
          const errorElement = fieldElement.nextElementSibling.querySelector('.appointment-form__text--error');
          const validElement = fieldElement.nextElementSibling.querySelector('.appointment-form__text--valid');

          if (fieldElement.value.trim() === '-' || fieldElement.value.trim() === '') {
            errorElement.innerText = field.errorMessage;
            errorElement.style.display = 'block'; // Show error message
            validElement.style.display = 'none'; // Hide valid message
            isValid = false;
          } else {
            errorElement.style.display = 'none'; // Hide error message
            validElement.style.display = 'block'; // Show valid message
          }
        });

        if (isValid) {
          HTMLFormElement.prototype.submit.call(appointmentForm);
        }
      });

      // function generateWeekdayOptions() {
      //   const today = new Date();
      //   const options = [];
      //   let addedDays = 0; // To count the weekdays added

      //   while (options.length < 5) { // We need 5 weekdays
      //     const currentDay = new Date();
      //     currentDay.setDate(today.getDate() + addedDays + 1); // Increment by 1, then 2, etc.
      //     const dayOfWeek = currentDay.getDay();

      //     if (dayOfWeek >= 1 && dayOfWeek <= 5) { // Only weekdays (Monday to Friday)
      //       const formattedDate = currentDay.toISOString().split('T')[0]; // Format as YYYY-MM-DD
      //       const weekdayName = currentDay.toLocaleString('en-US', { weekday: 'long' }); // Get the weekday name

      //       // Combine formatted date and weekday name
      //       const formattedDateWithWeekday = `${formattedDate}, ${weekdayName}`;

      //       options.push(formattedDateWithWeekday);
      //     }

      //     addedDays++; // Increment days to move to the next date
      //   }

      //   // Clear existing options and add new ones
      //   appointmentDateSelect.innerHTML = ''; // Clear existing options

      //   // Add the placeholder option
      //   const placeholderOption = document.createElement('option');
      //   placeholderOption.value = '';
      //   placeholderOption.textContent = 'Select date';
      //   placeholderOption.disabled = true; // Make it unselectable
      //   placeholderOption.selected = true; // Make it the default selected option
      //   appointmentDateSelect.appendChild(placeholderOption);

      //   // Add generated date options
      //   options.forEach((date) => {
      //     const option = document.createElement('option');
      //     option.value = date;
      //     option.textContent = date;
      //     appointmentDateSelect.appendChild(option);
      //   });
      // }

      // generateWeekdayOptions();
    });

    function getCurrentDateTime() {
      const date = new Date()
      const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
      const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ]

      // get current day, month, date and year
      const dayOfWeek = daysOfWeek[date.getDay()]
      const month = months[date.getMonth()]
      const day = date.getDate()
      const year = date.getFullYear()

      let hours = date.getHours()
      let minutes = date.getMinutes().toString().padStart(2, '0')

      const period = hours >= 12 ? 'PM':'AM'
      hours = hours % 12 || 12

      return document.querySelector('.header__date').innerText = `${dayOfWeek} ${hours}:${minutes} ${period} | ${month} ${day}, ${year}`
    }

    setInterval(getCurrentDateTime, 1000)
  
    document.querySelector('.services-btn').addEventListener('click', function() {
      const checkboxGroup = document.querySelector('.appointment-form__checkbox-group')
      checkboxGroup.classList.toggle('active')
    })

    const checkBoxContainers = document.querySelectorAll('.checkbox-container')
    const servicesBtn = document.getElementById('servicesBtn')
    const selectedServicesContainer = document.getElementById('selectedServices')
    let selectedServices = []
    
    checkBoxContainers.forEach(container => {
      const inputEl = container.querySelector('input')
      
      inputEl.addEventListener('change', () => {
        selectedServices = []
        
        checkBoxContainers.forEach(checkBoxContainer => {
          const checkbox = checkBoxContainer.querySelector('input')
          const label = checkBoxContainer.querySelector('label')

          if(checkbox.checked) {
            checkBoxContainer.style.backgroundColor = '#1d72f2'
            label.classList.add('active')
            selectedServices.push(checkbox.value)            
          } else {
            checkBoxContainer.style.backgroundColor = ''
            label.classList.remove('active')
          }
        })
        showSelectedServices()
      })
    })

    function showSelectedServices() {
      selectedServicesContainer.innerHTML = `
      <ul>
        ${selectedServices.map(service => {
          return `<li>${service}</li>`
        }).join('')}
      </ul>
      `
    }

  // Pass PHP array to JavaScript
  const availableDates = <?php echo json_encode($availableDates); ?>;
const disabledDates = <?php echo json_encode($disabledDates); ?>;

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#appointmentDate", {
        dateFormat: "Y-m-d",
        minDate: "today",
        enable: availableDates,  // Enable only available dates
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            // Disable the days that are in the disabledDates array
            const date = dayElem.dateObj.toISOString().split('T')[0]; // Get the date in 'Y-m-d' format

            if (disabledDates.includes(date)) {
                dayElem.classList.add('disabled'); // Add 'disabled' class to disable the date
                dayElem.setAttribute('aria-disabled', 'true'); // Add aria-disabled for accessibility
                dayElem.style.pointerEvents = 'none'; // Prevent interaction
            }
        }
    });
});

  </script>
</body>

</html>