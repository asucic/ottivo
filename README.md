[![Latest Stable Version](https://img.shields.io/packagist/v/phpunit/phpunit.svg?style=flat-square)](https://packagist.org/packages/phpunit/phpunit)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)

# Ottivo Vacation Day Calculator

This is a console application which calculates employee vacation days based on their age and employment duration.

## Installation

To setup this project run following commands:

```bash
$ git clone git@github.com:asucic/ottivo.git
$ composer install
```

## Usage

Employee data is stored inside `data/employees.json` file in JSON format. You can update this file manually. If you wish to check number of vacation days for target year, you can run a command:

```bash
$ ./console vacation-calculator 2020 
```

Which will calculate amount of vacation days for each employee for target year. Calculation of employee vacation days depends on their age, contract duration and default vacation days set by special contract if there is any.

`Note`: since it hasn't been cleary defined weather or not employee additional vacation days are calculated according to their age or duration of employment contract, I have assumed that 30 year mark applies to employee age.

## Running the tests

To run unit tests use the following command:

```
$ vendor/bin/phpunit
```

