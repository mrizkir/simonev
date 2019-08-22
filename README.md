# SIMONEV
Sistem Informasi Monitoring dan Evaluasi Pembangunan Daerah
## INSTALASI
### JAVASCRIPT
Themes yang digunakan oleh SIMONEV adalah DORE. Javascript gagal me-load file theme css karena DORE menggunakan relative path, 
oleh karena itu ganti menjadi path statis di baris ke 100 pada file "script.js".
```
  loadStyle("http://localhost/simonev/public/css/" + theme, onStyleComplete);
```
