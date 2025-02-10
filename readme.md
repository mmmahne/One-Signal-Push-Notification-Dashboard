
## 🌐 Deployment

### Hosting Biasa
1. Upload semua file ke direktori public_html
2. Atur permission:
   - Folder: 755
   - File: 644
   - .env: 600
3. Buat database dan import schema
4. Update file .env dengan kredensial yang sesuai

### Hostinger
1. Login ke hPanel
2. Upload file melalui File Manager atau FTP
3. Buat database MySQL
4. Import database.sql
5. Update kredensial di .env

## 👥 Login Default
Email: admin@eden.com
Password: admineden

Hardcoded karena gamau ribet


## ⚠️ Penting

- Jangan lupa mengubah kredensial default
- Backup database secara berkala
- Periksa log error jika terjadi masalah
- Pastikan PHP memiliki ekstensi yang diperlukan:
  - mysqli
  - curl
  - json

## 📄 Lisensi

[MIT License](LICENSE)

## 🤝 Kontribusi

Silakan buat pull request untuk kontribusi.

1. Fork repository
2. Buat branch baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## 🐛 Pelaporan Bug

Silakan buat issue untuk melaporkan bug atau mengusulkan fitur baru.