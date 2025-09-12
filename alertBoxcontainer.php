<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div class='Notify'>
    <div class='toastContainer'>
      <div class='order-2 Toast warnings'>
        <div class='headerToast warning d-flex justify-content-between'>
          <div class='message'>
            <i class='fa-solid fa-triangle-exclamation'></i>
            <span>Warning</span>
          </div>
          <button type='button' class='btn text-warning closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2' id="warn">
          THIS IS A WARNING
        </div>
      </div>
      <div class='order-3 Toast infos'>
        <div class='headerToast info d-flex justify-content-between'>
          <div class='message'>
            <i class='fa-solid fa-circle-info'></i>
            <span>Info</span>
          </div>
          <button type='button' class='btn text-info closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          THIS IS A INFO
        </div>
      </div>
      <div class='order-4 Toast dangers'>
        <div class='headerToast danger d-flex justify-content-between'>
          <div class='message'>
            <i class='fa-solid fa-circle-xmark'></i>
            <span>Oops!!!</span>
          </div>
          <button type='button' class='btn text-danger closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          THIS IS A OOPS!
        </div>
      </div>
      <div class='order-5 Toast successes'>
        <div class='headerToast success d-flex justify-content-between'>
          <div class='message'>
            <i class='fa-solid fa-square-check'></i>
            <span>Success</span>
          </div>
          <button type='button' class='btn text-success closeButton'><i class='fa-solid fa-rectangle-xmark'></i></button>
        </div>
        <div class='bodyToast p-2'>
          THIS IS A SUCCESS
        </div>
      </div>
    </div>
  </div>
  <script src="JavaScript/function.js"></script>
</body>

</html>