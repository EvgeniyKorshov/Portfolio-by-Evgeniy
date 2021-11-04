    INSERT INTO users (name,email) VALUES
    ('Геннадий', 'genadiy@mail.ru'),
    ('Наталья', 'natalia@mail.ru'),
    ('Александр', 'aleksandr@mail.ru'),
    ('Сергей', 'sergey@mail.ru'),
    ('Иван', 'ivan@mail.ru'),
    ('Мария', 'maria@mail.ru'),
    ('Василий', 'vasiliy@mail.ru'),
    ('Глеб', 'gleb@mail.ru'),
    ('Дарья', 'daria@mail.ru'),
    ('Ксения', 'ksenia@mail.ru');


    INSERT INTO orders (user_id,payment_id,delivery_id,pickup_id) VALUES 
    ('1','2','2','2'),('2','3','1','1'),('3','1','2','2'),('4','4','1','2'),('5','2','2','1'),
    ('6','1','2','1'),('7','1','1','2'),('8','1','2','1'),('9','4','2','1'),('10','1','2','2');  



    INSERT INTO payment (id,payment_type) VALUES 
    ('1','Не оплачено'),
    ('2','Наличные'),
    ('3','Карта'),
    ('4','кредит');


    INSERT INTO delivery (id,status_d) VALUES 
    ('1','доставка не оформлена'),
    ('2','передано в доставку');

    INSERT INTO pickup (id,status_p) VALUES 
    ('1','самовывоз не оформлен'),
    ('2','самовывоз');

     INSERT INTO orders_products (order_id,product_id) VALUES
    ('1', '1'),
    ('2', '2'),
    ('3', '3'),
    ('4', '4'),
    ('5', '5'),
    ('6', '6'),
    ('7', '7'),
    ('8', '8'),
    ('9', '9'),
    ('10', '10');


    INSERT INTO products (title,price,catalog_id,markdown_id,quantity_warehouse_id) VALUES
    ('AMD Ryzen 3 1200','6900', '1', '1', '1'),
    ('GIGABYTE B450 AORUS ELITE V2','3520', '2', '2', '2'),
    ('Aerocool VX PLUS 500W','2080', '3', '3', '3'),
    ('PALIT NVIDIA GeForce RTX 3060','80990', '4', '1', '4'),
    ('PCI-E CREATIVE Audigy RX','5000', '5', '1', '5'),
    ('ATX Zalman i3','4020', '6', '3', '6'),
    ('WiFi TP-LINK TL-WN821N USB 2.0','590', '7', '1', '7'),
    ('DVD-RW ASUS DRW-24D5MT/BLK/B/AS','1170', '8', '2', '8'),
    ('AMD Radeon R7 Performance Series R748G2606U2S-UO DDR4 - 8ГБ 2666','2390', '9', '3', '9'),
    ('GLACIALTECH IceWind 6015','160', '10', '1', '10');

    INSERT INTO evaluation_and_promotion (id,title) VALUES 
    ('1','не выбрано'),
    ('2','уценка'),
    ('3','акция');

     INSERT INTO warehouse (id,quantity) VALUES 
    ('1','10'),
    ('2','56'),
    ('3','21'),
    ('4','68'),
    ('5','99'),
    ('6','24'),
    ('7','72'),
    ('8','62'),
    ('9','14'),
    ('10','45');

    INSERT INTO catalog (title_catalog) VALUES 
    ('Процессоры'),
    ('Материнские платы'),
    ('Блоки питания'),
    ('Видеокарты'),
    ('Звуковые карты'),
    ('Корпуса'),
    ('Сетевые адаптеры'),
    ('Оптические приводы'),
    ('Модули памяти'),
    ('Системы охлаждения корпуса');
