
# Test Project For Laravel Dev 

This project is about CRUD for Category and Products.
This is also contain validations and product view through slug.


-Implemented an event listener which will do 2 things when any new Product is inserted successfully:
1. create an entry into a Laravel log . Show product created with name and time in the log.
2. Add the product info into a Laravel queue for PDF creation as follows:

-Implemented Laravel Queue feature which will create simple PDF file on server for each product inserted, with basic info like Name, Description, category name, price. 



## Setup
Clone the project repository and install composer if you haven't then run below commands for migration and seeding data.

php artisan migrate

php artisan db:seed

php artisan serve

## Endpoints

Created Resource routes for Category and Products.
You can directly use http://127.0.0.1:8000/products and http://127.0.0.1:8000/categories .

## Logs and PDF

Logs can be found at "\storage\logs" followed by product-create-YYYY-mm-dd.log
PDF can be found at "\public\storage\pdfs" followed by Produc Name.pdf

