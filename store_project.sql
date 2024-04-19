                                                                                            
    DROP DATABASE IF EXISTS store_project;
    CREATE DATABASE store_project DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_ru_0900_ai_ci;
    USE store_project;

    DROP TABLE IF EXISTS users;
    CREATE TABLE users (
      id SERIAL PRIMARY KEY,
      name VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      phone BIGINT UNSIGNED,
      adress VARCHAR(255),
      index_number BIGINT UNSIGNED
    );

    DROP TABLE IF EXISTS orders;
    CREATE TABLE orders (
    id SERIAL PRIMARY KEY ,
    user_id BIGINT UNSIGNED,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    delivery_id BIGINT ,
    pickup_id BIGINT ,
    payment_id BIGINT,
    KEY index_of_payment(payment_id),
    KEY index_of_delivery(delivery_id),
    KEY index_of_pickup(pickup_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS payment;
    CREATE TABLE payment (
    id BIGINT,
    payment_type VARCHAR(255) COMMENT 'тип оплаты',
    FOREIGN KEY (id) REFERENCES orders(payment_id)  ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS delivery;
    CREATE TABLE delivery (
    id BIGINT ,
    status_d VARCHAR(255) COMMENT 'передано в доставку',
    FOREIGN KEY (id) REFERENCES orders(delivery_id)  ON UPDATE CASCADE ON DELETE RESTRICT
    );
    
    DROP TABLE IF EXISTS pickup;
    CREATE TABLE pickup (
    id BIGINT ,
    status_p VARCHAR(255) COMMENT 'самовывоз',
    FOREIGN KEY (id) REFERENCES orders(pickup_id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS orders_products;
    CREATE TABLE orders_products (
    id SERIAL PRIMARY KEY,
    order_id BIGINT UNSIGNED,
    product_id BIGINT UNSIGNED,
    total INT UNSIGNED DEFAULT 1 COMMENT 'Количество заказанных товарных позиций',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY index_of_product_id(product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON UPDATE CASCADE ON DELETE RESTRICT
    );
    
    DROP TABLE IF EXISTS products;
    CREATE TABLE products (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    price BIGINT,
    catalog_id BIGINT UNSIGNED,
    quantity_warehouse_id BIGINT  COMMENT 'наличие',
    markdown_id BIGINT  COMMENT 'уценка',
    KEY index_of_catalog_markdown(markdown_id),
    KEY index_of_quantity_warehouse(quantity_warehouse_id),
    KEY index_of_catalog_id(catalog_id),
    FOREIGN KEY (id) REFERENCES orders_products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS evaluation_and_promotion;
    CREATE TABLE evaluation_and_promotion (
    id BIGINT ,
    title VARCHAR(255) COMMENT 'уценка,акция',
    FOREIGN KEY (id) REFERENCES products(markdown_id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS warehouse;
    CREATE TABLE warehouse (
    id BIGINT ,
    quantity BIGINT  COMMENT 'колличество',
    FOREIGN KEY (id) REFERENCES products(quantity_warehouse_id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS catalog;
    CREATE TABLE catalog (
    id SERIAL PRIMARY KEY,
    title_catalog VARCHAR(255),
    FOREIGN KEY (id) REFERENCES products(catalog_id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

    DROP TABLE IF EXISTS logs;
    CREATE TABLE logs (
    time_and_date_the_record_was_created DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'время и дата создания записи',
    table_name VARCHAR(255) COMMENT 'название таблицы',
    contents_of_the_name_field VARCHAR(255)  COMMENT 'содержимое поля name',
    primary_key_ID  BIGINT COMMENT 'идентификатор первичного ключа'
    ) COMMENT = 'Логи' ENGINE=Archive;
