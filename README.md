<p align="center">
    <a href="https://google.com" target="_blank">
        <img src="https://img.icons8.com/nolan/512/knowledge-sharing.png" height="100px">
    </a>
    <h1 align="center">Course Horizon</h1>
    <br>
</p>

<h2>Project Overview</h2>

This project has been designed and implemented using Domain-Driven Design (DDD) principles, 
ensuring a well-structured and maintainable codebase.


By focusing on the core domain and domain logic, 
I have created a solution that accurately addresses complex
business requirements while promoting a clear separation of concerns.

<h2> Scalable Architecture </h2>

The project has been developed with scalability in mind,
allowing it to adapt and grow with ease as the system's requirements evolve. 

By utilizing modular components and layers, the architecture is capable of handling
increased workloads and accommodating new features without compromising performance or maintainability.

INSTALLATION
------------

1. ```git clone```
2. ```composer install```
3. Copy .env.dist to .env
3. ```npm install && npm run build```
4. ```php artisan migrate```
4. ```php artisan key:generate```
4. ```php artisan db:seed```
4. ```php artisan test```
4. ```php artisan serve```

All done!

**NOTES:**
- Adjust ports to make sure they don't conflict with what you have on your local machine
- Make sure you have a proper enviroment if not using Laravel Sail, create a MYSQL DB with the same name as in your .env

