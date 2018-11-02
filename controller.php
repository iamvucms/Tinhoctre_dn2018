<?php
/**
 * @package TOIDICODEDB
 * @author  Toidicode Team
 * @copyright   Copyright (c) 2017, toidicode.com
 * @link    https://toidicode.com
 * @since   Version 1.0
 */
class mys
{
    /**
     * $host Chứa thông tin host
     * @var string
     */
    private $host = 'localhost';
    /**
     * $username Tài khoản truy cập mysql
     * @var string
     */
    private $username = 'root';
    /**
     * $password Mật khẩu truy cập sql
     * @var string
     */
    private $password = '';
    /**
     * $databaseName Tên Database các bạn muốn kết nối
     * @var string
     */
    private $databaseName = 'test';
    /**
     * $charset Dạng ký tự
     * @var string
     */
    private $charset = 'utf8';
    /**
     * $conn Lưu trữ lớp kết nối
     * @var objetc
     */
    public $conn;
    /**
     * debug lỗi, true là hiển thị, false là tắt
     * @var boolean
     */
    private $debug = true;
    /**
     * __construct Hàm khởi tạo
     * @return void;
     */
    public function __construct()
    {
        $this->connect();
    }
    /**
     * connect Kết nối
     * @return void
     */
    public function connect()
    {
        if (!$this->conn) {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->databaseName);
            if (mysqli_connect_errno()) {
                echo 'Failed: ' . mysqli_connect_error();
                die();
            }
            mysqli_set_charset($this->conn, $this->charset);
        }
    }
    /**
     * disConnect Ngắt kết nối
     * @return void
     */
    public function disConnect()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
    /**
     * error Hiển thị lỗi
     * @return string
     */
    public function error()
    {
        if ($this->conn && $this->debug === true) {
            return mysqli_error($this->conn);
        } else {
            return false;
        }
    }
    /**
     * insert thêm dữ liẹu
     * @param string $table tên bảng muốn thêm, array $data dữ liệu cần thêm
     * @return boolean
     */
    public function insert($table = '', $data = [])
    {
        $keys   = '';
        $values = '';
        foreach ($data as $key => $value) {
            $keys .= ',' . $key;
            $values .= ',"' . mysqli_real_escape_string($this->conn, $value) . '"';
        }
        $sql = 'INSERT INTO ' . $table . '(' . trim($keys, ',') . ') VALUES (' . trim($values, ',') . ')';
        return mysqli_query($this->conn, $sql);
    }
    /**
     * update sửa dữ liệu
     * @param string $table tên bảng muốn sửa, array $data dữ liệu cần sửa, array|int $id điều kiện
     * @return boolean
     */
    public function update($table = '', $data = [], $id = [])
    {
        $content = '';
        if (is_integer($id)) {
            $where = 'id = ' . $id;
        } else if (is_array($id) && count($id) == 1) {
            $listKey = array_keys($id);
            $where   = $listKey[0] . '=' . $id[$listKey[0]];
        } else {
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        }
        foreach ($data as $key => $value) {
            $content .= ',' . $key . '="' . mysqli_real_escape_string($this->conn, $value) . '"';
        }
        $sql = 'UPDATE ' . $table . ' SET ' . trim($content, ',') . ' WHERE ' . $where;
        return mysqli_query($this->conn, $sql);
    }
    /**
     * delete xóa dữ liệu
     * @param string $table tên bảng muốn xóa, array|int điều kiện
     * @return boolean
     */
    public function delete($table = '', $id = [])
    {
        $content = '';
        if (is_integer($id)) {
            $where = 'id = ' . $id;
        } else if (is_array($id) && count($id) == 1) {
            $listKey = array_keys($id);
            $where   = $listKey[0] . '=' . $id[$listKey[0]];
        } else {
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        }
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;
        return mysqli_query($this->conn, $sql);
    }
    /**
     * getObject lấy hết dữ liệu trong bảng trả về mảng đối tượng
     * @param string $table tên bảng muốn lấy ra dữ liệu
     * @return array objetc
     */
    public function getObject($table = '')
    {
        $sql  = 'SELECT * FROM ' . $table;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_object($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        return false;
    }
    /**
     * getObject lấy hết dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu
     * @return array
     */
    public function getArray($table = '')
    {
        $sql  = 'SELECT * FROM ' . $table;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        } else {
            return false;
        }
    }
    /**
     * getRowObject lấy một dòng dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu, array|int $id điều kiện
     * @return object
     */
    public function getRowObject($table = '', $id = [])
    {
        if (is_integer($id)) {
            $where = 'id = ' . $id;
        } else if (is_array($id) && count($id) == 1) {
            $listKey = array_keys($id);
            $where   = $listKey[0] . '=' . $id[$listKey[0]];
        } else {
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        }
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $where;
        if ($result = mysqli_query($this->conn, $sql)) {
            $data = mysqli_fetch_object($result);
            mysqli_free_result($result);
            return $data;
        } else {
            return false;
        }
    }
    /**
     * getRowArray lấy một dòng dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu, array|int $id điều kiện
     * @return array
     */
    public function getRowArray($table = '', $id = [])
    {
        if (is_integer($id)) {
            $where = 'id = ' . $id;
        } else if (is_array($id) && count($id) == 1) {
            $listKey = array_keys($id);
            $where   = $listKey[0] . '=' . $id[$listKey[0]];
        } else {
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        }
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $where;
        if ($result = mysqli_query($this->conn, $sql)) {
            $data = mysqli_fetch_array($result);
            mysqli_free_result($result);
            return $data;
        } else {
            return false;
        }
    }
    /**
     * query thực hiện query
     * @param string $sql
     * @return boolean|array
     */
    public function query($sql = '', $return = true)
    {
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($return === true) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[] = $row;
                }
                mysqli_free_result($result);
                return $data;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    /**
     * __destruct hàm hủy
     * @param none
     * @return void
     */
    public function __destruct()
    {
        $this->disConnect();
    }
}