# What is ArmourZeroShowcase
ArmourZeroShowcase is an environment of vulnerable and safe website to preview ArmourZero AVM capabilities. 
ArmourZeroShowcase includes sample of Command Execution & XSS, and showcases how ArmourZeroAVM helps identifies, assesses, and prioritises vulnerabilities. As well as its AI Remediation Features to help developers fix vulnerabilities in a short time.

# Installation Guide
If you want to run this tool, first of all you need to download web server solution like "xampp"- you can download xampp from Xampp. After your installation;

- For Windows you need to copy the files into the xampp/htdocs folder.

- For Mac Os you need to install mampp and copy the files into the mamp/htdocs folder. Mampp

- For Linux after download our files first you need to open apache server and copy the files to /var/www/html

# How to use
To test how the ArmourZero scanner works, simply fork this repository and integrate it into your ArmourZero Console. You'll be able to view real-time scans of the vulnerable web application along with the identified security issues.

The AI Remediations are applied on the secured version of the website, showcasing how ArmourZero AVM guides developers through fixing vulnerabilities effectively and securely.


# ⚠️ Vulnerability 1: Command Execution
🔍 Vulnerability Analysis
Input Source: typeBox parameter via $_GET
Sanitization: str_replace removes characters (&&, ;, /, \)
Flaw: Other dangerous characters like |, ||, and backticks are not filtered
Execution: Input is passed directly to shell_exec()

💥 Impact
An attacker can execute arbitrary shell commands on the server. This could result in:
- Unauthorized access
- Information disclosure
- Full system compromise

# 🐞 Vulnerability 2: Cross-Site Scripting (XSS)
🔍 Vulnerability Analysis
Input Source: username parameter via $_GET
Sanitization: Only removes exact <script> string
Flaw: Does not escape or encode output; filters are case-sensitive and incomplete

💥 Impact
This is a Reflected XSS vulnerability. An attacker can execute arbitrary JavaScript in the victim’s browser by tricking them into clicking a malicious link. Potential consequences include:
- Cookie theft
- Phishing redirects
- Keylogging
- Session hijacking
