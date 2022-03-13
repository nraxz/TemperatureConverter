#Converter

It converts temperatures from Fahrenheit to Celsius and from Celsius to Fahrenheit.

Commands:

php ./convert.php [number][unit][sign only for negative]

Number can be int or float, [-] for negetive value for example 35f-, for positive value input can be simply 35c.
Unit can be uppercase or lowercase both. 

    - php ./convert.php 20c 
        Output: 20c is converted to 68 Fahrenheit
    - php ./convert.php 20f
        Output:20f is converted to -6.6666666666667 Celsius
    - php ./convert.php 25F-
        Output: 25F- is converted to -31.666666666667 Celsius