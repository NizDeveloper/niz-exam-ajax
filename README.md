# XD

```` sql
create table personas(
	id_per int unsigned auto_increment,
	nombres varchar(50),
	apellidos varchar(50),
	id_padre1 int unsigned null,
	id_padre2 int unsigned null,
	id_abuelo1 int unsigned null,
	id_abuelo2 int unsigned null,
	id_abuelo3 int unsigned null,
	id_abuelo4 int unsigned null,
	primary key(id_per)
);
````
