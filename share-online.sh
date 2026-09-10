#!/usr/bin/env bash
# ==========================================================
# SIPEKAN - Share Localhost Online via Public Tunnel (SSH)
# ==========================================================

PORT=8000
echo "=========================================================="
echo "   SIPEKAN - Berbagi Akses Website ke Publik Online      "
echo "=========================================================="
echo ""

# Pastikan SSH key tersedia agar tidak meminta password
if [ ! -f "$HOME/.ssh/id_rsa" ] && [ ! -f "$HOME/.ssh/id_ed25519" ]; then
    echo "[*] Menyiapkan SSH Key otomatis..."
    ssh-keygen -t ed25519 -N "" -f "$HOME/.ssh/id_ed25519" -q
fi

# Pastikan Laravel Dev Server berjalan
if ! curl -s http://127.0.0.1:$PORT > /dev/null; then
    echo "[!] Web server lokal pada http://127.0.0.1:$PORT belum berjalan."
    echo "[*] Menjalankan php artisan serve..."
    php artisan serve --port=$PORT &
    sleep 2
fi

echo "[+] Web server lokal aktif di http://127.0.0.1:$PORT"
echo ""
echo "=========================================================="
echo "   PILIH METODE TUNNEL (SEMUA TANPA PASSWORD):           "
echo "=========================================================="
echo "1) Localhost.run (Rekomendasi - Cepat, Langsung Aktif & HTTPS)"
echo "2) Pinggy.io (Alternatif - HTTPS Otomatis)"
echo "3) Serveo.net (Alternatif)"
echo "4) Keluar"
echo ""
read -p "Pilihan Anda (1/2/3/4) [Default: 1]: " PILIHAN
PILIHAN=${PILIHAN:-1}

case $PILIHAN in
    1)
        echo ""
        echo "[*] Menghubungkan ke Localhost.run..."
        echo "[*] Link publik HTTPS (.lhr.life) akan segera muncul di bawah..."
        echo "[*] Tekan CTRL+C untuk berhenti membagikan."
        echo ""
        ssh -o StrictHostKeyChecking=no -R 80:localhost:$PORT nokey@localhost.run
        ;;
    2)
        echo ""
        echo "[*] Menghubungkan ke Pinggy.io..."
        echo "[*] Link publik HTTPS (.a.pinggy.io) akan muncul di layar..."
        echo "[*] Tekan CTRL+C untuk berhenti membagikan."
        echo ""
        ssh -o StrictHostKeyChecking=no -p 443 -R0:localhost:$PORT a.pinggy.io
        ;;
    3)
        echo ""
        echo "[*] Menghubungkan ke Serveo.net..."
        echo "[*] Link publik HTTPS (.serveo.net) akan muncul di layar..."
        echo "[*] Tekan CTRL+C untuk berhenti membagikan."
        echo ""
        ssh -o StrictHostKeyChecking=no -R 80:localhost:$PORT serveo.net
        ;;
    4)
        echo "Keluar."
        exit 0
        ;;
    *)
        echo "[*] Menjalankan Localhost.run sebagai default..."
        ssh -o StrictHostKeyChecking=no -R 80:localhost:$PORT nokey@localhost.run
        ;;
esac
