# Drupal Vulnerability Scanning Module 
<img src="images/logo.png"></br>
Scalable Networks CyberSec Australia</br>
https://scalablenetworks.com.au 



## Configuration management
Module will create a single file containing secret-token 

`scalable_cybersec.settings.yml`

## Module compatibility 
- Designed to work with Drupal 8.x
- Designed to work with Drupal 9.x

## Routes
- Module will expose Drupal's `composer.json` file via `webroot/composer.json/secret-token`
- Module will expose Drupal's `composer.lock` file via `webroot/composer.lock/secret-token`

This module allows for Scalable Network's DevOPS pipelines to securely access and read the existing version's of installed Drupal modules, their dependencies 
and packages + Drupal Core versions. This is used to generate daily compliance and vulnerability reports. 
