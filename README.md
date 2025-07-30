# Split Bill App

A Laravel web application that helps users **split bills between friends**. You can create bills (e.g., trips, dinners), assign friends, track who paid and who owes how much — all through a clean and responsive interface.

---

## 🚀 Features

- ✅ Create and manage bills
- 👥 Add multiple friends per bill
- 💸 Assign who paid and who shared
- 📊 View how much each person owes
- 🎨 Clean UI using Bootstrap/Tailwind
- 🔒 Server-side validation with user-friendly error messages

---

## 🛠️ Tech Stack

- **Laravel 11**
- **PHP 8+**
- **MySQL**
- **Bootstrap 5 / Tailwind CSS**
- **JavaScript**

---

## ⚙️ Installation

Follow the steps below to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/split-bill-app.git
   cd split-bill-app
````

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Set up the environment file**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your database** in the `.env` file:

   ```
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

5. **Run migrations**

   ```bash
   php artisan migrate
   ```

6. **Serve the app**

   ```bash
   php artisan serve
   ```

   The app will be available at [http://localhost:8000](http://localhost:8000)

---

## 📸 Screenshots

*You can add screenshots of your app here.*

---

## 🙋‍♀️ Author

**Anjana George**
GitHub: [@your-username](https://github.com/your-username)

---

## 🤖 AI Assistance Disclosure

Some parts of this project were developed with the help of AI tools  to:

- Assist in writing logic for bill calculations.
- Suggest improvements to the UI/UX using Bootstrap and Tailwind.
- Refactor validation logic and enhance user feedback.
- Format and polish this `README.md`.

All AI-generated suggestions were fully understood, reviewed, and adapted by me to meet the project’s requirements. The final implementation reflects my own learning, decisions, and development effort.

## 📄 License

This project is licensed under the [MIT License](LICENSE).


