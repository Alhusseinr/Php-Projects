create table user(
  user_Id int(200) NOT NULL AUTO_INCREMENT primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  Password varchar(2000) NOT NULL,
  Bdate datetime NOT NULL,
  email varchar(2000) NOT NULL,
  Pnumber varchar(200) NOT NULL,
  order_Id int(200) NOT NULL,
  Gender ENUM('Male', 'Female', 'Other'),
  role ENUM('Customer', 'Employee', 'Supervisor'),
  constraint fk1 foreign key (order_Id) references orders(order_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table orders(
  order_Id int(200) NOT NULL auto_increment primary key,
  order_Number varchar(2000) NOT NULL,
  address_Id int(200) NOT NULL,
  foreign key (address_Id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table address(
  address_Id int(200) NOT NULL auto_increment primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  address1 varchar(200) NOT NULL,
  address2 varchar(200),
  post_code varchar(200) NOT NULL,
  city varchar(200) NOT NULL,
  state varchar(200) NOT NULL,
  phone_number varchar(200) NOT NULL
);

create table orders_detail(
  orders_detail_Id int(11) NOT null auto_increment primary key ,
  order_Id int(200) NOT NULL,
  product_Id int(200) NOT NULL,
  product_name varchar(200) NOT NULL,
  product_quantity int,
  totalPrice int,
  isbn varchar(2000),
  foreign key (order_Id) references orders(order_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (product_Id) references products(product_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);


create table products(
  product_Id int(200) not null auto_increment primary key,
  supplier_Name varchar(200),
  category varchar(200),
  isbn varchar(200) not null,
  price double not null,
  size varchar(200)
);


create table cart_product(
  cart_id int(200) not null auto_increment primary key,
  product_id int(200) not null,
  address_id int(200) not null,
  Quantity int,
  foreign key (product_id) references products(product_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (address_id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table cart(
  cart_Id int(200) NOT NULL auto_increment primary key,
  address_Id int(200) NOT NULL,
  user_Id int(200) NOT NULL,
  foreign key (address_Id) references address(address_Id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (user_Id) references user(user_Id) ON UPDATE CASCADE
      ON DELETE CASCADE
)
