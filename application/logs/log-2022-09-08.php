<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-08 08:20:41 --> Query error: Unknown column 'm_produk.harga_beli' in 'field list' - Invalid query: SELECT `m_produk`.`id`, `m_produk`.`name`, `m_produk`.`m_jenis_produk_id`, `m_produk`.`harga_beli`, `m_produk`.`harga_jual_normal`, `m_produk`.`harga_jual_reseller`, `m_produk`.`berat`, `m_produk`.`satuan`, `m_produk`.`stok`, `m_produk`.`image_url`, `m_produk`.`status_data`, `m_jenis_produk`.`name` as `jenis_produk`, `m_kategori_produk`.`name` as `kategori_produk`
FROM `m_jenis_produk` `m_jenis_produk`, `m_kategori_produk` `m_kategori_produk`, `m_produk` `m_produk`
WHERE `m_produk`.`status_data` != 'deleted' AND `m_produk`.`m_jenis_produk_id` = `m_jenis_produk`.`id`
AND `m_produk`.`m_kategori_produk_id` = `m_kategori_produk`.`id`
ORDER BY `m_produk`.`id` DESC