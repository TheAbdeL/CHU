# CHU Internship Management System

## 📌 Project Overview
This project is a web application for managing internship requests at a CHU (Centre Hospitalier Universitaire).  
It allows **students** to send internship requests, and the **administration** (secretary, HR, chefs) to process and manage them.  

---

## 🚀 Features

### 🔹 Student
- Can **send a request** for an internship by filling out a form.
- Receives **login credentials via email** after submitting the request.
- On first login, the student must **change their password**.
- Can access their **personal and internship information** once logged in.

### 🔹 Chefs (3 users)
- Validate or refuse internship requests.
- Each chef must give their decision.
- The internship request is validated only if the approval process is completed.

### 🔹 Secretary
- Has read-only access.
- Can **view student information and requests**, but cannot modify anything.

### 🔹 Human Resources (HR)
- Can **modify student and internship information**.
- Can **send documents to students via email** (e.g., acceptance letters, internship agreements).

---

## 🏗️ Application Workflow
1. **Home Page**
   - Option 1: Send an internship request.
   - Option 2: Login.

2. **Student Request Phase**
   - Student fills out an internship request form.
   - The system creates a student account.
   - Login credentials are sent to the student by email.

3. **Login Phase**
   - Student logs in with the received credentials.
   - Student is required to change their password.
   - After login, the student sees their internship details.

4. **Administration Phase**
   - **Chefs**: Validate/refuse internship requests.
   - **Secretary**: Only views information (no modification).
   - **HR**: Modifies internship or student data, and sends official documents by email.

---

## ⚙️ Technologies
- **Backend:** PHP (with PHPMailer for sending emails)  
- **Database:** MySQL  
- **Frontend:** HTML, CSS, JavaScript  
- **Server:** XAMPP / Apache  

---

## 📬 Email Integration
- The system uses **PHPMailer** for sending emails:
  - Sending login credentials to students.
  - Sending documents from HR to students.
- Configurable with SMTP (e.g., Gmail, Outlook, or internal mail server).

---

## 👥 Roles Summary
| Role        | Permissions                                                                 |
|-------------|----------------------------------------------------------------------------|
| Student     | Request internship, login, view info                                       |
| Chef (x3)   | Validate or refuse internship requests                                     |
| Secretary   | View only (read access to student info)                                    |
| HR          | Modify info, send official documents to students via email                 |

---

## ▶️ How to Run the Project
1. Clone the project into `htdocs` (XAMPP).
2. Import the database from `database.sql`.
3. Configure `mail.php` with your SMTP settings.
4. Start Apache & MySQL from XAMPP.
5. Access the app at [http://localhost/CHU](http://localhost/CHU).

---

## 🔒 Authentication Notes
- Students receive **auto-generated credentials** via email after submitting the request form.
- On first login, students must **change their password** before accessing their profile.

---

## 🖥️ First Page (Index)
The first page of the application displays two options:

- **Send Internship Request**
- **Login**

Here is the HTML code for `index.php`:

```<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHU - Centre Hospitalier Universitaire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            width: 90%;
            margin: 20px;
        }

        .header {
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 50px 40px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .welcome-text h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #2c5aa0;
        }

        .welcome-text p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #666;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 40px;
        }

        @media (max-width: 600px) {
            .options {
                grid-template-columns: 1fr;
            }
        }

        .option-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: #2c5aa0;
        }

        .option-card .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            color: white;
        }

        .option-card h3 {
            font-size: 1.4em;
            margin-bottom: 15px;
            color: #2c5aa0;
        }

        .option-card p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .btn {
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 90, 160, 0.3);
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CHU</h1>
            <p>Centre Hospitalier Universitaire</p>
        </div>

        <div class="content">
            <div class="welcome-text">
                <h2>Bienvenue sur notre plateforme</h2>
                <p>Accédez aux services en ligne du CHU. Choisissez l'option qui correspond à vos besoins.</p>
            </div>

            <div class="options">
                <div class="option-card" onclick="handleStageRequest()">
                    <div class="icon">📋</div>
                    <h3>Demande de Stage</h3>
                    <p>Étudiants en médecine, soins infirmiers ou autres formations médicales, déposez votre demande de stage.</p>
                    <a href="#" class="btn" onclick="handleStageRequest(); return false;">Faire une demande</a>
                </div>

                <div class="option-card" onclick="handleAuthentication()">
                    <div class="icon">🔐</div>
                    <h3>Authentification</h3>
                    <p>Personnel médical et administratif, connectez-vous à votre espace personnel sécurisé.</p>
                    <a href="#" class="btn" onclick="handleAuthentication(); return false;">Se connecter</a>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; <span id="currentYear"></span> CHU - Centre Hospitalier Universitaire. Tous droits réservés.</p>
            <p>Pour toute assistance technique, contactez le service informatique.</p>
        </div>
    </div>

    <script>
        // Affichage de l'année courante
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Animation d'apparition au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                container.style.transition = 'all 0.8s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });

        // Effet de clic sur les cartes
        document.querySelectorAll('.option-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Animation de clic
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-5px)';
                }, 100);
            });
        });

        // Fonctions de navigation (remplacent les liens PHP)
        function handleStageRequest() {
            alert('Redirection vers la page de demande de stage...');
            // window.location.href = 'demande_stage.html';
        }

        function handleAuthentication() {
            alert('Redirection vers la page d\'authentification...');
            // window.location.href = 'authentification.html';
        }
    </script>
</body>
</html>
```


## 📄 Future Improvements
- Dashboard for statistics (number of requests, accepted, refused, pending).
- Multi-language support.
- Automatic generation of internship agreement PDF.
