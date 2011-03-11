
-----------------------------------------------------------------------------
-- rol
-----------------------------------------------------------------------------

DROP TABLE "rol" CASCADE;


CREATE TABLE "rol"
(
	"rol_identificador" VARCHAR(10)  NOT NULL,
	"rol_nombre" VARCHAR(50),
	"rol_url_menu" TEXT,
	"rol_url_inicio" TEXT,
	PRIMARY KEY ("rol_identificador")
);

COMMENT ON TABLE "rol" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- usuario
-----------------------------------------------------------------------------

DROP TABLE "usuario" CASCADE;


CREATE TABLE "usuario"
(
	"usu_identificador" VARCHAR(30)  NOT NULL,
	"usu_contrasena" TEXT  NOT NULL,
	"usu_nombre" VARCHAR(50),
	"usu_apellidos" VARCHAR(50),
	"usu_estado" VARCHAR(2),
	"usu_rol" VARCHAR(10),
	PRIMARY KEY ("usu_identificador")
);

COMMENT ON TABLE "usuario" IS '';


SET search_path TO public;
ALTER TABLE "usuario" ADD CONSTRAINT "usuario_FK_1" FOREIGN KEY ("usu_rol") REFERENCES "rol" ("rol_identificador") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- solicitud
-----------------------------------------------------------------------------

DROP TABLE "solicitud" CASCADE;

DROP SEQUENCE "solicitud_seq";

CREATE SEQUENCE "solicitud_seq";


CREATE TABLE "solicitud"
(
	"sol_id" INTEGER  NOT NULL,
	"sol_nombre" VARCHAR(50),
	"sol_escuela" VARCHAR(80),
	"sol_facultad" VARCHAR(80),
	"sol_archivo" VARCHAR(40),
	"sol_estado" VARCHAR(20)  NOT NULL,
	"sol_usuario" VARCHAR(30),
	"created_at" TIMESTAMP,
	"updated_at" TIMESTAMP,
	PRIMARY KEY ("sol_id")
);

COMMENT ON TABLE "solicitud" IS '';


SET search_path TO public;
ALTER TABLE "solicitud" ADD CONSTRAINT "solicitud_FK_1" FOREIGN KEY ("sol_usuario") REFERENCES "usuario" ("usu_identificador") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- comentario
-----------------------------------------------------------------------------

DROP TABLE "comentario" CASCADE;

DROP SEQUENCE "comentario_seq";

CREATE SEQUENCE "comentario_seq";


CREATE TABLE "comentario"
(
	"com_id" INTEGER  NOT NULL,
	"com_solicitud" INTEGER,
	"com_descripcion" VARCHAR(500),
	"com_usuario" VARCHAR(30),
	"com_sol_estado" VARCHAR(20),
	"created_at" TIMESTAMP,
	PRIMARY KEY ("com_id")
);

COMMENT ON TABLE "comentario" IS '';


SET search_path TO public;
ALTER TABLE "comentario" ADD CONSTRAINT "comentario_FK_1" FOREIGN KEY ("com_solicitud") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

ALTER TABLE "comentario" ADD CONSTRAINT "comentario_FK_2" FOREIGN KEY ("com_usuario") REFERENCES "usuario" ("usu_identificador") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- valor_hora_docente
-----------------------------------------------------------------------------

DROP TABLE "valor_hora_docente" CASCADE;


CREATE TABLE "valor_hora_docente"
(
	"vhd_nivel_programa" VARCHAR(20)  NOT NULL,
	"vhd_categoria_docente" VARCHAR(20)  NOT NULL,
	"nombrado_bonificado" FLOAT,
	"nombrado_carga_academica" FLOAT,
	"hora_catedra" FLOAT,
	PRIMARY KEY ("vhd_nivel_programa","vhd_categoria_docente")
);

COMMENT ON TABLE "valor_hora_docente" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- informacion_general
-----------------------------------------------------------------------------

DROP TABLE "informacion_general" CASCADE;

DROP SEQUENCE "informacion_general_seq";

CREATE SEQUENCE "informacion_general_seq";


CREATE TABLE "informacion_general"
(
	"ing_id" INTEGER  NOT NULL,
	"ing_sol_id" INTEGER,
	"ing_fecha" DATE,
	"ing_solicitante" VARCHAR(100),
	"ing_facultad" VARCHAR(80),
	"ing_escuela" VARCHAR(80),
	"ing_nombre_programa" VARCHAR(100),
	"ing_titulo_otorga" VARCHAR(80),
	"ing_motivo_solicitud" VARCHAR(20),
	"ing_cual_motivo" VARCHAR(50),
	"ing_ciudad_sede" VARCHAR(50),
	"ing_nivel_academico" VARCHAR(40),
	"ing_duracion_programa" INTEGER,
	"ing_jornada" VARCHAR(15),
	"ing_tipo_modalidad" VARCHAR(15),
	"ing_tipo_valor" VARCHAR(25),
	"ing_forma_pago" VARCHAR(20),
	"ing_valor" FLOAT,
	PRIMARY KEY ("ing_id")
);

COMMENT ON TABLE "informacion_general" IS '';


SET search_path TO public;
ALTER TABLE "informacion_general" ADD CONSTRAINT "informacion_general_FK_1" FOREIGN KEY ("ing_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- extructura_curricular
-----------------------------------------------------------------------------

DROP TABLE "extructura_curricular" CASCADE;

DROP SEQUENCE "extructura_curricular_seq";

CREATE SEQUENCE "extructura_curricular_seq";


CREATE TABLE "extructura_curricular"
(
	"ecu_id" INTEGER  NOT NULL,
	"ecu_sol_id" INTEGER,
	"ecu_periodo_academico" INTEGER,
	"ecu_asignatura" VARCHAR(100),
	"ecu_num_creditos" INTEGER,
	"ecu_total_horas" INTEGER,
	"ecu_num_programa_comparte" INTEGER,
	"ecu_categoria_docente" VARCHAR(15),
	"ecu_horas_dictadas_como" VARCHAR(20),
	"ecu_valor_hora" FLOAT,
	PRIMARY KEY ("ecu_id")
);

COMMENT ON TABLE "extructura_curricular" IS '';


SET search_path TO public;
ALTER TABLE "extructura_curricular" ADD CONSTRAINT "extructura_curricular_FK_1" FOREIGN KEY ("ecu_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- valor_diferenciado
-----------------------------------------------------------------------------

DROP TABLE "valor_diferenciado" CASCADE;


CREATE TABLE "valor_diferenciado"
(
	"vad_ing_id" INTEGER  NOT NULL,
	"vad_periodo" INTEGER  NOT NULL,
	"vad_valor" FLOAT,
	PRIMARY KEY ("vad_ing_id","vad_periodo")
);

COMMENT ON TABLE "valor_diferenciado" IS '';


SET search_path TO public;
ALTER TABLE "valor_diferenciado" ADD CONSTRAINT "valor_diferenciado_FK_1" FOREIGN KEY ("vad_ing_id") REFERENCES "informacion_general" ("ing_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- presupuesto_ingresos
-----------------------------------------------------------------------------

DROP TABLE "presupuesto_ingresos" CASCADE;

DROP SEQUENCE "presupuesto_ingresos_seq";

CREATE SEQUENCE "presupuesto_ingresos_seq";


CREATE TABLE "presupuesto_ingresos"
(
	"pin_id" INTEGER  NOT NULL,
	"pin_sol_id" INTEGER,
	"pin_numero_inscritos" INTEGER  NOT NULL,
	"pin_numero_matriculados" INTEGER  NOT NULL,
	"pin_exenciones" INTEGER,
	PRIMARY KEY ("pin_id")
);

COMMENT ON TABLE "presupuesto_ingresos" IS '';


SET search_path TO public;
ALTER TABLE "presupuesto_ingresos" ADD CONSTRAINT "presupuesto_ingresos_FK_1" FOREIGN KEY ("pin_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- fuentes_externas
-----------------------------------------------------------------------------

DROP TABLE "fuentes_externas" CASCADE;

DROP SEQUENCE "fuentes_externas_seq";

CREATE SEQUENCE "fuentes_externas_seq";


CREATE TABLE "fuentes_externas"
(
	"fue_id" INTEGER  NOT NULL,
	"fue_sol_id" INTEGER,
	"fue_nombre" VARCHAR(100),
	PRIMARY KEY ("fue_id")
);

COMMENT ON TABLE "fuentes_externas" IS '';


SET search_path TO public;
ALTER TABLE "fuentes_externas" ADD CONSTRAINT "fuentes_externas_FK_1" FOREIGN KEY ("fue_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- contribucion_fuente_externa
-----------------------------------------------------------------------------

DROP TABLE "contribucion_fuente_externa" CASCADE;


CREATE TABLE "contribucion_fuente_externa"
(
	"cfe_pin_id" INTEGER  NOT NULL,
	"cfe_fue_id" INTEGER  NOT NULL,
	"cfe_periodo" INTEGER  NOT NULL,
	"cfe_valor" FLOAT,
	PRIMARY KEY ("cfe_pin_id","cfe_fue_id","cfe_periodo")
);

COMMENT ON TABLE "contribucion_fuente_externa" IS '';


SET search_path TO public;
ALTER TABLE "contribucion_fuente_externa" ADD CONSTRAINT "contribucion_fuente_externa_FK_1" FOREIGN KEY ("cfe_pin_id") REFERENCES "presupuesto_ingresos" ("pin_id") ON DELETE CASCADE;

ALTER TABLE "contribucion_fuente_externa" ADD CONSTRAINT "contribucion_fuente_externa_FK_2" FOREIGN KEY ("cfe_fue_id") REFERENCES "fuentes_externas" ("fue_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- presupuesto_egresos
-----------------------------------------------------------------------------

DROP TABLE "presupuesto_egresos" CASCADE;

DROP SEQUENCE "presupuesto_egresos_seq";

CREATE SEQUENCE "presupuesto_egresos_seq";


CREATE TABLE "presupuesto_egresos"
(
	"peg_id" INTEGER  NOT NULL,
	"peg_sol_id" INTEGER,
	"peg_hse_cord_programa" INTEGER,
	"peg_hse_secretaria" INTEGER,
	"peg_hse_aux_administrativo" INTEGER,
	"peg_hse_monitorias" INTEGER,
	"peg_sm_direccion" FLOAT,
	"peg_sm_coordinacion" FLOAT,
	"peg_sm_otro_nombre" FLOAT,
	"peg_sm_otro_valor" FLOAT,
	PRIMARY KEY ("peg_id")
);

COMMENT ON TABLE "presupuesto_egresos" IS '';


SET search_path TO public;
ALTER TABLE "presupuesto_egresos" ADD CONSTRAINT "presupuesto_egresos_FK_1" FOREIGN KEY ("peg_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- concepto_gastos
-----------------------------------------------------------------------------

DROP TABLE "concepto_gastos" CASCADE;

DROP SEQUENCE "concepto_gastos_seq";

CREATE SEQUENCE "concepto_gastos_seq";


CREATE TABLE "concepto_gastos"
(
	"cog_id" INTEGER  NOT NULL,
	"cog_sol_id" INTEGER,
	"cog_concepto" VARCHAR(100),
	"cog_tipo" VARCHAR(15)  NOT NULL,
	PRIMARY KEY ("cog_id")
);

COMMENT ON TABLE "concepto_gastos" IS '';


SET search_path TO public;
ALTER TABLE "concepto_gastos" ADD CONSTRAINT "concepto_gastos_FK_1" FOREIGN KEY ("cog_sol_id") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- inversiones_gastos_generales
-----------------------------------------------------------------------------

DROP TABLE "inversiones_gastos_generales" CASCADE;


CREATE TABLE "inversiones_gastos_generales"
(
	"igg_cog_id" INTEGER  NOT NULL,
	"igg_periodo" INTEGER  NOT NULL,
	"igg_costo" FLOAT,
	PRIMARY KEY ("igg_cog_id","igg_periodo")
);

COMMENT ON TABLE "inversiones_gastos_generales" IS '';


SET search_path TO public;
ALTER TABLE "inversiones_gastos_generales" ADD CONSTRAINT "inversiones_gastos_generale_FK_1" FOREIGN KEY ("igg_cog_id") REFERENCES "concepto_gastos" ("cog_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- historico_analisis
-----------------------------------------------------------------------------

DROP TABLE "historico_analisis" CASCADE;

DROP SEQUENCE "historico_analisis_seq";

CREATE SEQUENCE "historico_analisis_seq";


CREATE TABLE "historico_analisis"
(
	"hia_estado" VARCHAR(25)  NOT NULL,
	"hia_solicitud" INTEGER,
	"hia_usuario" VARCHAR(30),
	"created_at" TIMESTAMP,
	"id" INTEGER  NOT NULL,
	PRIMARY KEY ("id")
);

COMMENT ON TABLE "historico_analisis" IS '';


SET search_path TO public;
ALTER TABLE "historico_analisis" ADD CONSTRAINT "historico_analisis_FK_1" FOREIGN KEY ("hia_solicitud") REFERENCES "solicitud" ("sol_id") ON DELETE CASCADE;

ALTER TABLE "historico_analisis" ADD CONSTRAINT "historico_analisis_FK_2" FOREIGN KEY ("hia_usuario") REFERENCES "usuario" ("usu_identificador") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- facultad
-----------------------------------------------------------------------------

DROP TABLE "facultad" CASCADE;

DROP SEQUENCE "facultad_seq";

CREATE SEQUENCE "facultad_seq";


CREATE TABLE "facultad"
(
	"fac_id" INTEGER  NOT NULL,
	"fac_nombre" VARCHAR(100),
	PRIMARY KEY ("fac_id")
);

COMMENT ON TABLE "facultad" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- dependencia
-----------------------------------------------------------------------------

DROP TABLE "dependencia" CASCADE;


CREATE TABLE "dependencia"
(
	"dep_codigo" VARCHAR(40)  NOT NULL,
	"dep_facultad" INTEGER,
	"dep_nombre" VARCHAR(100),
	PRIMARY KEY ("dep_codigo")
);

COMMENT ON TABLE "dependencia" IS '';


SET search_path TO public;
ALTER TABLE "dependencia" ADD CONSTRAINT "dependencia_FK_1" FOREIGN KEY ("dep_facultad") REFERENCES "facultad" ("fac_id") ON DELETE CASCADE;

-----------------------------------------------------------------------------
-- docentes
-----------------------------------------------------------------------------

DROP TABLE "docentes" CASCADE;


CREATE TABLE "docentes"
(
	"cedula" VARCHAR(40)  NOT NULL,
	"nombre" VARCHAR(40),
	"apellidos" VARCHAR(80),
	"facultad" VARCHAR(100),
	"dependencia" VARCHAR(100),
	"categoria" VARCHAR(40),
	PRIMARY KEY ("cedula")
);

COMMENT ON TABLE "docentes" IS '';


SET search_path TO public;
-----------------------------------------------------------------------------
-- decersion
-----------------------------------------------------------------------------

DROP TABLE "decersion" CASCADE;

DROP SEQUENCE "decersion_seq";

CREATE SEQUENCE "decersion_seq";


CREATE TABLE "decersion"
(
	"dec_id" INTEGER  NOT NULL,
	"dec_sede" VARCHAR(80),
	"dec_facultad" INTEGER,
	"dec_tipo_progama" VARCHAR(40),
	"dec_periodo" INTEGER,
	PRIMARY KEY ("dec_id")
);

COMMENT ON TABLE "decersion" IS '';


SET search_path TO public;
ALTER TABLE "decersion" ADD CONSTRAINT "decersion_FK_1" FOREIGN KEY ("dec_facultad") REFERENCES "facultad" ("fac_id") ON DELETE CASCADE;
