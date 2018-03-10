# LdapProjet

## Description

This project propose a Ldap web interface of openldap in order to manage users and groups.

Based on Docker, we have two images :
- openldap : the ldap server instance
- webappldap : the web interface which communicates whith openldap


## Use of Docker

To simplify Docker utilisation, you juste have to run the Makefile :

```
cd Docker
make
```

Two containers will run behind. You can access the container server at this address : [Web interface](http://127.0.0.1:80/ldap).

## Web interface

Admin access :
- username : admin
- password : bla
