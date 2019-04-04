create table address(
  address_Id int NOT NULL auto_increment primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  address1 varchar(200) NOT NULL,
  address2 varchar(200),
  post_code varchar(200) NOT NULL,
  city varchar(200) NOT NULL,
  state varchar(200) NOT NULL,
  phone_number varchar(200) NOT NULL
);

create table orders(
  order_Id int NOT NULL auto_increment primary key,
  order_Number varchar(2000) NOT NULL,
  address_Id int NOT NULL,
  foreign key (address_Id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table user(
  user_Id int NOT NULL AUTO_INCREMENT primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  Password varchar(2000) NOT NULL,
  Bdate datetime NOT NULL,
  email varchar(2000) NOT NULL,
  Pnumber varchar(200) NOT NULL,
  order_Id int NULL,
  Gender ENUM('Male', 'Female', 'Other'),
  role ENUM('Customer', 'Employee', 'Supervisor'),
  constraint fk1 foreign key (order_Id) references orders(order_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);


create table products(
  product_Id int not null auto_increment primary key,
  supplier_Name varchar(200),
  category varchar(200),
  isbn varchar(200) not null,
  price double not null,
  size varchar(200)
);


create table orders_detail(
  orders_detail_Id int NOT null auto_increment primary key ,
  order_Id int NOT NULL,
  product_Id int NOT NULL,
  product_name varchar(200) NOT NULL,
  product_quantity int,
  totalPrice int,
  isbn varchar(25),
  foreign key (order_Id) references orders(order_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (product_Id) references products(product_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);


create table cart_product(
  cart_id int not null auto_increment primary key,
  product_id int not null,
  address_id int not null,
  Quantity int,
  foreign key (product_id) references products(product_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (address_id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table cart(
  cart_Id int NOT NULL auto_increment primary key,
  address_Id int NOT NULL,
  user_Id int NOT NULL,
  foreign key (address_Id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (user_Id) references user(user_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
)
