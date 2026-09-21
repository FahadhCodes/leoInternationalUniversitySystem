function selectFunction1() {
  const role = document.getElementById("role");
  if (role.value === "Academic") {
    document.querySelector("#role-A").style.transform = "scale(1, 1)";
    document.querySelector("#role-NA").style.transform = "scale(0, 0)";
  } else if (role.value === "NON-Academic") {
    document.querySelector("#role-A").style.transform = "scale(0, 0)";
    document.querySelector("#role-NA").style.transform = "scale(1, 1)";
  } else {
    document.querySelector("#role-NA").style.transform = "scale(0, 0)";
    document.querySelector("#role-A").style.transform = "scale(0, 0)";
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
    fac1.value == "0" ? (depa[i].style.transform = "scale(0,0)") : (depa[i].style.transform = "scale(1,1)");
  }
  //add subject logic
  const fac2 = document.getElementById("facultySelection2");
  const depa1 = document.getElementById("DepartmentSelector");
  /* 
  THIS LOGIC SPECIFICALLY CONSTRUCTED FOR ADD SECTION--->ADDING NEW SUBJECT PART NOT FOR ALL 
  */
  const sub = document.getElementsByClassName("sub");
  for (let i = 0; i < sub.length; i++) {
    fac2.value == "0" || depa1.value == "0" ? (sub[i].style.transform = "scale(0,0)") : (sub[i].style.transform = "scale(1,1)");
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
    messageColor = "#BA8E23";
  } else if (type === "infos") {
    headerType = "info";
    symbole = "fa-solid fa-circle-info";
    messageColor = "#00bfff";
  } else if (type === "dangers") {
    headerType = "danger";
    symbole = "fa-solid fa-circle-xmark";
    messageColor = "#FF474C";
  } else if (type === "successes") {
    headerType = "success";
    symbole = "fa-solid fa-square-check";
    messageColor = "#00ff00";
  }
  // 1. Use 'let' so it can be reassigned
  let toastContainer = document.querySelector(".toastCont");
  if (!toastContainer) {
    toastContainer = document.createElement("div");
    toastContainer.classList.add("toastCont");
    document.body.appendChild(toastContainer);
  }
  document.querySelector(".toastCont").innerHTML = `
  <div class="Notify">
    <div class="toastContainer">
      <div class="order-2 Toast ${type}">
        <div class="headerToast ${headerType} d-flex justify-content-between">
          <div class="message" style="color:${messageColor}">
            <i class="${symbole}"></i>
            <span style="text-shadow: 0px 0px 4px #232323;">${headerType}</span>
          </div>
          <button type="button" class="btn text-${headerType} closeButton"><i class="fa-solid fa-rectangle-xmark"></i></button>
        </div>
        <div class="bodyToast p-2" style="color:${messageColor}; text-shadow: 0px 0px 4px #232323;">
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
      document.getElementById(departmentformElement).innerHTML = xhr.responseText;
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
      document.getElementById("subIdAuto").addEventListener("click", function () {
        document.getElementById("suggestedSubjectID").innerHTML = xhr.responseText;
        document.getElementById("suggestedSubjectID").style.transform = "scale(1,1)";
      });
    } else if (xhr.status != 200) {
      console.error("ERROR WITH RECIEVING DATA: ", xhr.status);
    } else if (xhr.readyState != 4) {
      console.error("ERROR IN READY STATE", xhr.readyState);
    }
  };
  xhr.send(`departmentID=${departmentID}&subjectYear=${subjectYear}&sem=${sem}`);
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
        if (confirm("YOU MUST FILL THE ID FIELDS AND AT LEAST ONE OF OTHER FIELDS TO UPDATE")) {
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
    // console.log(Math.max(...arr));
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
    card.querySelector("h3").style.transform = "translateY(0vh)";
    card.querySelector(".numberBar").style.transform = "translate(0%, 0%)";
    card.querySelector(".numberBar").style.opacity = "1";
    card.querySelector(".countBar").style.transform = "translate(0%, 0%)";
    card.querySelector(".countBar").style.opacity = "1";
    card.querySelectorAll(".ROW-1").forEach((x) => {
      x.style.transform = "translateY(0%)";
    });
    card.querySelectorAll(".ROW-2").forEach((x) => {
      x.style.transform = "translateY(0%)";
    });
  });
  card.addEventListener("mouseout", () => {
    card.querySelector("h3").style.transform = "translateY(5vh)";
    card.querySelector(".numberBar").style.transform = "translate(564%, 0%)";
    card.querySelector(".numberBar").style.opacity = "0";
    card.querySelector(".countBar").style.transform = "translate(-107%, 0%)";
    card.querySelector(".countBar").style.opacity = "0";
    card.querySelectorAll(".ROW-1").forEach((x) => {
      x.style.transform = "translateY(310%)";
    });
    card.querySelectorAll(".ROW-2").forEach((x) => {
      x.style.transform = "translateY(210%)";
    });
  });
});
function marksToResult(marks) {
  if (marks >= 90) {
    return "A+";
  } else if (marks < 90 && marks >= 80) {
    return "A";
  } else if (marks < 80 && marks >= 75) {
    return "A-";
  } else if (marks < 75 && marks >= 70) {
    return "B+";
  } else if (marks < 70 && marks >= 65) {
    return "B";
  } else if (marks < 65 && marks >= 60) {
    return "B-";
  } else if (marks < 60 && marks >= 55) {
    return "C+";
  } else if (marks < 55 && marks >= 50) {
    return "C";
  } else if (marks < 50 && marks >= 45) {
    return "C-";
  } else if (marks < 45 && marks >= 40) {
    return "D+";
  } else if (marks < 40 && marks >= 30) {
    return "D";
  } else if (marks < 30) {
    return "E";
  }
}
//_requestANDResponses_________________________________________________________________________________________________________________
//_______FacDep___________________________________________________________________________________________________________________
const container = document.querySelector(".checkBoxContent.dep");
const container1 = document.querySelector(".checkBoxContent.sub");
const faccheckBoxs = document.querySelectorAll(".CheckBoX");
const SelectYear = document.querySelector(".SelectYear");
const SelectSem = document.querySelector(".SelectSem");
const selcSub = document.querySelector(".selc.sub");
//Faculty
const faccheckedBox = [];
const facNameList = [];
//Department
const depcheckedBox = [];
const depNameList = [];
//Subject
const subcheckedBox = [];
const subNameList = [];
const unChecked = [];
//DB
let faculties = "";
let departments = "";
let subjects = "";
//Checked List UI property--------------------<
function CheckedListUI_property(nameList) {
  let str = "";
  nameList.forEach((item) => {
    console.info("UI function execuring...");
    str += `<span class='badge tradi-blue1-border text-dark m-1 fw-medium'>${item}</span>`;
  });
  return str;
}
//Checked List UI property--------------------<
//created for store checked box
function storingCheckedBoxes(allcheckBoxesarr, checkedBoxesArr, nameList, modifyingDom) {
  console.log("storingCheckedBoxes() funtion executing...");
  allcheckBoxesarr.forEach((aCheckBox) => {
    aCheckBox.addEventListener("change", () => {
      if (aCheckBox.checked) {
        console.log("Value storing...");
        checkedBoxesArr.push(aCheckBox.value);
        nameList.push(aCheckBox.name);
      } else {
        console.log("Value removing...");
        checkedBoxesArr.splice(checkedBoxesArr.indexOf(aCheckBox.value), 1);

        nameList.splice(nameList.indexOf(aCheckBox.name), 1);
      }
      console.log("Debugging: ", checkedBoxesArr);
      modifyingDom.innerHTML = CheckedListUI_property(nameList);
    });
  });
}

function subjectCheckBoxes(depcheckedBox, year, sem) {
  fetch(`../Server.php?dids=${depcheckedBox.join("|")}&year=${year}&sem=${sem}`)
    .then((res) => res.json())
    .then((items) => {
      container1.innerHTML = "";
      for (let i = 0; i < items.length; i++) {
        container1.innerHTML += `
            <div class="checkBox">
              <input class="selSub" type="checkbox" name="${items[i].subject_name}" id="${items[i].subject_id}" value="${items[i].subject_id}">
              <label class='tradi-blue1 fw-medium depCheckBox' for="${items[i].subject_id}">${items[i].subject_name}</label>
            </div>
          `;
      }
      const subCheckboxes = document.querySelectorAll(".selSub");
      storingCheckedBoxes(subCheckboxes, subcheckedBox, subNameList, selcSub);
    })
    .catch((err) => console.log("Exception(Sub): ", err));
}
document.querySelectorAll(".SelectBoxes").forEach((selectBox) => {
  selectBox.addEventListener("change", () => {
    console.log("TESTING SUBJEC:", SelectYear.value);
    console.log("TESTING SUBJEC:", SelectSem.value);
    subjectCheckBoxes(depcheckedBox, SelectYear.value, SelectSem.value);
    const depCheckboxes = document.querySelectorAll(".selDep");
    unchekingSubject(depCheckboxes, SelectYear.value, SelectSem.value);
  });
});
// deparment_uncheing
function unchekingSubject(depCheckboxes, year, sem) {
  depCheckboxes.forEach((aCheckBox) => {
    aCheckBox.addEventListener("change", () => {
      if (aCheckBox.checked) {
        subjectCheckBoxes(depcheckedBox, year, sem); //changes the checkBoxes
      } else {
        unChecked.push(aCheckBox.value);
        subjectCheckBoxes(depcheckedBox, year, sem); //changes the checkBoxes
        fetch(`../Server.php?dids=${unChecked.join("|")}&year=${year}&sem=${sem}`)
          .then((res) => res.json())
          .then((items) => {
            for (let i = 0; i < items.length; i++) {
              if (subcheckedBox.includes(items[i].subject_id) && subNameList.includes(items[i].subject_name)) {
                console.log("removing: ", items[i].subject_id, items[i].subject_name);
                subcheckedBox.splice(subcheckedBox.indexOf(items[i].subject_id), 1);
                subNameList.splice(subNameList.indexOf(items[i].subject_name), 1);
              }
            }
            console.log("|||||||||||||", subNameList, subcheckedBox);
            selcSub.innerHTML = CheckedListUI_property(subNameList);
          })
          .catch((err) => console.log("Exception(Sub): ", err));
      }
    });
  });
}
// deparment_uncheing
function departmentCheckBox(checkBox) {
  fetch(`../Server.php?faculty_id=${checkBox.value}`)
    .then((res) => {
      return res.json();
    })
    .then((data) => {
      container.innerHTML = "";
      if (Array.isArray(data)) {
        data.forEach((item) => {
          container.innerHTML += `
            <div class="checkBox">
              <input class="selDep" type="checkbox" name="${item.department_name}" id="${item.department_id}" value="${item.department_id}">
              <label class='tradi-blue1 fw-medium depCheckBox' for="${item.department_id}">${item.department_name}</label>
            </div>
          `;
        });
      }
      const depCheckboxes = document.querySelectorAll(".selDep");
      const selcDep = document.querySelector(".selc.dep");
      storingCheckedBoxes(depCheckboxes, depcheckedBox, depNameList, selcDep);
      unchekingSubject(depCheckboxes, SelectYear.value, SelectSem.value);
    })
    .catch((ex) => {
      console.log("Exeption: ", ex);
    });
}

// const selcDep = document.querySelector(".selc.dep");
faccheckBoxs.forEach((checkBox) => {
  checkBox.addEventListener("change", function () {
    if (checkBox.checked) {
      console.log(checkBox);
      departmentCheckBox(checkBox);
    } else {
      //refetching data for eliminate unchecked elements in department based on faculty arrays
      fetch(`../Server.php?faculty_id=${checkBox.value}`)
        .then((res) => res.json())
        .then((data) => {
          if (Array.isArray(data)) {
            data.forEach((item) => {
              console.log("Eliminating departments list:", item.department_id);
              if (
                //checking the uncheked faculty's deparments included in the arrya or not
                depcheckedBox.includes(item.department_id) ||
                depNameList.includes(item.department_name)
              ) {
                //eliminating spefic department id from "depcheckedBox" array
                depcheckedBox.splice(depcheckedBox.indexOf(item.department_id), 1);
                //eliminating spefic department name from "depNameList" array
                depNameList.splice(depNameList.indexOf(item.department_name), 1);
                //subjectFixing

                //subjectFixing
                //refreshing and displaying
                document.querySelector(".selc.dep").innerHTML = CheckedListUI_property(depNameList);
                faculties = faccheckedBox.join("|");
                departments = depcheckedBox.join("|");
                console.log("A list of departments after elimination based on unchecked faculties:", depcheckedBox);
              }
            });
          }
        });
    }
  });
});
const selcFac = document.querySelector(".selc.fac");
storingCheckedBoxes(faccheckBoxs, faccheckedBox, facNameList, selcFac);

//facDep Request_________________________
try {
  document.querySelector(".facDepSubmit").addEventListener("click", () => {
    // if click that submit button
    let stfId = document.querySelector(".stfId").value;
    faculties = faccheckedBox.join("|");
    departments = depcheckedBox.join("|");
    subjects = subcheckedBox.join("|");
    if (stfId == "") {
      autoToast("dangers", "Pleas fill Staff Id field".toUpperCase());
      document.querySelector(".stfId").style.border = "1px solid red";
    } else {
      //debugging
      console.info("Sending data to DataBase...");
      console.log("faculties:", faculties);
      console.log("departments:", departments);
      console.log("Subjects:", subjects);
      //debugging
      sendStoredArr(stfId, faculties, departments, subjects);
    }
  });
} catch (error) {
  if (error.message == "Cannot read properties of null (reading 'addEventListener')") {
    console.log("No facDepSubmit button is not in the landing-page");
  }
}

function sendStoredArr(stfid, fac, dep, sub) {
  fetch(`../Server.php?stfId=${stfid}&fac=${fac}&dep=${dep}&sub=${sub}`)
    .then((res) => res.json())
    .then((data) => {
      autoToast(data.type, data.message);
    })
    .catch((ex) => {
      console.warn("Exception: ", ex);
    });
}
//facDep Request_________________________
//_______FacDep___________________________________________________________________________________________________________________

//____Exam Result Table Respons_______________________________________________________________________________________
const yearSem = document.querySelector(".yearAndSem");
const search = document.getElementById("search");
const result = document.getElementById("tab1");
function stdDashboard_Home_subject() {
  fetch(`../Server.php?YEAR_AND_SEM=${yearSem.value}&SEARCH=${search.value}`)
    .then((res) => {
      return res.json();
    })
    .then((data) => {
      result.innerHTML = "";
      data.forEach((item) => {
        result.innerHTML += `
        <tr>
        <td>${item.subject_id}</td>
        <td>${item.subject_name}</td>
        <td>${marksToResult(item.marks)}</td>
        </tr>
        `;
      });
    })
    .catch((err) => console.error("Error: ", err));
}

try {
  yearSem.addEventListener("change", stdDashboard_Home_subject);
  search.addEventListener("keyup", stdDashboard_Home_subject);
} catch (error) {
  console.log(error);
}
//____Exam Result Table Respons_______________________________________________________________________________________
// RES -----------------------------------------------------------------------------------------------------------------
function requester(getPayload, action, triggeringElement, wannaToast, responseData) {
  let timeout; // Variable to hold our debounce timery
  triggeringElement.addEventListener(action, async () => {
    // 1. Clear the timer if the user types another key quickly
    clearTimeout(timeout);

    // 2. Set a timer to wait 500ms after they STOP typing before fetching
    let delay = action === "keyup" ? 500 : 0;

    timeout = setTimeout(async () => {
      const payload = getPayload();
      console.log("REQUEST:", payload); //MUST BE HIDDEN
      try {
        const respons = await fetch("../Server.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(payload),
        });
        if (!respons.ok) {
          console.log("ERROR:", respons.status);
        }
        const data = await respons.json();
        if (wannaToast) autoToast(data.type, data.message);
        if (responseData) responseData(data);
      } catch (error) {
        console.log("ERROR:", error);
      }
    }, delay);
  });
}
// RES -----------------------------------------------------------------------------------------------------------------
////////////____Lecture Dashboard_______________________________________________________________________________________
//____Lecture Annoucement_______________________________________________________________________________________
try {
  const multiFormsCont = document.querySelector(".multiFormsCont");
  const selectedSubjects = multiFormsCont.querySelectorAll(".selSub");
  const dueDate = document.getElementById("dueDate");
  const title = multiFormsCont.querySelector(".title");
  const messageBox = multiFormsCont.querySelector(".message-box");
  const generalButton = multiFormsCont.querySelector(".generalButton");
  const arr = [];
  selectedSubjects.forEach((el) => {
    el.addEventListener("change", () => {
      if (el.checked) {
        arr.push(el.value);
        console.log(arr);
      } else {
        const index = arr.indexOf(el.value);
        if (index > -1) {
          arr.splice(index, 1);
        }
        console.log(arr);
      }
    });
  });
  requester(
    () => {
      return {
        payloadid: "00001",
        selectedSubjects: arr.join("|"),
        dueDate: dueDate.value,
        title: title.value,
        messageBox: messageBox.value,
      };
    },
    "click",
    generalButton,
    true,
  );
} catch (error) {
  console.log("ERROR:", error);
}
//____Lecture Annoucement_______________________________________________________________________________________
//____Lecture Username_______________________________________________________________________________________
const setting_userName = document.getElementById("setting_userName");
requester(
  () => {
    return {
      payloadid: "00002",
      setting_userName: setting_userName.value,
    };
  },
  "click",
  document.getElementById("btnUpdateUsername"),
  true,
);
//____Lecture Username_______________________________________________________________________________________
//____Lecture pwd_______________________________________________________________________________________
try {
  const setting_current_pswrd = document.getElementById("setting_current_pswrd");
  const setting_confirm_pswrd = document.getElementById("setting_confirm_pswrd");
  const setting_new_pswrd = document.getElementById("setting_new_pswrd");
  requester(
    () => {
      if (setting_confirm_pswrd.value == setting_new_pswrd.value) {
        return {
          payloadid: "00003",
          setting_current_pswrd: setting_current_pswrd.value,
          setting_confirm_pswrd: setting_confirm_pswrd.value,
        };
      } else {
        autoToast("dangers", "The entered passwords does not match!");
      }
    },
    "click",
    document.getElementById("btnUpdatePassword"),
    true,
  );
} catch (error) {}
//____Lecture pwd_______________________________________________________________________________________
//____Affiliations_______________________________________________________________________________________
try {
  const pickedFaculties = [];
  const pickedDepartment = [];
  const pickedSubjects = [];
  const affiliatins = {
    pickedFaculties: pickedFaculties,
    pickedDepartment: pickedDepartment,
    pickedSubjects: pickedSubjects,
  };
  try {
    const setting_faculty_ids = document.getElementById("setting_faculty_ids");
  } catch (error) {}
  requester(
    () => {
      return {
        payloadid: "00004",
        setting_faculty_ids: setting_faculty_ids.value,
      };
    },
    "keyup",
    setting_faculty_ids,
    false,
    (data) => {
      const suggestions = document.querySelector(".suggestBadges");
      suggestions.innerHTML = "";
      console.log("TEST::::::::", data);
      data.forEach((item) => {
        suggestions.innerHTML += `
           <button type="button" class="badge tradi-yellow1-bg text-dark border tradi-yellow1-border px-2 py-1"
              id="${item.faculty_id}"
              data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title="${item.facultyName}">
              <i class="fa-solid fa-book me-1"></i> ${item.faculty_id}
          </button>
        `;
      });
      document
        .querySelector(".suggestBadges")
        .querySelectorAll(".badge")
        .forEach((item) => {
          item.addEventListener("click", () => {
            pickedFaculties.push(item.id);
            let uniqueIds = [...new Set(pickedFaculties)];
            document.querySelector(".pickedFaculties").innerHTML = "";
            uniqueIds.forEach((id) => {
              document.querySelector(".pickedFaculties").innerHTML += `
             <div class="btn btn-group">
                  <div class="text-dark badge btn tradi-blue2-bg">${id}</div>
                  <div id="${id}" class="text-dark badge btn tradi-yellow2-bg close"><i class="fa-solid fa-close"></i></div>
              </div>
            `;
            });
          });
        });
      document.querySelector(".pickedFaculties").addEventListener("click", (e) => {
        const closeBtn = e.target.closest(".badge.close");
        if (closeBtn) {
          const index = pickedFaculties.indexOf(closeBtn.id);
          if (index > -1) {
            pickedFaculties.splice(index, 1);
          }
          console.log(pickedFaculties);
          closeBtn.closest(".btn-group").remove();
        }
      });

      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));
    },
  );
} catch (error) {}
//____Affiliations_______________________________________________________________________________________
