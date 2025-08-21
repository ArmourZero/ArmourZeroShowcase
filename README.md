# ArmourZero Showcase

**ArmourZero Showcase** is a demo environment that contains both **vulnerable** and **secure** versions of websites to show how **ArmourZero AVM (Automated Vulnerability Management)** works.

It includes examples of common web application vulnerabilities and demonstrates:

- How ArmourZero detects, assesses, and prioritizes them
- How ArmourZero AI helps fix them with remediation suggestions

---

## 🚀 Installation Guide

To run this showcase locally, install a web server stack like **XAMPP**, **MAMP**, or **Apache**.

### 🖥️ For Windows:

1. Download and install **XAMPP** [here](https://www.apachefriends.org/index.html).
2. Copy the entire project folder into `xampp/htdocs`.
3. Start Apache from the XAMPP control panel.
4. Open browser and visit:  
   `http://localhost/your-folder-name/`

### 🍎 For macOS:

1. Download and install **MAMP** [here](https://www.mamp.info/).
2. Copy the project into `mamp/htdocs`.
3. Start the MAMP server.
4. Visit:  
   `http://localhost:8888/your-folder-name/`

### 🐧 For Linux:

1. Start Apache:  
   `sudo systemctl start apache2`
2. Copy the project to:  
   `/var/www/html/`
3. Access via browser:  
   `http://localhost/your-folder-name/`

---

## 🧪 How to Use

1. Fork this repository.
2. Integrate it with your [ArmourZero Console](https://console.armourzero.com/).
3. Run scans to:
   - Detect vulnerabilities in real time
   - See how ArmourZero provides remediation using AI
4. Compare **vulnerable** and **secure** versions to understand the impact of insecure code.

---

# ⚠️ Vulnerability 1: Command Execution

### 🔎 Where?

- Source: `typeBox` parameter via `$_GET`

### 🛠️ Problem:

- Only filters a few characters (`&&`, `;`, `/`, `\`)
- Dangerous commands using `|`, `||`, backticks (\`) are still allowed
- Passes input directly to `shell_exec()` – very risky!

### 💥 Impact:

- Attacker can run system-level commands
- Could lead to:
  - File/system access
  - Full server compromise
  - Information theft

---

# ⚠️ Vulnerability 2: Cross-Site Scripting (XSS)

### 🔎 Where?

- Source: `username` parameter via `$_GET`

### 🛠️ Problem:

- Only removes the exact `<script>` string (case-sensitive)
- Does **not** escape or encode output

### 💥 Impact:

- Reflected XSS:
  - Cookie theft
  - Credential stealing
  - Phishing links
  - Session hijacking

---

# ⚠️ Vulnerability 3: Private Key Exposure

### 🔎 Where?

- A private key is accidentally exposed in the source code or downloadable file

### 🛠️ Problem:

- Keys (e.g., `.pem` or `.env`) should **never** be public
- Could happen if files are pushed to Git without `.gitignore`

### 💥 Impact:

- Attackers could impersonate your server
- Full compromise of secure connections (SSL/TLS)

---

# ⚠️ Vulnerability 4: PHPMailer Header Injection

### 🔎 Where?

- Source: Email input in vulnerable form using PHPMailer (old version)

### 🛠️ Problem:

- Email field not sanitized properly
- Allows line breaks (`%0A`) or new headers (e.g., `Bcc:`)

### 💥 Impact:

- Attacker can:
  - Add BCC to email and send to themselves
  - Abuse your email system for spam/phishing
  - Leak sensitive data silently

---

## ✅ How ArmourZero Helps

- **Detects** vulnerabilities like the ones above through scans
- **Shows impact** and how they can be exploited
- **Suggests AI-generated remediations**
- **Guides developers** on best security practices to fix issues

---

> This environment is for educational and testing purposes only.  
> Please **do not deploy to production** environments.

---
