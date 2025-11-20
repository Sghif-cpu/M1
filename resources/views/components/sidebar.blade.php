<?php
?>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <div class="logo">V-K</div>
            <div class="sidebar-title">Rekam Medis Elektronik<br>Manajemen Informasi<br>Kesehatan - Kampus Utama</div>
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
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('pendaftaran') }}" class="menu-item">
            <i class="fas fa-user-plus"></i>
            <span>Pendaftaran</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-users"></i>
            <span>Pasien</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-id-card"></i>
            <span>BPJS</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-clinic-medical"></i>
            <span>Poliklinik</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-pills"></i>
            <span>Gudang Obat</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-money-bill"></i>
            <span>Kasir</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-database"></i>
            <span>Master Data</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-flask"></i>
            <span>Laboratorium</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-bed"></i>
            <span>Rawat Inap</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-certificate"></i>
            <span>PONED</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-key"></i>
            <span>Ubah Password</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-cog"></i>
            <span>Pengaturan</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-users-cog"></i>
            <span>Pengaturan Grup</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-road"></i>
            <span>Bypass</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fab fa-whatsapp"></i>
            <span>Whatsapp</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-receipt"></i>
            <span>Billing</span>
        </a>
    </nav>
</aside>
