<?php

//rutas relativas
$sf_symfony_lib_dir  = dirname(__FILE__).'/../lib/symfony';
$sf_symfony_data_dir = dirname(__FILE__).'/../data/symfony';

//marzo 9 2010
//define ('URL_SASPA', 'http://192.168.3.120/saspa/web/');
//define ('PATH_LIBRERIAS','http://192.168.3.120/saspa/lib/');

//Para uso local
define ('URL_SASPA', 'http://127.0.0.1/saspa/web/');
define ('PATH_LIBRERIAS', URL_SASPA.'../lib/');


//definicion temporal de los parametros del sistema Parametros temporales
define ('SMMLV',515000);//salario minimo mensual vigente 2010
define ('DESERCION',0.1);//Necesaria para calcular el # de estudiantes matriculados
define ('VALOR_INSCRIPCION',SMMLV*0.12);
define ('VALOR_FORMULARIO',SMMLV*0.03);
define ('VALOR_MATRICULA',250000);
define ('VALOR_COSTOS_FIJOS',600000);
define ('ASIG_ASIST_DOCENCIA',325000);
define ('PORCENTAJE_PRESTACIONES',0.04);
define ('SUELDO_MES_PROFESOR',1800000);
define ('GASTOS_REPRESENTACION',10800000);
define ('VALOR_HORA_DOCENTE',15000);
define ('VALOR_HORA_SECRETARIA',7000);
define ('VALOR_HORA_AUXILIARES',9000);
define ('VALOR_HORA_MONITORIAS',3600);
define ('VALOR_MATRICULA_PREGRADO',150000);
