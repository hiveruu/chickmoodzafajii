# Chick Mood - Aplikasi Kasir Rice Bowl

Aplikasi kasir sederhana berbasis PHP native + MySQL untuk usaha rice bowl "Chick Mood".

## Struktur Database
5 tabel saling berelasi (sudah dinormalisasi sampai 3NF):
- `kategori_menu` (master)
- `menu` (master, FK ke kategori_menu)
- `users` (master, kasir/admin)
- `pesanan` (transaksi header, FK ke users)
- `detail_pesanan` (transaksi detail, FK ke pesanan & menu)

## Cara Menjalankan (XAMPP / Laragon)

1. Copy folder `chickmood` ke dalam `htdocs` (XAMPP) atau `www` (Laragon).
2. Buka phpMyAdmin, lalu import file `database/chickmood.sql`.
   (Database `db_chickmood` akan otomatis dibuat beserta data contoh.)
3. Cek pengaturan koneksi di `config/koneksi.php` (default: host=localhost, user=root, password=kosong).
4. Jalankan Apache & MySQL, lalu buka browser ke:
   `http://localhost/chickmood/`
5. Login dengan salah satu akun berikut (password sama untuk semua):

   | Username | Password    | Role  |
   |----------|-------------|-------|
   | admin    | password123 | admin |
   | siti     | password123 | kasir |
   | budi     | password123 | kasir |
   | rani     | password123 | kasir |
   | dedi     | password123 | kasir |

## Fitur

- **Login** berbasis session, password di-hash dengan bcrypt (`password_hash` / `password_verify`).
- **Kasir**: pilih menu -> masuk keranjang -> bayar -> hitung kembalian otomatis -> cetak struk.
  Satu transaksi menyimpan data ke tabel `pesanan` (relasi ke `users`) dan `detail_pesanan`
  (relasi ke `pesanan` & `menu`), serta otomatis mengurangi `stok` pada tabel `menu`.
- **Riwayat Transaksi**: daftar semua transaksi + detail item yang dibeli.
- **CRUD Kategori Menu**.
- **CRUD Data Menu** (nama, harga, stok, kategori).
- **CRUD Data User** (khusus role admin).
- Validasi: kategori/menu yang masih dipakai tidak bisa dihapus (menjaga integritas relasi FK).

## Catatan
- Menu > 5 data, kategori 5 data, user 5 data (memenuhi ketentuan minimal 5 data per tabel master).
- Silakan ubah nama file zip / struktur folder sesuai format penamaan yang diminta di soal
  (misal: NIM_NamaLengkap_Kelas), karena informasi tersebut belum diberikan saat pengerjaan.
