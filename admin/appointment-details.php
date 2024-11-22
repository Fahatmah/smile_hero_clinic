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
    <title>Appointment Details | Admin | Smile Hero Clinic</title>
    <link rel="stylesheet" href="../src/dist/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </head>
  <body class="admin__page">
    <main class="admin__main">
      <!-- nav header -->
      <?php include("includes/nav.php"); ?>
      <section class="admin__content">
        <!-- side bar -->
        <?php include("includes/side_nav.php"); ?>

        <div class="appointment-details-cont">
          <header>
            <div class="header-and-btn">
              <h1>Appointment Details</h1>
              <a href="booked.php">Go Back</a>
            </div>

            <div class="overview-details">
              <div class="details">
                <!-- date -->
                <div class="date">
                  <p class="day" id="weekday">
                    <!-- oks na dito, automatic nang magrereturn ng weekday -->
                  </p>
                  <p class="apt-date" id="date">
                    <!-- return mo lang dito is apt date (ex. 2024-11-18) -->
                    2024-11-18
                  </p>
                </div>
                <!-- time apt-id -->
                <div class="time-apt-id">
                  <p class="time">
                    <img src="../assets/admin_assets/icons/clock.svg" alt="">
                    11:00 AM
                  </p>
                  <p class="apt-id">
                    <img src="../assets/admin_assets/icons/book.svg" alt="">
                    SHC34c4
                  </p>
                </div>
                <!-- services -->
                <div class="service-message">
                  <p class="service">
                    <img src="../assets/admin_assets/icons/note-text.svg" alt="">
                    Routine Check-up
                  </p>
                  <p class="message">
                    <img src="../assets/admin_assets/icons/message-text.svg" alt="">
                    I would like a routine checkup
                  </p>
                </div>
              </div>
              <div class="actions">
                <button type="button" class="complete-btn" id="completeBtn">Complete</button>
                <button type="button" class="reschedule-btn" id="rescheduleBtn">Reschedule</button>
              </div>
            </div>
          </header>

          <div class="table-cont">
            <table>
              <tbody>
                <tr>
                  <td>Name</td>
                  <td>John Paul Villaruel Dela Cruz</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>jpvillaruel02@gmail.com</td>
                </tr>
                <tr>
                  <td>Contact Number</td>
                  <td>09070050140</td>
                </tr>
                <tr>
                  <td>Label</td>
                  <td>Online</td>
                </tr>
                <tr>
                  <td>Location</td>
                  <td>Bayani Road, Taguig City</td>
                </tr>
                <tr>
                  <td>Services</td>
                  <td>Routine Check-up</td>
                </tr>
                <tr>
                  <td>Message</td>
                  <td>I would like a routine checkup</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>In Progress</td>
                </tr>
                <tr>
                  <td>Appointment Date</td>
                  <td>2024-11-29</td>
                </tr>
                <tr>
                  <td>Appointment Time</td>
                  <td>11:00 AM</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
    <!-- modals -->
    <section class="reschedule-modal" id="rescheduleModal" style="display: none;">
      <div class="content">
        <form action="" id="rescheduleForm">
          <section>
            <div class="appointment-form__field">
              <label for="appointmentDate" class="appointment-form__label">Date</label>
              <input type="text" name="appointmentDate" id="appointmentDate" class="appointment-form__input" placeholder="Select a date" 
                      value="<?php echo (isset( $_SESSION['selectAppointmentDate']) ? $_SESSION['selectAppointmentDate'] : ''); ?>">
              <div class="appointment-form__validation">
                <p class="appointment-form__text appointment-form__text--error">Error</p>
                <p class="appointment-form__text appointment-form__text--valid">Valid</p>
              </div>
              <p class="time_error"><?php echo $DateMessageError ?></p>
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
              <p class="time_error"><?php echo $TimeMessageError ?></p>
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

                
              <div id="selectedServicesError" class="appointment-form__text--error" style="display: none; color: red; font-size: 14px; "></div>
            </div>
            <div class="btn-container">
              <input type="submit" name="submit" value="Reschedule" class="appointment-form__submit-button">
              <input type="button" value="Cancel" class="appointment-form__cancel-button" id="cancelBtn">
            </div>
          </section>

        </form>
      </div>
    </section>
    <section class="alert-modal">
      <div class="container">
        <p class="body-text">
          Appointment Completed ✓
        </p>
      </div>
    </section>
    <script>
      const weekdayText = document.getElementById('weekday')
      const dateEl = document.getElementById('date')
      const dateText = dateEl.textContent.trim()
      
      const date = new Date(dateText)
      const day = date.getDate()

      const weekdays = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"]
      const weekday = weekdays[date.getDay()]
      weekdayText.textContent = weekday
      dateEl.textContent = day

      document.addEventListener('DOMContentLoaded', () => {
        const rescheduleForm = document.getElementById('rescheduleForm');
        const cancelBtn = document.getElementById('cancelBtn')
        const rescheduleModal = document.getElementById('rescheduleModal')
        const completeBtn = document.getElementById('completeBtn')
        const rescheduleBtn = document.getElementById('rescheduleBtn')
        const actions = document.querySelector('.actions') 
        const alertModal = document.querySelector('.alert-modal') 

        completeBtn.addEventListener('click', () => {
          alertModal.style.right = '1rem'

          setTimeout(() => {
            alertModal.style.animation = 'fadeInOut 3s ease-in-out'

            alertModal.addEventListener('animationend', () => {
              alertModal.style.display = 'none'; 
            }, { once: true });
          }, 3000)

          while(actions.firstChild){
            actions.removeChild(actions.firstChild)
          }

          const completeText = document.createElement('p')
          completeText.textContent = 'Completed ✓'
          completeText.classList = 'complete-text'

          actions.appendChild(completeText)
        })

        rescheduleBtn.addEventListener('click', () => {
          rescheduleModal.style.display = 'flex'
        })

        cancelBtn.addEventListener('click', () => {
          if(rescheduleModal.style.display == 'flex') rescheduleModal.style.display = 'none'
        })

        rescheduleForm.addEventListener('submit', (e) => {
          e.preventDefault();

          const fields = [
            {
              id: 'appointmentDate',
              errorMessage: 'Please select a date'
            },
            {
              id: 'appointmentTime',
              errorMessage: 'Please select a time'
            },
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

          // Validate dentalService checkboxes
          const serviceCheckboxes = document.querySelectorAll('input[name="dentalService[]"]');
          const selectedServicesError = document.getElementById('selectedServicesError');
          const anyServiceSelected = Array.from(serviceCheckboxes).some(checkbox => checkbox.checked);

          if (!anyServiceSelected) {
            selectedServicesError.innerText = 'Please select at least one service';
            selectedServicesError.style.display = 'block'; // Show error message
            isValid = false;
          } else {
            selectedServicesError.style.display = 'none'; // Hide error message
          }

          if (isValid) {
            HTMLFormElement.prototype.submit.call(rescheduleForm);
          }
        });
      });

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
      // const availableDates = <?php echo json_encode($availableDates); ?>;
      const availableDates = ["2024-11-22","2024-11-25","2024-11-26","2024-11-27","2024-11-28","2024-11-29"]
      // const disabledDates = <?php 
      // echo json_encode($disabledDates)
      ; ?>;

      document.addEventListener('DOMContentLoaded', function() {
          flatpickr("#appointmentDate", {
              dateFormat: "Y-m-d",
              minDate: "today",
              enable: availableDates,
          });
      });
    </script>
  </body>
</html>
