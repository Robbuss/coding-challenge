# Assignment 
Create a backend application to multiply the matrix with very basic front-end should allow entering and
validating the two matrices and output the result in a readable format described below.

Validation
For Matrix multiplication, the column count in the first matrix should be equal to the row count of the
second matrix. If this condition is not met, the app should throw a validation error.
Resulting matrix

The resulting matrix should contain characters rather than numbers similar to excel columns.
Examples: 1 => A, 26 => Z, 27 => AA, 28 => AB. At least the calculation itself should be covered by tests.

Technical Details
• PHP 7.4
• Laravel with vuejs
• PSR-12
• Strict type hinting
• Unit tests
• Docker (Bonus)

# Strategy 
- Create a Dockerfile with Php7.4  
- Use the Vue CLI to generate a frontend, I chose TypeScript.  
- Get Axios for requesting  
- Disable CSRF middleware and make sure the CORS is not blocking the requests  
- Create a very simple matrix in the frontend to visualize what I'm doing  
- Create controller and test for the matrix in numbers  
- Get the matrix multiplication to work with numbers   
- Write a separate class for conversion to the Excel like notation  
- Write a test to cover the examples in the Assignment  

# Possible improvement 
Add a few buttons in the frontend to add columns and rows to each matrix 

# Run: 
```docker-compose up --build -d```
note: It could take a while before everything is running, because npm run serve has to compile 

# Troubleshooting: 
- try running composer install
- check file permissions on storage/logs/laravel.log if the logging isnt present 

# Urls:
- localhost:8123 (backend)
- localhost:8124 (frontend)

Connect to api container with VSC 