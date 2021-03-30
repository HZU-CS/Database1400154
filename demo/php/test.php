<?php
// 连接数据库
// 参考https://www.runoob.com/php/func-mysqli-connect.html
$link = mysqli_connect("localhost", "root", "root", "test", 3306);
if (mysqli_connect_error()) {
    // 连接数据库失败，关闭连接
    die("数据库连接错误");
}

// 查询语句
$query = "SELECT * FROM books;";
// 执行查询语句，返回true如果查询语句无错误
if ($result = mysqli_query($link, $query)) {
    // 获取查询语句返回的结果
    $res = mysqli_fetch_all($result);
    // 打印结果
    echo "<pre>";
    print_r($res);
    echo "</pre>";
} else {
    echo "查询语句执行失败";
}

// 插入语句
$query = "INSERT INTO books (title, author_fname, author_lname, released_year, stock_quantity, pages)
VALUES ('测试插入', '测试fname', '测试lname', Year(now()), 7355608, 999)";
if ($result = mysqli_query($link, $query)) {
    echo "插入语句执行成功" . "<br>";
} else {
    echo "插入语句执行失败" . "<br>";
}

// 修改语句
$query = "UPDATE books SET author_fname = '修改fname' WHERE author_fname = '测试fname'";
if ($result = mysqli_query($link, $query)) {
    echo "修改语句执行成功" . "<br>";
} else {
    echo "修改语句执行失败" . "<br>";
}

// 删除语句
$query = "DELETE FROM books WHERE author_fname = '修改fname'";
if ($result = mysqli_query($link, $query)) {
    echo "删除语句执行成功" . "<br>";
} else {
    echo "删除语句执行失败" . "<br>";
}

// 执行完毕，关闭连接
mysqli_close($link);
?>