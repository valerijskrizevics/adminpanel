# Projekta instalācija

1. Uzinstalējiet docker un docker-compose
2. Uzinstalējiet composer globāli
3. Noklonējiet šo repozitoriju
4. Pārējiet uz mapi, kur ir šis fails
5. Pārējiet uz apakšmapi **laradock** un termināli izpildiet komandu:
- **docker-compose up -d nginx mysql workspace**
6. Atzriezieties mapē kur ir šis README. Terminālī izpildiet komandas:
- **composer install**
- **composer dump-autoload**
7. Ieejiet jauizveidotajā **workspace** konteinerī un izpildiet komandas:
- **php artisan migrate**
- **php artisan db:seed** 
8. Pārlūkā dodieties uz http://localhost, piereģistrējieties un notestējiet sistēmu
9. Izveidoto kodu pēc jetstream instalācijas var apskatīties šeit https://github.com/valerijskrizevics/adminpanel/pull/9