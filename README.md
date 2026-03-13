# <img src="https://raw.githubusercontent.com/TheSourav-001/DIU-Hub/main/public/favicon.ico" width="48" align="center" /> DIU-Hub - Academic Resource Sharing Platform

<div align="center">

[![Visitors](https://api.visitorbadge.io/api/visitors?path=TheSourav-001%2FDIU-Hub&labelColor=%234F46E5&countColor=%237C3AED&style=flat-square)](https://visitorbadge.io/status?path=TheSourav-001%2FDIU-Hub)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.2-777bb4?style=flat-square&logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat-square&logo=mysql)](https://www.mysql.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

<img src="https://readme-typing-svg.herokuapp.com?font=Plus+Jakarta+Sans&weight=700&size=24&pause=1000&color=4F46E5&center=true&vCenter=true&width=500&lines=Academic+Resource+Sharing;Knowledge+Exchange;Lecture+Notes+%26+Guides;Empowering+DIU+Students" alt="Typing SVG" />

</div>

---

## 🌟 Overview

**DIU-Hub** is a state-of-the-art, feature-rich academic platform designed for the **Daffodil International University (DIU)** community. It bridges the gap between students and peer-shared learning materials, using a centralized repository for lecture notes, question banks, and course resources.

![Project Banner](https://via.placeholder.com/1200x400/4F46E5/FFFFFF?text=DIU-Hub+-+Academic+Resource+Sharing)

### 🔴 The Problem
Students often struggle to find organized, course-specific study materials, relying on scattered social media groups or outdated physical copies which are difficult to search through.

### 🟢 The Solution (DIU-Hub)
A centralized, secure, and real-time portal that organizes academic reports, verifies content through admin moderation, and rewards contributors through a premium-grade user experience.

---

## 🚀 Key Features

| | Feature | Description |
|---|---|---|
| 📦 | **Resource Management** | Advanced uploading with drag-and-drop support, categories, and real-time scannability. |
| 🔍 | **Smart Search** | Powerful filtering by Course Code, Department, and Faculty with instant results. |
| 🏆 | **Leaderboard** | "Top Contributors" tracking that rewards active sharers with community recognition. |
| 🛡️ | **Enterprise Security** | Built on Laravel 11 with signed download URLs, CSRF protection, and Rate Limiting. |
| 🔔 | **Smart Alerts** | Real-time notifications for system updates, approvals, and resource requests. |
| 🔖 | **Bookmarks** | Save your most-needed study materials to your personal dashboard for quick access. |

---

## 🖼️ System Preview

<div align="center">

| Dashboard Insights | Mobile Experience |
| --- | --- |
| ![Dashboard](https://via.placeholder.com/800x600/4F46E5/FFFFFF?text=Dashboard+Preview) | <img src="https://via.placeholder.com/280x600/4F46E5/FFFFFF?text=Mobile+UI" width="280"> |

</div>

---

## 🏗️ Architecture

DIU-Hub follows a robust **Model-View-Controller (MVC)** architectural pattern using the **TALL Stack** for a reactive and scalable experience.

```mermaid
flowchart TD
    A[Student Browser] -->|HTTP Request| B[Vite / Web Server]
    B -->|Route Handling| C[Laravel 11 Controller]

C -->|Fetch / Save Data| D[Eloquent Model]
D -->|SQL Queries| E[(MySQL Database)]

C -->|Render Dynamic UI| F[Blade Views + Alpine.js]
F -->|Responsive HTML| A

subgraph Security Layer
G[Signed URLs / Download Guard]
H[CSRF Protection]
I[Rate Limiter]
J[Secure Session (Breeze)]
end

C -. Security Checks .-> G
C -. Security Checks .-> H
C -. Security Checks .-> I
C -. Security Checks .-> J
```

---

## 📊 Visual Documentation

### 🗄️ Database ER Diagram
```mermaid
erDiagram
    USERS ||--o{ RESOURCES : uploads
    USERS ||--o{ BOOKMARKS : saves
    USERS ||--o{ DOWNLOADS : performs
    USERS ||--o{ RATINGS : gives
    USERS ||--o{ NOTIFICATIONS : receives
    USERS ||--o{ RESOURCE_REQUESTS : makes
    DEPARTMENTS ||--o{ COURSES : contains
    DEPARTMENTS ||--o{ RESOURCES : classifies
    COURSES ||--o{ RESOURCES : categorizes
    RESOURCES ||--o{ TAGS : has_many
    RESOURCES ||--o{ RATINGS : receives

    USERS {
        int id PK
        string name
        string email
        string student_id
        int points
    }
    RESOURCES {
        int id PK
        int user_id FK
        string title
        string file_path
        string type
        int department_id FK
        string status
    }
    RESOURCE_REQUESTS {
        int id PK
        int user_id FK
        string title
        string description
        string status
    }
```

### 🛣️ User Flow
```mermaid
graph LR
    Start((Start)) --> Landing[Home Page]
    Landing --> Auth{Authenticated?}
    Auth -- No --> Register[Register / Login]
    Auth -- Yes --> Dash[Student Dashboard]
    Register --> Dash
    Dash --> Upload[Upload Resource]
    Dash --> Search[Explore Materials]
    Dash --> Request[Request Resource]
    Search --> Download[Signed Download]
    Search --> Bookmark[Save to Library]
```

### 🔁 Resource Approval Process
```mermaid
stateDiagram-v2
    [*] --> Uploading
    Uploading --> PendingApproval: Initial Upload
    PendingApproval --> active: Admin Approved
    PendingApproval --> Rejected: Violated Guidelines
    active --> Downloadable: Available for Students
    active --> Archived: Outdated Material
    Rejected --> [*]: Resource Deleted
```

### 🔐 Secure Download Flow
```mermaid
sequenceDiagram
    participant S as Student
    participant C as Controller
    participant M as Middleware_Signed
    participant F as File Storage

    S->>C: Click Download
    C->>C: Generate Temporarily Signed URL
    C-->>S: Redirect with Signature
    S->>M: Request with Signature
    M-->>C: Signature Valid
    C->>F: Fetch Protected File
    F-->>S: Secure File Stream
```

---

## 🛡️ Security Hardening

- **CSRF Protection**: Native Laravel tokens for all state-changing interactions.
- **Signed URLs**: Downloads are protected with time-limited signed signatures to prevent direct linking.
- **Rate Limiting**: Integrated anti-spam mechanisms for uploads and requests (Throttle middleware).
- **Secure Sessions**: HTTP-Only and SameSite cookie policies via Laravel Session layer.
- **XSS Prevention**: Automated Blade output encoding.
- **SQLi Protection**: Full abstraction via Eloquent ORM and Query Builder.

---

## 🛠️ Installation Guide

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer & NPM

### Setup Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/TheSourav-001/DIU-Hub.git
   ```
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```
3. **Environment Setup**:
   - Copy `.env.example` to `.env`.
   - Configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.
   ```bash
   php artisan key:generate
   ```
4. **Database Migration**:
   ```bash
   php artisan migrate --seed
   ```
5. **Compile Assets & Launch**:
   ```bash
   npm run dev
   # Open another terminal
   php artisan serve
   ```

---

## 👨‍💻 Developed By

**Sourav Dipto Apu**  
*Full-Stack Developer & UI/UX Enthusiast*

[![LinkedIn](https://img.shields.io/badge/LinkedIn-Profile-blue?style=flat-square&logo=linkedin)](https://linkedin.com/in/thesourav)
[![Github](https://img.shields.io/badge/GitHub-Profile-black?style=flat-square&logo=github)](https://github.com/TheSourav-001)

---
<div align="center">
  <sub>Built with ❤️ for the DIU Community</sub>
</div>
