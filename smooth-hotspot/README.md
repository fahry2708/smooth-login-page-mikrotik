# Smooth Hotspot

Template halaman Hotspot MikroTik (RouterOS 7) dan template voucher Mikhmon untuk **Smooth Broadband Internet**.
Modern, responsif (HP sampai desktop), tanpa framework dan tanpa CDN, jadi tetap jalan sebelum pelanggan login.

## Isi

```
smooth-hotspot/
├── hotspot/                      # Salin ke router (HTML Directory)
│   ├── login.html                # Login: tab Voucher, Member, Scan QR + daftar paket
│   ├── status.html               # Status koneksi
│   ├── alogin.html               # Loading setelah login berhasil
│   ├── logout.html
│   ├── flogout.html              # Konfirmasi logout
│   ├── error.html
│   ├── radvert.html
│   ├── redirect.html             # File sistem hotspot
│   ├── rlogin.html
│   ├── rstatus.html
│   ├── md5.js
│   ├── errors.txt                # Pesan error (Indonesia)
│   ├── errors-en.txt             # Pesan error (Inggris)
│   └── img/logo.png
└── voucher-mikhmon/              # Tempel ke Template Editor Mikhmon
    ├── voucher-template-smooth-a4.php       # Ringkas, 3 kolom per baris di A4
    └── voucher-template-smooth-modern.php   # Lebih besar, bergaya tiket
```

## Fitur login

- Mode **Voucher**: satu kolom kode, `username` dan `password` diisi kode yang sama.
- Mode **Member**: username dan password terpisah, ada tombol Show/Hide.
- Mode **Scan QR**: scan QR voucher dengan kamera bawaan HP, lalu langsung login.
  Halaman membaca link `.../login?username=X&password=Y` atau `?voucher=X` dan mengirimnya otomatis.
- Mendukung **HTTP-CHAP** (MD5 di dalam halaman, tanpa library) dan HTTP-PAP.
- Validasi input, tombol dikunci saat proses, dan pesan error MikroTik tampil di kotak merah.

## Pasang di RouterOS 7

1. Upload isi folder `hotspot/` ke router lewat **Files** (misalnya ke `Hotspot-new`), termasuk subfolder `img`.
2. Buka **IP → Hotspot → Server Profiles**, pilih profile yang dipakai, lalu isi **HTML Directory** dengan nama folder tadi.
   Penulisannya harus sama persis, termasuk huruf besar-kecil. Jika ada di dalam folder lain, tulis juga awalannya (misalnya `flash/Hotspot-new`).
3. Hapus cache browser HP (atau pakai incognito), putuskan WiFi, lalu sambungkan lagi.

## Pasang template voucher di Mikhmon

1. Buka Template Editor di Mikhmon.
2. Hapus isi template, lalu tempel isi salah satu file di `voucher-mikhmon/`. Simpan dengan nama baru.
3. Cetak. Di dialog print: **Scale 100%**, margin Default/Minimum, aktifkan **Background graphics**.
4. Agar login lewat QR berfungsi, aktifkan opsi **QR** saat generate voucher.

## Yang perlu disesuaikan

| Yang diubah | Di mana |
|---|---|
| Daftar harga paket | tabel di `hotspot/login.html` |
| Nomor WhatsApp CS | `hotspot/login.html`, `hotspot/radvert.html`, kedua file di `voucher-mikhmon/`. Cari `08XX.XXXX.XXXX` (teks) dan `628XXXXXXXXXX` (link `wa.me`, format 62 tanpa angka 0 di depan), lalu ganti dengan nomor Anda |
| Logo | ganti `hotspot/img/logo.png` (nama file harus tetap `logo.png`) |
| Warna | variabel CSS di bagian atas `<style>` tiap file (`--navy`, `--electric`, `--cyan`) |

## Catatan teknis

- **Jangan pakai `'use strict'` di script yang membaca `$(chap-id)`**. Nilai CHAP berisi escape oktal (misalnya `\245`), dan strict mode menolaknya, sehingga seluruh JavaScript halaman login mati.
- Variabel `$(...)` hanya diisi oleh MikroTik. Membuka file langsung di browser (atau lewat GitHub Pages) akan menampilkan teks `$(...)` mentah, jadi tampilan akhir hanya bisa dilihat dari router.
- Jika muncul **404** setelah upload, cek dulu path **HTML Directory** dan pastikan file sistem (`redirect.html`, `rlogin.html`, `rstatus.html`, `errors.txt`) ada di folder.
- Link WhatsApp (`wa.me`) baru bisa dibuka sebelum login jika `wa.me` dan `*.whatsapp.com` ditambahkan ke **Walled Garden**.
- File sistem (`redirect.html`, `rlogin.html`, `rstatus.html`, `errors*.txt`, `md5.js`) ditulis ulang mengikuti perilaku bawaan MikroTik. Jika ada yang tidak cocok, pakai file asli dari router Anda.

## Lisensi

Kode: [MIT](LICENSE). Logo dan merek Smooth Broadband Internet tidak termasuk dalam lisensi dan tidak boleh dipakai ulang tanpa izin.
