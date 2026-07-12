<?php
//плохо
class OrderService {
    private MySQLDatabase $db; // жёсткая зависимость от конкретной БД

    public function __construct() {
        $this->db = new MySQLDatabase();
    }
}

//хорошо
interface DatabaseInterface {
    public function save(Order $order): void;
    public function find(int $id): ?Order;
}

class OrderService {
    public function __construct(
        private DatabaseInterface $db,   // зависимость от абстракции
        private PaymentGateway $gateway
    ) {}
}

// Внедряем через конструктор (Dependency Injection)
$service = new OrderService(new PostgreSQLDatabase(), new StripeGateway());