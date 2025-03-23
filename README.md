# Projekta instalācija

1. Uzinstalējiet docker un docker-compose
2. Uzinstalējiet composer globāli
3. Noklonējiet šo repozitoriju
4. Pārējiet uz mapi, kur ir šis fails
5. Terminālī izpildiet komandas:
- **docker-compose up -d**
- **composer install**
- **composer dump-autoload**
6. Ieejiet jauizveidotajā app konteinerī un izpildiet komandas:
- **php artisan migrate**
- **php artisan db:seed** 
7. Pārlūkā dodieties uz http://localhost, piereģistrējieties un notestējiet sistēmu
8. Izveidoto kodu pēc jetstream instalācijas var apskatīties šeit https://github.com/valerijskrizevics/adminpanel/pull/1
