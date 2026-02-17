# 📘 Projekt: Własny Facebook (PHP + MySQL + JS)

## 🎯 Cel projektu

Celem projektu jest stworzenie uproszczonej wersji Facebooka z:
- systemem użytkowników,
- tablicą postów (feed),
- lajkami i komentarzami,
- wyszukiwarką użytkowników,
- historią wyszukiwań,
- systemem znajomych.

Projekt będzie oparty na:
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Baza danych:** MySQL  

---

# 🧱 ETAP 1 — Projekt bazy danych

Najpierw tworzę bazę danych `myfacebook`.

## Tabele:

### 👤 users
Przechowuje dane użytkowników.

- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- username (VARCHAR)
- email (VARCHAR)
- password_hash (VARCHAR)
- avatar_url (VARCHAR)
- bio (TEXT)
- created_at (TIMESTAMP)

---

### 📝 posts
Przechowuje posty użytkowników.

- id (INT, AUTO_INCREMENT)
- user_id (INT, FOREIGN KEY)
- content (TEXT)
- image_url (VARCHAR)
- created_at (TIMESTAMP)
- likes_count (INT)

---

### 💬 comments
Komentarze pod postami.

- id
- post_id
- user_id
- content
- created_at

---

### 🤝 friends
Relacje między użytkownikami.

- id
- user_id
- friend_id
- status (pending / accepted)

---

### 🔎 search_history
Historia wyszukiwań użytkownika.

- id
- user_id
- query
- timestamp

---

# 🧠 ETAP 2 — Backend (PHP)

## Co będę robić:

### 1️⃣ Połączenie z bazą
Tworzę plik `db_connect.php` z PDO.

### 2️⃣ Rejestracja i logowanie
- haszowanie hasła (`password_hash`)
- sesje (`session_start()`)

### 3️⃣ Pobieranie postów
Plik `get_posts.php`:
- pobiera posty znajomych
- sortuje po `created_at DESC`
- zwraca dane jako JSON

### 4️⃣ Dodawanie posta
Plik `add_post.php`:
- zapisuje post do bazy
- przypisuje go do zalogowanego użytkownika

### 5️⃣ Lajki
Plik `like_post.php`:
- zwiększa `likes_count`
- aktualizuje bez przeładowania strony (AJAX)

---

# 🎨 ETAP 3 — Frontend

## 📌 Strona główna (Feed)

Zawiera:
- formularz dodawania posta
- listę postów
- przycisk „Lubię to”
- sekcję komentarzy

Posty generowane dynamicznie przez JavaScript.

---

## 👤 Profil użytkownika

Zawiera:
- zdjęcie w tle
- avatar
- bio
- lista postów użytkownika

---

## 🔎 Wyszukiwarka

### Jak działa:
1. Użytkownik wpisuje nazwę.
2. JS wysyła zapytanie do PHP.
3. PHP zapisuje frazę w `search_history`.
4. Pod polem wyszukiwania pokazują się ostatnie wyszukiwania.

Historia działa do momentu zakończenia sesji.

---

# ⚡ ETAP 4 — Interakcje (JavaScript)

Będę używać:
- `fetch()`
- manipulacji DOM
- event listenerów

### Funkcje:
- dynamiczne ładowanie postów
- lajki bez przeładowania
- komentarze bez refreshu
- live search (podpowiedzi podczas pisania)

---

# 🚀 ETAP 5 — Zaawansowane funkcje

Aby projekt wyglądał profesjonalnie:

## 🔔 System powiadomień
- ktoś polubił post
- ktoś wysłał zaproszenie

## 💬 Prosty Messenger
- AJAX polling
lub
- WebSocket (bardziej zaawansowane)

## ♾ Infinite Scroll
- ładowanie kolejnych postów przy przewijaniu

## 🖼 Upload zdjęć
- walidacja typu pliku
- ograniczenie rozmiaru
- kompresja

---

# 🛡 Bezpieczeństwo

Muszę pamiętać o:

- Prepared Statements (PDO)
- walidacji danych
- ochronie przed SQL Injection
- `htmlspecialchars()` przy wyświetlaniu danych
- sprawdzaniu sesji użytkownika

---

# 📂 Struktura plików

