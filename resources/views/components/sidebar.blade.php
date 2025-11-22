<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tema Rumah Sakit</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f9f6;
        }

        /* === SIDEBAR === */
        aside.sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(135deg, #43cea2, #185a9d); /* <<< GRADIENT NOMOR 3 */
            color: white;
            position: fixed;
            padding: 0;
            overflow-y: auto;
            transition: width 0.35s ease, padding 0.3s ease;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .logo {
            width: 45px;
            height: 45px;
            background: white;
            color: #185a9d;
            font-size: 22px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .sidebar-title {
            font-size: 14px;
            line-height: 1.2;
            transition: opacity 0.2s ease;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
        }

        /* === USER PROFILE === */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-top: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a7f3d0, #34d399);
            color: #064e3b;
            display: flex;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .menu {
            padding: 10px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 15px;
            cursor: pointer;
            white-space: nowrap;
            transition: padding 0.3s ease, gap 0.3s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
            border-radius: 6px;
        }

        .active {
            background: rgba(255,255,255,0.25) !important;
            border-radius: 6px;
        }

        /* === DROPDOWN === */
        .has-dropdown {
            justify-content: space-between;
        }

        .dropdown-icon {
            transition: 0.25s;
        }

        .dropdown-open .dropdown-icon {
            transform: rotate(180deg);
        }

        .submenu {
            display: none;
            background: linear-gradient(135deg, #6ee7b7, #34d399);
            margin-left: 20px;
            border-left: 3px solid #ffffff;
            padding-left: 10px;
            transition: all 0.3s ease;
        }

        .submenu-item {
            padding: 8px 0;
            color: #064e3b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* === COLLAPSED SIDEBAR ANIMATION === */
        aside.sidebar.collapsed {
            width: 70px;
        }

        aside.sidebar.collapsed .sidebar-title,
        aside.sidebar.collapsed .user-info,
        aside.sidebar.collapsed .menu-item span,
        aside.sidebar.collapsed .submenu,
        aside.sidebar.collapsed .submenu-item,
        aside.sidebar.collapsed .submenu-logo {
            opacity: 0;
            pointer-events: none;
            display: none !important;
        }

        aside.sidebar.collapsed .menu-item {
            justify-content: center !important;
            padding: 14px 0 !important;
            gap: 0 !important;
        }

        aside.sidebar.collapsed .dropdown-icon {
            display: none !important;
        }

        /* Center avatar & logo in collapsed mode */
        aside.sidebar.collapsed .user-avatar {
            margin: 0 auto !important;
        }

        aside.sidebar.collapsed .user-profile {
            justify-content: center !important;
        }

        aside.sidebar.collapsed .logo-container {
            width: 100%;
            justify-content: center !important;
        }

        aside.sidebar.collapsed .sidebar-header {
            justify-content: center !important;
        }
    </style>
</head>

<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <div class="logo">V-K</div>
            <div class="sidebar-title">
                Rekam Medis Elektronik<br>
                Manajemen Informasi<br>
                OPUS
            </div>
        </div>
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="user-profile">
        <div class="user-avatar">A</div>
        <div class="user-info">
            <div class="user-name">Administrator</div>
            <div class="user-role">Super Administrator</div>
        </div>
    </div>

    <nav class="menu">

        <a href="#" class="menu-item active">
            <i class="fas fa-home"></i> <span>Beranda</span>
        </a>

        <a href="#" class="menu-item has-dropdown" onclick="toggleDropdown(event, 'pendaftaranDropdown')">
            <i class="fas fa-user-plus"></i><span>Pendaftaran</span>
            <i class="fas fa-chevron-down dropdown-icon"></i>
        </a>

        <div class="submenu" id="pendaftaranDropdown">
            <a href="#" class="submenu-item"><div class="submenu-logo"></div> Pasien Lama</a>
            <a href="#" class="submenu-item"><div class="submenu-logo"></div> Pasien Baru</a>
            <a href="#" class="submenu-item"><div class="submenu-logo"></div> List Pendaftaran</a>
            <a href="#" class="submenu-item"><div class="submenu-logo"></div> Edit Pendaftaran</a>
            <a href="#" class="submenu-item"><div class="submenu-logo"></div> Antrian Online</a>
        </div>

        <a href="#" class="menu-item"><i class="fas fa-users"></i> <span>Pasien</span></a>
        <a href="#" class="menu-item"><i class="fas fa-id-card"></i> <span>BPJS</span></a>
        <a href="#" class="menu-item"><i class="fas fa-clinic-medical"></i> <span>Poliklinik</span></a>
        <a href="#" class="menu-item"><i class="fas fa-pills"></i> <span>Gudang Obat</span></a>
        <a href="#" class="menu-item"><i class="fas fa-money-bill"></i> <span>Kasir</span></a>
        <a href="#" class="menu-item"><i class="fas fa-database"></i> <span>Master Data</span></a>
        <a href="#" class="menu-item"><i class="fas fa-file-alt"></i> <span>Laporan</span></a>
        <a href="#" class="menu-item"><i class="fas fa-flask"></i> <span>Laboratorium</span></a>
        <a href="#" class="menu-item"><i class="fas fa-bed"></i> <span>Rawat Inap</span></a>
        <a href="#" class="menu-item"><i class="fas fa-certificate"></i> <span>PONED</span></a>
        <a href="#" class="menu-item"><i class="fas fa-key"></i> <span>Ubah Password</span></a>
        <a href="#" class="menu-item"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
        <a href="#" class="menu-item"><i class="fas fa-users-cog"></i> <span>Pengaturan Grup</span></a>
        <a href="#" class="menu-item"><i class="fas fa-road"></i> <span>Bypass</span></a>
        <a href="#" class="menu-item"><i class="fab fa-whatsapp"></i> <span>Whatsapp</span></a>
        <a href="#" class="menu-item"><i class="fas fa-receipt"></i> <span>Billing</span></a>

    </nav>
</aside>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
}

function toggleDropdown(event, id) {
    event.preventDefault();
    let submenu = document.getElementById(id);
    let parent = event.currentTarget;

    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    parent.classList.toggle("dropdown-open");
}
</script>

</body>
</html>
