create schema visagelivre;

create table visagelivre._user(
 nickname varchar(30) constraint _user_pk primary key,
 pass varchar(20) not null,
 email varchar(40) not null
 );
 
create table visagelivre._friendof(
nickname varchar(30) not null constraint _friendof_user_fk1 references visagelivre._user,
friend varchar(30) not null constraint _friendof_user_fk2 references visagelivre._user,
birth_date date default current_date,
constraint _friendof_pk primary key (nickname, friend));

create table visagelivre._friendrequest(
nickname varchar(30) not null constraint _friendrequest_user_fk1 references visagelivre._user,
target varchar(30) not null constraint _friendrequest_user_fk2 references visagelivre._user,
request_date date default current_date,
constraint _friendrequest_pk primary key (nickname, target));

alter table visagelivre._friendof add constraint name_friend_chk check (nickname != friend);
alter table visagelivre._friendrequest add constraint name_target_chk check (nickname != target);

create table visagelivre._document(
IDDOC serial constraint _document_PK primary key,
content varchar(128) not null,
create_date timestamp not null default now(),
auteur varchar(30) not null constraint _document_user_fk references visagelivre._user on delete cascade);

create table visagelivre._post(
IDDOC integer not null constraint _post_PK primary key 
    constraint _post_IS_document_fk references visagelivre._document on delete cascade);
   
create table visagelivre._comment(
IDDOC integer not null constraint _comment_PK primary key 
    constraint _comment_IS_document_fk references visagelivre._document on delete cascade,
ref integer not null constraint _comment_document_fk references visagelivre._document on delete cascade);


insert into visagelivre._user(nickname,pass,email) values ('fe','122','fe@nl.fr');
insert into visagelivre._user(nickname,pass,email) values ('de','123','de@nl.fr');
insert into visagelivre._user(nickname,pass,email) values ('gr','124','gr@nl.fr');
insert into visagelivre._user(nickname,pass,email) values ('fr','125','fr@nl.fr');
insert into visagelivre._user(nickname,pass,email) values ('azed','126','azed@nl.fr');

insert into visagelivre._friendof(nickname,friend,birth_date) values('fe','de','21/12/12');
insert into visagelivre._friendof(nickname,friend,birth_date) values('fe','gr','21/12/12');
insert into visagelivre._friendof(nickname,friend,birth_date) values('fe','fr','21/12/12');
