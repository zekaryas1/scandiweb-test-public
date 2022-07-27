create database eCommerce;

create table Products
(
    sku    varchar(255) not null,
    name   varchar(255) not null,
    price  decimal      not null,
    type   varchar(255) not null,
    size   int          null,
    weight float          null,
    length float          null,
    width  float          null,
    height float          null,
    constraint sku
        unique (sku)
);