# authProject

О проекте:

Участвовал в марафоне где надо было добавить функциональность на верстке (данный на марафоне).
Основная задача программы это простая социальная сеть к которому можно войти, посмотреть данные других пользователей, изменить свои данные.
А для регистрации нужно логин и пароль с повтором, а остальное пишется после по желанию (место жительство, Имя, Фамилия, и т.д.)

Цель:

- Сделать простую логику на верстке за короткий срок (1 - 2 дня)
- Редирект если не авторизован (пока на нескольких страницах)
- Авторизация, регистрация
- Редактирование пользователя (Если админ можно всех, если нет только свою)
- Показ данных пользователей


Примечание:

- Нельзя было добавлять библиотеки и прочее (Идея написать простой велосипед руками)
- Верстку особо не трогал (Не разделял хедер и футер. В основном из-за нескольких видов Хедера)
- Основная страница (Users.php)


Добавил некие правила приличия ООП (показывающий текущий навык и теорию по ООП):

В нем есть (3 кита из 4, часть шаблона проектирования SOLID, а именно пока S(где класс должен выполнять что то одно)):
- Наследование - пока что 1 родительский класс в котором происходит валидация 
- Инкапсуляция (защитил данные в PDO, private, геттеры)
- пример Полиморфизма пока нету
- Абстракция (думаю в папках функция я показал самые необходимые и простые функции, а остальные (н\р валидация) скрыл
- S - принцип единственной ответственности (классы выполняет написанную роль)

