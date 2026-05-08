<?php
// department_students.php
// Dynamic Department-wise Student Management Page for Lecturer Dashboard
// Leo International University LMS

session_start();

// -----------------------------------------------------------
// Mock data – replace with real DB queries
// -----------------------------------------------------------
$departments = [
    ['id' => 1, 'name' => 'Faculty of Applied Science',       'code' => 'FAS', 'color' => '#00b4d8'],
    ['id' => 2, 'name' => 'Faculty of Engineering',           'code' => 'FEN', 'color' => '#4cc9f0'],
    ['id' => 3, 'name' => 'Faculty of Management',            'code' => 'FMG', 'color' => '#0077b6'],
    ['id' => 4, 'name' => 'Faculty of Computing',             'code' => 'FCO', 'color' => '#023e8a'],
];

$selected_dept_id = isset($_GET['dept_id']) ? (int)$_GET['dept_id'] : 1;

// Find selected dept
$selected_dept = null;
foreach ($departments as $d) {
    if ($d['id'] == $selected_dept_id) {
        $selected_dept = $d;
        break;
    }
}
if (!$selected_dept) $selected_dept = $departments[0];

// Mock students per department
$students_data = [
    1 => [
        ['id' => '21APP5704', 'name' => 'Muhammadh R.F.',   'email' => 'fahadmohamed2948@gmail.com',   'batch' => '2021', 'gpa' => 3.7, 'status' => 'Active',  'avatar' => 'MR'],
        ['id' => '21APP5705', 'name' => 'Umayanga K.B.K.',  'email' => 'kavindaumayanga411@gmail.com',  'batch' => '2021', 'gpa' => 3.4, 'status' => 'Active',  'avatar' => 'UK'],
        ['id' => '21APP5706', 'name' => 'Nethmini G.P.T.',  'email' => 'tharushikagpnethmini@gmail.com', 'batch' => '2021', 'gpa' => 3.8, 'status' => 'Active',  'avatar' => 'NG'],
        ['id' => '21APP5707', 'name' => 'Guluwita I.S.',    'email' => 'isuruguluwita2002@gmail.com',   'batch' => '2021', 'gpa' => 3.2, 'status' => 'Active',  'avatar' => 'GI'],
        ['id' => '22APP5101', 'name' => 'Perera S.M.',      'email' => 'saman.perera@leo.ac.lk',        'batch' => '2022', 'gpa' => 2.9, 'status' => 'Active',  'avatar' => 'PS'],
        ['id' => '22APP5102', 'name' => 'Fernando A.L.',    'email' => 'amali.fernando@leo.ac.lk',      'batch' => '2022', 'gpa' => 3.5, 'status' => 'Active',  'avatar' => 'FA'],
        ['id' => '22APP5103', 'name' => 'Silva R.D.',       'email' => 'ravi.silva@leo.ac.lk',          'batch' => '2022', 'gpa' => 1.8, 'status' => 'Probation', 'avatar' => 'SR'],
        ['id' => '20APP4001', 'name' => 'Wickrama T.K.',   'email' => 'thisara.w@leo.ac.lk',           'batch' => '2020', 'gpa' => 3.9, 'status' => 'Active',  'avatar' => 'WT'],
    ],
    2 => [
        ['id' => '21ENG3001', 'name' => 'Karunarathne D.S.', 'email' => 'dinesh.k@leo.ac.lk', 'batch' => '2021', 'gpa' => 3.6, 'status' => 'Active', 'avatar' => 'KD'],
        ['id' => '21ENG3002', 'name' => 'Jayasinghe M.P.',  'email' => 'madu.j@leo.ac.lk',  'batch' => '2021', 'gpa' => 3.1, 'status' => 'Active', 'avatar' => 'JM'],
        ['id' => '22ENG3101', 'name' => 'Rathnayake C.L.',  'email' => 'chami.r@leo.ac.lk', 'batch' => '2022', 'gpa' => 2.7, 'status' => 'Active', 'avatar' => 'RC'],
    ],
    3 => [
        ['id' => '21MGT2001', 'name' => 'Bandara P.R.',     'email' => 'piumi.b@leo.ac.lk', 'batch' => '2021', 'gpa' => 3.3, 'status' => 'Active', 'avatar' => 'BP'],
        ['id' => '21MGT2002', 'name' => 'Dissanayake H.N.', 'email' => 'hasini.d@leo.ac.lk', 'batch' => '2021', 'gpa' => 2.5, 'status' => 'Active', 'avatar' => 'DH'],
        ['id' => '22MGT2101', 'name' => 'Senanayake V.L.',  'email' => 'vithu.s@leo.ac.lk', 'batch' => '2022', 'gpa' => 3.8, 'status' => 'Active', 'avatar' => 'SV'],
        ['id' => '22MGT2102', 'name' => 'Liyanage T.B.',    'email' => 'tharaka.l@leo.ac.lk', 'batch' => '2022', 'gpa' => 1.5, 'status' => 'Probation', 'avatar' => 'LT'],
    ],
    4 => [
        ['id' => '21COM1001', 'name' => 'Abeysekara R.M.',  'email' => 'rukan.a@leo.ac.lk',  'batch' => '2021', 'gpa' => 4.0, 'status' => 'Active', 'avatar' => 'AR'],
        ['id' => '21COM1002', 'name' => 'Weerasekara N.S.', 'email' => 'nadun.w@leo.ac.lk',  'batch' => '2021', 'gpa' => 3.6, 'status' => 'Active', 'avatar' => 'WN'],
        ['id' => '22COM1101', 'name' => 'Gunawardena A.P.', 'email' => 'anusha.g@leo.ac.lk', 'batch' => '2022', 'gpa' => 3.2, 'status' => 'Active', 'avatar' => 'GA'],
    ],
];

$students = $students_data[$selected_dept_id] ?? [];

// Stats
$total     = count($students);
$active    = count(array_filter($students, fn($s) => $s['status'] === 'Active'));
$probation = count(array_filter($students, fn($s) => $s['status'] === 'Probation'));
$avg_gpa   = $total > 0 ? round(array_sum(array_column($students, 'gpa')) / $total, 2) : 0;

// Search filter (server-side demo)
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search) {
    $students = array_filter($students, function ($s) use ($search) {
        return stripos($s['name'], $search) !== false
            || stripos($s['id'],   $search) !== false
            || stripos($s['email'], $search) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Students – Lecturer Dashboard | LEO University</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================================================================
   COLOUR PALETTE (matched to existing Lecturer Dashboard)
   ================================================================ */
        :root {
            --navy: #0d1b3e;
            /* deep navy sidebar / topbar   */
            --navy-light: #162348;
            /* sidebar hover                */
            --teal: #00b4d8;
            /* primary accent (stat cards)  */
            --teal-dark: #0077b6;
            /* darker teal                  */
            --teal-light: #90e0ef;
            /* light teal highlight         */
            --gold: #c9a84c;
            /* university gold accent       */
            --white: #ffffff;
            --bg: #f0f4f8;
            /* page background              */
            --card-bg: #ffffff;
            --border: #dce3ef;
            --text-main: #1a2a4a;
            --text-muted: #6b7a99;
            --sidebar-w: 72px;
            --topbar-h: 60px;
            --radius: 12px;
            --shadow: 0 4px 20px rgba(13, 27, 62, .09);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ── SIDEBAR ─────────────────────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 0 16px;
            z-index: 100;
            box-shadow: 2px 0 12px rgba(0, 0, 0, .25);
        }

        .sidebar-logo {
            width: 100%;
            padding: 12px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(201, 168, 76, .12);
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            margin-bottom: 8px;
        }

        .sidebar-logo img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .sidebar-logo .logo-placeholder {
            width: 42px;
            height: 42px;
            background: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--navy);
            font-weight: 700;
        }

        .nav-icon {
            width: 44px;
            height: 44px;
            margin: 4px 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .55);
            font-size: 20px;
            cursor: pointer;
            transition: background .2s, color .2s;
            text-decoration: none;
            position: relative;
        }

        .nav-icon:hover,
        .nav-icon.active {
            background: var(--teal);
            color: #fff;
        }

        .nav-icon .tooltip-label {
            position: absolute;
            left: calc(var(--sidebar-w) - 4px);
            background: var(--navy);
            color: #fff;
            font-size: 11px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity .2s;
            box-shadow: var(--shadow);
        }

        .nav-icon:hover .tooltip-label {
            opacity: 1;
        }

        .nav-spacer {
            flex: 1;
        }

        /* ── TOPBAR ──────────────────────────────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--navy);
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 99;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .2);
            gap: 14px;
        }

        .topbar-home {
            color: rgba(255, 255, 255, .75);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-home:hover {
            color: var(--teal);
        }

        .topbar-spacer {
            flex: 1;
        }

        .topbar-bell {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .75);
            font-size: 17px;
            cursor: pointer;
            transition: background .2s;
            position: relative;
        }

        .topbar-bell:hover {
            background: var(--teal);
            color: #fff;
        }

        .topbar-bell .badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ff5c5c;
            border-radius: 50%;
            border: 2px solid var(--navy);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .25);
        }

        .topbar-name {
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.2;
        }

        .topbar-role {
            color: var(--teal-light);
            font-size: 11px;
        }

        /* ── MAIN CONTENT ────────────────────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            padding: 28px 28px 40px;
            min-height: calc(100vh - var(--topbar-h));
        }

        /* ── PAGE HEADER ─────────────────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-main);
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .breadcrumb-custom {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
        }

        .breadcrumb-custom a {
            color: var(--teal);
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        /* ── DEPT TABS ───────────────────────────────────────────────── */
        .dept-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .dept-tab {
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            border: 2px solid var(--border);
            background: var(--card-bg);
            color: var(--text-muted);
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .dept-tab .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dept-tab:hover {
            border-color: var(--teal);
            color: var(--teal);
        }

        .dept-tab.active {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
        }

        .dept-tab.active .dot {
            background: var(--teal);
        }

        /* ── STAT CARDS ──────────────────────────────────────────────── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 900px) {
            .stats-row {
                grid-template-columns: repeat(1, 1fr);
            }
        }

        @media (max-width: 520px) {
            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(13, 27, 62, .14);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            flex-shrink: 0;
        }

        .stat-icon.teal {
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }

        .stat-icon.amber {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }

        .stat-icon.navy {
            background: linear-gradient(135deg, #162348, #0d1b3e);
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
        }

        /* ── TOOLBAR ─────────────────────────────────────────────────── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px;
            flex: 1;
            min-width: 220px;
            max-width: 360px;
            transition: border-color .2s;
        }

        .search-box:focus-within {
            border-color: var(--teal);
        }

        .search-box input {
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: var(--text-main);
            background: transparent;
            width: 100%;
        }

        .search-box i {
            color: var(--text-muted);
        }

        .filter-select {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: var(--text-main);
            background: var(--card-bg);
            cursor: pointer;
            transition: border-color .2s;
            outline: none;
        }

        .filter-select:focus {
            border-color: var(--teal);
        }

        .btn-primary-custom {
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: background .2s, transform .15s;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            background: var(--teal-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-main);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-outline-custom:hover {
            border-color: var(--teal);
            color: var(--teal);
        }

        /* ── STUDENT TABLE ───────────────────────────────────────────── */
        .table-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-card thead th {
            background: var(--navy);
            color: rgba(255, 255, 255, .8);
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            padding: 13px 16px;
            white-space: nowrap;
            border: none;
        }

        .table-card tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .table-card tbody tr:last-child {
            border-bottom: none;
        }

        .table-card tbody tr:hover {
            background: rgba(0, 180, 216, .04);
        }

        .table-card td {
            padding: 13px 16px;
            font-size: 13px;
            color: var(--text-main);
            vertical-align: middle;
        }

        .student-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .student-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-name {
            font-weight: 600;
            font-size: 13.5px;
        }

        .student-id {
            font-size: 11px;
            color: var(--text-muted);
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-active {
            background: #e6f9f0;
            color: #1a8a5e;
        }

        .badge-probation {
            background: #fff3e0;
            color: #b76e00;
        }

        .gpa-bar {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .gpa-track {
            flex: 1;
            height: 6px;
            border-radius: 3px;
            background: var(--border);
            overflow: hidden;
            max-width: 80px;
        }

        .gpa-fill {
            height: 100%;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--teal), var(--teal-dark));
            transition: width .4s ease;
        }

        .gpa-fill.low {
            background: linear-gradient(90deg, #f39c12, #e67e22);
        }

        .gpa-fill.danger {
            background: linear-gradient(90deg, #e74c3c, #c0392b);
        }

        .action-btns {
            display: flex;
            gap: 7px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: all .2s;
            color: var(--text-muted);
            background: transparent;
            text-decoration: none;
        }

        .action-btn.view:hover {
            border-color: var(--teal);
            color: var(--teal);
            background: rgba(0, 180, 216, .07);
        }

        .action-btn.grade:hover {
            border-color: #2ecc71;
            color: #2ecc71;
            background: rgba(46, 204, 113, .07);
        }

        .action-btn.msg:hover {
            border-color: #f39c12;
            color: #f39c12;
            background: rgba(243, 156, 18, .07);
        }

        /* ── EMPTY STATE ─────────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 52px;
            color: var(--teal-light);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h5 {
            color: var(--text-main);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* ── DEPT INFO STRIP ─────────────────────────────────────────── */
        .dept-info-strip {
            background: linear-gradient(135deg, var(--navy) 0%, #162348 100%);
            border-radius: var(--radius);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
        }

        .dept-info-strip .dept-badge {
            background: var(--teal);
            color: var(--navy);
            font-weight: 800;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            letter-spacing: .08em;
            white-space: nowrap;
        }

        .dept-info-strip .dept-name {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }

        .dept-info-strip .dept-meta {
            color: rgba(255, 255, 255, .5);
            font-size: 12px;
            margin-top: 3px;
        }

        .dept-info-strip .spacer {
            flex: 1;
        }

        .dept-info-strip .dept-counts {
            text-align: right;
        }

        .dept-info-strip .count-num {
            color: var(--teal);
            font-size: 24px;
            font-weight: 700;
        }

        .dept-info-strip .count-label {
            color: rgba(255, 255, 255, .5);
            font-size: 11px;
        }

        /* ── PAGINATION ──────────────────────────────────────────────── */
        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            font-size: 12.5px;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 8px;
        }

        .page-btns {
            display: flex;
            gap: 6px;
        }

        .page-btn {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            background: transparent;
            color: var(--text-muted);
            transition: all .2s;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
        }

        /* ── ANIMATIONS ──────────────────────────────────────────────── */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeInUp .35s ease both;
        }

        .animate-d1 {
            animation-delay: .05s;
        }

        .animate-d2 {
            animation-delay: .10s;
        }

        .animate-d3 {
            animation-delay: .15s;
        }

        .animate-d4 {
            animation-delay: .20s;
        }

        .animate-d5 {
            animation-delay: .25s;
        }

        /* ── RESPONSIVE ──────────────────────────────────────────────── */
        @media (max-width: 700px) {
            .main {
                padding: 16px;
            }

            .table-card {
                overflow-x: auto;
            }

            .dept-info-strip .dept-counts {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ============================================================
     SIDEBAR
============================================================ -->
    <nav class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-placeholder">L</div>
        </div>

        <a href="LectureDashboard.php" class="nav-icon" title="Home">
            <i class="bi bi-house-fill"></i>
            <span class="tooltip-label">Home</span>
        </a>
        <a href="#" class="nav-icon" title="Upload Materials">
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <span class="tooltip-label">Materials</span>
        </a>
        <a href="#" class="nav-icon" title="Assignments">
            <i class="bi bi-file-earmark-check-fill"></i>
            <span class="tooltip-label">Assignments</span>
        </a>
        <a href="department_students.php" class="nav-icon active" title="Department Students">
            <i class="bi bi-people-fill"></i>
            <span class="tooltip-label">Students</span>
        </a>
        <a href="#" class="nav-icon" title="Grades & Results">
            <i class="bi bi-bar-chart-fill"></i>
            <span class="tooltip-label">Results</span>
        </a>
        <a href="#" class="nav-icon" title="Messages">
            <i class="bi bi-envelope-fill"></i>
            <span class="tooltip-label">Messages</span>
        </a>

        <div class="nav-spacer"></div>

        <a href="#" class="nav-icon" title="Settings">
            <i class="bi bi-gear-fill"></i>
            <span class="tooltip-label">Settings</span>
        </a>
        <a href="logout.php" class="nav-icon" title="Logout">
            <i class="bi bi-box-arrow-right"></i>
            <span class="tooltip-label">Logout</span>
        </a>
    </nav>

    <!-- ============================================================
     TOPBAR
============================================================ -->
    <header class="topbar">
        <a href="LectureDashboard.php" class="topbar-home">
            <i class="bi bi-house"></i> Home
        </a>
        <span style="color:rgba(255,255,255,.3)">/</span>
        <span style="color:var(--teal);font-size:13.5px;font-weight:500">Department Students</span>

        <div class="topbar-spacer"></div>

        <div class="topbar-bell">
            <i class="bi bi-bell"></i>
            <div class="badge"></div>
        </div>

        <div class="topbar-user">
            <div class="topbar-avatar">DW</div>
            <div>
                <div class="topbar-name">Dinesh Weerasinghe</div>
                <div class="topbar-role">DWM_A_11234</div>
            </div>
        </div>
    </header>

    <!-- ============================================================
     MAIN
============================================================ -->
    <main class="main">

        <!-- PAGE HEADER -->
        <div class="page-header animate">
            <div>
                <div class="breadcrumb-custom">
                    <a href="LectureDashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a>
                    <i class="bi bi-chevron-right" style="font-size:10px"></i>
                    <span>Department Students</span>
                </div>
                <div class="page-title">Department Student Management</div>
                <div class="page-subtitle">View and manage students by faculty / department</div>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <a href="#" class="btn-outline-custom">
                    <i class="bi bi-download"></i> Export
                </a>
                <a href="#" class="btn-primary-custom">
                    <i class="bi bi-person-plus-fill"></i> Add Student
                </a>
            </div>
        </div>

        <!-- DEPARTMENT TABS -->
        <div class="dept-tabs animate animate-d1">
            <?php foreach ($departments as $d): ?>
                <a href="?dept_id=<?= $d['id'] ?>"
                    class="dept-tab <?= ($d['id'] == $selected_dept_id) ? 'active' : '' ?>">
                    <span class="dot" style="background:<?= $d['color'] ?>"></span>
                    <?= htmlspecialchars($d['code']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- DEPT INFO STRIP -->
        <div class="dept-info-strip animate animate-d2">
            <div class="dept-badge"><?= htmlspecialchars($selected_dept['code']) ?></div>
            <div>
                <div class="dept-name"><?= htmlspecialchars($selected_dept['name']) ?></div>
                <div class="dept-meta">LEO International University &bull; Academic Year 2024/25</div>
            </div>
            <div class="spacer"></div>
            <div class="dept-counts">
                <div class="count-num"><?= $total ?></div>
                <div class="count-label">Total Students</div>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-row animate animate-d2">
            <div class="stat-card">
                <div class="stat-icon teal"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="stat-value"><?= $total ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-person-check-fill"></i></div>
                <div>
                    <div class="stat-value"><?= $active ?></div>
                    <div class="stat-label">Active Students</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div>
                    <div class="stat-value"><?= $probation ?></div>
                    <div class="stat-label">On Probation</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon navy"><i class="bi bi-star-fill"></i></div>
                <div>
                    <div class="stat-value"><?= $avg_gpa ?></div>
                    <div class="stat-label">Average GPA</div>
                </div>
            </div>
        </div>

        <!-- TOOLBAR -->
        <div class="toolbar animate animate-d3">
            <form method="GET" action="" style="display:contents">
                <input type="hidden" name="dept_id" value="<?= $selected_dept_id ?>">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search"
                        value="<?= htmlspecialchars($search) ?>"
                        placeholder="Search by name, ID or email…">
                </div>
                <select name="batch" class="filter-select">
                    <option value="">All Batches</option>
                    <option value="2020">Batch 2020</option>
                    <option value="2021">Batch 2021</option>
                    <option value="2022">Batch 2022</option>
                    <option value="2023">Batch 2023</option>
                </select>
                <select name="status" class="filter-select">
                    <option value="">All Status</option>
                    <option value="Active">Active</option>
                    <option value="Probation">Probation</option>
                </select>
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-funnel-fill"></i> Filter
                </button>
                <?php if ($search): ?>
                    <a href="?dept_id=<?= $selected_dept_id ?>" class="btn-outline-custom">
                        <i class="bi bi-x-lg"></i> Clear
                    </a>
                <?php endif; ?>
            </form>
            <div style="flex:1"></div>
            <a href="#" class="btn-outline-custom">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </a>
        </div>

        <!-- STUDENTS TABLE -->
        <div class="table-card animate animate-d4">
            <?php if (empty($students)): ?>
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <h5>No students found</h5>
                    <p>No students match your current filters. Try adjusting your search.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Reg. No</th>
                            <th>Email</th>
                            <th>Batch</th>
                            <th>GPA</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($students as $s): ?>
                            <tr>
                                <td style="color:var(--text-muted);font-size:12px"><?= $i++ ?></td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar"><?= htmlspecialchars($s['avatar']) ?></div>
                                        <div>
                                            <div class="student-name"><?= htmlspecialchars($s['name']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="student-id" style="font-size:12.5px;font-weight:600;color:var(--teal-dark)">
                                        <?= htmlspecialchars($s['id']) ?>
                                    </span>
                                </td>
                                <td style="color:var(--text-muted);font-size:12.5px">
                                    <?= htmlspecialchars($s['email']) ?>
                                </td>
                                <td>
                                    <span style="background:#eef2ff;color:#3a5bd9;padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:600">
                                        <?= htmlspecialchars($s['batch']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $gpa = $s['gpa'];
                                    $pct = ($gpa / 4.0) * 100;
                                    $fillClass = $gpa >= 3.0 ? '' : ($gpa >= 2.0 ? 'low' : 'danger');
                                    ?>
                                    <div class="gpa-bar">
                                        <strong style="font-size:13px;min-width:28px"><?= $gpa ?></strong>
                                        <div class="gpa-track">
                                            <div class="gpa-fill <?= $fillClass ?>"
                                                style="width:<?= $pct ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-status <?= $s['status'] === 'Active' ? 'badge-active' : 'badge-probation' ?>">
                                        <i class="bi <?= $s['status'] === 'Active' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill' ?>"></i>
                                        <?= htmlspecialchars($s['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="student_profile.php?id=<?= $s['id'] ?>"
                                            class="action-btn view" title="View Profile">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="grade_student.php?id=<?= $s['id'] ?>"
                                            class="action-btn grade" title="View Grades">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </a>
                                        <a href="message.php?to=<?= $s['id'] ?>"
                                            class="action-btn msg" title="Send Message">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- PAGINATION -->
                <div class="pagination-bar">
                    <span>Showing <strong><?= count($students) ?></strong> of <strong><?= $total ?></strong> students</span>
                    <div class="page-btns">
                        <button class="page-btn"><i class="bi bi-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-submit search on Enter (already works via form), visual polish only
        document.querySelectorAll('.gpa-fill').forEach(el => {
            const w = el.style.width;
            el.style.width = '0';
            setTimeout(() => {
                el.style.width = w;
            }, 100);
        });
    </script>
</body>

</html>