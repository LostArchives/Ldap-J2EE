all: openldap webappldap compose data

openldap:
	docker build --no-cache -t openldap -f DockerfileLdap .

webappldap:
	docker build --no-cache -t webappldap -f DockerfileApp .

compose: openldap webappldap
	docker-compose up &
	sleep 5

data: compose
	ldapadd -x -h localhost -p 389 -D cn=admin,dc=bla,dc=com -f groups.ldif -w bla
