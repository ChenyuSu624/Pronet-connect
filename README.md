# PHP Project with AMPPS

## Overview
This project is a PHP web application running on the AMPPS stack. AMPPS provides an easy-to-use local development environment with Apache, MySQL, PHP, and other necessary tools.

## Prerequisites
Ensure you have the following installed on your system:

- [AMPPS](https://ampps.com/downloads)
- PHP (comes with AMPPS)
- MySQL (for database-driven applications)
- PowerShell (for command-line operations)

## Installation & Setup

### Step 1: Clone the Repository
If you have Git installed, you can clone this project:

```powershell
git clone https://github.com/your-username/my_php_project.git
cd my_php_project
```

Alternatively, you can manually download the project and place it in the `www` directory of AMPPS.

### Step 2: Move the Project to AMPPS `www` Directory
If the project is not already inside `www`, move it:

```powershell
Move-Item -Path my_php_project -Destination "C:\Program Files (x86)\Ampps\www\"
cd "C:\Program Files (x86)\Ampps\www\my_php_project"
```

### Step 3: Start Apache & MySQL
- Open **AMPPS Control Panel**
- Start **Apache** and **MySQL**

### Step 4: Run the Project
Open a web browser and visit:
```
http://localhost/my_php_project/
```

## Running the Project After Cloning
If you clone the project later and need to run it:
1. Move the project to `www` if necessary.
2. Start **Apache** and **MySQL** via AMPPS.
3. Open your browser and visit:
   ```
   http://localhost/my_php_project/
   ```

## License
This project is open-source. Feel free to modify and use it as needed.

## Author
Chenyu Su
