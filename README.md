# Laravel 10 Microsec Project

Ez a Laravel 10 alapú projekt a Microsec beadandó feladatot valósítja meg. A projekt funkciói közé tartozik a felhasználói regisztráció, bejelentkezés, profil adatainak módosítása, valamint a felhasználói adatok JSON fájlban és adatbázisban történő tárolása.

## Követelmények

- PHP 8.1 vagy újabb verzió
- Composer
- Node.js és npm
- MySQL vagy más kompatibilis adatbázis

## Telepítési lépések

### 1. Klónozd a repót
Először klónozd a projekt repóját a gépedre:

```bash
git clone https://github.com/szycsaba/microsec.git
cd microsec
```
### 2. Composer csomagok telepítése
```bash
composer install
```
### 3. NPM csomagok telepítése
Telepítsd a front-end függőségeket:
```bash
npm install
```
### 4. Környezeti beállítások
Konfiguráld be a **.env** fájlt a saját adatbázis- és egyéb konfigurációd szerint
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adatbazis_nev
DB_USERNAME=adatbazis_felhasznalo
DB_PASSWORD=adatbazis_jelszo
```

### 5. Titkos kulcs generálása
```bash
php artisan key:generate
```

### 6. Adatbázis migrációk futtatása
```bash
php artisan migrate
```

### 7. Vite indítása (CSS és JavaScript build)
A Vite segítségével töltsd be és építsd meg a CSS és JavaScript fájlokat:
```bash
npm run dev
```

### 8. Az alkalmazás indítása
Futtasd az alkalmazást a Laravel beépített szerverén:
```bash
php artisan serve
```
Ezután a böngésződben megnyithatod az alkalmazást a következő címen:
```bash
http://127.0.0.1:8000
```

## Fő funkciók
- **Regisztráció**: A felhasználók regisztrálhatnak e-mail cím, becenév, születési dátum és jelszó megadásával. Az adatok egyszerre tárolódnak adatbázisban és JSON fájlban.
- **Bejelentkezés**: A regisztrált felhasználók bejelentkezhetnek az e-mail címük és jelszavuk használatával.
- **Profil frissítése**: A bejelentkezett felhasználók szerkeszthetik a profil adataikat, beleértve a becenevet, születési dátumot és jelszót.
- **Véletlenszerű adatforrás kiválasztása**: A felhasználói adatok véletlenszerűen kerülnek visszaolvasásra az adatbázisból vagy a JSON fájlból, ezzel szimulálva az adatforrás kimaradását.
- **JSON és adatbázis egyidejű frissítése**: A felhasználói adatok módosítása során mind az adatbázis, mind a JSON fájl frissül, biztosítva a szinkronizációt.

## Tesztek futtatása
A projekt tartalmaz feature teszteket. A tesztek futtatásához használd a következő parancsot:
```bash
php artisan test
```
## Hibakeresés
Ha bármilyen hibát tapasztalsz, ellenőrizd a **storage/logs/laravel.log** fájlt!

## Fontos fájlok és útvonalak
- **JSON fájl helye**: `storage/app/users.json`
- **Login útvonal**: `/login` – Bejelentkezési oldal.
- **Register útvonal**: `/register` – Regisztrációs oldal.
- **Profile szerkesztés útvonal**: `/profile/edit` – Profil szerkesztési oldal.

## Licensz
Ez a projekt nyílt forráskódú, és szabadon használható a saját igényeid szerint. A licensz típusa a **MIT License**, amely megengedi a szoftver szabad használatát, másolását, módosítását és terjesztését, amennyiben a szoftver eredeti licensze megmarad.
