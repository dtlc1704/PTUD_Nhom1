<?php
// Database connection parameters
$host = 'localhost'; // or your server IP
$username = 'root';  // your MySQL username
$password = '';      // your MySQL password (empty if no password)
$dbname = 'Sanpham'; // database name
$port = 3307;
// Create a connection to MySQL
$conn = new mysqli($host, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database "Sanpham"
$sql_create_db = "CREATE DATABASE IF NOT EXISTS Sanpham";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists.\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the "Sanpham" database to use it
$conn->select_db($dbname);

// Create the tables

// Customer Table
$sql_create_customer = "
CREATE TABLE IF NOT EXISTS Customer (
    customer_id INT NOT NULL PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(255),
    address VARCHAR(50),
    gender VARCHAR(10),
    year INT
)";
if ($conn->query($sql_create_customer) === TRUE) {
    echo "Customer table created successfully.\n";
} else {
    echo "Error creating Customer table: " . $conn->error;
}

// Orders Table
$sql_create_orders = "
CREATE TABLE IF NOT EXISTS Orders (
    order_id INT NOT NULL PRIMARY KEY,
    country VARCHAR(100),
    order_address VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(20),
    created_at DATETIME,
    customer_id INT,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
)";
if ($conn->query($sql_create_orders) === TRUE) {
    echo "Orders table created successfully.\n";
} else {
    echo "Error creating Orders table: " . $conn->error;
}

// Brand Table
$sql_create_brand = "
CREATE TABLE IF NOT EXISTS Brand (
    brand_id INT NOT NULL PRIMARY KEY,
    name VARCHAR(255),
    created_at DATETIME
)";
if ($conn->query($sql_create_brand) === TRUE) {
    echo "Brand table created successfully.\n";
} else {
    echo "Error creating Brand table: " . $conn->error;
}

// Product Category Table
$sql_create_product_category = "
CREATE TABLE IF NOT EXISTS Product_category (
    product_category_id INT NOT NULL PRIMARY KEY,
    name VARCHAR(255),
    created_at DATETIME
)";
if ($conn->query($sql_create_product_category) === TRUE) {
    echo "Product_category table created successfully.\n";
} else {
    echo "Error creating Product_category table: " . $conn->error;
}

// Product Table
$sql_create_product = "
CREATE TABLE IF NOT EXISTS Product (
    product_id INT NOT NULL PRIMARY KEY,
    brand_id INT,
    product_category_id INT,
    name VARCHAR(255),
    description TEXT,
    content TEXT,
    price DECIMAL(10,2),
    qty INT,
    hashtag VARCHAR(255),
    created_at DATETIME,
    FOREIGN KEY (brand_id) REFERENCES Brand(brand_id),
    FOREIGN KEY (product_category_id) REFERENCES Product_category(product_category_id)
)";
if ($conn->query($sql_create_product) === TRUE) {
    echo "Product table created successfully.\n";
} else {
    echo "Error creating Product table: " . $conn->error;
}

// Product Comment Table
$sql_create_product_comment = "
CREATE TABLE IF NOT EXISTS Product_comment (
    product_comment_id INT NOT NULL PRIMARY KEY,
    customer_id INT,
    product_id INT,
    email VARCHAR(255),
    name VARCHAR(100),
    messages TEXT,
    rating INT,
    created_at DATETIME,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
)";
if ($conn->query($sql_create_product_comment) === TRUE) {
    echo "Product_comment table created successfully.\n";
} else {
    echo "Error creating Product_comment table: " . $conn->error;
}

// Product Detail Table
$sql_create_product_detail = "
CREATE TABLE IF NOT EXISTS Product_detail (
    product_detail_id INT NOT NULL PRIMARY KEY,
    product_id INT,
    color VARCHAR(50),
    size VARCHAR(10),
    material VARCHAR(50),
    detail_qty INT,
    created_at DATETIME,
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
)";
if ($conn->query($sql_create_product_detail) === TRUE) {
    echo "Product_detail table created successfully.\n";
} else {
    echo "Error creating Product_detail table: " . $conn->error;
}

// Order Detail Table
$sql_create_order_detail = "
CREATE TABLE IF NOT EXISTS Order_detail (
    order_detail_id INT NOT NULL PRIMARY KEY,
    order_id INT,
    product_id INT,
    qty INT,
    amount DECIMAL(10,2),
    discount DECIMAL(10,2),
    total DECIMAL(10,2),
    created_at DATETIME,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
)";
if ($conn->query($sql_create_order_detail) === TRUE) {
    echo "Order_detail table created successfully.\n";
} else {
    echo "Error creating Order_detail table: " . $conn->error;
}

// Blog Table
$sql_create_blog = "
CREATE TABLE IF NOT EXISTS Blog (
    blog_id INT NOT NULL PRIMARY KEY,
    customer_id INT,
    title VARCHAR(255),
    name VARCHAR(50),
    image VARCHAR(255),
    category VARCHAR(255),
    content TEXT,
    created_at DATETIME,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
)";
if ($conn->query($sql_create_blog) === TRUE) {
    echo "Blog table created successfully.\n";
} else {
    echo "Error creating Blog table: " . $conn->error;
}

// Blog Comment Table
$sql_create_blog_comment = "
CREATE TABLE IF NOT EXISTS Blog_comment (
    blog_comment_id INT NOT NULL PRIMARY KEY,
    customer_id INT,
    blog_id INT,
    name VARCHAR(50),
    messages TEXT,
    created_at DATETIME,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (blog_id) REFERENCES Blog(blog_id)
)";
if ($conn->query($sql_create_blog_comment) === TRUE) {
    echo "Blog_comment table created successfully.\n";
} else {
    echo "Error creating Blog_comment table: " . $conn->error;
}

// Close the connection
$conn->close();
?>