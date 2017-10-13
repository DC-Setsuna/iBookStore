#iBook Store Data
##Table 1:

* table name: book
* id: 10位**INT**自增 补零  **PRIMARY KEY**
* book_title: 12位 **VARCHAR** 唯一
* book_author: 10位 **VARCHAR**
* book_price: **Decimal(6,2)**
* book_class: 8位**VARCHAR**
* book_rate: **Decimal(2,1)** 最大值5
* sales_count: 8位**INT** 初始为0 自增
* img_url: 不用保存图片文件，只要url
* introduce: 书的介绍

<style>
body {
	font-size: 18px;
}

</style>