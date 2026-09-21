<?php
// ----------------------------------------------------------------------------------
// Teaching Affiliations Existence Check (One-time modification rule)
// ----------------------------------------------------------------------------------
$STFID = $_SESSION['STFID'] ?? "";
$faculty_ids = "";
$department_ids = "";
$userName = "";
$createdDate = "";
$subjects = "";
$affiliations_exist = false;

if (!empty($STFID) && isset($con)) {
    $checkQuery = "SELECT `Createddate`, `staffID`, `userName`, `faculty_ids`, `department_ids`, `subjects` FROM `staffsaccount` WHERE `staffID` = '{$STFID}'";
    $checkResult = mysqli_query($con, $checkQuery);
    if ($checkResult && $accountRow = mysqli_fetch_assoc($checkResult)) {
        $faculty_ids = trim($accountRow['faculty_ids'] ?? "");
        $department_ids = trim($accountRow['department_ids'] ?? "");
        $userName = $accountRow['userName'] ?? "";
        $createdDate = $accountRow['Createddate'] ?? "";
        $subjects = trim($accountRow['subjects'] ?? "");

        // Check if affiliations are already configured (one-time accessibility)
        if (!empty($faculty_ids) && !empty($department_ids)) {
            $affiliations_exist = true;
        }
    }
}
?>

<div class="span2 subContainer pe-2">
    <!-- Header Title Banner with Current Modules / Subjects Labels -->
    <div class="d-flex align-items-center justify-content-between mb-3 px-2 flex-wrap gap-2">
        <div>
            <h2 class="headType1 m-0 d-inline-block">
                <i class="fa-solid fa-sliders me-2"></i>Account Settings
            </h2>
            <p class="text-secondary small m-0">Manage your credentials, affiliations, and teaching subjects</p>
        </div>

        <!-- Current Modules / Subjects Labels (Replacing previous admission badge) -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <?php if (!empty($subjects)): ?>
                <span class="small text-secondary fw-semibold me-1 d-none d-md-inline">Current Modules:</span>
                <?php
                $subjectList = explode('|', $subjects);
                foreach ($subjectList as $sub):
                    if (!empty(trim($sub))):
                ?>
                        <span class="badge tradi-yellow1-bg text-dark border tradi-yellow1-border px-2 py-1">
                            <i class="fa-solid fa-book me-1"></i><?php echo htmlspecialchars(trim($sub)); ?>
                        </span>
                <?php
                    endif;
                endforeach;
                ?>
            <?php else: ?>
                <span class="badge bg-light text-secondary border px-2 py-1">
                    <i class="fa-solid fa-book-open me-1"></i>No Modules Assigned
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3">
        <!-- ========================================== -->
        <!-- LEFT COLUMN: Account Details & Password    -->
        <!-- ========================================== -->
        <div class="col-lg-6 col-12">
            <!-- Basic Information Form -->
            <section class="p-4 mb-3">
                <h3 class="fw-bolder tradi-blue1 mb-3">
                    <i class="fa-solid fa-user-gear me-2"></i>Profile Information
                </h3>
                <form id="profileSettingForm" method="post">
                    <div class="mb-3">
                        <label for="setting_staffID" class="generalLabel fw-semibold d-block mb-1">Staff ID</label>
                        <input type="text" id="setting_staffID" name="staffID" class="inputBarDesign w-100 px-2 text-secondary" value="<?php echo htmlspecialchars($STFID); ?>" readonly disabled />
                        <small class="text-muted">Staff identifier is permanently assigned.</small>
                    </div>

                    <div class="mb-3">
                        <label for="setting_createdDate" class="generalLabel fw-semibold d-block mb-1">Account Created Date</label>
                        <input type="text" id="setting_createdDate" name="Createddate" class="inputBarDesign w-100 px-2 text-secondary" value="<?php echo htmlspecialchars($createdDate); ?>" readonly disabled />
                    </div>

                    <div class="mb-3">
                        <label for="setting_userName" class="generalLabel fw-semibold d-block mb-1">Username</label>
                        <input type="text" id="setting_userName" name="userName" class="inputBarDesign w-100 px-2" value="<?php echo htmlspecialchars($userName); ?>" placeholder="Enter new username" required />
                    </div>

                    <button type="button" id="btnUpdateUsername" class="generalButton btn w-100 py-2 mt-2">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Update Username
                    </button>
                </form>
            </section>

            <!-- Password & Security Form -->
            <section class="p-4">
                <h3 class="fw-bolder tradi-blue1 mb-3">
                    <i class="fa-solid fa-shield-halved me-2"></i>Security & Password
                </h3>
                <form id="passwordSettingForm" method="post">
                    <div class="mb-3 passwordbarcont row">
                        <label for="setting_current_pswrd" class="col-7 generalLabel fw-semibold d-block">Current Password</label>
                        <input type="password" id="setting_current_pswrd" name="current_pswrd" class="col-4 inputBarDesign px-2" placeholder="Enter current password" required />
                        <button type="button" class="col-2 btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
                            <i class="passwordEye fa-solid fa-eye-slash"></i>
                        </button>
                    </div>

                    <div class="mb-3 passwordbarcont row">
                        <label for="setting_new_pswrd" class="col-7 generalLabel fw-semibold d-block">New Password</label>
                        <input type="password" id="setting_new_pswrd" name="new_pswrd" class="col-4 inputBarDesign px-2" placeholder="Enter new password" required />
                        <button type="button" class="col-2 btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
                            <i class="passwordEye fa-solid fa-eye-slash"></i>
                        </button>
                    </div>

                    <div class="mb-3 passwordbarcont row">
                        <label for="setting_confirm_pswrd" class="col-7 generalLabel fw-semibold d-block">Confirm New Password</label>
                        <input type="password" id="setting_confirm_pswrd" name="confirm_pswrd" class="col-4 inputBarDesign px-2" placeholder="Repeat new password" required />
                        <button type="button" class="col-2 btn generalButton h-100 passwordButton" onmousedown=" passwordButtonHold(this)" onmouseup="passwordButtonunhold(this)">
                            <i class="passwordEye fa-solid fa-eye-slash"></i>
                        </button>
                    </div>

                    <button type="button" id="btnUpdatePassword" class="generalButton btn w-100 py-2 mt-2">
                        <i class="fa-solid fa-key me-2"></i>Update Password
                    </button>
                </form>
            </section>
        </div>

        <!-- ========================================== -->
        <!-- RIGHT COLUMN: Teaching Affiliations        -->
        <!-- ========================================== -->
        <div class="col-lg-6 col-12">
            <!-- Teaching Affiliations (Faculty, Department, and Subjects) Component -->
            <section class="p-4">
                <h3 class="fw-bolder tradi-blue1 mb-3">
                    <i class="fa-solid fa-building-columns me-2"></i>Teaching Affiliations
                </h3>

                <?php if ($affiliations_exist): ?>
                    <!-- STATE A: Affiliations already configured (Locked - further changes via admin) -->
                    <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center">
                        <i class="fa-solid fa-lock text-primary fs-4 me-3"></i>
                        <div>
                            <strong class="d-block">Affiliations Locked</strong>
                            <span class="small">Faculty, Department, and Subject affiliations are already configured and cannot be modified directly.</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="generalLabel fw-semibold d-block mb-1">Assigned Faculty IDs</label>
                        <input type="text" class="inputBarDesign w-100 px-2 text-secondary" value="<?php echo htmlspecialchars($faculty_ids); ?>" readonly disabled />
                    </div>

                    <div class="mb-3">
                        <label class="generalLabel fw-semibold d-block mb-1">Assigned Department IDs</label>
                        <input type="text" class="inputBarDesign w-100 px-2 text-secondary" value="<?php echo htmlspecialchars($department_ids); ?>" readonly disabled />
                    </div>

                    <!-- Subject IDs input bar under Teaching Affiliations (Locked) -->
                    <div class="mb-3">
                        <label class="generalLabel fw-semibold d-block mb-1">Assigned Subject IDs</label>
                        <input type="text" class="inputBarDesign w-100 px-2 text-secondary" value="<?php echo htmlspecialchars($subjects); ?>" readonly disabled />
                    </div>

                    <!-- Request Admin Change Section -->
                    <div class="border rounded p-3 mt-3 bg-light">
                        <h6 class="fw-bold tradi-blue1 mb-2">
                            <i class="fa-solid fa-paper-plane me-2"></i>Request Change to Admin
                        </h6>
                        <p class="small text-secondary mb-2">
                            To modify your faculty, department, or assigned subject affiliations, submit a change request for administrative review.
                        </p>
                        <form id="affiliationRequestForm" method="post">
                            <textarea id="setting_request_reason" name="request_reason" class="inputBarDesign w-100 p-2 mb-2" style="height: 80px; resize: vertical;" placeholder="Provide reason and requested changes to faculty, department, or subjects..."></textarea>
                            <button type="button" id="btnRequestAdminChange" class="generalButton btn w-100 py-2">
                                <i class="fa-solid fa-envelope me-2"></i>Send Request to Admin
                            </button>
                        </form>
                    </div>

                <?php else: ?>
                    <!-- STATE B: Affiliations not yet configured (One-time initial access) -->
                    <div class="alert alert-warning py-2 px-3 mb-3 d-flex align-items-center">
                        <i class="fa-solid fa-triangle-exclamation text-warning fs-4 me-3"></i>
                        <div>
                            <strong class="d-block">One-Time Configuration</strong>
                            <span class="small">You can set your Faculty, Department, and Subject IDs once. Future updates will require administrator approval.</span>
                        </div>
                    </div>
                    <style>
                        .custom-tooltip {
                            --bs-tooltip-bg: var(--color1);
                            --bs-tooltip-color: var(--colorA);
                        }
                    </style>
                    <form id="affiliationsInitialForm" method="post">
                        <div class="mb-3">
                            <label for="setting_faculty_ids" class="generalLabel fw-semibold d-block mb-1">Faculty ID(s)</label>
                            <div class="alert alert-info" role="alert">
                                <span class="badge text-dark bg-info">Suggesion Box</span>
                                <hr>
                                <div class="suggestBadges">
                                    <button class="badge tradi-yellow1-bg text-dark border tradi-yellow1-border px-2 py-1"
                                        id=""
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="This top tooltip is themed via CSS variables.">
                                        <i class="fa-solid fa-book me-1"></i> Test
                                    </button>
                                </div>
                            </div>
                            <input type="text" id="setting_faculty_ids" name="faculty_ids" class="inputBarDesign w-100 px-2" placeholder="e.g. F01 or F01|F02" required />
                            <small class="text-muted">Separate multiple faculties with a pipe (|).</small>
                        </div>

                        <div class="mb-3">
                            <label for="setting_department_ids" class="generalLabel fw-semibold d-block mb-1">Department ID(s)</label>
                            <input type="text" id="setting_department_ids" name="department_ids" class="inputBarDesign w-100 px-2" placeholder="e.g. D01 or D01|D02" required />
                            <small class="text-muted">Separate multiple departments with a pipe (|).</small>
                        </div>

                        <!-- Subject IDs input bar under Teaching Affiliations (Initial Setup) -->
                        <div class="mb-3">
                            <label for="setting_subjects" class="generalLabel fw-semibold d-block mb-1">Subject IDs</label>
                            <input type="text" id="setting_subjects" name="subjects" class="inputBarDesign w-100 px-2" value="<?php echo htmlspecialchars($subjects); ?>" placeholder="e.g. SUB101|SUB102|SUB103" required />
                            <small class="text-muted">Module identifiers separated by pipe (|).</small>
                        </div>
                        <div class="alert alert-light" role="alert">
                            <span class="badge text-light bg-dark">Selected Faculties :</span>
                            <div class="pickedFaculties">
                                <div class="btn btn-group">
                                    <div class="text-dark badge btn tradi-blue2-bg">ID</div>
                                    <div id="ID" class="text-dark badge btn tradi-yellow2-bg close"><i class="fa-solid fa-close"></i></div>
                                </div>
                            </div>
                            <hr>
                            <span class="badge text-light bg-dark">Selected Department :</span>
                            test
                            <hr>
                            <span class="badge text-light bg-dark">Selected Subjects :</span>
                            test
                        </div>
                        <button type="button" id="btnSaveInitialAffiliations" class="generalButton btn w-100 py-2 mt-2">
                            <i class="fa-solid fa-check-double me-2"></i>Save & Lock Affiliations
                        </button>
                    </form>
                <?php endif; ?>
            </section>
        </div>
    </div>
</div>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>