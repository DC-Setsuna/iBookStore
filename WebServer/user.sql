-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2017-10-15 06:21:11
-- 服务器版本： 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ibook`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(0000000001, 'dengcheng', 'dengcheng'),
(0000000002, 'dengchengpst', 'dengcheng123'),
(0000000003, 'dengchenghh', 'dengcheng123'),
(0000000004, 'qwerqwer', '12341234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;