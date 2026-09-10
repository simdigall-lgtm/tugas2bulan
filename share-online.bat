@echo off
title SIPEKAN - Berbagi Akses Website Online
cls
echo ==========================================================
echo    SIPEKAN - Berbagi Akses Website ke Publik Online      
echo ==========================================================
echo.
echo [*] Memeriksa koneksi server lokal di port 8000...

echo.
echo ==========================================================
echo    PILIH METODE TUNNEL (SEMUA TANPA PASSWORD):           
echo ==========================================================
echo [1] Localhost.run (Rekomendasi - Cepat, Langsung Aktif ^& HTTPS)
echo [2] Pinggy.io (Alternatif - HTTPS Otomatis)
echo [3] Serveo.net (Alternatif)
echo [4] Keluar
echo.
set /p pilihan="Pilihan Anda (1/2/3/4) [Default: 1]: "
if "%pilihan%"=="" set pilihan=1

if "%pilihan%"=="1" (
    echo.
    echo [*] Menghubungkan ke Localhost.run...
    echo [*] Link publik HTTPS (.lhr.life) akan muncul di bawah:
    echo [*] Tekan CTRL+C untuk berhenti.
    echo.
    ssh -o StrictHostKeyChecking=no -R 80:localhost:8000 nokey@localhost.run
) else if "%pilihan%"=="2" (
    echo.
    echo [*] Menghubungkan ke Pinggy.io...
    echo [*] Link publik HTTPS (.a.pinggy.io) akan muncul di bawah:
    echo [*] Tekan CTRL+C untuk berhenti.
    echo.
    ssh -o StrictHostKeyChecking=no -p 443 -R0:localhost:8000 a.pinggy.io
) else if "%pilihan%"=="3" (
    echo.
    echo [*] Menghubungkan ke Serveo.net...
    echo [*] Link publik HTTPS (.serveo.net) akan muncul di bawah:
    echo [*] Tekan CTRL+C untuk berhenti.
    echo.
    ssh -o StrictHostKeyChecking=no -R 80:localhost:8000 serveo.net
) else (
    echo Keluar.
)
pause
