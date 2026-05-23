<?php
session_start();
// Indian Timezone fix taaki date/time sahi dikhe
date_default_timezone_set('Asia/Kolkata'); 
require 'config.php';

if (!isset($_SESSION['admin_logged'])) {
    header("Location: index.php");
    exit;
}

/* Filters Logic */
$q = trim($_GET['q'] ?? '');
$date_from = $_GET['date_from'] ?? '';
$date_to   = $_GET['date_to'] ?? '';
$range     = $_GET['range'] ?? ''; 

$sql = "SELECT * FROM enquiries WHERE 1=1";
$conds = [];

// Quick Range Logic
if ($range === 'today') {
    $conds[] = "DATE(created_at) = CURDATE()";
} elseif ($range === 'yesterday') {
    $conds[] = "DATE(created_at) = SUBDATE(CURDATE(),1)";
} elseif ($range === 'last7') {
    $conds[] = "DATE(created_at) >= SUBDATE(CURDATE(),7)";
}

// Search Logic
if ($q !== '') {
    $conds[] = "(full_name LIKE '%$q%' OR email LIKE '%$q%' OR phone LIKE '%$q%')";
}

// Custom Date Logic
if ($date_from !== '') {
    $conds[] = "DATE(created_at) >= '$date_from'";
}
if ($date_to !== '') {
    $conds[] = "DATE(created_at) <= '$date_to'";
}

if ($conds) {
    $sql .= " AND " . implode(" AND ", $conds);
}

$sql .= " ORDER BY id DESC LIMIT 500";
$res = $conn->query($sql);

/* Stats */
$today_count = $conn->query("SELECT COUNT(*) c FROM enquiries WHERE DATE(created_at)=CURDATE()")->fetch_assoc()['c'];
$month_count = $conn->query("SELECT COUNT(*) c FROM enquiries WHERE MONTH(created_at)=MONTH(CURDATE()) AND YEAR(created_at)=YEAR(CURDATE())")->fetch_assoc()['c'];
$total_count = $conn->query("SELECT COUNT(*) c FROM enquiries")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-grad: linear-gradient(to right, #7610cd, #ce95ff);
            --dark-blue: #1e1b4b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8f9ff;
            color: #475569;
        }
        .background-gradient { background: var(--primary-grad); }
        
        .gradient-text {
            background: linear-gradient(90deg, #7610cd, #ce95ff, #7610cd);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 5s linear infinite;
        }
        @keyframes gradientMove { to { background-position: 200% center; } }

        /* Navbar */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 15px 25px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(118, 16, 205, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover { transform: translateY(-5px); }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 24px;
            background: #f3e8ff;
            color: #7610cd;
        }

        /* Table Style */
        .table-container { background: #fff; border-radius: 20px; overflow: hidden; }
        
        /* Fixed Mobile Table View: Ab card nahi banega, horizontal scroll hoga */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            min-width: 900px; /* Force minimum width to keep rows flat on mobile */
            white-space: nowrap;
        }
        
        .table thead {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
        }
        .table th { font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; padding: 20px; }
        .table td { padding: 18px 20px; border-bottom: 1px solid #f1f5f9; }

        /* Buttons & Badges */
        .btn-grad {
            background: var(--primary-grad);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 12px;
            font-weight: 600;
        }
        .btn-grad:hover { color: white; opacity: 0.9; }
        .btn-outline-custom {
            border: 2px solid #7610cd;
            color: #7610cd;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-outline-custom:hover, .btn-outline-custom.active {
            background: var(--primary-grad);
            color: white;
            border-color: transparent;
        }

        .btn-reset {
            background: #f1f5f9;
            color: #475569;
            border-radius: 12px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="./logo.png" height="60" class="me-2">
            <span class="gradient-text fw-bold fs-4">ADMIN PANEL</span>
        </a>
        <a href="logout.php" class="btn btn-danger btn-sm px-4 rounded-pill">
            <i class="fas fa-power-off me-2"></i>Logout
        </a>
    </div>
</nav>

<div class="container-fluid p-4">
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                    <div class="ms-4">
                        <p class="text-muted mb-0 fw-bold">Today's Leads</p>
                        <h2 class="mb-0 fw-bold"><?= $today_count ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background:#e0f2fe; color:#0369a1;"><i class="fas fa-chart-line"></i></div>
                    <div class="ms-4">
                        <p class="text-muted mb-0 fw-bold">Monthly Reach</p>
                        <h2 class="mb-0 fw-bold"><?= $month_count ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background:#fef2f2; color:#991b1b;"><i class="fas fa-database"></i></div>
                    <div class="ms-4">
                        <p class="text-muted mb-0 fw-bold">Total Enquiries</p>
                        <h2 class="mb-0 fw-bold"><?= $total_count ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="?range=today" class="btn btn-outline-custom <?= $range=='today'?'active':'' ?>">Today</a>
            <a href="?range=yesterday" class="btn btn-outline-custom <?= $range=='yesterday'?'active':'' ?>">Yesterday</a>
            <a href="?range=last7" class="btn btn-outline-custom <?= $range=='last7'?'active':'' ?>">Last 7 Days</a>
            <a href="dashboard.php" class="btn-reset ms-auto"><i class="fas fa-sync"></i> Reset All</a>
        </div>

        <form class="row g-3">
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" class="form-control border-start-0" placeholder="Name, Email or Phone...">
                </div>
            </div>
            <div class="col-lg-3">
                <input type="date" name="date_from" value="<?= $date_from ?>" class="form-control" title="From Date">
            </div>
            <div class="col-lg-3">
                <input type="date" name="date_to" value="<?= $date_to ?>" class="form-control" title="To Date">
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-grad w-100">Apply Filter</button>
            </div>
        </form>
    </div>

    <div class="card table-container">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Info</th>
                        <th>Contact Details</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if($res->num_rows > 0) {
                        while($row = $res->fetch_assoc()) {
                            // Indian Date Formatting
                            $formatted_date = date("d-m-Y", strtotime($row['created_at']));
                            $formatted_time = date("h:i A", strtotime($row['created_at']));
                    ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $i++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle background-gradient text-white d-flex align-items-center justify-content-center me-3" style="width:35px; height:35px; font-size:12px">
                                    <?= strtoupper(substr($row['full_name'], 0, 1)) ?>
                                </div>
                                <span class="fw-semibold"><?= htmlspecialchars($row['full_name']) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="fas fa-envelope me-1 text-muted"></i> <?= htmlspecialchars($row['email']) ?></div>
                            <div class="small"><i class="fas fa-phone me-1 text-muted"></i> <?= htmlspecialchars($row['phone']) ?></div>
                        </td>
                        <td class="fw-bold"><?= $formatted_date ?></td>
                        <td class="text-muted small fw-bold"><?= $formatted_time ?></td>
                        <td>
                            <div class="text-truncate" style="max-width: 250px; white-space: normal;" title="<?= htmlspecialchars($row['message']) ?>">
                                <?= htmlspecialchars($row['message']) ?>
                            </div>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50">
                            <h5 class="text-muted">No records found matching your criteria</h5>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>