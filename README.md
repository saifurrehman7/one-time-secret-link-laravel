# 🔐 Secure Secret Link

A Laravel application for securely sharing sensitive information using one-time, expiring links.  
Secrets are encrypted, destroyed after first access (burn-after-read), and can optionally be delivered via email to a configured helpdesk.

---

## ✨ Key Features

- One-time secret sharing (burn-after-read)
- Encrypted secret handling
- Expiring access links
- Optional helpdesk email delivery
- No persistent exposure of sensitive data

---

## 🛠 Tech Stack

- Backend: Laravel
- Frontend: Blade, Bootstrap, JavaScript, AJAX
- Email: Laravel Mail
- Security: AES Encryption
- Database: MySQL

---

## 🔄 How It Works

1. User enters sensitive information.
2. Data is encrypted and stored securely.
3. A one-time secret link is generated and copied.
4. The link is shared with the intended recipient.
5. On first access, the secret is displayed once and permanently destroyed.
6. Optionally, the secret is sent to a helpdesk email.

---

## ⚙️ Installation

```bash
git clone https://github.com/saifurrehman7/one-time-secret-link-laravel.git
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

## 👨‍💻 Author

Saif Ur Rehman  
Senior Software Engineer
saifrehman.developer@gmail.com
