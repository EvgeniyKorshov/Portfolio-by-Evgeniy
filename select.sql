                                                              /*Тематика курсовой работы - 'интернет магазин по комплектующим для пк'
                                                              задача базы данных хранение информации о заказах,пользователях и товарах.
                                              значение расставлены рандомно чисто для заполнения таблиц поэтому на один заказ может оформлена и доставка и самовывоз*/


   
                     --я так понимаю у ENGINE=Archive нет связей поэтому оптимизировать нельзя?!

                     --данная процедура выполняет общий подсчет товаров на складе 
                     DELIMITER //
                     DROP PROCEDURE IF EXISTS  get_sum_products//
                     CREATE PROCEDURE get_sum_products(str VARCHAR(45))
                     BEGIN
                     CASE str
                     WHEN 'Подсчет общего кол-ва товаров'
                     THEN
                      SELECT SUM(quantity) as 'Сумма товаров на складе'
                      FROM  warehouse;
                     
                     END CASE;
                     END //
                     DELIMITER ;
                     CALL get_sum_products('Подсчет общего кол-ва товаров');
                     --данная процедура по имени находит номер заказа ,способ оплаты,статус доставки
                      DELIMITER //
                      DROP PROCEDURE IF EXISTS  get_customers //
                     CREATE PROCEDURE get_customers (arg VARCHAR(255))
                     BEGIN
                     SELECT orders.id as 'Номер заказа',users.name as 'Имя',payment.payment_type as 'способо оплаты', delivery.status_d as 'Статус доставки'
                     FROM orders
                     JOIN (users)
                     ON (users.id = orders.user_id)
                     JOIN (delivery)
                     ON (delivery.id = orders.delivery_id)
                     JOIN (payment)
                     ON (payment.id = orders.payment_id)
                     WHERE users.name = arg;
                     END //
                     DELIMITER ;
                     CALL get_customers('дарья');


                     --выборка показывает номер заказа,имя покупателя,тип оплаты,статус доставки
                     SELECT 
                     orders.id as 'заказ',
                     users.name as 'Покупатель',
                     payment.payment_type as 'тип оплаты',
                     delivery.status_d as 'Статус достаки'
                     from orders 
                     JOIN (payment)
                     ON (payment.id = orders.payment_id)
                     JOIN (delivery)
                     ON (delivery.id = orders.delivery_id)
                     JOIN (users)
                     ON (users.id = orders.user_id)
                     order by orders.id;

                     --выборка показывает номер заказа,имя покупателя,тип оплаты,статус самовывоза
                     SELECT 
                     orders.id as 'заказ',
                     users.name as 'Покупатель',
                     payment.payment_type as 'тип оплаты',
                     pickup.status_p as 'Статус самовывоза'
                     from orders 
                     JOIN (payment)
                     ON (payment.id = orders.payment_id)
                     JOIN (pickup)
                     ON (pickup.id = orders.pickup_id)
                     JOIN (users)
                     ON (users.id = orders.user_id)
                     order by orders.id;

                     --выборка показывает номер товара,товар,cколько товара в наличии на складе,тип акции 
                     SELECT 
                     products.id,
                     products.title as 'товар',
                     warehouse.quantity as 'в наличии',
                     evaluation_and_promotion.title as 'распродажи'
                     from products 
                     JOIN (warehouse)
                     ON (warehouse.id = products.quantity_warehouse_id)
                     JOIN (evaluation_and_promotion)
                     ON (evaluation_and_promotion.id = products.markdown_id)
                     order by products.id;


                 --тригеры 

                 --выполняют функцию создания логов из трех таблиц (посчитал что зачем мудрить и можно использовать эту часть из домашнего задания предыдущего урока)

                DELIMITER //
                DROP TRIGGER IF EXISTS auto_insert_products//
                CREATE TRIGGER auto_insert_products after INSERT ON products
                FOR EACH ROW
                BEGIN
                       INSERT INTO logs SET primary_key_ID=NEW.id,contents_of_the_name_field=NEW.title,table_name='products';
                END//
                DELIMITER ;

                DELIMITER //
                DROP TRIGGER IF EXISTS auto_insert_users//
                CREATE TRIGGER auto_insert_users after INSERT ON users
                FOR EACH ROW
                BEGIN
                       INSERT INTO logs SET primary_key_ID=NEW.id,contents_of_the_name_field=NEW.name,table_name='users';
                END//
                DELIMITER ;

                DELIMITER //
                DROP TRIGGER IF EXISTS auto_insert_catalogs//
                CREATE TRIGGER auto_insert_catalogs after INSERT ON catalog
                FOR EACH ROW
                BEGIN
                       INSERT INTO logs SET primary_key_ID=NEW.id,contents_of_the_name_field=NEW.title_catalog,table_name='catalogs';
                END//
                DELIMITER ;

                --представления
                

                --ввыводит номер заказа ,товара ,сам товар и каталог
                DROP VIEW IF EXISTS VIEW_status_zakaza
                CREATE VIEW VIEW_status_zakaza AS SELECT 
                orders_products.order_id as 'Заказ',
                orders_products.product_id as 'Товар',
                products.title as 'Название',
                catalog.title_catalog as 'Каталог'
                from orders_products 
                JOIN (products)
                ON (products.id = orders_products.product_id)
                JOIN (catalog)
                ON (catalog.id = products.catalog_id);

                SELECT * from VIEW_status_zakaza;


                --выводит строки где колличество товаров на складе меньше 20
                DROP VIEW IF EXISTS cnt_sklad;
                CREATE VIEW sklad AS SELECT id,quantity AS cnt FROM warehouse where quantity<20;

                SELECT * from sklad; --  не получилось избавиться от *(в обычном запросе знаю что делать,а в представлении туплю)