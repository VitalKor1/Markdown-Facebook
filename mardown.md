# 🚀 Facebook – Nowoczesna Platforma Społecznościowa

## 📌 Koncepcja Projektu

FAebook to skalowalna aplikacja społecznościowa typu full-stack, umożliwiająca użytkownikom publikowanie treści, budowanie sieci znajomych oraz interakcję w czasie rzeczywistym. 

Projekt został zaprojektowany w architekturze warstwowej (3-tier architecture), co zapewnia:
- czytelny podział odpowiedzialności
- łatwą rozbudowę
- możliwość skalowania
- bezpieczeństwo danych
- modularność kodu

System opiera się na architekturze klient–serwer z REST API.

---

# 🏗️ Architektura Systemu

## 1️⃣ Warstwa prezentacji (Frontend)

Technologie:
- HTML5
- CSS3 (Flexbox / Grid)
- JavaScript (ES6+)
- Fetch API (komunikacja z backendem)

Odpowiedzialność:
- Renderowanie interfejsu użytkownika
- Dynamiczne ładowanie danych (AJAX)
- Obsługa interakcji użytkownika
- Aktualizacja widoku bez przeładowania strony (SPA-like behavior)

Frontend nie przechowuje logiki biznesowej – jedynie prezentuje dane pobrane z API.

---

## 2️⃣ Warstwa logiki aplikacji (Backend – PHP REST API)

Technologie:
- PHP 8+
- PDO (bezpieczne połączenie z bazą danych)
- JSON jako format komunikacji

Backend pełni rolę pośrednika między frontendem a bazą danych.

### Odpowiedzialność backendu:

- Autoryzacja i uwierzytelnianie użytkowników
- Walidacja danych wejściowych
- Obsługa logiki biznesowej
- Zarządzanie relacjami użytkowników
- Obsługa postów, komentarzy i polubień
- Zwracanie odpowiedzi w formacie JSON

Każda funkcjonalność systemu jest realizowana poprzez oddzielny endpoint API.

---

## 3️⃣ Warstwa danych (MySQL)

Relacyjna baza danych przechowuje dane użytkowników i ich aktywność.

### Główne encje systemu:

### 👤 Users
Reprezentuje konto użytkownika w systemie.

Relacje:
- 1:N z posts
- 1:N z comments
- N:N z users (relacja friends)

---

### 📝 Posts
Reprezentuje treści publikowane przez użytkowników.

Relacje:
- N:1 z users
- 1:N z comments

---

### 💬 Comments
Reprezentuje komentarze pod postami.

Relacje:
- N:1 z posts
- N:1 z users

---

### 🤝 Friends
Tabela relacyjna obsługująca relacje typu wiele-do-wielu między użytkownikami.

Status relacji:
- pending
- accepted
- rejected

---

### 🔎 Search History
Przechowuje historię wyszukiwań użytkownika w celu poprawy UX.

---

# 🔄 Przepływ Danych (Data Flow)

1. Użytkownik wykonuje akcję w interfejsie (np. dodaje post).
2. JavaScript wysyła zapytanie HTTP (POST/GET) do endpointu PHP.
3. Backend:
   - waliduje dane
   - wykonuje operację na bazie danych
   - zwraca odpowiedź JSON
4. Frontend aktualizuje widok dynamicznie.

Cały system działa asynchronicznie bez przeładowywania strony.

---

# 🔐 Bezpieczeństwo

- Hasła przechowywane jako `password_hash`
- Prepared statements (PDO)
- Walidacja danych po stronie serwera
- Ochrona przed SQL Injection
- Ograniczenie dostępu do endpointów (sesje / tokeny)

---

# 📁 Struktura Projektu

