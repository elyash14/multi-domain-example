# Deploy multi-subdomain app on the Kubernetes cluster by Laravel



In this sample laravel app, a web application with multiple domain will be created. 


## Tools & Libraries

- [Laravel](https://laravel.com) v9
- [Minikube](https://minikube.sigs.k8s.io/docs)
- [PHP K8s](https://php-k8s.renoki.org)

### Laravel
Laravel is a PHP framework to create we application

### Minikube
Minikube is a lightweight Kubernetes implementation that creates a VM on your local machine and deploys a simple cluster containing only one node

## PHP K8s
PHP K8s is a library to control your Kubernetes clusters with Kubernetes API which supports any form of authentication, the exec API, and it has an easy implementation for CRDs.

## Installation

- Install Minikube with this [link](https://minikube.sigs.k8s.io/docs/start)

- Clone repository and run composer command.  ``` composer install```
- Run kubectl proxy command to access kubernetes API. ``` kubectl proxy --port=8080 & ```
- - Make sure the above command port and .env file port must be equal
- Run the artisan server. ``` php artisan serv ```


## Authors

Elyas Mosayebi [@elyash14](https://github.com/elyash14)