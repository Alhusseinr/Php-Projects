create table users(
  users_id int NOT NULL AUTO_INCREMENT primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  Password varchar(2000) NOT NULL,
  Bdate datetime NOT NULL,
  email varchar(2000) NOT NULL,
  Pnumber varchar(200) NOT NULL,
  Gender ENUM('Male', 'Female', 'Other'),
  role ENUM('Customer', 'Employee', 'Supervisor')
);

create table address(
  address_id int NOT NULL auto_increment primary key,
  Fname varchar(200) NOT NULL,
  Lname varchar(200) NOT NULL,
  address1 varchar(200) NOT NULL,
  address2 varchar(200),
  post_code varchar(200) NOT NULL,
  city varchar(200) NOT NULL,
  state varchar(200) NOT NULL,
  phone_number varchar(200) NOT NULL,
  users_id int not null,
  foreign key (users_id) references users(users_id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table orders(
  order_id int NOT NULL auto_increment primary key,
  order_Number varchar(2000) NOT NULL,
  address_id int NOT NULL,
  users_id int null,
  foreign key (address_id) references address(address_id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (users_id) references users(users_id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table products(
  product_id int not null auto_increment primary key,
  product_name varchar(200) not null,
  quantity int not null,
  supplier_Name varchar(200),
  category varchar(200),
  price double not null
);

create table orders_detail(
  orders_detail_id int NOT null auto_increment primary key ,
  order_id int NOT NULL,
  product_id int NOT NULL,
  users_id int not null,
  product_name varchar(200) NOT NULL,
  product_quantity int,
  totalPrice int,
  isbn varchar(25),
  foreign key (users_id) references users(users_id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (order_id) references orders(order_id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (product_id) references products(product_id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table cart_product(
  cart_product_id int not null auto_increment primary key,
  product_id int not null,
  quantity int,
  cart_id int not null,
  foreign key (product_id) references products(product_id) ON UPDATE CASCADE
      ON DELETE CASCADE
);

create table cart(
  cart_id int NOT NULL auto_increment primary key,
  users_id int NOT NULL,
  cart_product_id int null,
  foreign key (users_id) references users(users_id) ON UPDATE CASCADE
      ON DELETE CASCADE,
  foreign key (cart_product_id) references cart_product(cart_product_id) on UPDATE CASCADE
      ON DELETE CASCADE
);

create table supplier(
  supplier_id int not null auto_increment primary key,
  product_id int not null,
  foreign key (product_id) references products(product_id) on DELETE cascade on update cascade
)
