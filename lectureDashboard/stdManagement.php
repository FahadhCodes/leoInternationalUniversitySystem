<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faculty Dashboard – University of Leo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        /* ── Root Variables ── */
        :root {
            --navy: #0f1e35;
            --navy-light: #162844;
            --teal: #1ab4c8;
            --teal-hover: #15a0b2;
            --white: #ffffff;
            --bg: #f0f2f5;
            --border: #dde3ea;
            --text-main: #1a2540;
            --text-muted: #8392a5;
            --header-h: 68px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* ══════════════════════════════
       SIDEBAR
    ══════════════════════════════ */

        /* logo placeholder shield */
        .logo-shield {
            width: 46px;
            height: 46px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            width: 100%;
            padding: 0 8px;
        }

        .nav-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8fa3bf;
            font-size: 18px;
            cursor: pointer;
            transition: background .2s, color .2s;
            text-decoration: none;
        }

        .nav-icon:hover {
            background: var(--navy-light);
            color: var(--teal);
        }

        .nav-icon.active {
            background: var(--teal);
            color: #fff;
        }

        .sidebar-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 12px 8px;
            width: 100%;
        }

        /* ══════════════════════════════
       MAIN CONTENT AREA
    ══════════════════════════════ */
        .page-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-content {
            padding: 28px 28px 40px;
            flex: 1;
        }

        /* ══════════════════════════════
       MAIN CONTAINER  →  .mainContainerD
    ══════════════════════════════ */
        .mainContainerD {
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        /* ── Container 1: Faculty Header ── */
        .faculty-header {
            background: var(--navy);
            color: #fff;
            padding: 20px 28px;
        }

        .faculty-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .faculty-header p {
            font-size: .87rem;
            color: #9fb3cc;
            margin: 0;
        }

        /* ── Stat Cards row (inside container 1) ── */
        .stats-row {
            padding: 20px 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .stat-card {
            background: #f7f9fc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            background: var(--teal);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 17px;
            flex-shrink: 0;
        }

        .stat-info .num {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
        }

        .stat-info .lbl {
            font-size: .77rem;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* ── Container 2 & 3 side-by-side layout ── */
        .middle-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin-bottom: 22px;
        }

        /* ── Section titles ── */
        .section-title {
            font-size: 1.05rem;
            font-weight: 700;
            text-align: center;
            color: var(--text-main);
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--border);
        }

        /* ══════════════════════════════
       FORM ELEMENTS  →  .formElementContD
    ══════════════════════════════ */
        .form-body {
            padding: 20px 22px;
        }

        .formElementContD {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .formElementContD .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .formElementContD .form-control,
        .formElementContD .form-select {
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: .86rem;
            color: var(--text-main);
            background: #f9fafb;
            padding: 9px 12px;
            height: auto;
            transition: border-color .2s, box-shadow .2s;
        }

        .formElementContD .form-control:focus,
        .formElementContD .form-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(26, 180, 200, .12);
            background: #fff;
            outline: none;
        }

        .formElementContD .form-control::placeholder {
            color: #b0bbc8;
        }

        /* Two-column inline fields (Max Score + Weight) */
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        /* Dark dropdowns matching screenshot */
        .select-dark {
            background: var(--navy) !important;
            color: #fff !important;
            border-color: var(--navy) !important;
        }

        .select-dark option {
            background: var(--navy);
        }

        /* ══════════════════════════════
       TABLES  →  .tableStyleD
    ══════════════════════════════ */
        .table-wrapper {
            padding: 0;
        }

        .table-search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
        }

        .search-input-wrap i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 13px;
        }

        .search-input-wrap input {
            width: 100%;
            padding: 8px 10px 8px 30px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: .84rem;
            background: #f9fafb;
        }

        .search-input-wrap input:focus {
            outline: none;
            border-color: var(--teal);
        }

        .filter-select {
            padding: 8px 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: .84rem;
            background: #f9fafb;
            color: var(--text-main);
            cursor: pointer;
        }

        /* The table itself */
        .tableStyleD {
            width: 100%;
            border-collapse: collapse;
        }

        .tableStyleD thead tr {
            background: var(--navy);
            color: #fff;
        }

        .tableStyleD thead th {
            font-size: .80rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: 12px 18px;
            border: none;
        }

        .tableStyleD tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .tableStyleD tbody tr:last-child {
            border-bottom: none;
        }

        .tableStyleD tbody tr:hover {
            background: #f5f8fc;
        }

        .tableStyleD tbody td {
            padding: 13px 18px;
            font-size: .86rem;
            color: var(--text-main);
            vertical-align: middle;
        }

        /* Task list specific: bold task name + small ID below */
        .task-name {
            font-weight: 700;
            font-size: .88rem;
            display: block;
        }

        .task-id {
            font-size: .75rem;
            color: var(--text-muted);
        }

        .task-type {
            font-size: .84rem;
            color: var(--text-muted);
        }

        .task-year {
            font-size: .84rem;
            color: var(--text-main);
            font-weight: 500;
        }

        /* Student list: avatar + name + id */
        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            background: var(--navy);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .student-name {
            font-weight: 600;
            font-size: .88rem;
            display: block;
        }

        .student-id {
            font-size: .75rem;
            color: var(--text-muted);
        }

        /* Student list search bar (4 filters) */
        .student-search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        /* Completion rate badge */
        .rate-badge {
            display: inline-block;
            font-size: .83rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        /* Pending task number */
        .pending-num {
            font-weight: 600;
            color: var(--text-main);
        }
    </style>
</head>

<body>

    <!-- ════════════════════════════
       SIDEBAR
  ════════════════════════════ -->


    <!-- ════════════════════════════
       PAGE WRAPPER
  ════════════════════════════ -->
    <div class="page-wrapper">
        <div class="page-content">

            <!-- ══════════════════════════════════════════════
           CONTAINER 1 — Faculty Header + Stats
      ══════════════════════════════════════════════ -->
            <div class="mainContainerD">

                <!-- Faculty Header -->
                <div class="faculty-header">
                    <h2>Faculty of Applied Science</h2>
                    <p>Department of Physical Sciences and Technology</p>
                </div>

                <!-- Stat Cards -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <div class="stat-info">
                            <div class="num">10</div>
                            <div class="lbl">Total Students</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-file-pen"></i></div>
                        <div class="stat-info">
                            <div class="num">10</div>
                            <div class="lbl">Total Assessments</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
                        <div class="stat-info">
                            <div class="num">10</div>
                            <div class="lbl">Total Exams</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-check-double"></i></div>
                        <div class="stat-info">
                            <div class="num">10</div>
                            <div class="lbl">Total Corrections</div>
                        </div>
                    </div>
                </div>

            </div><!-- /mainContainerD #1 -->


            <!-- ══════════════════════════════════════════════
           MIDDLE ROW — Container 2 (Assign Task) + Container 3 (Task Lists)
      ══════════════════════════════════════════════ -->
            <div class="middle-row">

                <!-- ── CONTAINER 2 — Assign Task Form ── -->
                <div class="mainContainerD" style="margin-bottom:0;">
                    <div class="section-title">Assign Task</div>
                    <div class="form-body">

                        <div class="formElementContD">

                            <!-- Task name -->
                            <div>
                                <label class="form-label">Task</label>
                                <input type="text" class="form-control" placeholder="Enter Task Name">
                            </div>

                            <!-- Max Score + Weight (two column) -->
                            <div class="field-row">
                                <div>
                                    <label class="form-label">Max Score</label>
                                    <input type="number" class="form-control" placeholder="Max Score">
                                </div>
                                <div>
                                    <label class="form-label">Weight</label>
                                    <input type="number" class="form-control" placeholder="Weight">
                                </div>
                            </div>

                            <!-- Assigned Date -->
                            <div>
                                <label class="form-label">Assigned Date</label>
                                <input type="date" class="form-control">
                            </div>

                            <!-- Closing Date -->
                            <div>
                                <label class="form-label">Closing Date</label>
                                <input type="date" class="form-control">
                            </div>

                            <!-- Assignment Type + Year -->
                            <div class="field-row">
                                <div>
                                    <select class="form-select select-dark">
                                        <option selected disabled>Assignment Type</option>
                                        <option>Assignment</option>
                                        <option>Mid-Term Exam</option>
                                        <option>Group Assessment</option>
                                        <option>Semester Exam</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select select-dark">
                                        <option selected disabled>Year</option>
                                        <option>Year 1</option>
                                        <option>Year 2</option>
                                        <option>Year 3</option>
                                        <option>Year 4</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Select Subject -->
                            <div>
                                <select class="form-select select-dark">
                                    <option selected disabled>Select Subject</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Computer Science</option>
                                    <option>Statistics</option>
                                </select>
                            </div>

                        </div><!-- /formElementContD -->
                    </div>
                </div><!-- /mainContainerD #2 -->


                <!-- ── CONTAINER 3 — Task Lists ── -->
                <div class="mainContainerD" style="margin-bottom:0;">
                    <div class="section-title">Task Lists</div>

                    <!-- Search + Year filter -->
                    <div class="table-search-bar">
                        <div class="search-input-wrap">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search by Task or ID">
                        </div>
                        <select class="filter-select">
                            <option>Year ▾</option>
                            <option>Year 1</option>
                            <option>Year 2</option>
                            <option>Year 3</option>
                            <option>Year 4</option>
                        </select>
                    </div>

                    <!-- Task table -->
                    <div class="table-wrapper">
                        <table class="tableStyleD">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Type</th>
                                    <th>Assigned Student Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="task-name">Assignment</span>
                                        <span class="task-id">APP_A_001</span>
                                    </td>
                                    <td class="task-type">Assignment</td>
                                    <td class="task-year">1</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="task-name">Mid-Term</span>
                                        <span class="task-id">APP_M_001</span>
                                    </td>
                                    <td class="task-type">Mid-Term Exam</td>
                                    <td class="task-year">1</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="task-name">Group Assessment</span>
                                        <span class="task-id">APP_GA_001</span>
                                    </td>
                                    <td class="task-type">Group Assessment</td>
                                    <td class="task-year">1</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="task-name">Semester Exam</span>
                                        <span class="task-id">APP_SE_001</span>
                                    </td>
                                    <td class="task-type">Group Assessment</td>
                                    <td class="task-year">1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div><!-- /mainContainerD #3 -->

            </div><!-- /middle-row -->


            <!-- ══════════════════════════════════════════════
           CONTAINER 4 + 5 — Student List
           (Shown as one container with inner sections in the screenshot)
      ══════════════════════════════════════════════ -->
            <div class="mainContainerD">
                <div class="section-title">Student List</div>

                <!-- Student search bar (4 filters) -->
                <div class="student-search-bar">
                    <div class="search-input-wrap" style="flex:2;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search by name or ID">
                    </div>
                    <select class="filter-select">
                        <option>All Batches</option>
                        <option>Batch 2021</option>
                        <option>Batch 2022</option>
                        <option>Batch 2023</option>
                    </select>
                    <select class="filter-select">
                        <option>Pending Task</option>
                        <option>0 Pending</option>
                        <option>1–3 Pending</option>
                        <option>4+ Pending</option>
                    </select>
                    <select class="filter-select">
                        <option>Completion Rate</option>
                        <option>0–25%</option>
                        <option>25–50%</option>
                        <option>50–75%</option>
                        <option>75–100%</option>
                    </select>
                </div>

                <!-- Student table -->
                <div class="table-wrapper">
                    <table class="tableStyleD">
                        <thead>
                            <tr>
                                <th>Person</th>
                                <th>Pending Tasks</th>
                                <th>Completion Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">R</div>
                                        <div>
                                            <span class="student-name">R.F. Muhammadh</span>
                                            <span class="student-id">21APPXXXX</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="pending-num">3</span></td>
                                <td><span class="rate-badge">20%</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">R</div>
                                        <div>
                                            <span class="student-name">R.F. Muhammadh</span>
                                            <span class="student-id">21APPXXXX</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="pending-num">3</span></td>
                                <td><span class="rate-badge">20%</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">R</div>
                                        <div>
                                            <span class="student-name">R.F. Muhammadh</span>
                                            <span class="student-id">21APPXXXX</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="pending-num">3</span></td>
                                <td><span class="rate-badge">20%</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar">R</div>
                                        <div>
                                            <span class="student-name">R.F. Muhammadh</span>
                                            <span class="student-id">21APPXXXX</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="pending-num">3</span></td>
                                <td><span class="rate-badge">20%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div><!-- /mainContainerD #4+5 -->

        </div><!-- /page-content -->
    </div><!-- /page-wrapper -->

    <style>
        /* ════════════════════════════════════════════════════
       RESPONSIVE STYLES
       Desktop (≥1024px) → original layout, no changes
       Tablet  (768–1023px) → narrower sidebar, 2-col stats, stacked middle
       Mobile  (<768px)  → bottom nav bar, no sidebar, single-col everything
    ════════════════════════════════════════════════════ */

        /* ── TABLET  (768px – 1023px) ── */
        @media (min-width: 768px) and (max-width: 1023px) {

            :root {
                --sidebar-w: 64px;
            }

            /* Slightly compact sidebar */
            .nav-icon {
                width: 42px;
                height: 42px;
                font-size: 16px;
            }

            .logo-shield {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            /* Tighter page padding */
            .page-content {
                padding: 18px 16px 32px;
            }

            /* Stats: 2 × 2 grid on tablet */
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 16px;
            }

            /* Middle row: stack vertically on tablet */
            .middle-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            /* Faculty header smaller text */
            .faculty-header h2 {
                font-size: 1.1rem;
            }

            .faculty-header p {
                font-size: .82rem;
            }

            /* Student search bar wraps naturally */
            .student-search-bar {
                flex-wrap: wrap;
                gap: 8px;
            }

            .student-search-bar .search-input-wrap {
                flex: 1 1 100%;
            }

            .student-search-bar .filter-select {
                flex: 1 1 calc(33% - 8px);
            }

            /* Table: allow horizontal scroll on tight widths */
            .table-wrapper {
                overflow-x: auto;
            }
        }


        /* ── MOBILE  (<768px) ── */
        @media (max-width: 767px) {

            /* ── Hide the vertical sidebar completely ── */
            .sidebar {
                display: none;
            }

            /* ── Page wrapper: no left margin, add bottom padding for nav bar ── */
            .page-wrapper {
                margin-left: 0;
                padding-bottom: 70px;
                width: 96vw;
                /* room for bottom nav */
            }

            .page-content {
                padding: 14px 12px 24px;
            }

            /* ── Fixed bottom navigation bar ── */
            .mobile-bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 62px;
                background: var(--navy);
                z-index: 200;
                align-items: stretch;
                border-top: 2px solid var(--teal);
            }

            .mobile-bottom-nav a {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: #8fa3bf;
                font-size: 18px;
                text-decoration: none;
                gap: 3px;
                transition: color .2s;
            }

            .mobile-bottom-nav a span {
                font-size: .60rem;
                font-family: 'DM Sans', sans-serif;
                letter-spacing: .02em;
            }

            .mobile-bottom-nav a.active {
                color: var(--teal);
            }

            .mobile-bottom-nav a:hover {
                color: var(--teal);
            }

            /* ── Mobile top bar (logo + page title) ── */
            .mobile-topbar {
                display: flex;
                align-items: center;
                gap: 10px;
                background: var(--navy);
                padding: 12px 16px;
                margin-bottom: 14px;
                border-radius: 0 0 14px 14px;
                box-shadow: 0 3px 10px rgba(0, 0, 0, .15);
            }

            .mobile-topbar .mob-logo {
                width: 36px;
                height: 36px;
                background: var(--teal);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                flex-shrink: 0;
            }

            .mobile-topbar .mob-title {
                color: #fff;
                font-size: .95rem;
                font-weight: 700;
                line-height: 1.2;
            }

            .mobile-topbar .mob-sub {
                color: #9fb3cc;
                font-size: .72rem;
            }

            /* ── Container 1: Stats → 2×2 grid ── */
            .faculty-header {
                padding: 14px 16px;
            }

            .faculty-header h2 {
                font-size: 1rem;
            }

            .faculty-header p {
                font-size: .78rem;
            }

            .stats-row {
                grid-template-columns: 1fr;
                gap: 10px;
                padding: 12px 12px;
            }

            .stat-card {
                padding: 12px 12px;
                gap: 10px;
            }

            .stat-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
                border-radius: 8px;
            }

            .stat-info .num {
                font-size: 1.25rem;
            }

            .stat-info .lbl {
                font-size: .72rem;
            }

            /* ── Middle row: single column ── */
            .middle-row {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            /* ── Section titles ── */
            .section-title {
                font-size: .95rem;
                padding: 14px 16px 12px;
            }

            /* ── Form body tighter ── */
            .form-body {
                padding: 14px 14px;
            }

            .formElementContD {
                gap: 12px;
            }

            /* On very small screens, stack Max Score + Weight */
            .field-row {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            /* ── Table search bars ── */
            .table-search-bar {
                flex-wrap: wrap;
                gap: 8px;
                padding: 10px 12px;
            }

            .table-search-bar .search-input-wrap {
                flex: 1 1 100%;
            }

            .table-search-bar .filter-select {
                flex: 1 1 auto;
            }

            /* ── Student search: stack all ── */
            .student-search-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                padding: 10px 12px;
            }

            .student-search-bar .search-input-wrap {
                flex: unset;
            }

            .student-search-bar .filter-select {
                width: 100%;
            }

            /* ── Tables: horizontal scroll ── */
            .table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .tableStyleD {
                min-width: 480px;
            }

            .tableStyleD thead th {
                font-size: .75rem;
                padding: 10px 12px;
            }

            .tableStyleD tbody td {
                font-size: .82rem;
                padding: 11px 12px;
            }

            /* Student cell: smaller avatar */
            .avatar {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            .student-name {
                font-size: .83rem;
            }

            .student-id {
                font-size: .70rem;
            }

            /* mainContainerD margin */
            .mainContainerD {
                margin-bottom: 14px;
                border-radius: 12px;
            }
        }

        /* ── Extra-small phones (<400px): stack Max Score/Weight too ── */
        @media (max-width: 399px) {
            .field-row {
                grid-template-columns: 1fr;
            }
        }

        /* ── Hide mobile-only elements on desktop/tablet ── */
        .mobile-bottom-nav,
        .mobile-topbar {
            display: none;
        }
    </style>

    <!-- Mobile Bottom Navigation (hidden on desktop via CSS) -->
    <nav class="mobile-bottom-nav">
        <a href="#" title="Home">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="#" title="Upload">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <span>Upload</span>
        </a>
        <a href="#" title="Tasks" class="active">
            <i class="fa-solid fa-users"></i>
            <span>Students</span>
        </a>
        <a href="#" title="Reports">
            <i class="fa-solid fa-chart-bar"></i>
            <span>Reports</span>
        </a>
        <a href="#" title="Settings">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>