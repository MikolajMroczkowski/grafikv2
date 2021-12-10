create table if not exists akceptaction
(
    id            int auto_increment
        primary key,
    user          text                           not null,
    name          text collate utf8mb4_polish_ci not null,
    surname       text collate utf8mb4_polish_ci not null,
    password      text                           not null,
    mail          text                           not null,
    grupaZawodowa int                            not null,
    isAdmin       int                            not null
);

create table if not exists blokada
(
    id    int auto_increment
        primary key,
    year  int  not null,
    month int  not null,
    date  date not null
);

create table if not exists daneDni
(
    id      int auto_increment
        primary key,
    user    int  not null,
    typeDay int  not null,
    date    date not null
);

create table if not exists grupyZawodowe
(
    id       int auto_increment
        primary key,
    Etykieta text collate utf8mb4_polish_ci not null
);

create table if not exists logLogowan
(
    id        int auto_increment
        primary key,
    user      int      not null,
    timestamp datetime not null
);

create table if not exists maxVal
(
    id        int auto_increment
        primary key,
    userGroup int null,
    type      int null,
    val       int null,
    constraint maxVal_id_uindex
        unique (id)
);

create table if not exists passwordReset
(
    id   int auto_increment
        primary key,
    kod  text not null,
    user int  not null
);

create table if not exists tokens
(
    id            int auto_increment
        primary key,
    user          int  not null,
    token         text not null,
    grupaZawodowa int  not null
);

create table if not exists typyDni
(
    id       int auto_increment
        primary key,
    etykieta text not null,
    kod      text not null,
    kolor    text not null
)
    collate = utf8mb4_polish_ci;

create table if not exists uprawnieniaDniDlaGrup
(
    id      int auto_increment
        primary key,
    grupa   int not null,
    typDnia int not null
);

create table if not exists users
(
    id            int auto_increment
        primary key,
    user          text                           not null,
    name          text collate utf8mb4_polish_ci not null,
    surname       text collate utf8mb4_polish_ci not null,
    password      text                           not null,
    mail          text                           not null,
    grupaZawodowa int                            not null,
    isAdmin       int                            not null
);

create table if not exists usersTableRow
(
    id     int auto_increment
        primary key,
    user   int not null,
    wiersz int not null
);
