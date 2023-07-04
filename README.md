# Path Navigator

## Main Endpoint
- Auto Complete
- Get File Lines

# Install 
````
git clone https://github.com/abarakat4202/path-navigator.git
cd path-navigator
composer install
cp .env.example .env
cp .env.example .env.testing
php artisan serve
````

Go to [https://localhost:8000](https://localhost:8000)

# Postman Collection 
## Navigator
### GET 
[/api/navigator/auto-complete](#get-navigator-autocomplete)
### GET /api/navigator/auto-complete
Get path suggestions
**Request**
````
curl --location 'http://localhost:8000/api/navigator/auto-complete?file_path=..%2F' \
--header 'Accept: application/json' \
--header 'X-QUEEN-TECH-AUTHORIZATION: Xy56G3F8P4ymHkHspZQlQB6ngBHdJS27J7tdDXKI'
````

**Response**
````
[
    "../README.md",
    "../app",
    "../artisan",
    "../bootstrap",
    "../composer.json",
    "../composer.lock",
    "../config",
    "../database",
    "../node_modules",
    "../package-lock.json",
    "../package.json",
    "../phpunit.xml",
    "../public",
    "../resources",
    "../routes",
    "../storage",
    "../tests",
    "../vendor",
    "../vite.config.js"
]
````

[/api/navigator/file-lines](#get-navigator-file-lines)
### GET /api/navigator/file-lines
Get paginated file lines contents
**Request**
````
curl --location 'http://localhost:8000/api/navigator/file-lines?file_path=%2Fvar%2Flog&page=2&lines_number=null&=null' \
--header 'Accept: application/json' \
--header 'X-QUEEN-TECH-AUTHORIZATION: Xy56G3F8P4ymHkHspZQlQB6ngBHdJS27J7tdDXKI'
````

**Response**
````
{
    "current_page": 2,
    "data": {
        "11": "START TRANSACTION;\n",
        "12": "SET time_zone = \"+00:00\";\n",
        "13": "\n",
        "14": "\n",
        "15": "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n",
        "16": "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n",
        "17": "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n",
        "18": "/*!40101 SET NAMES utf8mb4 */;\n",
        "19": "\n",
        "20": "--\n"
    },
    "first_page_url": "http://localhost:8000/api/navigator/file-lines?page=1",
    "from": 11,
    "last_page": 44385,
    "last_page_url": "http://localhost:8000/api/navigator/file-lines?page=44385",
    "links": [
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=1",
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=1",
            "label": "1",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=2",
            "label": "2",
            "active": true
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=4",
            "label": "4",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=5",
            "label": "5",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=6",
            "label": "6",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=7",
            "label": "7",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=8",
            "label": "8",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=9",
            "label": "9",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=10",
            "label": "10",
            "active": false
        },
        {
            "url": null,
            "label": "...",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=44384",
            "label": "44384",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=44385",
            "label": "44385",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/navigator/file-lines?page=3",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://localhost:8000/api/navigator/file-lines?page=3",
    "path": "http://localhost:8000/api/navigator/file-lines",
    "per_page": 10,
    "prev_page_url": "http://localhost:8000/api/navigator/file-lines?page=1",
    "to": 20,
    "total": 443842
}
````