 <style>
   #preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #fffdfa !important;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

#preloader-logo {
  height: 70px;
  z-index: 2;
  animation: fadeLogo 2.5s forwards;
}

/* Circles */
.circlep {
  position: absolute;
  border-radius: 50%;
  opacity: 0.9;
  animation: zoom 2.5s forwards;
}

.circlep1 {
  width: 80px;
  height: 80px;
  background: #cd95ff8f;
  animation-delay: 0s;
}

.circlep2 {
  width: 100px;
  height: 100px;
  background: #7510cd76;
  animation-delay: 0.2s;
}

.circlep3 {
  width: 90px;
  height: 90px;
  background: #ffffff;
  animation-delay: 0.4s;
}

.circlep4 {
  width: 110px;
  height: 110px;
  background: #7510cd88;
  animation-delay: 0.6s;
}

.circlep5 {
  width: 95px;
  height: 95px;
  background: aliceblue;
  animation-delay: 0.8s;
}

/* Animations */
@keyframes zoom {
  0% {
    transform: scale(1);
    opacity: 0.9;
  }
  100% {
    transform: scale(20);
    opacity: 0;
  }
}

@keyframes fadeLogo {
  0% {
    opacity: 1;
    transform: scale(1);
  }
  100% {
    opacity: 0;
    transform: scale(1.2);
  }
}

/* Hide preloader after animation */
body.loaded #preloader {
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.6s ease, visibility 0.6s ease;
}

  </style>
<div id="preloader">
  <img src="./images/loader.png" alt="Logo" id="preloader-logo"/>
  <div class="circlep circlep1"></div>
  <div class="circlep circlep2"></div>
  <div class="circlep circlep3"></div>
  <div class="circlep circlep4"></div>
  <div class="circlep circlep5"></div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const preloader = document.getElementById("preloader");

    // Check if preloader has already been shown this session
    if (!sessionStorage.getItem("preloaderShown")) {
      setTimeout(() => {
        document.body.classList.add("loaded");
        sessionStorage.setItem("preloaderShown", "true");
      }, 2500); // Matches animation duration
    } else {
      // Skip preloader if already shown
      preloader.style.display = "none";
      document.body.classList.add("loaded");
    }
  });
</script>
