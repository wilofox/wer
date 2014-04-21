-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 23-08-2011 a las 18:31:48
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `datablanco`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `contafiles`
-- 

CREATE TABLE `contafiles` (
  `id` int(11) NOT NULL auto_increment,
  `tienda` varchar(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cc` varchar(5) NOT NULL,
  `aplicacion` varchar(1) NOT NULL,
  `documentos` varchar(50) NOT NULL,
  `periodo` varchar(1) NOT NULL,
  `fechap` datetime NOT NULL,
  `fcreacion` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `cbi` varchar(10) NOT NULL,
  `dbi` varchar(1) NOT NULL,
  `cigv` varchar(10) NOT NULL,
  `digv` varchar(1) NOT NULL,
  `ctotal` varchar(10) NOT NULL,
  `dtotal` varchar(1) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;
