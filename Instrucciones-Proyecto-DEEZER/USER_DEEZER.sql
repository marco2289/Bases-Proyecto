CREATE USER DEEZER
IDENTIFIED BY "oracle"
DEFAULT TABLESPACE USERS
TEMPORARY TABLESPACE TEMP;  
ALTER USER DEEZER QUOTA UNLIMITED ON USERS;
GRANT create session TO DEEZER;
GRANT create table TO DEEZER;
GRANT create view TO DEEZER;
GRANT create any trigger TO DEEZER;
GRANT create any procedure TO DEEZER;
GRANT create sequence TO DEEZER;
GRANT create materialized view TO DEEZER;
GRANT select any table TO DEEZER;
GRANT create synonym TO DEEZER;






