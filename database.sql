create database ANDROID;
use ANDROID;
create table and_user(
userId int primary key auto_increment,
userName varchar(20) not null unique comment '用户名:具有唯一性',
userPassword char(32) not null comment '用户密码:MD5加密',
userDepart char(50) not null comment '用户所属的部门'
)charset utf8;
create table and_depart(
departID int primary key auto_increment,
departName char(50) not null comment '部门名称'
)engine=MyISAM default charset=utf8;
create table and_file(
file_id int primary key auto_increment,
file_name varchar(255) comment '文件名称',
file_save varchar(255) comment '文件保存的地址',
file_size int comment '文件的大小',
file_time datetime comment '文件上传的时间',
folder_id int not null comment '文件所属目录',
product_id int not null comment '文件所属产品'
)charset utf8;
create table and_folder(
folder_id int primary key auto_increment,
folder_name varchar(255) not null comment '目录名称',
folder_time datetime comment '目录创建的时间',
folder_path varchar(255) comment '目录的路径',
folder_pid int comment '父级目录'
)charset utf8;
create table and_product(
product_id int primary key auto_increment,
product_name varchar(255) not null comment '产品的名称'
)charset utf8;
insert into and_user values(1,'root',md5('root'),'renshibu');
insert into and_depart values(1,'renshibu');
insert into and_depart values(1,'shouji');