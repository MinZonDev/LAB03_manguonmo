<?php

// Lớp kết nối CSDL
class Db {

    // Biến kết nối CSDL
    protected static $connection;

    // Hàm kết nối CSDL
    public function connect() {
        // Kết nối tới CSDL trong trường hợp kết nối chưa được khởi tạo
        if (!isset(self::$connection)) {
            include_once 'config.php';

            self::$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            // Xử lý lỗi nếu kết nối không thành công
            if (self::$connection->connect_error) {
                die("Kết nối CSDL thất bại: " . self::$connection->connect_error);
            }
            echo "Kết nối thành công";
        }
        return self::$connection;
    }

    // Hàm thực hiện truy vấn CSDL
    public function query_execute($queryString) {
        // Khởi tạo kết nối
        $connection = $this->connect();

        // Thực hiện truy vấn
        $result = $connection->query($queryString);

        return $result;
    }

    // Hàm lấy kết quả truy vấn dạng mảng
    public function select_to_array($queryString) {
        // Khởi tạo mảng kết quả
        $rows = array();

        // Lấy kết quả truy vấn
        $result = $this->query_execute($queryString);

        // Duyệt qua từng dòng kết quả và lưu vào mảng
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }

        return $rows;
    }

}
?>
