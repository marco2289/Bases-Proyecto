--------------------------------------------------------
--  DDL for Sequence SEQ_CODUPERSONAS
--------------------------------------------------------

   CREATE SEQUENCE  "DEEZER"."SEQ_CODPERSONAS"  MINVALUE 10 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 110 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence SEQ_CODUSUARIOS
--------------------------------------------------------

   CREATE SEQUENCE  "DEEZER"."SEQ_CODUSUARIOS"  MINVALUE 10 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 110 CACHE 20 NOORDER  NOCYCLE ;

--------------------------------------------------------
--  DDL for Procedure REGISTRO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "DEEZER"."REGISTRO" (v_nombreu in varchar2,v_correo in varchar2, v_contrasena in varchar2,v_sexo in INTEGER,v_edad in INTEGER,v_codigo out INTEGER,v_mensaje out VARCHAR2) 
AS
 v_email number:=0;
 v_name number:=0;
 v_aux number:=0;
BEGIN

SELECT COUNT(1) INTO v_email
FROM TBL_USUARIOS 
WHERE CORREO = v_correo;

SELECT COUNT(1) INTO v_name
FROM TBL_USUARIOS
WHERE NOMBRE_USUARIO = v_nombreu;

IF v_email != 0 THEN
v_aux:=v_aux+2;
v_codigo:=v_aux;
END IF;

IF v_name != 0 THEN
v_aux:=v_aux+1;
v_codigo:=v_aux;
END IF;

IF v_aux=0 THEN
v_codigo:=v_aux;
v_mensaje:='Registro exitoso';
INSERT INTO TBL_PERSONAS (CODIGO_PERSONA, CODIGO_SEXO) 
VALUES (SEQ_CODPERSONAS.NEXTVAL,v_sexo);
INSERT INTO TBL_USUARIOS (CODIGO_USUARIO, NOMBRE_USUARIO, CONTRASENA, FECHA_INSCRIPCION, EDAD, CORREO,FOTO) 
VALUES (SEQ_CODUSUARIOS.NEXTVAL, v_nombreu, v_contrasena,SYSDATE,v_edad, v_correo,'deezer/fotoperfiles/perfil.jpg');
COMMIT;
ELSIF v_aux=1 THEN
v_mensaje:='NombreU en uso';
ELSIF v_aux=2 THEN
v_mensaje:='Correo en uso';
ELSIF v_aux=3 THEN
v_mensaje:='Correo y NombreU en uso';
END IF;

END;
/
--------------------------------------------------------
--  DDL for Procedure UPDATE_INFO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "DEEZER"."UPDATE_INFO" (v_codigousuario in INTEGER,v_nombreu in varchar2,v_dia in INTEGER,v_mes in INTEGER,v_ano in INTEGER, v_apellido in varchar2,v_sexo in INTEGER,v_nombre in VARCHAR2,v_telefono in VARCHAR2,v_codigop in INTEGER,v_codigo out INTEGER,v_mensaje out VARCHAR2) 
AS

v_nameuser number:=0;
v_aux number:=0;
BEGIN


SELECT COUNT(1) INTO v_nameuser
FROM TBL_USUARIOS 
WHERE CODIGO_USUARIO != v_codigousuario AND NOMBRE_USUARIO = v_nombreu;

IF v_nameuser = 1 THEN
v_aux:=v_aux+1;
v_codigo:=v_aux;
END IF;


IF v_aux=0 THEN
v_codigo:=v_aux;
v_mensaje:='Actualizacion exitosa';

UPDATE TBL_PERSONAS 
SET  CODIGO_SEXO=v_sexo,
NOMBRE=v_nombre,
APELLIDO=v_apellido,
FECHA_NACIMIENTO=TO_DATE(v_dia||'-'||v_mes||'-'||v_ano,'DD-MM-YYYY'),
TELEFONO=v_telefono
WHERE CODIGO_PERSONA=v_codigousuario;

UPDATE TBL_USUARIOS 
SET  CODIGO_LUGAR=v_codigop,
NOMBRE_USUARIO=v_nombreu
WHERE  CODIGO_USUARIO=v_codigousuario;
COMMIT;

ELSIF v_aux=1 THEN
v_mensaje:='NombreU en uso';
END IF;

END;
/