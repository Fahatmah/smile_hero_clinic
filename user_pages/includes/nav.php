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
    <div class="header__date">Monday 9:34 AM | September 9, 2024</div>
    <button class="header__button button--appointment">
      <a href="../user_pages/appointment_form_page.php">
        Set an appointment
      </a>  
    </button>
  </div>
</nav>

<script>
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
</script>