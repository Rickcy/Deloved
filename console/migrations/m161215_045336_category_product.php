<?php

use yii\db\Migration;

class m161215_045336_category_product extends Migration
{
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE category_type(id INT NOT NULL PRIMARY KEY,code VARCHAR(100));
       
       CREATE TABLE category(
       id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(255) NOT NULL ,
       parent_id INT,
       categorytype_id INT,
        FOREIGN KEY (parent_id) REFERENCES category (id),
        FOREIGN KEY (categorytype_id) REFERENCES category_type (id));
         
        INSERT INTO category_type  VALUES (1, "GOOD");
        INSERT INTO category_type  VALUES (2, "SERVICE");    
        
        INSERT INTO category  VALUES (1, "Категории", null, null);
        INSERT INTO category  VALUES (1228, "Категории товаров", 1, 1);
        INSERT INTO category  VALUES (1229, "Автосервис/Автотовары", 1228, 1);
        INSERT INTO category  VALUES (1230, "Автоаксессуары", 1229, 1);
        INSERT INTO category  VALUES (1231, "Автозапчасти для грузовых автомобилей", 1229, 1);
        INSERT INTO category  VALUES (1232, "Автозапчасти для легковых автомобилей", 1229, 1);
        INSERT INTO category  VALUES (1233, "Автосигнализация продажа", 1229, 1);
        INSERT INTO category  VALUES (1234, "Авто- и мотосалоны", 1229, 1);
        INSERT INTO category  VALUES (1235, "Автошины, диски", 1229, 1);
        INSERT INTO category  VALUES (1236, "Автохимия, масла", 1229, 1);
        INSERT INTO category  VALUES (1237, "АЗС", 1229, 1);
        INSERT INTO category  VALUES (1238, "Специализированное автооборудование", 1229, 1);
        INSERT INTO category  VALUES (1239, "Интернет. Связь. Информационные технологии.", 1228, 1);
        INSERT INTO category  VALUES (1240, "Интернет, мобильная связь", 1239, 1);
        INSERT INTO category  VALUES (1241, "Мобильные телефоны, прочие средства связи", 1239, 1);
        INSERT INTO category  VALUES (1242, "Телекоммуникационное и IT-оборудование", 1239, 1);
        INSERT INTO category  VALUES (1243, "Программное обеспечение", 1239, 1);
        INSERT INTO category  VALUES (1244, "Компьютеры. Офисная техника.", 1228, 1);
        INSERT INTO category  VALUES (1245, "Компьютеры, комплектующие", 1244, 1);
        INSERT INTO category  VALUES (1246, "Оргтехника, комплектующие, расходные материалы", 1244, 1);
        INSERT INTO category  VALUES (1247, "Сетевое оборудование", 1244, 1);
        INSERT INTO category  VALUES (1248, "Медицина. Здоровье. Красота.", 1228, 1);
        INSERT INTO category  VALUES (1249, "Аптеки", 1248, 1);
        INSERT INTO category  VALUES (1250, "Медицинское оборудование, инструменты", 1248, 1);
        INSERT INTO category  VALUES (1251, "Оборудование, инструменты для салонов красоты", 1248, 1);
        INSERT INTO category  VALUES (1252, "Расходные материалы для салонов красоты", 1248, 1);
        INSERT INTO category  VALUES (1253, "Металлопрокат. Металлообработка.", 1228, 1);
        INSERT INTO category  VALUES (1254, "Металлоизделия", 1253, 1);
        INSERT INTO category  VALUES (1255, "Металлообработка", 1253, 1);
        INSERT INTO category  VALUES (1256, "Металлоконструкции", 1253, 1);
        INSERT INTO category  VALUES (1257, "Нержавеющий металлопрокат", 1253, 1);
        INSERT INTO category  VALUES (1258, "Прием, переработка металла", 1253, 1);
        INSERT INTO category  VALUES (1259, "Сварочные материалы", 1253, 1);
        INSERT INTO category  VALUES (1260, "Цветной металлопрокат", 1253, 1);
        INSERT INTO category  VALUES (1261, "Черный металлопрокат", 1253, 1);
        INSERT INTO category  VALUES (1262, "Строительство", 1228, 1);
        INSERT INTO category  VALUES (1263, "Стройматериалы и конструкции", 1262, 1);
        INSERT INTO category  VALUES (1264, "Отделочные материалы", 1262, 1);
        INSERT INTO category  VALUES (1265, "Промышленность, производство, переработка", 1228, 1);
        INSERT INTO category  VALUES (1266, "Деревообрабатывающая промышленность", 1265, 1);
        INSERT INTO category  VALUES (1267, "Легкая промышленность", 1265, 1);
        INSERT INTO category  VALUES (1268, "Литейное производство", 1265, 1);
        INSERT INTO category  VALUES (1269, "Машиностроение", 1265, 1);
        INSERT INTO category  VALUES (1270, "Медицинская промышленность", 1265, 1);
        INSERT INTO category  VALUES (1271, "Нефтегазовая промышленность", 1265, 1);
        INSERT INTO category  VALUES (1272, "Пищевая промышленность", 1265, 1);
        INSERT INTO category  VALUES (1273, "Приборостроение", 1265, 1);
        INSERT INTO category  VALUES (1274, "Прием, переработка драгоценных металлов", 1265, 1);
        INSERT INTO category  VALUES (1275, "Производство изделий из пластмасс", 1265, 1);
        INSERT INTO category  VALUES (1276, "Станкостроение", 1265, 1);
        INSERT INTO category  VALUES (1277, "РТИ (резины, пластмассы)", 1265, 1);
        INSERT INTO category  VALUES (1278, "Топливная промышленность", 1265, 1);
        INSERT INTO category  VALUES (1279, "Химическая промышленность", 1265, 1);
        INSERT INTO category  VALUES (1280, "Технические газы", 1265, 1);
        INSERT INTO category  VALUES (1281, "Уголь", 1265, 1);
        INSERT INTO category  VALUES (1282, "Утилизация отходов, вторсырье", 1265, 1);
        INSERT INTO category  VALUES (1283, "Электроэнергетика", 1265, 1);
        INSERT INTO category  VALUES (1284, "Оборудование и инструменты", 1228, 1);
        INSERT INTO category  VALUES (1285, "Оборудование", 1284, 1);
        INSERT INTO category  VALUES (1286, "Банковское оборудование", 1285, 1);
        INSERT INTO category  VALUES (1287, "Вентиляционное, тепловое, климатическое оборудование и системы", 1285, 1);
        INSERT INTO category  VALUES (1288, "Гидравлическое оборудование, комплектующие", 1285, 1);
        INSERT INTO category  VALUES (1289, "Газовое оборудование, комплектующие", 1285, 1);
        INSERT INTO category  VALUES (1290, "Деревообрабатывающее оборудование, комплектующие", 1285, 1);
        INSERT INTO category  VALUES (1291, "Прокат оборудования", 1285, 1);
        INSERT INTO category  VALUES (1292, "Прочее оборудование", 1285, 1);
        INSERT INTO category  VALUES (1293, "Сварочное оборудование", 1285, 1);
        INSERT INTO category  VALUES (1294, "Торговое и складское оборудование", 1285, 1);
        INSERT INTO category  VALUES (1295, "Электрооборудование", 1284, 1);
        INSERT INTO category  VALUES (1296, "Инструменты", 1284, 1);
        INSERT INTO category  VALUES (1297, "Абразивный инструмент", 1284, 1);
        INSERT INTO category  VALUES (1298, "Бензо- и электроинструмент", 1284, 1);
        INSERT INTO category  VALUES (1299, "Измерительный инструмент", 1284, 1);
        INSERT INTO category  VALUES (1300, "Прокат инструмента", 1284, 1);
        INSERT INTO category  VALUES (1301, "Прочие инструменты", 1284, 1);
        INSERT INTO category  VALUES (1302, "Слесарно-монтажные инструменты", 1284, 1);
        INSERT INTO category  VALUES (1303, "Охрана. Безопасность", 1228, 1);
        INSERT INTO category  VALUES (1304, "Противопожарное оборудование, инвентарь", 1303, 1);
        INSERT INTO category  VALUES (1305, "Продажа, установка ремонт домофонов", 1303, 1);
        INSERT INTO category  VALUES (1306, "Системы безопасности и охраны", 1303, 1);
        INSERT INTO category  VALUES (1307, "Сельское хозяйство", 1228, 1);
        INSERT INTO category  VALUES (1308, "Агрофирмы многопрофильные", 1307, 1);
        INSERT INTO category  VALUES (1309, "Агрохимия", 1307, 1);
        INSERT INTO category  VALUES (1310, "Животноводство, птицеводство", 1307, 1);
        INSERT INTO category  VALUES (1311, "Зерно", 1307, 1);
        INSERT INTO category  VALUES (1312, "Корма", 1307, 1);
        INSERT INTO category  VALUES (1313, "Оборудование для сельского хозяйства", 1307, 1);
        INSERT INTO category  VALUES (1314, "Пчеловодство", 1307, 1);
        INSERT INTO category  VALUES (1315, "Сельскохозяйственная техника", 1307, 1);
        INSERT INTO category  VALUES (1316, "Семена", 1307, 1);
        INSERT INTO category  VALUES (1317, "Растениеводство", 1307, 1);
        INSERT INTO category  VALUES (1318, "Тепличные хозяйства", 1307, 1);
        INSERT INTO category  VALUES (1319, "Торговая деятельность", 1228, 1);
        INSERT INTO category  VALUES (1320, "Оптовая торговля", 1319, 1);
        INSERT INTO category  VALUES (1321, "Алкогольная продукция, напитки", 1320, 1);
        INSERT INTO category  VALUES (1322, "Аудио-видео бытовая техника", 1320, 1);
        INSERT INTO category  VALUES (1323, "Бытовая химия и косметика", 1320, 1);
        INSERT INTO category  VALUES (1324, "Канцелярские товары и принадлежности, книги", 1320, 1);
        INSERT INTO category  VALUES (1325, "Мебель и комплектующие", 1320, 1);
        INSERT INTO category  VALUES (1326, "Одежда и обувь", 1320, 1);
        INSERT INTO category  VALUES (1327, "Продукты питания", 1320, 1);
        INSERT INTO category  VALUES (1328, "Посуда, хозтовары", 1320, 1);
        INSERT INTO category  VALUES (1329, "Прочая оптовая торговля", 1320, 1);
        INSERT INTO category  VALUES (1330, "Табачная продукция", 1320, 1);
        INSERT INTO category  VALUES (1331, "Розничная торговля", 1319, 1);
        INSERT INTO category  VALUES (1332, "Алкогольная продукция, напитки", 1331, 1);
        INSERT INTO category  VALUES (1333, "Аудио-видео бытовая техника", 1331, 1);
        INSERT INTO category  VALUES (1334, "Бытовая химия и косметика", 1331, 1);
        INSERT INTO category  VALUES (1335, "Канцелярские товары и принадлежности, книги", 1331, 1);
        INSERT INTO category  VALUES (1336, "Мебель", 1331, 1);
        INSERT INTO category  VALUES (1337, "Одежда и обувь", 1331, 1);
        INSERT INTO category  VALUES (1338, "Продукты питания", 1331, 1);
        INSERT INTO category  VALUES (1339, "Посуда, хозтовары", 1331, 1);
        INSERT INTO category  VALUES (1340, "Прочая розничная торговля", 1331, 1);
        INSERT INTO category  VALUES (1341, "Табачная продукция", 1331, 1);
        INSERT INTO category  VALUES (1343, "Категории услуг", 1, 2);
        INSERT INTO category  VALUES (1344, "Бизнес-услуги. Финансы. Право.", 1343, 2);
        INSERT INTO category  VALUES (1345, "Аудиторские услуги", 1344, 2);
        INSERT INTO category  VALUES (1346, "Адвокаты и адвокатские образования", 1344, 2);
        INSERT INTO category  VALUES (1347, "Банковская деятельность", 1344, 2);
        INSERT INTO category  VALUES (1348, "Бизнес-инкубаторы", 1344, 2);
        INSERT INTO category  VALUES (1349, "Бухгалтерские услуги", 1344, 2);
        INSERT INTO category  VALUES (1350, "Защита авторских прав", 1344, 2);
        INSERT INTO category  VALUES (1351, "Кадровые агентства", 1344, 2);
        INSERT INTO category  VALUES (1352, "Коллекторские услуги", 1344, 2);
        INSERT INTO category  VALUES (1353, "Лизинговые услуги", 1344, 2);
        INSERT INTO category  VALUES (1354, "Саморегулируемые организации (СРО)", 1344, 2);
        INSERT INTO category  VALUES (1355, "Нотариальные услуги", 1344, 2);
        INSERT INTO category  VALUES (1356, "Патентные услуги", 1344, 2);
        INSERT INTO category  VALUES (1357, "Регистрация ценных бумаг", 1344, 2);
        INSERT INTO category  VALUES (1358, "Организация выставок", 1344, 2);
        INSERT INTO category  VALUES (1359, "Оценка, экспертиза", 1344, 2);
        INSERT INTO category  VALUES (1360, "Страхование", 1344, 2);
        INSERT INTO category  VALUES (1361, "Специальная оценка условий труда", 1344, 2);
        INSERT INTO category  VALUES (1362, "Таможенные услуги", 1344, 2);
        INSERT INTO category  VALUES (1363, "Финансовый консалтинг", 1344, 2);
        INSERT INTO category  VALUES (1364, "Юридические услуги", 1344, 2);
        INSERT INTO category  VALUES (1365, "Информационно – коммуникационные услуги", 1343, 2);
        INSERT INTO category  VALUES (1366, "Автоматизация бизнес-процессов", 1365, 2);
        INSERT INTO category  VALUES (1367, "Автоматизация производственных процессов", 1365, 2);
        INSERT INTO category  VALUES (1368, "Интернет, мобильная связь", 1365, 2);
        INSERT INTO category  VALUES (1369, "Информационная безопасность", 1365, 2);
        INSERT INTO category  VALUES (1370, "Разработка, поддержка и продвижение web-сайтов", 1365, 2);
        INSERT INTO category  VALUES (1371, "Техническое обслуживание", 1343, 2);
        INSERT INTO category  VALUES (1372, "Заправка картриджей", 1371, 2);
        INSERT INTO category  VALUES (1373, "Ремонт оргтехники", 1371, 2);
        INSERT INTO category  VALUES (1374, "Ремонт компьютеров", 1371, 2);
        INSERT INTO category  VALUES (1375, "Услуги системного администрирования", 1371, 2);
        INSERT INTO category  VALUES (1376, "Медицинские услуги", 1343, 2);
        INSERT INTO category  VALUES (1377, "Больницы и поликлиники", 1376, 2);
        INSERT INTO category  VALUES (1378, "Медицинские центры", 1376, 2);
        INSERT INTO category  VALUES (1379, "Услуги узких специалистов", 1376, 2);
        INSERT INTO category  VALUES (1380, "Образование", 1343, 2);
        INSERT INTO category  VALUES (1381, "Автошколы", 1380, 2);
        INSERT INTO category  VALUES (1382, "Дополнительное образование", 1380, 2);
        INSERT INTO category  VALUES (1383, "Курсы", 1380, 2);
        INSERT INTO category  VALUES (1384, "Обучение за рубежом", 1380, 2);
        INSERT INTO category  VALUES (1385, "Профессиональная переподготовка, повышение квалификации", 1380, 2);
        INSERT INTO category  VALUES (1386, "Бизнес-тренинги, семинары", 1380, 2);
        INSERT INTO category  VALUES (1387, "Охрана. Безопасность", 1343, 2);
        INSERT INTO category  VALUES (1388, "Монтаж охранно-пожарных систем", 1387, 2);
        INSERT INTO category  VALUES (1389, "Услуги инкассации", 1387, 2);
        INSERT INTO category  VALUES (1390, "Услуги охраны", 1387, 2);
        INSERT INTO category  VALUES (1391, "Ремонт и обслуживание авто- и мототехники", 1343, 2);
        INSERT INTO category  VALUES (1392, "Автомойки", 1391, 2);
        INSERT INTO category  VALUES (1393, "Автосигнализация установка", 1391, 2);
        INSERT INTO category  VALUES (1394, "Ремонт автоэлектрики", 1391, 2);
        INSERT INTO category  VALUES (1395, "Ремонт и техобслуживание авто- и мототехники;", 1391, 2);
        INSERT INTO category  VALUES (1396, "Риэлтерские услуги. Недвижимость", 1343, 2);
        INSERT INTO category  VALUES (1397, "Агентства недвижимости, риэлторы", 1396, 2);
        INSERT INTO category  VALUES (1398, "Аренда жилья и офисов", 1396, 2);
        INSERT INTO category  VALUES (1399, "Аренда производственных, торговых площадей", 1396, 2);
        INSERT INTO category  VALUES (1400, "Управление недвижимым имуществом", 1396, 2);
        INSERT INTO category  VALUES (1401, "Оценка, регистрация", 1396, 2);
        INSERT INTO category  VALUES (1402, "Реклама. Полиграфия. СМИ", 1343, 2);
        INSERT INTO category  VALUES (1403, "Газеты, журналы", 1402, 2);
        INSERT INTO category  VALUES (1404, "Маркетинговые, социологические исследования", 1402, 2);
        INSERT INTO category  VALUES (1405, "Наружная реклама", 1402, 2);
        INSERT INTO category  VALUES (1406, "PR, связи с общественностью", 1402, 2);
        INSERT INTO category  VALUES (1407, "Видеостудии", 1402, 2);
        INSERT INTO category  VALUES (1408, "Дизайн рекламы", 1402, 2);
        INSERT INTO category  VALUES (1409, "Информационные агентства", 1402, 2);
        INSERT INTO category  VALUES (1410, "Издательства, типографии", 1402, 2);
        INSERT INTO category  VALUES (1411, "Печати и штампы", 1402, 2);
        INSERT INTO category  VALUES (1412, "Рекламные агентства", 1402, 2);
        INSERT INTO category  VALUES (1413, "Фотостудии", 1402, 2);
        INSERT INTO category  VALUES (1414, "Строительство", 1343, 2);
        INSERT INTO category  VALUES (1415, "Архитектурно-строительное проектирование", 1414, 2);
        INSERT INTO category  VALUES (1416, "Быстровозводимые здания, сооружения", 1414, 2);
        INSERT INTO category  VALUES (1417, "Дизайн интерьеров, ландшафтный дизайн", 1414, 2);
        INSERT INTO category  VALUES (1418, "Индивидуальное жилищное строительство", 1414, 2);
        INSERT INTO category  VALUES (1419, "Монтаж инженерных систем и оборудования", 1414, 2);
        INSERT INTO category  VALUES (1420, "Сантехнические работы", 1414, 2);
        INSERT INTO category  VALUES (1421, "Строительство жилых кварталов, бизнес центров", 1414, 2);
        INSERT INTO category  VALUES (1422, "Строительная техника и оборудование", 1414, 2);
        INSERT INTO category  VALUES (1423, "Строительство специальных сооружений,", 1414, 2);
        INSERT INTO category  VALUES (1424, "Строительство бань, саун", 1414, 2);
        INSERT INTO category  VALUES (1425, "Промышленное строительство", 1414, 2);
        INSERT INTO category  VALUES (1426, "Реконструкция и капремонт зданий", 1414, 2);
        INSERT INTO category  VALUES (1427, "Ремонт, отделка помещений", 1414, 2);
        INSERT INTO category  VALUES (1428, "Фасадные работы", 1414, 2);
        INSERT INTO category  VALUES (1429, "Электромонтажные и электроизмерительные работы", 1414, 2);
        INSERT INTO category  VALUES (1430, "Прочие услуги в сфере строительства и ремонта", 1414, 2);
        INSERT INTO category  VALUES (1431, "Транспорт. Грузоперевозки. Логистика.", 1343, 2);
        INSERT INTO category  VALUES (1432, "Аренда и прокат транспорта", 1431, 2);
        INSERT INTO category  VALUES (1433, "Автомобильные грузоперевозки", 1431, 2);
        INSERT INTO category  VALUES (1434, "Ж/д грузоперевозки", 1431, 2);
        INSERT INTO category  VALUES (1435, "Морские, речные грузоперевозки", 1431, 2);
        INSERT INTO category  VALUES (1436, "Пассажирские авиаперевозки", 1431, 2);
        INSERT INTO category  VALUES (1437, "Пассажирские автоперевозки", 1431, 2);
        INSERT INTO category  VALUES (1438, "Пассажирские ж/д перевозки", 1431, 2);
        INSERT INTO category  VALUES (1439, "Пассажироперевозки морские, речные", 1431, 2);
        INSERT INTO category  VALUES (1440, "Такси", 1431, 2);
        INSERT INTO category  VALUES (1441, "Услуги складского хранения", 1431, 2);
        INSERT INTO category  VALUES (1442, "Экспресс-доставка", 1431, 2);
        INSERT INTO category  VALUES (1443, "Услуги досуга, отдыха. Общепит.", 1343, 2);
        INSERT INTO category  VALUES (1444, "Базы отдыха", 1443, 2);
        INSERT INTO category  VALUES (1445, "Гостиницы, отели, гостевые дома.", 1443, 2);
        INSERT INTO category  VALUES (1446, "Организация активных туров", 1443, 2);
        INSERT INTO category  VALUES (1447, "Прокат спортинвентаря, техники", 1443, 2);
        INSERT INTO category  VALUES (1448, "Профессиональные спортивные клубы", 1443, 2);
        INSERT INTO category  VALUES (1449, "Спортивно-интеллектуальные клубы", 1443, 2);
        INSERT INTO category  VALUES (1450, "Тренажерные залы", 1443, 2);
        INSERT INTO category  VALUES (1451, "Фитнес-клубы", 1443, 2);
        INSERT INTO category  VALUES (1452, "Туристические агентства, туроператоры", 1443, 2);
        INSERT INTO category  VALUES (1453, "Бары, рестораны", 1443, 2);
        INSERT INTO category  VALUES (1454, "Бильярд", 1443, 2);
        INSERT INTO category  VALUES (1455, "Боулинг", 1443, 2);
        INSERT INTO category  VALUES (1456, "Кафе", 1443, 2);
        INSERT INTO category  VALUES (1457, "Кофейни", 1443, 2);
        INSERT INTO category  VALUES (1458, "Караоке клубы", 1443, 2);
        INSERT INTO category  VALUES (1459, "Кинотеатры", 1443, 2);
        INSERT INTO category  VALUES (1460, "Музеи", 1443, 2);
        INSERT INTO category  VALUES (1461, "Ночные клубы", 1443, 2);
        INSERT INTO category  VALUES (1462, "Организация и проведение праздников", 1443, 2);
        INSERT INTO category  VALUES (1463, "Парки культуры и отдыха", 1443, 2);
        INSERT INTO category  VALUES (1464, "Развлекательные комплексы", 1443, 2);
        INSERT INTO category  VALUES (1465, "Театры", 1443, 2);
        INSERT INTO category  VALUES (1466, "Услуги в сфере красоты", 1343, 2);
        INSERT INTO category  VALUES (1467, "Салоны красоты", 1466, 2);
        INSERT INTO category  VALUES (1468, "SPA-салоны", 1466, 2);
        INSERT INTO category  VALUES (1469, "Косметология", 1466, 2);
        INSERT INTO category  VALUES (1470, "Прочие услуги", 1343, 2);
        INSERT INTO category  VALUES (1471, "Ателье", 1470, 2);
        INSERT INTO category  VALUES (1472, "Ветеринарные услуги", 1470, 2);
        INSERT INTO category  VALUES (1473, "Дезинфекция, дератация, дезинсекция", 1470, 2);
        INSERT INTO category  VALUES (1474, "Доставка товаров, еды, цветов", 1470, 2);
        INSERT INTO category  VALUES (1475, "Изготовление и ремонт мебели", 1470, 2);
        INSERT INTO category  VALUES (1476, "Изготовление ключей, ремонт замков, заточка инструмента", 1470, 2);
        INSERT INTO category  VALUES (1477, "Клининговые услуги", 1470, 2);
        INSERT INTO category  VALUES (1478, "Коммунальные службы", 1470, 2);
        INSERT INTO category  VALUES (1479, "Ремонт бытовой, аудио-, видеотехники", 1470, 2);
        INSERT INTO category  VALUES (1480, "Прачечные и химчистки", 1470, 2);
        INSERT INTO category  VALUES (1481, "Ритуальные услуги", 1470, 2);
        INSERT INTO category  VALUES (1482, "Справочно-информационные услуги", 1470, 2);
        INSERT INTO category  VALUES (1483, "Утилизация, вывоз, переработка отходов", 1470, 2);
        INSERT INTO category  VALUES (1484, "Часовые мастерские", 1470, 2);
        INSERT INTO category  VALUES (1485, "Ювелирные мастерские", 1470, 2);
        INSERT INTO category  VALUES (1486, "Фото-видеосъемка", 1470, 2);
        INSERT INTO category  VALUES (16161, "Авто-мото химия", 1230, 1);
        INSERT INTO category  VALUES (16162, "Автосигнализации", 1230, 1);
        INSERT INTO category  VALUES (16163, "Автоэмали/автоаэрографии", 1230, 1);
        INSERT INTO category  VALUES (16164, "Шины/диски", 1230, 1);
        INSERT INTO category  VALUES (16165, "Авто -чехлы/ковры", 1230, 1);
        INSERT INTO category  VALUES (16166, "Тюнинговые комплектующие", 1230, 1);
        INSERT INTO category  VALUES (16167, "Авто -стекла/зеркала", 1230, 1);
        INSERT INTO category  VALUES (16168, "Авто-кондиционеры", 1230, 1);
        INSERT INTO category  VALUES (16169, "Электрооборудование", 1230, 1);
        INSERT INTO category  VALUES (16170, "Звуковое оборудование", 1230, 1);
                
        
        
        ');
        $this->createTable('{{%account_category}}',[
            'id'=>$this->primaryKey(),
            'account_id'=>$this->integer(),
            'category_id'=>$this->integer()
        ]);

        $this->createIndex('fk_account_id','{{%account_category}}','account_id');
        $this->addForeignKey('fk_account_id','{{%account_category}}','account_id','{{%account}}','id','SET NULL','CASCADE');
        $this->createIndex('fk_category_id','{{%account_category}}','category_id');
        $this->addForeignKey('fk_category_id','{{%account_category}}','category_id','{{%category}}','id','SET NULL','CASCADE');
    }

    public function safeDown()
    {
       $this->delete('category');
       $this->delete('category_type');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
