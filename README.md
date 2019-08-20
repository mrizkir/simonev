# SIMONEV (SISTEM INFORMASI MONITORING DAN EVALUASI)
Sistem Informasi Monitoring dan Evaluasi Pembangunan Daerah
## INSTALASI
### JAVASCRIPT
Themes yang digunakan oleh SIMONEV adalah DORE. Javascript gagal me-load file theme css karena DORE menggunakan relative path, 
oleh karena itu ganti menjadi path statis di baris ke 100.
```
  loadStyle("http://localhost/simonev/public/css/" + theme, onStyleComplete);
```
