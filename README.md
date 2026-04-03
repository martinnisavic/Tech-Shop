# Tech-Shop - E-Commerce Aplikacija

**Profesionalna e-commerce platforma za prodaju kompjuterske opreme i tehnike.**

---

## 📋 Sadržaj

- [Opis Projekta](#-opis-projekta)
- [Tehnologije](#-tehnologije)
- [Instalacija](#-instalacija)
- [Struktura Projekta](#-struktura-projekta)
- [Funkcionalnosti](#-funkcionalnosti)
- [Baza Podataka](#-baza-podataka)
- [Korisničke Role](#-korisničke-role)
- [API Endpoints](#-api-endpoints)
- [Validacija](#-validacija)
- [Sigurnost](#-sigurnost)
- [Troubleshooting](#-troubleshooting)

---

## 🎯 Opis Projekta

**Tech-Shop** je moderna e-commerce aplikacija razvijena u PHP-u koja omogućava:
- Registraciju i prijavu korisnika sa verifikacijom email-a
- Pregled i kupovinu proizvoda (kompjuteri, laptopi, mobilni telefoni, itd.)
- Upravljanje korinom za kupovinu
- Praćenje narudžbina i profila
- Admin panel za upravljanje proizvodima i korisnicima

Aplikacija je dizajnirana sa fokusom na **usability**, **sigurnost** i **responsivnost**.

---

## 🛠️ Tehnologije

### Backend
- **PHP 7.x+** - Server-side scripting
- **MySQL/MariaDB** - Relacijska baza podataka
- **PDO** - PHP Data Objects za sigurnu konekciju
- **PHPMailer** - Email servisa za slanje verifikacionih linkova
- **Sessions** - Upravljanje sesijama i autentifikacijom

### Frontend
- **HTML5** - Semantička struktura
- **CSS3** - Responsive styling
- **Vanilla JavaScript** - Client-side interakcije
- **Bootstrap 5** - CSS framework
- **Moduli (ES6)** - Organizovan JavaScript kod

### Alati
- **XAMPP** - Lokalni development server
- **Composer** - PHP package manager (za PHPMailer)

---

## ⚙️ Instalacija

### Preduslov
- XAMPP instaliran i pokrenut
- MySQL server aktiviran
- PHP verzija 7.0+

### Koraci

1. **Kloniranje projekta**
   ```bash
   git clone <repository-url> Tech-Shop
   cd Tech-Shop
   ```

2. **Kreirajte bazu podataka**
   ```sql
   CREATE DATABASE `tech-shop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Importujte datoteke baze**
   - Otvorite phpMyAdmin na `http://localhost/phpmyadmin`
   - Izaberite bazu `tech-shop`
   - Importujte SQL datoteke iz `database/` foldera

4. **Konfiguracija konekcije**
   
   Proverite [konekcija/konekcija.php](konekcija/konekcija.php):
   ```php
   $username = "root";
   $password = "";
   $db = new PDO("mysql:host=localhost;dbname=tech-shop", $username, $password);
   ```

5. **PHPMailer konfiguracija**
   
   Proverite [funkcijePhp/registerObrada.php](funkcijePhp/registerObrada.php) za email setupe:
   ```php
   $mail->Host       = 'smtp.gmail.com';
   $mail->SMTPAuth   = true;
   $mail->Username   = 'vasa.email@gmail.com';
   $mail->Password   = 'app-password';
   ```

6. **Pokretanje aplikacije**
   - Umestite folder u `C:\xampp\htdocs\Projekti\`
   - Pristupite na `http://localhost/Projekti/Tech-Shop/`

---

## 📁 Struktura Projekta

```
Tech-Shop/
│
├── index.php                 # Glavna tačka unosa (MVC kontroler)
│
├── konekcija/
│   └── konekcija.php        # MySQL konekcija via PDO
│
├── funkcijePhp/             # Backend logika
│   ├── LogInProvera.php     # Login autentifikacija
│   ├── registerObrada.php   # Registracija sa email validacijom
│   ├── addToCart.php        # Dodaj proizvod u korpu
│   ├── removeFromCart.php   # Ukloni proizvod iz korpe
│   ├── editObrada.php       # Editovanje profila
│   └── provera.php          # Generalna validacija
│
├── views/                   # HTML template-i
│   ├── head.php            # <head> sekcija
│   ├── nav.php             # Navigacijski meni
│   ├── footer.php          # Footer
│   ├── login.php           # Login forma
│   ├── register.php        # Registracijska forma
│   ├── shop.php            # Prikaz proizvoda
│   ├── product_card_info.php # Detaljni prikaz proizvoda
│   ├── cart.php            # Korpa za kupovinu
│   ├── buy.php             # Checkout stranica
│   ├── profil.php          # Korisnički profil
│   ├── edit_profile.php    # Editovanje profila
│   ├── about.php           # O nama stranica
│   ├── verifikacija.php    # Email verifikacija
│   └── logout.php          # Logout process
│
├── assets/                 # Frontend resursi
│   ├── style.css           # Glavna CSS datoteka
│   ├── main.js             # Glavni JavaScript
│   ├── logIn.js            # Login logika
│   ├── register.js         # Registracija logika
│   ├── functions.js        # Utility funkcije
│   │
│   └── css/               # Modularni CSS
│       ├── footer.css
│       ├── first_div.css
│       ├── login.css
│       ├── register.css
│       ├── new_arrivals.css
│       ├── add_div.css
│       ├── product_card_info.css
│       └── author.css
│
│   └── img/              # Slike proizvoda
│       ├── acer/
│       ├── apple/
│       ├── asus/
│       ├── dell/
│       └── ReklamneSlike/
│
├── phpmailer/             # PHPMailer biblioteka
│   ├── PHPMailer.php
│   ├── SMTP.php
│   ├── Exception.php
│   └── language/          # Lokalizuje poruke
│
└── README.md             # Ovaj fajl
```

---

## ✨ Funkcionalnosti

### 🔐 Autentifikacija

#### 1. Registracija
- **Validacija:**
  - Email: `[\S]{3,20}@(gmail|yahoo|outlook)\.com`
  - Lozinka: Min 8 karaktera, least 1 OVO, 1 malo slovo, 1 broj, 1 specijalni karakter
  - Username: 8-25 karaktera, brojevi i separatori
  - Telefon: Srpski format +381 ili 06x
  
- **Proces:**
  - Validacija na frontend-u (JavaScript)
  - Ponovljena validacija na backend-u
  - Šifrovanje lozinke sa `password_hash()`
  - Slanje verifikacionog email-a
  - Korisnik je inicijalno neaktivan (`is_active=0`)

#### 2. Login
- Email i Lozinka validacija
- Provera da li je korisnik aktivan (`is_active=1`)
- Session-based autentifikacija
- Čuvanje u sesiji: `userID`, `username`, `role`
- Password verification sa `password_verify()`

#### 3. Email Verifikacija
- PHPMailer sa Gmail SMTP
- Slanje validacijskog tokena
- Klik na link aktivira nalog
- Sigurnosni timeout na tokenu

---

### 🛍️ Shopping System

#### Prikaz Proizvoda
- **SQL:**
  ```sql
  SELECT p.id, p.name, p.description, p.price, i.src, i.alt
  FROM products p
  LEFT JOIN images i ON p.id = i.productId AND i.`shop-prikaz`=1
  ```
- Proizvodi sa više slika
- Responsive grid layout

#### Korpa (Cart)
- **Čuvanje:** PHP Sessions `$_SESSION['cart']`
- **Struktura:** `['product_id' => quantity]`
- **Operacije:**
  - Dodaj proizvod: `addToCart.php`
  - Ukloni proizvod: `removeFromCart.php`
  - Prikaz ukupne cene
  - Modifikovanje količine

#### Checkout
- Prikupljanje podataka za dostavu
- Pregled narudžbine
- Kreiranje porudžbine u bazi

---

### 👤 Korisnički Profil

- **Pregled profila:**
  - Lični podaci
  - Email
  - Telefon
  - Adresa

- **Editovanje:**
  - Ime i prezime
  - Telefon
  - Firma
  - AJAX update bez osvežavanja stranice

- **Admin panel:**
  - Pregled svih korisnika
  - Pregled svih narudžbina
  - Toggle prikaza

---

## 🗄️ Baza Podataka

### Tabele

#### `user` (Korisnici)
```sql
CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(25) UNIQUE NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL (hashed),
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `telefon` VARCHAR(20) NOT NULL,
  `pol` VARCHAR(10),
  `grad` VARCHAR(50),
  `firma` VARCHAR(100),
  `role` ENUM('user', 'admin') DEFAULT 'user',
  `is_active` BOOLEAN DEFAULT 0,
  `verification_token` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### `products` (Proizvodi)
```sql
CREATE TABLE `products` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10,2) NOT NULL,
  `category` VARCHAR(50),
  `stock` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### `images` (Slike proizvoda)
```sql
CREATE TABLE `images` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `productId` INT NOT NULL,
  `src` VARCHAR(255) NOT NULL,
  `alt` VARCHAR(100),
  `shop-prikaz` BOOLEAN DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (productId) REFERENCES products(id) ON DELETE CASCADE
);
```

#### `orders` (Narudžbine)
```sql
CREATE TABLE `orders` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `total_price` DECIMAL(10,2) NOT NULL,
  `status` ENUM('pending', 'processing', 'shipped', 'delivered') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (userId) REFERENCES user(id) ON DELETE CASCADE
);
```

#### `order_items` (Stavke narudžbine)
```sql
CREATE TABLE `order_items` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `orderId` INT NOT NULL,
  `productId` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (orderId) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (productId) REFERENCES products(id)
);
```

---

## 👥 Korisničke Role

### 1. **Admin**
- Pristup admin panelu
- Upravljanje proizvodima (Add/Edit/Delete)
- Pregled svih korisnika
- Pregled svih narudžbina
- Upravljanje narudžbinama (status update)

### 2. **Obični Korisnik**
- Pregled proizvoda
- Shopping
- Upravljanje sopstvenim profilom
- Pregled sopstvenih narudžbina
- Editovanje podataka

---

## 🔌 API Endpoints

### Autentifikacija

#### `POST /funkcijePhp/LogInProvera.php`
**Zahtev:**
```json
{
  "email": "korisnik@gmail.com",
  "password": "SecurePass123!"
}
```
**Odgovor (200):**
```json
{
  "status": "200",
  "message": "Uspešan login!"
}
```
**Odgovor (401):**
```json
{
  "status": "401",
  "message": "Neispravna lozinka"
}
```

#### `POST /funkcijePhp/registerObrada.php`
**Zahtev:**
```json
{
  "username": "novi_korisnik",
  "email": "korisnik@gmail.com",
  "password": "SecurePass123!",
  "password_confirm": "SecurePass123!",
  "telefon": "+381601234567",
  "ime": "Marko",
  "prezime": "Marković",
  "pol": "M",
  "grad": "Beograd"
}
```
**Odgovor (422):**
```json
{
  "status": "422",
  "message": "Greška sa validacijom",
  "errors": {
    "email": "Email je u lošem formatu"
  }
}
```

### Shopping

#### `GET /funkcijePhp/addToCart.php?productToCartId=5`
- Dodaje proizvod u sesiju
- Povećava količinu ako već postoji

#### `GET /funkcijePhp/removeFromCart.php?id=5`
- Uklanja proizvod iz korpe

### Profil

#### `POST /funkcijePhp/editObrada.php`
**Zahtev:**
```json
{
  "ime": "Novo Ime",
  "prezime": "Novo Prezime",
  "telefon": "+381601234567",
  "firma": "MojaPoslovna"
}
```

---

## ✔️ Validacija

### Frontend (JavaScript)
- **Login/Register:** Real-time validacija
- **File:** [assets/register.js](assets/register.js), [assets/logIn.js](assets/logIn.js)

### Backend (PHP)

#### Regex Izrazi

**Email:**
```php
'/^[\S]{3,20}@(gmail|yahoo|outlook)\.com$/'
```

**Lozinka:**
```php
'/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*()-\+]).{8,}$/'
```

**Username:**
```php
'/^[\S]{8,25}$/'
```

**Telefon (srpski):**
```php
'/^((\+381)6\d\s\d{2}\s\d{2}\s\d{3}|(06)\d\s\d{2}\s\d{2}\s\d{3}|(06)\d-\d{2}-\d{2}-\d{3})$/'
```

**Ime/Prezime:**
```php
'/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20}|-[A-ZČĆŽŠĐ][a-zčćžšđ]{1,20})?$/'
```

---

## 🔒 Sigurnost

### 1. **Lozinke**
- Heširanje: `password_hash()` (bcrypt)
- Verifikacija: `password_verify()`
- Minimalno 8 karaktera
- Obavezna kompleksnost

### 2. **SQL Injection Zaštita**
```php
// PDO prepared statements
$stmt = $db->prepare($query);
$stmt->execute($params);
```

### 3. **XSS Zaštita**
```php
echo htmlspecialchars($korisnickoUnos);
```

### 4. **Sessions**
```php
session_start(); // Na početku svakog fajla
```

### 5. **CSRF Protection** (Preporuka)
- Koristiti CSRF tokene za forme
- Validacija referrera

### 6. **Email Verifikacija**
- Token-based aktivacija
- Timeout na tokenu
- Sprečava fake email-e

### 7. **HTTPS** (Production)
- Svi linkovi preko HTTPS
- Secure cookies

---

## 🐛 Troubleshooting

### Problem: "Greška sa konekcijom"
**Rešenje:**
1. Proverite da li je MySQL pokrenut
2. Proverite kredencijale u [konekcija/konekcija.php](konekcija/konekcija.php)
3. Proverite da li baza `tech-shop` postoji

### Problem: Email se ne šalje
**Rešenje:**
1. Proverite Gmail app password (ne normalna lozinka)
2. Omogućite "Less secure app access"
3. Proverite SMTP port (obično 587)
4. Proverite error log

### Problem: "Email je u lošem formatu"
**Rešenje:**
- Email mora biti sa `.com` domenama (gmail, yahoo, outlook)
- ICT zadržava samo `ict.edu.rs`
- Primer: `korisnik@gmail.com` ✓

### Problem: Proizvodi se ne prikazuju
**Rešenje:**
1. Proverite da li ste ubacili podatke u `products` tabelu
2. Proverite da imaju slike sa `shop-prikaz=1` u `images` tabeli
3. Proverite SQL query u [views/shop.php](views/shop.php)

### Problem: Korpa se gubi nakon osvežavanja
**Rešenje:**
- Sessions su čuvane na serveru
- Ako vam se korpa gubi, proverite `session.gc_maxlifetime` u `php.ini`
- Povećajte vrednost ako je niska

### Problem: Admin panel nije dostupan
**Rešenje:**
1. Proverite da li je vaš `role='admin'` u bazi
2. UPDATE korisnika u PHPMyAdmin:
   ```sql
   UPDATE user SET role='admin' WHERE id=1;
   ```

---

## 📝 Napomene za Razvoj

### Dodavanje Nove Stranice

1. Kreirajte PHP datoteku u `views/` folderu
2. U `index.php` dodajte case statement:
   ```php
   case 'nova_stranica.php':
       require_once("views/nova_stranica.php");
       break;
   ```
3. Pristupite preko: `index.php?stranica=nova_stranica.php`

### Dodavanje Novog Proizvoda

```sql
INSERT INTO products (name, description, price, category, stock) 
VALUES ('Novi Proizvod', 'Opis', 9999.99, 'Kategorija', 10);
```

Zatim dodajte slike:
```sql
INSERT INTO images (productId, src, alt, shop-prikaz) 
VALUES (LAST_INSERT_ID(), 'assets/img/proizvod.jpg', 'Opis slike', 1);
```

### Customizacija CSS

Sve CSS datoteke su modularizovane u `assets/css/` folderu. Importovane su u [assets/style.css](assets/style.css).

---

## 📞 Kontakt i Podrška

- **Email:** support@techshop.rs
- **Issues:** [GitHub Issues Link]
- **Dokumentacija:** Pogledajte kod za detalje

---

## 📄 Licenca

MIT Licenca - Slobodno koristite, modifikujte i distribuirajte

---

## 🚀 Future Roadmap

- [ ] Payment gateway integracija (Stripe/PayPal)
- [ ] SMS notifikacije za narudžbine
- [ ] Real-time inventory management
- [ ] Product reviews i ratings
- [ ] Discount codes sistem
- [ ] Email newsletter
- [ ] Mobile aplikacija
- [ ] Advanced search i filtering
- [ ] Abandoned cart reminder emaili
- [ ] Multi-language support

---

**Poslednja ažuriranja:** april 2026  
**Verzija:** 1.0.0

