<?php require "./Includes/connection.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TESTING</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />

</head>

<body style="background-image: url('static\ images/CarouselImages/carousel1.jpg');background-size: cover;">
  <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>
  <button class="alertTriggerbtn btn btn-warning" data-type="warnings" data-message="Bettery Low!!!">Button</button>
  <button class="alertTriggerbtn btn btn-danger" data-type="dangers" data-message="Why did you radeem it!!!? Fu*k🤬">Button</button>
  <button class="alertTriggerbtn btn btn-success" data-type="successes" data-message="Great!!! thank you!!">Button</button>
  <button class="alertTriggerbtn btn btn-info" data-type="infos" data-message="click the button and close the window">Button</button>



  <div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container top-0 end-0 p-3">
      <div class="toast warnings" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header warning d-flex justify-content-between">
          <div class="meesage">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Warning</span>
          </div>
          <button type='button' class='btn text-warning closeButton' data-bs-dismiss="toast"><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class="toast-body ps-3 fw-medium">
          This is a Warning!!!
        </div>
      </div>
      <div class="toast dangers" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header danger d-flex justify-content-between">
          <div class="meesage">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>Oops!!!</span>
          </div>
          <button type='button' class='btn text-danger closeButton' data-bs-dismiss="toast"><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class="toast-body ps-3 fw-medium">
          You made a Mistake!!!
        </div>
      </div>
      <div class="toast successes" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header success d-flex justify-content-between">
          <div class="meesage">
            <i class="fa-solid fa-square-check"></i>
            <span>Success</span>
          </div>
          <button type='button' class='btn text-success closeButton' data-bs-dismiss="toast"><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class="toast-body ps-3 fw-medium">
          Conguragulations!!!
        </div>
      </div>
      <div class="toast infos" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header info d-flex justify-content-between">
          <div class="meesage">
            <i class="fa-solid fa-circle-info"></i>
            <span>Info</span>
          </div>
          <button type='button' class='btn text-info closeButton' data-bs-dismiss="toast"><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class="toast-body ps-3 fw-medium">
          An Information for you...
        </div>
      </div>
    </div>
  </div>
  <script>
    document.querySelectorAll(".alertTriggerbtn").forEach((button) => {
      button.addEventListener("click", () => {
        let alertType = button.dataset.type;
        let message = button.dataset.message;
        alertTrigger(alertType, message)
      });
    });

    function alertTrigger(alertType, message) {
      const toastLiveExample = document.querySelector("." + alertType);
      toastLiveExample.querySelector(".toast-body").innerHTML = message;
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
      toastBootstrap.show();
    }
  </script>
  <script>
    // const toastTrigger = document.getElementById('liveToastBtn')
    // const toastLiveExample = document.querySelectorAll('.toast')

    // if (toastTrigger) {
    //   toastLiveExample.forEach(toast => {
    //     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast)
    //     toastTrigger.addEventListener('click', () => {
    //       toastBootstrap.show()
    //     })
    //   })
    // }
  </script>
</body>

</html>