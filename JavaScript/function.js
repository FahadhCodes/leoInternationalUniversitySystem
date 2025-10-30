function selectFunction1() {
  const role = document.getElementById("role");
  //const facultiesCheck = document.getElementsByClassName("faculties-check");
  if (role.value === "Academic") {
    document.querySelector("#role-A").style.transform = "scale(1, 1)";
    document.querySelector("#role-NA").style.transform = "scale(0, 0)";
    // for (let i = 0; i < facultiesCheck.length; i++) {
    //   role.value === "Academic"
    //     ? (facultiesCheck[i].style.transform = "scale(1, 1)")
    //     : (facultiesCheck[i].style.transform = "scale(0, 0)");
    // }
  } else if (role.value === "NON-Academic") {
    document.querySelector("#role-A").style.transform = "scale(0, 0)";
    document.querySelector("#role-NA").style.transform = "scale(1, 1)";
    // for (let i = 0; i < facultiesCheck.length; i++) {
    //   facultiesCheck[i].style.transform = "scale(0, 0)";
    // }
  } else {
    document.querySelector("#role-NA").style.transform = "scale(0, 0)";
    document.querySelector("#role-A").style.transform = "scale(0, 0)";
    // for (let i = 0; i < facultiesCheck.length; i++) {
    //   facultiesCheck[i].style.transform = "scale(0, 0)";
    // }
  }
}

function inputbarEnabler() {
  //add department logic
  const fac1 = document.getElementById("facultySelection1");
  const depa = document.getElementsByClassName("depa");
  for (let i = 0; i < depa.length; i++) {
    /* 
    THIS LOGIC SPECIFICALLY CONSTRUCTED FOR ADD SECTION--->ADDING NEW DEPARTMENT PART NOT FOR ALL 
    */
    fac1.value == "0"
      ? (depa[i].style.transform = "scale(0,0)")
      : (depa[i].style.transform = "scale(1,1)");
  }
  //add subject logic
  const fac2 = document.getElementById("facultySelection2");
  const depa1 = document.getElementById("DepartmentSelector");
  /* 
  THIS LOGIC SPECIFICALLY CONSTRUCTED FOR ADD SECTION--->ADDING NEW SUBJECT PART NOT FOR ALL 
  */
  const sub = document.getElementsByClassName("sub");
  for (let i = 0; i < sub.length; i++) {
    fac2.value == "0" || depa1.value == "0"
      ? (sub[i].style.transform = "scale(0,0)")
      : (sub[i].style.transform = "scale(1,1)");
  }
}
//subjectIdgeneratorButton.style.transform = "scale(0,0)";
//Custom Alert
function toastClose() {
  const toast = document.querySelectorAll(".Toast");
  toast.forEach((element) => {
    const closeButton = element.querySelector(".closeButton");
    closeButton.addEventListener("click", () => {
      console.log("closed");
      element.style.transform = "scale(0)";
      setTimeout(() => {
        element.classList.add("disappear");
      }, 0);
      setTimeout(() => {
        element.classList.add("vanish");
      }, 500);
    });
  });
}
toastClose();
function autoToast(type, message) {
  let headerType;
  let symbole;
  if (type === "warnings") {
    headerType = "warning";
    symbole = "fa-solid fa-triangle-exclamation";
  } else if (type === "infos") {
    headerType = "info";
    symbole = "fa-solid fa-circle-info";
  } else if (type === "dangers") {
    headerType = "danger";
    symbole = "fa-solid fa-circle-xmark";
  } else if (type === "successes") {
    headerType = "success";
    symbole = "fa-solid fa-square-check";
  }
  document.querySelector(".toastCont").innerHTML = `
  <div class="Notify">
    <div class="toastContainer">
      <div class="order-2 Toast ${type}">
        <div class="headerToast ${headerType} d-flex justify-content-between">
          <div class="message">
            <i class="${symbole}"></i>
            <span>${headerType}</span>
          </div>
          <button type="button" class="btn text-${headerType} closeButton"><i class="fa-solid fa-rectangle-xmark"></i></button>
        </div>
        <div class="bodyToast p-2">
          ${message}
        </div>
      </div>
    </div>
  </div>
    `;
  toastClose();
}
//Custom Alert
//form validation
document.querySelectorAll(".submitButton").forEach((submitButton) => {
  submitButton.addEventListener("click", function (e) {
    const areaSection = this.dataset.section;
    const input = document.querySelectorAll(`.mustFILL.${areaSection}`);
    let valid = true;
    input.forEach((input) => {
      if (input.value.trim() === "") {
        input.style.border = "1px solid red";
        input.style.backgroundColor = "#ffcfcfff";
        valid = false;
      }
    });
    if (!valid) {
      autoToast("dangers", "PLEASE FILL ALL THE RQUIRED INPUT FIELDS");
      // e.preventDefault();
      return;
    }
  });
});

function optionHover() {
  const options = document.querySelectorAll("option");
  options.forEach((element) => {
    element.style.backgroundColor = "#122044";
    element.style.color = "#b48f2e";
  });
}

function departmentSelectUpdator(facutyformElement, departmentformElement) {
  const fid = document.getElementById(facutyformElement).value;
  const xhr = new XMLHttpRequest();
  xhr.open("post", "../admin/add.php", true);
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById(departmentformElement).innerHTML =
        xhr.responseText;
    } else if (xhr.readyState != 4) {
      console.error(`Request Not processed: ${xhr.readyState}`);
    } else if (xhr.status != 200) {
      console.error(`Response from add.php not recieving: ${xhr.status}`);
    }
  };
  xhr.send(`facultyId=${fid}`);
}

function subjectIDgenorator() {
  const departmentID = document.getElementById("DepartmentSelector").value;
  const subjectYear = document.getElementById("subjectyear").value;
  const sem = document.getElementById("subjectSem").value;
  const xhr = new XMLHttpRequest();
  xhr.open("post", "../admin/add.php", true);
  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document
        .getElementById("subIdAuto")
        .addEventListener("click", function () {
          document.getElementById("suggestedSubjectID").innerHTML =
            xhr.responseText;
          document.getElementById("suggestedSubjectID").style.transform =
            "scale(1,1)";
        });
    } else if (xhr.status != 200) {
      console.error("ERROR WITH RECIEVING DATA: ", xhr.status);
    } else if (xhr.readyState != 4) {
      console.error("ERROR IN READY STATE", xhr.readyState);
    }
  };
  xhr.send(
    `departmentID=${departmentID}&subjectYear=${subjectYear}&sem=${sem}`
  );
}

function facultyCheckBoxes() {
  const arr = [];
  const checked = document.querySelectorAll(".facultyID");
  checked.forEach((checkbox) => {
    checkbox.value = arr;
  });
}
function updateFormValidation() {
  document.querySelectorAll(".submitButton_U").forEach((button) => {
    button.addEventListener("click", function (e) {
      const areaSection = button.dataset.section;
      const primaryKey = document.querySelector(`.primaryKey.${areaSection}`);
      const subForm = document.querySelectorAll(`.subForm.${areaSection}`);
      let valid = true;
      let filledForm = "";

      if (!primaryKey || !primaryKey.value.trim()) {
        valid = false;
        if (primaryKey) {
          primaryKey.style.border = "1px solid red";
          primaryKey.style.backgroundColor = "#ffcfcfff";
        }
      }

      subForm.forEach((frm) => {
        if (frm.value.trim() !== "") {
          filledForm += frm.value.trim();
        } else {
          frm.style.border = "1px solid red";
          frm.style.backgroundColor = "#ffcfcfff";
        }
      });

      if (!valid || filledForm === "") {
        if (
          confirm(
            "YOU MUST FILL THE ID FIELDS AND AT LEAST ONE OF OTHER FIELDS TO UPDATE"
          )
        ) {
          e.reset();
        } else {
          e.preventDefault();
        }
      }
    });
  });
}

const dropdownMain = document.querySelectorAll("div.navItem.nav2");
let height = 0;
dropdownMain.forEach((element) => {
  element.addEventListener("mouseover", () => {
    const arr = new Array();
    const dropDown = element.querySelector(".dropDown");
    const drpItems = dropDown.querySelectorAll(".drpItems");
    for (let i = 0; i < drpItems.length; i++) {
      const lists = drpItems[i];
      const list = lists.querySelectorAll("li");
      arr[i] = list.length;
    }
    height = Math.max(...arr) * 45.5 + 70;
    console.log(Math.max(...arr));
    if (dropDown) {
      dropDown.style.height = height + "px";
      dropDown.style.opacity = "1";
    }
  });
  element.addEventListener("mouseout", () => {
    const dropDown = element.querySelector(".dropDown");
    if (dropDown) {
      dropDown.style.height = "0px";
      dropDown.style.opacity = "0";
    }
  });
});

function passwordButtonHold(button) {
  const container = button.closest(".passwordbarcont"); // go up to the parent div
  const eye = container.querySelector(".passwordEye");
  const input = container.querySelector(".inputBarDesign");

  eye.classList.remove("fa-eye-slash");
  eye.classList.add("fa-eye");
  input.type = "text";
}

function passwordButtonunhold(button) {
  const container = button.closest(".passwordbarcont");
  const eye = container.querySelector(".passwordEye");
  const input = container.querySelector(".inputBarDesign");

  eye.classList.add("fa-eye-slash");
  eye.classList.remove("fa-eye");
  input.type = "password";
}
const student = document.querySelectorAll(".logContainer.students");
const staff = document.querySelectorAll(".logContainer.staffs");
document.querySelectorAll("button.studentReg").forEach((button) => {
  button.addEventListener("click", function () {
    staff.forEach((stf) => (stf.style.display = "none"));
    student.forEach((std) => (std.style.display = "grid"));
  });
});

document.querySelectorAll("button.staffReg").forEach((button) => {
  button.addEventListener("click", function () {
    student.forEach((std) => (std.style.display = "none"));
    staff.forEach((stf) => (stf.style.display = "grid"));
  });
});

cardlist = document.querySelectorAll(".card_DASH");
cardlist.forEach((card) => {
  card.addEventListener("mouseover", () => {
    console.log("Hi");
    card.querySelector("h3").style.transform = "translateY(0vh)";
    card.querySelector(".countBar").style.transform = "translate(0%, 0%)";
    card.querySelector(".numberBar").style.transform = "translate(0%, 0%)";
    card.querySelectorAll(".ROW-1").forEach((x) => {
      x.style.transform = "translateY(0%)";
    });
    card.querySelectorAll(".ROW-2").forEach((x) => {
      x.style.transform = "translateY(0%)";
    });
  });
  card.addEventListener("mouseout", () => {
    console.log("Hi");
    card.querySelector("h3").style.transform = "translateY(5vh)";
    card.querySelector(".countBar").style.transform = "translate(-107%, 0%)";
    card.querySelector(".numberBar").style.transform = "translate(564%, 0%)";
    card.querySelector(".numberBar").style.transform = "translate(564%, 0%)";
    card.querySelectorAll(".ROW-1").forEach((x) => {
      x.style.transform = "translateY(310%)";
    });
    card.querySelectorAll(".ROW-2").forEach((x) => {
      x.style.transform = "translateY(210%)";
    });
  });
});
