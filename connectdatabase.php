<?php 

function ConnectDB()
{
	try
	{
	$conn = new PDO("mysql:host=localhost;dbname=library","root","mysql");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$conn->query("SET NAMES UTF8");//thiết lập chế độ unicode
	}
	catch(PDOException $ex)
	{
		echo "<p>" . $ex->getMessage() . "</p>";//thông báo lỗi hệ thống
		die ("<h3> LỖI KẾT NỐI CSDL </h3>");
	}
	return $conn;
}
function getAllBooks($keyword="")
{
    $conn = ConnectDB();
    if($conn==NULL)
        return -1;//Lỗi kết nối CSDL
    $sql = "SELECT * FROM books ";
    if($keyword!="")
        $sql .= " WHERE title LIKE '%$keyword%'";
    $pdo_stm = $conn->prepare($sql);
    $ketqua = $pdo_stm->execute();//trả về TRUE/FALSE
    if($ketqua == FALSE)
        return -2;//lỗi SQL
    else{
        $rows = $pdo_stm->fetchAll();
        return $rows;
    }    
}
?>
