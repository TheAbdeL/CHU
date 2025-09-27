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


## 📄 Future Improvements
- Dashboard for statistics (number of requests, accepted, refused, pending).
- Multi-language support.
- Automatic generation of internship agreement PDF.
